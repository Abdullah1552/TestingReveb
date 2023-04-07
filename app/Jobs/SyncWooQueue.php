<?php

namespace App\Jobs;

use App\Models\WooSyncHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\WooSyncTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class SyncWooQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, WooSyncTrait;
    protected $company_id , $sync_history_id ;

    protected $sync_cats = [];
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
            $this->woo_sync();


            $sync_history_record = WooSyncHistory::with('user')->find($this->sync_history_id);


            $data = [
                'user' => $sync_history_record->user,
                'time' => $sync_history_record->updated_at->diffForHumans(),
                'sync_type' => "Upload Product WooCommerce ",
            ];



            DB::table('woo_sync_histories')->where('id',$this->sync_history_id)->update([
                'is_completed' => '1',
                'categories_arr' => $this->sync_cats,
                'products_arr' => $this->sync_products,
                'variants_arr' => $this->sync_variants,
            ]);

            Mail::send('email.syncwooEmail',$data , function($message) use($sync_history_record){
                $message->to($sync_history_record->user->email);
                $message->subject('Upload Product WooCommerce synchronizing Completed');
            });

        }catch (\Exception $e){
            $error = $e->getFile().' \t Line: '.$e->getLine().'  \n '.$e->getMessage().'  \n '.$e->getTraceAsString();

            DB::table('woo_sync_histories')->where('id',$this->sync_history_id)->update([
                'exception' => $error,
                'categories_arr' => $this->sync_cats,
                'products_arr' => $this->sync_products,
                'variants_arr' => $this->sync_variants,
            ]);
        }


    }

    public function woo_sync()
    {



        // check which product catergories are not on woocomerce
        $cats = DB::table('categories')->select('id')->get();
        foreach ($cats as  $cat){
            if(  $this->check_woo_category($cat->id) !== true){
                $this->sync_cats[]= $cat->id;
            }
        }

         // Upload product catergories are not on woocomerce
         foreach ($this->sync_cats as $cat) {
             $this->sync_category($cat);
         }

        // check which product are not on woocomerce
        $products = DB::table('products')->select('id')->get();
        foreach ($products as  $product){
            if(  $this->check_woo_product($product->id) !== true){
                $this->sync_products[]= $product->id;
            }
        }


        // Upload products  are not on woocomerce
        foreach ($this->sync_products as $product) {
            $this->sync_product($product);
        }


        // check which product variants are not on woocomerce
        $variants = DB::table('product_variants')->select('id')->get();
        foreach ($variants as  $variant){
            if( $this->check_woo_variant($variant->id) !== true){
                $this->sync_variants[]= $variant->id;
            }
        }

        // Upload products variants  on woocomerce
        foreach ($this->sync_variants as $variant) {
            $this->sync_variant($variant);
        }




    }

}

