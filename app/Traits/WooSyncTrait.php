<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\{Product\ProductVariant,Product};
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Http;
use App\Helpers\helpers;
use Codexshaper\WooCommerce\Models\Variation;


trait WooSyncTrait
{
    // this function will check product Category exist on woocomerce or not
    function check_woo_category($id){
        $cat = DB::table('categories')->find($id);
        if(isset($cat->w_cat_id) && $cat->w_cat_id ){
            $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products/categories/'.$cat->w_cat_id.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'));
            if($response->status() == 404){
                return $cat->id;
            }
        }else{
            return $cat->id;
        }
        return true;
    }

    function sync_category($id,$update = false){
        $cat_data = DB::table('categories')->find($id);

        if($update == true && isset($cat_data->w_cat_id) && $cat_data->w_cat_id){
            $response = Http::put(config('woocommerce.store_url').'/wp-json/wc/v3/products/categories/'.$cat_data->w_cat_id.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),['name'=>$cat_data->name]);
        }else{
            $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products/categories?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),['name'=>$cat_data->name]);
        }


        if( $response->status() == 201 && isset($response->json()['id'])  && $response->json()['id']){
            DB::table('categories')->where('id',$id)->update(['w_cat_id'=>$response->json()['id']]);
            return true;
        } else if ($response->status() == 400 && isset($response->json()['data']['resource_id']) && $response->json()['data']['resource_id']) {
            DB::table('categories')->where('id',$id)->update(['w_cat_id'=>$response->json()['data']['resource_id']]);
            return true;
        }
        return false;
    }

    // this function will check product exist on woocomerce or not
    // if exist it will return true else it will return its id
    function check_woo_product($id)
    {
        $product = DB::table('products')->select('*')->find($id);
        if(isset($product->w_id) && $product->w_id ){
            $response = Http::get(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$product->w_id.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'));
            if($response->status() == 404)
                return $product->id;
        }else{
            return $product->id;
        }
        return true;
    }

    // this function will upload product to woocomerce
    function sync_product($id){
        $product = Product::with('variants')->find($id);
        $woo_product = [
            "name" => $product->name,
            "stock_quantity" => helpers::product_updated_stock($product->id),
            "regular_price" => $product->product_price,
            "sale_price"=>$product->product_price,
            "description"=>isset($product->detail)?$product->detail:"",
            'manage_stock'=>true,
            'stock_status'=>'instock',
            'weight' =>$product->weight,
            'sku'=>$product->product_code,
            'type'=>(isset($product->is_variant) && $product->is_variant ?'variable':'simple'),
            "categories"=>[
                [
                    'id' => DB::table('categories')->find($product->product_category)->w_cat_id
                ]
            ],
        ];


        if ($product->is_variant == '1' && $product->variants) {

            $attribute = $product->variants[0]->attribute;
            $attribute_rec = DB::table('attributes')
                ->where(DB::raw('lower(name)'), strtolower($attribute))
                ->first();

            $woo_product['attributes'] = [
                [
                    'name' => $product->variants[0]->attribute,
                    'visible' => true,
                    'variation' => true,
                    'options' =>  explode(',', $attribute_rec->attr_value)
                ]
            ];
        }

        $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),$woo_product);

        if( $response->status() == 201 && isset($response->json()['id'])  && $response->json()['id']){
            DB::table('products')->where('id',$id)->update(['w_id'=>$response->json()['id']]);
            if(isset($product->is_variant) && $product->is_variant == "1"){
                $this->sync_product_variant($id);
            }
            return true;

        } else if ($response->status() == 400 && isset($response->json()['data']['resource_id']) && $response->json()['data']['resource_id']) {
            $response = Http::put(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$response->json()['data']['resource_id'].'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),$woo_product);
            DB::table('products')->where('id',$id)->update(['w_id'=>$response->json()['id']]);

            if(isset($product->is_variant) && $product->is_variant == "1"){
                $this->sync_product_variant($id);
            }

            return true;
        }
        return false;

    }

    // this function will upload product's Variants to woocomerce
    function sync_product_variant($id){
        $products = Product::with('variants')
            ->select('*')
            ->where('products.id',$id)
            ->first();

        foreach ($products->variants as $variant) {

            $this->sync_variant($variant->id);
        }

    }

    // this function will check product variant exist on woocomerce or not
    function check_woo_variant($id){
        $variant = ProductVariant::with('products')->find($id);
        if(isset($variant->products,$variant->products->id) && $variant->products->id){
            if( $this->check_woo_product($variant->products->id)  !== true){
                $this->sync_product($variant->products->id);
            }
            if(isset($variant->v_id) && $variant->v_id ){
                $response = Http::get(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$variant->products->w_id.'products'.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'));
                if($response->status() == 404){
                    return $variant->id;
                }
            }else{
                return $variant->id;
            }
        }
        return true;
    }

    // this function will upload product variant to woocomerce
    function sync_variant($id){
        $variant = ProductVariant::with('products')->find($id);
        $price = ($variant->products->product_price) + (isset($variant->additional_price) && is_numeric($variant->additional_price) ? (int) $variant->additional_price : 0);

        $woo_variant = [
            'regular_price' =>(string)$price,
            'sale_price' =>(string)$price,
            'stock_quantity' => helpers::updated_stock($variant->item_code),
            'sku' => $variant->item_code,
            'manage_stock' =>true,
            'stock_status' =>'instock',
            'weight' => $variant->products->weight,
            'attributes'=>[
                [
                    'name'     => $variant->name,
                    'option' => $variant->name,
                ],
            ]
        ];

        $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$variant->products->w_id.'/variations?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),$woo_variant);
        if( $response->status() == 201 && isset($response->json()['id'])  && $response->json()['id']){
            DB::table('product_variants')->where('id',$id)->update(['v_id'=>$response->json()['id']]);
            return true;
        } else if ($response->status() == 400 && isset($response->json()['data']['resource_id']) && $response->json()['data']['resource_id']) {
            $response = Http::put(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$variant->products->w_id.'/variations/'.$response->json()['data']['resource_id'].'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'),$woo_variant);

            if($response->status() == 200 ){
               DB::table('product_variants')->where('id',$id)->update(['v_id'=>$response->json()['id']]);
                return true;
            }
            \Log::info($response->json());





        }
        return false;

    }
}
