<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Product;
use App\Models\WhereHouse;
use App\Traits\WooSyncTrait;
use Illuminate\Support\Facades\DB;
use WooCommerce\Models\Attribute;
use Codexshaper\WooCommerce\Models\Variation;
use Illuminate\Http\Request;
use Keygen\Keygen;
use App\Models\Product\ProductWarehousePrice;
use App\Models\Product\ProductVariant;
use App\Models\StockDetails;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

use App\Models\Product\Category;

class ItemController extends Controller
{
    use WooSyncTrait;
    function __construct()
    {
        $this->middleware('permission:product_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = WhereHouse::all();
        return view('Items.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'brand_id' => 'required',
            'name' => 'required',
            'product_category' => 'required',
            'weight' => 'required',
            'alert_qty' => 'required',
            'product_cost' => 'required',
            'product_price' => 'required',
        ];
        $message = [
            'name.required' => 'Item Required',
            'brand_id.required' => 'Brand Required',
            'product_category.required' => 'Category Required',
        ];
        $this->validate($request, $rules, $message);

        if (DB::table('products')->where('product_code', $request->product_code)->whereNotIn('products.id', [$request->id])->count()) {
            return response()->json([
                'success' => 'false',
                'errors' => "Another Product with same Product code already Exist.",
            ], 422);
        }

        $data['brand_id'] = $request->brand_id;
        $data['name'] = $request->name;
        $data['product_code'] = $request->product_code;
        $data['product_category'] = $request->product_category;
        $data['weight'] = $request->weight;
        $data['unit'] = $request->unit;
        $data['product_cost'] = $request->product_cost;
        $data['product_price'] = $request->product_price;
        $data['profit_per'] = $request->profit_per;
        $data['profit_val'] = $request->profit_val;
        $data['inventory'] = $request->inventory;
        $data['alert_qty'] = $request->alert_qty;
        $data['tax_method'] = $request->tax_method;
        $data['featured'] = $request->featured;
        $data['detail'] = $request->detail;
        $id = $request->id;
        if (isset($request->is_diffPrice)) {
            $data['is_diffPrice'] = $request->is_diffPrice;
        }
        if (isset($request->is_variant)) {
            $data['is_variant'] = $request->is_variant;
        }
        $images = '';
        if (isset($request->product_images)) {
            foreach ($request->product_images as $product_image) {
                $images .= url('storage/app/' . $product_image->store('public/product_images')) . ',';
            }
            $data['product_images'] = rtrim($images, ',');
        }
        if (isset($request->is_promo)) {
            $data['is_promo'] = $request->is_promo;
            $data['promotional_price'] = $request->promotional_price;
            $data['promotional_start'] = $request->promotional_start;
            $data['promotional_end'] = $request->promotional_end;
        }
        $att = [];
        if (isset($request->is_variant)) {
            $att['attributes'] = [
                [
                    'name' => $request->attribute,
                    'visible' => true,
                    'variation' => true,
                    'options' => explode(',', $request->type),
                ]
            ];
        }
        $countWh = 0;
        if (isset($request->diff_price)) {
            $countWh = count($request->diff_price);
        }
        //create a woocomerece simple product
        $wData=[
            "name"=>$request->name,
            "regular_price"=>$request->product_price,
            "sale_price"=>$request->product_price,
//            "description"=>$request->detail,
//            "short_description"=>'',
            'manage_stock' => true,
            'stock_status' => 'instock',
            'weight' => $request->weight,
            'sku' => $request->product_code,
            'type' => (isset($request->is_variant) ? 'variable' : 'simple'),
            "categories" => [
                [
                    'id' => Category::find($request->product_category)->w_cat_id
                ]
            ],
        ];
        $wData = array_merge($wData, $att);
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $ret = Product::create($data);
                $PID = $ret->id;
                if (woo_state()) {
                    $product = \Codexshaper\WooCommerce\Models\Product::create($wData);
                    Product::where('id', $PID)->update(['w_id' => $product['id']]);
                }
                if (isset($request->is_variant)) {
                    $countVariant = count($request->variant_name);
                    //variant
                    for ($j = 0; $j < $countVariant; $j++) {
                        if (!empty($request['variant_name'][$j])) {
                            $jArray = [
                                'name' => $request['variant_name'][$j],
                                'item_code' => $request['variant_name'][$j] . '-' . $request['item_code'][$j],
                                'additonal_price' => $request['additional_price'][$j],
                                'attribute' => $request->attribute,
                                'attribute_value' => $request['variant_name'][$j],
                                'PID' => $PID,
                            ];
                            $price = ($request->product_price) + (is_numeric($request['additional_price'][$j]) ? $request['additional_price'][$j] : 0);
                            $variation_data = [
                                'regular_price' => (string)$price,
                                'sale_price' => (string)$price,
                                'sku' => $request['variant_name'][$j] . '-' . $request->product_code,
                                'manage_stock' => true,
                                'stock_status' => 'instock',
                                'weight' => $request->weight,
                                'attributes' => [
                                    [
                                        'name' => $request->attribute,
                                        'option' => $request['variant_name'][$j],
                                    ],
                                ]
                            ];
                            $p_array = [];
                            if (woo_state()) {
                                $w_var = Variation::create($product['id'], $variation_data);
                                $p_array = ['v_id' => $w_var['id']];
                            }
                            $jArray = array_merge($jArray, $p_array);
                            ProductVariant::create($jArray);

                            $warehouses = WhereHouse::select('id')->get();
                            foreach ($warehouses as $warehouse) {
                                $itemdata = [
                                    'product_id' => $PID,
                                    'Qty' => 0,
                                    'product_code' => $request['variant_name'][$j] . '-' . $request['item_code'][$j],
                                    'OID' => 0,
                                    'WHID' => $warehouse->id,
                                    'in_out' => 1,
                                ];
                                StockDetails::create($itemdata);
                            }


                        }
                    }
                } else {

                    $warehouses = WhereHouse::select('id')->get();
                    foreach ($warehouses as $warehouse) {
                        $itemdata = [
                            'product_id' => $PID,
                            'Qty' => 0,
                            'product_code' => $request->product_code,
                            'OID' => 0,
                            'WHID' => $warehouse->id,
                            'in_out' => 1,
                        ];
                        StockDetails::create($itemdata);
                    }
                }
            } else {
                $ret = Product::where('id', $id)->update($data);
                $PID = $id;
                ProductVariant::where('PID', $PID)->delete();
                $product_id = Product::find($id);
                if (woo_state()) {
                    \Codexshaper\WooCommerce\Facades\Product::update($product_id->w_id, $wData);
                }

                if (isset($request->is_variant)) {

                    $countVariant = count($request->item_code);
                    for ($j = 0; $j <= $countVariant; $j++) {


                        if (!empty($request['variant_name'][$j])) {
                            $item_code = $request['variant_name'][$j] . '-' . $request->product_code;
                            $jArray = [
                                'name' => $request['variant_name'][$j],
                                'item_code' => $item_code,
                                'additonal_price' => $request['additional_price'][$j],
                                'attribute' => $request->attribute,
                                'attribute_value' => $request['variant_name'][$j],
                                'PID' => $PID,
                            ];
                            $price = ($request->product_price) + (is_numeric($request['additional_price'][$j]) ? $request['additional_price'][$j] : 0);
                            $variation_data = [
                                'regular_price' => (string)$price,
                                'sale_price' => (string)$price,
                                'sku' => $item_code,
                                'manage_stock' => true,
                                'stock_status' => 'instock',
                                'weight' => $request->weight,
                                'attributes' => [
                                    [
                                        'name' => $request->attribute,
                                        'option' => $request['variant_name'][$j],
                                    ],
                                ]
                            ];
                            $p_array = [];
                            if (isset($request['v_id'][$j])) {
                                if (woo_state()) {
                                    $w_var = Variation::update($product_id->w_id, $request['v_id'][$j], $variation_data);
                                    $p_array = ['v_id' => $w_var['id']];
                                }
                                // ProductVariant::create($jArray);
                                $jArray = array_merge($jArray, $p_array);
                                ProductVariant::create($jArray);
//                                    ProductVariant::where('v_id', $request['v_id'][$j])->update($jArray);
                            } else {
                                if (woo_state()) {
                                    $w_var = Variation::create($product_id->w_id, $variation_data);
                                    $p_array = ['v_id' => $w_var['id']];
                                }
                                $jArray = array_merge($jArray, $p_array);
                                ProductVariant::create($jArray);
                            }

                        }
                    }
                }
            }
            ProductWarehousePrice::where('PID', $PID)->delete();
            if (isset($request->is_diffPrice)) {
                for ($i = 0; $i < $countWh; $i++) {
                    if (!empty($request['diff_price'][$i])) {
                        $array[] = [
                            'price' => $request['diff_price'][$i],
                            'warehouse_id' => $request['warehouse_id'][$i],
                            'PID' => $PID
                        ];
                    }
                }
                ProductWarehousePrice::insert($array);
            }
            DB::commit();
            return response()->json(['success' => 'Added new record Successfully.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            return response()->json([
                'success' => 'false',
                'errors' => $e->errorInfo,
            ], 400);
            DB::rollback();
        }
    }

    /*list data*/
    public function get_data(Request $request)
    {
        $count = $request->per_page;
        if ($count > 0) {
            $per_page = $count;

        } else if ($count == '0') {
            $per_page = Product::all()->count();

        } else {
            $per_page = 25;
        }
        $result = DB::table('products')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('categories', 'products.product_category', 'categories.id')
            ->join('unit_types', 'products.unit', 'unit_types.id')
            ->select('products.*', 'brands.brand_name', 'categories.name AS cat_name', 'unit_types.unit_name',
                DB::raw("(select IFNULL(sum(Qty),0) from stock_details where product_id=products.id and in_out=1)-(select IFNULL(sum(Qty),0) from stock_details where product_id=products.id and in_out=2) AS pq"))
            ->when($request->pn, function ($query) use ($request) {
                $query->where('products.name', 'LIKE', '%' . $request->pn . '%');
            })
            ->when($request->pc, function ($query) use ($request) {
                $query->where('product_code', $request->pc);
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('product_category', $request->category_id);
            })
            ->orderBy('products.id', 'DESC')
            ->paginate($per_page);
        return $result;
    }

    public function get_brand_data(Request $request)
    {
        $count = $request->per_page;
        if ($count > 0) {
            $per_page = $count;

        } else if ($count == '0') {
            $per_page = Brand::all()->count();

        } else {
            $per_page = 25;
        }
        $result = DB::table('brands')
            ->select('brands.*', 'brands.brand_name')
            ->when($request->pn, function ($query) use ($request) {
                $query->where('brands.brand_name', 'LIKE', '%' . $request->pn . '%');
            })

            ->paginate($per_page);
        return $result;
    }

    public function get_category_data(Request $request)
    {
        $count = $request->per_page;
        if ($count > 0) {
            $per_page = $count;

        } else if ($count == '0') {
            $per_page = Category::all()->count();

        } else {
            $per_page = 25;
        }
        $result = DB::table('categories')
            ->select('categories.*', 'categories.name')
            ->when($request->pn, function ($query) use ($request) {
                $query->where('categories.name', 'LIKE', '%' . $request->pn . '%');
            })

            ->paginate($per_page);
        return $result;
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Product::with(['brand', 'category'])->find($id);
        $variant = ProductVariant::where('PID', $id)->get();
        $warehouse = ProductWarehousePrice::where('PID', $id)->orderBy('id', 'DESC')->get();
        $variantHtml = '';
        $i = 0;
        foreach ($variant as $value) {
            $variantHtml .= '<tr class="prev-variant">
                                <td>
                                <input type="hidden" name="v_id[]" value="' . $value->v_id . '">
                                <select style="height: 35px" type="text" name="type" disabled class="form-control">
                                    <option value="0">Select Attribute</option>
                                    ' . Product\Attribute::dropdown($value->attribute) . '
                                </select>
                                </td>
                                <td>
                                    <select style="height: 35px; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"name="variant_name[]" class="form-control product_var selected_attribute">

                                    ' . Product\Attribute::attribute_dropdown($value->attribute, $value->attribute_value) . '
                                    </select>
                                 </td>
                                <td><input type="number" name="item_code[]" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);" class="form-control" value="' . explode('-', $value->item_code)[1] . '"></td>
                                <td><input type="text" style="height: 35px;" name="additional_price[]" value="' . $value->additonal_price . '" class="form-control"></td>';
            if ($i == 0) {
                $variantHtml .= '<td><button type="button" class="btn btn-info more_variant"><i class="fa fa-plus"></i> </button></td>';
            } else {
                $variantHtml .= '<td><button type="button" class="btn btn-danger remove"><i class="fa fa-trash"></i> </button></td>';
            }
            $variantHtml .= '</tr>';
            $i++;
        }
        if ($variant->count() > 0) {
            $attr = $value->attribute;
        } else {
            $attr = '';
        }
        return compact('result', 'variantHtml', 'warehouse', 'attr');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pid = Product::find($id);
        if (woo_state() && $pid->w_id) {
            \Codexshaper\WooCommerce\Facades\Product::delete($pid->w_id, ['force' => true]);
        }
        Product::destroy($id);
    }

    public function product_code()
    {

        prev_code:
        $id = Keygen::numeric(8)->generate();
        $product_exists = \Illuminate\Support\Facades\DB::table('products')->where('product_code', $id)->exists();
        if ($product_exists) {
            goto prev_code;
        } else {
            return $id;
        }
    }
    public static function check_unique_product_code($code )
    {
        return \Illuminate\Support\Facades\DB::table('products')->where('product_code', $code)->exists();
    }

    public function import(Request $request)
    {

        // this var help to upload created products to woocommerce
        $created_product = [];
        $company_id = Auth::user()->company_id;


        if (!$request->isMethod('post')) {
            return redirect('/items');
        }

        $file = fopen($request->file, "r");
        $i = 0;

        DB::beginTransaction();
        try {
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {

                $i++;

                if($i == 1){
                    continue;
                }
                if(self::check_unique_product_code($filedata[ 3])){
                    return response()->json([
                        'success' => 'false',
                        'errors' => "In ".$i." line Product code already exist",
                    ], 505);
                }

                $brand_rec = DB::table('brands')
                    ->where(DB::raw('lower(brand_name)'), strtolower($filedata[ 4]))
                    ->first();
                if ($brand_rec) {
                    $brand_id = $brand_rec->id;
                } else {
                    $brand_id = DB::table('brands')->insertGetId(
                        [
                            'brand_name' => $filedata[4]
                        ]
                    );
                }


                $category_rec = DB::table('categories')
                    ->where(DB::raw('lower(name)'), strtolower($filedata[ 5]))
                    ->first();
                if ($category_rec) {
                    $category_id = $category_rec->id;
                } else {
                    $category_id = DB::table('categories')->insertGetId(
                        [
                            'name' => $filedata[5]
                        ]
                    );
                }

                $unit_rec = DB::table('unit_types')
                    ->where(DB::raw('lower(unit_name)'), strtolower($filedata[ 6]))
                    ->first();

                if ($unit_rec) {
                    $unit_id = $unit_rec->id;
                } else {
                    $unit_id = DB::table('unit_types')->insertGetId(
                        [
                            'unit_name' => $filedata[6]
                        ]
                    );
                }

                $product_cost = (float)$filedata[8];
                $product_price = (float)$filedata[11];
                $weight = isset($filedata[15]) ? (float)$filedata[15]:0;
                $data = [
                    'product_code' => $filedata[ 3],
                    'name' => $filedata[2],
                    'brand_id' => $brand_id,
                    'product_category' => $category_id,
                    'unit' => $unit_id,
                    'alert_qty' => "10",
                    'inventory' => '1',
                    'product_cost' => $product_cost,
                    'product_price' => $product_price,
                    'profit_per' => $product_cost/$product_price * 100 ,
                    'profit_val' => $product_price - $product_cost,
                    'imported_by_csv' => '1',
                    'weight' => $weight,
                    'is_variant' => strtolower($filedata[12]) == "yes"? '1':'0',
                ];

                $product = Product::create($data);

                if(strtolower($filedata[12])  == "yes" ){
                    $attribute_rec = DB::table('attributes')
                        ->where(DB::raw('lower(name)'), strtolower($filedata[ 13 ]))
                        ->first();
                    if(!$attribute_rec){
                        $attribute_id = DB::table('attributes')->insertGetId(
                            [
                                'name' => $filedata[13],
                                'attr_value' => ' '
                            ]
                        );
                        $attribute_rec = DB::table('attributes')
                            ->where('id' ,$attribute_id)
                            ->first();
                    }

                    $db_attr_vals = explode(',',   trim($attribute_rec->attr_value ) );
                    if(count($db_attr_vals) <=1 && $db_attr_vals[0]==""){
                        $db_attr_vals=[];
                    }



                    // convert attributes and varriant cost (string) (data from excel ) to (1d)array

                    $varriant_array = explode(',', $filedata[ 14 ]);
                    foreach ($varriant_array as $attr){
                        $attr_arr = explode('/', $attr);
                        $attr_val = $attr_arr[0];
                        $additonal_price = $attr_arr[1];
                        if (!in_array($attr_val,$db_attr_vals )) {
                            $db_attr_vals[] = $attr_val;
                        }

                        $varriant_id = ProductVariant::create(
                            [
                                'name' => $attr_val,
                                'item_code' => $attr_val.'-'.$product->product_code,
                                'PID' => $product->id,
                                'additonal_price' => $additonal_price,
                                'attribute' => $attribute_rec->name,
                                'attribute_value' => $attr_val,
                                'imported_by_csv' => '1',
                            ]
                        );

                        $warehouses = WhereHouse::select('id')->get();
                        foreach ($warehouses as $warehouse) {
                            $itemdata = [
                                'product_id' => $product->id,
                                'Qty' => 0,
                                'product_code' => $varriant_id->item_code,
                                'OID' => 0,
                                'WHID' => $warehouse->id,
                                'in_out' => 1,
                            ];
                            StockDetails::create($itemdata);
                        }



                    }
                    $db_attr_vals = implode(',', $db_attr_vals);

                    $attribute_id = DB::table('attributes')->where('id',$attribute_rec->id)->update([
                             'name' => $filedata[13],
                             'attr_value' => $db_attr_vals
                     ]);
                }else{
                    $warehouses = WhereHouse::select('id')->get();
                    foreach ($warehouses as $warehouse) {
                        $itemdata = [
                            'product_id' => $product->id,
                            'Qty' => 0,
                            'product_code' => $product->product_code,
                            'OID' => 0,
                            'WHID' => $warehouse->id,
                            'in_out' => 1,
                        ];
                        StockDetails::create($itemdata);
                    }
                }

                // generate queue to upload the product on woocommcerce
                if (woo_state()) {
                    dispatch(new \App\Jobs\WoocommerceUploadProduct($company_id, $product->id));
                }

            }
            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'successfully imported csv file',
            ],	200 );

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success'   => false,
                'message'   => $e->getMessage(),
                'data'      => [],
            ],	505);

        }




    }
}
