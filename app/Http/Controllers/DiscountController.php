<?php

namespace App\Http\Controllers;

use App\Models\{Discount, Product, Product\Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:discount_view', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discounts.index');
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
            'name' => 'required',
            'discount_by' => 'required',
            'valid_from' => 'required',
            'valid_till' => 'required',
            'min_qty' => 'required',
            'max_qty' => 'required',
            'discount_on' => 'required',
            'value' => 'required',

        ];
        $message = [
            'name.required' => 'Name Required',
            'discount_by.required' => 'Discount by Required',
            'valid_from.required' => 'Valid from Required',
            'valid_till.required' => 'Valid till Required',
            'min_qty.required' => 'Min Quantity Required',
            'max_qty.required' => 'Max Quantity Required',
            'discount_on.required' => 'Discount Required',
            'value.required' => 'Discount Value is Required',
        ];
        $this->validate($request, $rules, $message);
        $data = request()->except(['_token', 'discount_on', 'categories']);
        $id = $request->id;

        if(isset($request->status) && $request->status=='1'){
            /************To check any product is available in another discount**************/
            $discount_on_product = [];
            if (isset($request->discount_by) && $request->discount_by == "category") {

//            if (count($request->discount_on) > 1) {
//                return response()->json([
//                    'status' => 'false',
//                    'errors' => ['You are not allow to select multiple categories. mutiple categories are in under working'],
//                ], 400);
//            }
                foreach ($request->discount_on as $discount_on) {
                    $category = Category::where('id', $discount_on)->first();
                    $cat_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'category')->orderBy('id', 'DESC')->get();
                    foreach ($cat_discounts as $dis) {
                        if ($dis) {
                            $discounted_cats = explode(',', $dis->discount_on);
                            if (in_array($category->id, $discounted_cats)) {
                                if($id!=$dis->id){
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => [$category->name . ' has already discount in ' . $dis->name . ' discount.'],
                                    ], 400);
                                }

                            }
                        }
                    }
                }

                foreach ($request->discount_on as $discount_on) {
                    $category = Category::with('products')->where('id', $discount_on)->first();
                    $prod_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'product')->orderBy('id', 'DESC')->get();
                    foreach ($category->products as $products) {
                        foreach ($prod_discounts as $dis) {
                            if ($dis) {
                                $discounted_cats = explode(',', $dis->discount_on);
                                if (in_array($products->id, $discounted_cats)) {
                                    if($id!=$dis->id) {
                                        return response()->json([
                                            'status' => 'false',
                                            'errors' => ['Product (' . $products->name . ') from ' . $category->name . ' (Category) has already an active discount in ' . $dis->name . ' discount.'],
                                        ], 400);
                                    }
                                }
                            }
                        }
                    }
                }


            } elseif (isset($request->discount_by) && $request->discount_by == "product") {
                $discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                    ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'product')->orderBy('id', 'DESC')->get();

                foreach ($request->discount_on as $discount_on) {
                    $product = Product::find($discount_on);
                    foreach ($discounts as $dis) {
                        if ($dis) {
                            $discounted_product = explode(',', $dis->discount_on);
                            if (in_array($discount_on, $discounted_product)) {
                                if($id!=$dis->id) {
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => ['You have already applied a discount on  ' . $product->name . ' in ' . $dis->name . ' discount '],
                                    ], 400);
                                }
                            }
                        }

                    }

                    $category = Category::where('id', $product->product_category)->first();
                    $cats_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'category')->orderBy('id', 'DESC')->get();
                    foreach ($cats_discounts as $dis) {
                        if ($dis) {
                            $discounted_cats = explode(',', $dis->discount_on);
                            if (in_array($category->id, $discounted_cats)) {
                                if($id!=$dis->id) {
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => ['Discount you are appling on product (' . $product->name . ') already have active discount on his parent Category in ' . $dis->name . ' discount'],
                                    ], 400);
                                }
                            }
                        }

                    }
                }

            }
            /**e**/
        }


        $data['discount_on'] = implode(',', $request->discount_on);
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $ret = Discount::create($data);
            } else {
                $ret = Discount::where('id', $id)->update($data);
            }
            DB::commit();
            return response()->json(['success' => 'Added new record Successfully.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors' => $e->getMessage(),
            ], 400);
            DB::rollBack();
        }
    }

    public function get_data(Request $request)
    {
        $count = $request->per_page;
        if ($count > 0) {
            $per_page = $count;
        } else if ($count == '0') {
            $per_page = Discount::get()->count();
        } else {
            $per_page = 25;
        }
        return Discount::when($request->name, function ($query) use ($request) {
            $query->where('discounts.name', 'LIKE', '%' . $request->name . '%');
        })->paginate($per_page);
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
        $result = Discount::find($id);
        return $result;
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
        Discount::destroy($id);
    }

    public function discountOn(Request $request)
    {
        if ($request->value == 'category') {
            $result = Category::all('id', 'name');
        } else {
            $result = Product::when($request->categories, function ($query) use ($request) {
                $query->whereIn('product_category', $request->categories);
            })->select('id', 'name')->get();
        }
        return response()->json($result);
    }

    public function discount_on_category(Request $request)
    {

        $pd = 0;
        $data = $request->only('product_id', 'qty', 'Unit_cost');
        $cat_arr = [];
        /*
         * The purpose of this for loop code to convert array from products and its qty
         * to categories and its qty
         *
         * */

        for ($i = 0; $i < count($data['product_id']); $i++) {
            $cat_id = Product::with('category')->find($data['product_id'][$i])->category->id;

            if (count($cat_arr) > 0) {
                for ($i2 = 0; $i2 < count($cat_arr); $i2++) {
                    if (in_array($cat_id, $cat_arr[$i2])) {
                        $cat_arr[$i2]['qty'] += (int)$data['qty'][$i];
                        $cat_arr[$i2]['Unit_cost'] += (int)$data['Unit_cost'][$i];
                        break;
                    } else if ($i2 == count($cat_arr) - 1) {
                        $cat_arr[] = ['cat_id' => $cat_id, 'qty' => (int)$data['qty'][$i], 'Unit_cost' => (int)$data['Unit_cost'][$i]];
                        break;
                    }
                }

            } else {
                $cat_arr[] = ['cat_id' => $cat_id, 'qty' => (int)$data['qty'][$i], 'Unit_cost' => (int)$data['Unit_cost'][$i]];
            }
        }
//return $cat_arr;
        foreach ($cat_arr as $cat) {
            
            $discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'category')->get();
            foreach ($discounts as $dis) {
                $discount_on_arr = explode(',', $dis->discount_on);
                if (in_array($cat['cat_id'], $discount_on_arr)) {
                    if ($cat['qty'] >= $dis->min_qty && $cat['qty'] <= $dis->max_qty) {
                        switch ($dis->discount_type) {
                            case "Fixed":
                                $pd += $dis->value * $cat['qty'];
                                break;
                            case "Percentage":
                                $percentage = (int)$dis->value;
                                $products_price = (int)$cat['Unit_cost'];
                                $pd += $percentage / 100 * $products_price;
                                break;
                        }
                    }
                }
            }
        }

        return $pd;

    }

    function change_status(Request $request)
    {

        $id = $discount_id = $request->discount_id;

        $discount=Discount::find($discount_id );
        $discount->discount_on=explode(',',$discount->discount_on);
        $status = Discount::find($discount_id)->status;

        if ($status == '0') {
            /************To check any product is available in another discount**************/
            $discount_on_product = [];
            if (isset($discount->discount_by) && $discount->discount_by == "category") {
                foreach ($discount->discount_on as $discount_on) {
                    $category = Category::where('id', $discount_on)->first();
                    $cat_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'category')->orderBy('id', 'DESC')->get();
                    foreach ($cat_discounts as $dis) {
                        if ($dis) {
                            $discounted_cats = explode(',', $dis->discount_on);
                            if (in_array($category->id, $discounted_cats)) {
                                if($id!=$dis->id) {
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => [$category->name . ' has already active discount in ' . $dis->name . ' discount.'],
                                    ], 400);
                                }
                            }
                        }
                    }
                }

                foreach ($discount->discount_on as $discount_on) {
                    $category = Category::with('products')->where('id', $discount_on)->first();
                    $prod_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'product')->orderBy('id', 'DESC')->get();
                    foreach ($category->products as $products) {
                        foreach ($prod_discounts as $dis) {
                            if ($dis) {
                                $discounted_cats = explode(',', $dis->discount_on);
                                if (in_array($products->id, $discounted_cats)) {
                                    if($id!=$dis->id) {
                                        return response()->json([
                                            'status' => 'false',
                                            'errors' => ['Product (' . $products->name . ') from ' . $category->name . ' (Category) has already an active discount in ' . $dis->name . ' discount.'],
                                        ], 400);
                                    }
                                }
                            }
                        }
                    }
                }


            } elseif (isset($discount->discount_by) && $discount->discount_by == "product") {
                $discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                    ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'product')->orderBy('id', 'DESC')->get();
                foreach ($discount->discount_on as $discount_on) {
                    $product = Product::find($discount_on);
                    foreach ($discounts as $dis) {
                        if ($dis) {
                            $discounted_product = explode(',', $dis->discount_on);
                            if (in_array($discount_on, $discounted_product)) {
                                if($id!=$dis->id) {
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => ['You have already active discount on  ' . $product->name . ' in ' . $dis->name . ' discount '],
                                    ], 400);
                                }
                            }
                        }
                    }

                    $category = Category::where('id', $product->product_category)->first();
                    $cats_discounts = Discount::where('status', '1')->where('valid_from', '<=', date('Y-m-d'))
                        ->where('valid_till', '>=', date('Y-m-d'))->where('discount_by', 'category')->orderBy('id', 'DESC')->get();
                    foreach ($cats_discounts as $dis) {
                        if ($dis) {
                            $discounted_cats = explode(',', $dis->discount_on);
                            if (in_array($category->id, $discounted_cats)) {
                                if($id!=$dis->id) {
                                    return response()->json([
                                        'status' => 'false',
                                        'errors' => ['Discount you are appling on product (' . $product->name . ') already have active discount on his parent Category in ' . $dis->name . ' discount'],
                                    ], 400);
                                }
                            }
                        }
                    }
                }
            }
            /**e**/


            Discount::where('id', $discount_id)->update(['status' => '1']);
            return 1;

        } else {
            Discount::where('id', $discount_id)->update(['status' => '0']);
            return 0;
        }
    }
    public function delete_multiple(Request $request)
    {
        foreach ($request->records as $record){
            $this->destroy($record);
        }
    }
}
