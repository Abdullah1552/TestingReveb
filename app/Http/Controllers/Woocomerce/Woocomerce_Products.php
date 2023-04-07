<?php

namespace App\Http\Controllers\Woocomerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Woocomerce_Products extends Controller
{
    static function update_product($product_id,$variations_id=0,$data){

        if($variations_id){
            $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$product_id.'/variations/'.$variations_id.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'), $data);
        }else{
            $response = Http::post(config('woocommerce.store_url').'/wp-json/wc/v3/products/'.$product_id.'?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret'), $data);
        }
        if($response->status() !=200){
            \Log::info('Product failed '.$product_id.' updating stock '.json_encode($response->json()));
        };
    }
}
