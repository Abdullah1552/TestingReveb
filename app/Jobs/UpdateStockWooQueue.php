<?php

namespace App\Jobs;

use App\Traits\WooSyncTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Helpers\helpers;
use App\Models\{Product\ProductVariant,Product};
use Illuminate\Console\Command;
use App\Models\WooSyncHistory;
use App\Http\Controllers\Woocomerce\Woocomerce_Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UpdateStockWooQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ,WooSyncTrait;

    protected $company_id , $sync_history_id ,$current_product;

    protected $sync_products=[];
    protected $sync_variants=[];
    /**
     * Create a new job instance.
     *
     * @param $company_id
     */
    public function __construct($company_id,$sync_history_id)
    {
        $this->company_id = $company_id;
        $this->sync_history_id = $sync_history_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{

            $products = Product::with('variants')
                ->select('*')
                ->where('company_id',$this->company_id)
                ->get();

            foreach ($products as $product){

                if($this->check_woo_product($product->id) === true){

                    $this->sync_products[] = $this->current_product = $product->id;

                    //Update Products
                    $product_id = $product->w_id;
                    $stock_quantity=helpers::product_updated_stock($product->id);
                    $data = [
                        'stock_quantity' =>$stock_quantity ,
                    ];
                    Woocomerce_Products::update_product($product_id,null,$data);

                    //Update Variants
                    if($product->is_variant=="1"){
                        foreach ($product->variants as $variant){
                            if($this->check_woo_variant($variant->id) === true){

                                $this->sync_variants[] =  $variant->id;

                                $variation_id=ProductVariant::where('item_code', $variant->item_code)->value('v_id');
                                $stock_quantity=helpers::updated_stock($variant->item_code);
                                $data = [
                                    'stock_quantity' => $stock_quantity ,
                                ];
                                Woocomerce_Products::update_product($product_id,$variation_id,$data);
                            }

                        }

                    }
                }

            }


            $sync_history_record = WooSyncHistory::with('user')->find($this->sync_history_id);
            $data = [
                'user' => $sync_history_record->user,
                'time' => $sync_history_record->updated_at->diffForHumans(),
                'sync_type' => "Update WooCommerce Stock",
            ];

            DB::table('woo_sync_histories')->where('id',$this->sync_history_id)->update([
                'is_completed' => '1',
                'products_arr' => $this->sync_products,
                'variants_arr' => $this->sync_variants,
            ]);

            Mail::send('email.syncwooEmail',$data , function($message) use($sync_history_record){
                $message->to($sync_history_record->user->email);
                $message->subject('Update WooCommerce Stock synchronizing Completed');
            });


        }catch (\Exception $e){
            $error = $e->getFile().' \t Line: '.$e->getLine().'  \n '.$e->getMessage().'  \n '.$e->getTraceAsString();

            DB::table('woo_sync_histories')->where('id',$this->sync_history_id)->update([
                'exception' => $error,
                'products_arr' => $this->sync_products,
                'variants_arr' => $this->sync_variants,
                'custom_error_message' => "Error on Product: ".$this->current_product ,
            ]);
        }




    }
}
