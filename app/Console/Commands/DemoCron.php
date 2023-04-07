<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
// WhereHouse
use App\Models\WhereHouse;
use App\Models\StockDetails;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
    public function handle()
    {

        $products = Product::with('WH')->leftJoin('brands', 'products.brand_id', 'brands.id')
        ->where('products.is_variant', '0')
        ->leftjoin('stock_details', 'stock_details.product_id', 'products.id')
        ->leftjoin('where_houses','stock_details.WHID','where_houses.id')
        ->leftJoin('categories', 'categories.id', '=', 'products.product_category')
        ->select( 'products.*','products.id As PID', 'products.name as product_name', 'products.product_code as item_code', 'products.*',
            DB::raw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) As available_stock"),
            'brands.brand_name', 'categories.name as category_name','where_houses.WH_Name as warehouse_name'
        )
        ->get();
        foreach($products as $product ){
            if($product->is_variant !="1" && $product->available_stock < 1){
                $warehouses = WhereHouse::select('id')->get();
                foreach($warehouses as $warehouse)
                {
                    $itemdata = [
                    'product_id' => $product->id,
                    'Qty' => 0,
                    'product_code' =>$product->product_code,
                    'OID' => 0,
                    'WHID'=>$warehouse->id,
                    'in_out'=>1,
                    ];
                    StockDetails::create($itemdata);
                }
            }

        }
        $variants =Product::with('WH')->join('product_variants', 'products.id', 'product_variants.PID')
            ->leftjoin('stock_details', 'stock_details.product_code', 'product_variants.item_code')
            ->leftjoin('where_houses','stock_details.WHID','where_houses.id')
            ->leftJoin('categories', 'categories.id', '=', 'products.product_category')
            ->select('*', 'products.name as product_name', 'product_variants.*',
                DB::raw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) As available_stock"),
                'categories.name as category_name','where_houses.WH_Name as warehouse_name')
            ->get();

            foreach($variants as $variants ){
                if($product->is_variant  && $product->available_stock < 1){
                    $warehouses = WhereHouse::select('id')->get();
                    foreach($warehouses as $warehouse)
                    {
                        $itemdata = [
                        'product_id' => $product->id,
                        'Qty' => 0,
                        'product_code' =>$product->item_code,
                        'OID' => 0,
                        'WHID'=>$warehouse->id,
                        'in_out'=>1,
                        ];
                        StockDetails::create($itemdata);
                    }
                }

            }
    }
}
