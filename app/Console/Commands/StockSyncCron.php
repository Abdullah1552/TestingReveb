<?php

namespace App\Console\Commands;

use App\Helpers\helpers;
use App\Models\{Product\ProductVariant,Product};
use Illuminate\Console\Command;
use App\Http\Controllers\Woocomerce\Woocomerce_Products;

class StockSyncCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocksync:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public $message=[];

    public function handle()
    {

        set_time_limit(0);
        \Log::info("Cron is working fine! on ". config('woocommerce.store_url'));
        $products = Product::with('variants')
            ->select('*')
            // ->orderBy('products.id','Desc')
            // ->where('products.id',12)
            ->get();
        foreach ($products as $product){

            //Update Products
            $product_id = $product->w_id;
            $stock_quantity=helpers::product_updated_stock($product->id);
            $data = [
                'stock_quantity' =>$stock_quantity ,
            ];
            \Log::info('Product Process start '.$product->product_code.' updating stock ');
            Woocomerce_Products::update_product($product_id,null,$data);

            //Update Variants
            if($product->is_variant=="1"){
                foreach ($product->variants as $variant){
                    $variation_id=ProductVariant::where('item_code', $variant->item_code)->value('v_id');
                    $stock_quantity=helpers::updated_stock($variant->item_code);
                    $data = [
                        'stock_quantity' =>$stock_quantity ,
                    ];
                    \Log::info('Product Process start '.$product->product_code.' updating stock V '.$variant->item_code);
                    Woocomerce_Products::update_product($product_id,$variation_id,$data);
                }

            }
        }

    }
}
