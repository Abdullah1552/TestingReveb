<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuickFixController extends Controller
{

    // this function was made for stock adjustment error solution
    public function stock_check()
    {
        DB::beginTransaction();
        try{
            /** All stock  records whose product does not exist according to their given product IDs
             *
             */
            $notexisted_prods_stock = DB::table('stock_details')
                ->leftJoin('products', 'products.id', '=', 'stock_details.product_id')
                ->whereNull('products.name')
                ->select('stock_details.*')
                ->get();

            dd($notexisted_prods_stock);
            $updation_detail =  [];
            // stock ids that product does not exist
            $stock_ids =  [];
            foreach ($notexisted_prods_stock as $key => $rec) {

                $prod_code_arr = explode('-',$rec->product_code);
                if(count($prod_code_arr) >1 && isset($prod_code_arr[1])){
                    $code = $prod_code_arr[1];


                    /**** this (below) product ID will be replaced to the stock detail table records whose product
                     doest exist according to product_id column but exist according to its product code ****/
                    $product = DB::table('products')->select('products.id')->where('product_code', $code)->first();

                    if($product && isset($product->id)  ){
                        $updation_detail[$key]['product_code'] = $code;
                        $updation_detail[$key]['stock_rec_id'] = $rec->id;
                        $updation_detail[$key]['product_id_f'] =  $rec->product_id;
                        $updation_detail[$key]['product_id_t'] = $product->id;
                        $update_record = DB::table('stock_details')->where('stock_details.id', $rec->id)
                        ->update([
                            'product_id'=>$product->id
                        ]);
                    } else {
                        $stock_ids[] = $rec->id;
                    }
                }else{

                    $product = DB::table('products')->select('products.id')->where('product_code',  $rec->product_code)->first();
                    if($product && isset($product->id)  ){
                        $updation_detail[$key]['product_code'] = $code;
                        $updation_detail[$key]['stock_rec_id'] = $rec->id;
                        $updation_detail[$key]['product_id_f'] =  $rec->product_id;
                        $updation_detail[$key]['product_id_t'] = $product->id;
                        $update_record = DB::table('stock_details')->where('stock_details.id', $rec->id)
                        ->update([
                            'product_id'=>$product->id
                        ]);
                    } else {
                        $stock_ids[] = $rec->id;
                    }
                }





            }

            // delete  that stocks records that doest not have products
            DB::table('stock_details')->whereIn('stock_details.id', $stock_ids)->delete();


            echo json_encode($updation_detail);
            // echo json_encode($stock_ids);

            DB::commit();
        }catch(\Exception $e){

            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 505);
        }


    }
}
