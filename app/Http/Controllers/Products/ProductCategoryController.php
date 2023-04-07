<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Imports\BulkProductCategoryImport;
use Excel;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use App\Traits\WooSyncTrait;

class ProductCategoryController extends Controller
{
    use WooSyncTrait;

    function __construct()
    {
        $this->middleware('permission:product_category_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product.Product_Details.productcategory');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|unique:categories,name',
        ];
        $message=[
            'name.required'=>'Category Name Required',
            'name.unique'=>'Category Already Exist with same Name',
        ];
        $this->validate($request, $rules, $message);
        $data=$request->except(['_token']);
        $id=$request->id;

        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $ret=Category::create($data);
                if(woo_state()) {
                    $this->sync_category($ret->id);
                }
            } else {
                Category::where('id', $id)->update($data);
                if(woo_state()) {
                    $this->sync_category($id,true);
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => " new Category Added Successfully.",
            ],  200);

        }catch (\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'error_code' =>  $e->getCode(),
                'message' => $e->getMessage(),
            ], 505);
        }
    }
    //@dispaly data in list
    public function get_data(Request $request){
        // dd($request->category_id);
        return Category::when($request->category_id, function($query)use ($request){
                        $query->where('id', $request->category_id);
                        })->orderBy('id','DESC')
                        ->paginate();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try{
            $pid=Category::find($id);
            if(woo_state() && isset($pid->w_cat_id) && $pid->w_cat_id){
                \Codexshaper\WooCommerce\Models\Category::delete($pid->w_cat_id,['force'=>true]);
            }
            Category::destroy($id);
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $error = $e->getMessage();

            if($e->getCode()  == 23000){
                $error = "Products exists with this category ";
            }

            return response()->json([
                'success' => false,
                'error_code' => $e->getCode(),
                'message' => $error,
            ], 505);

        }


    }
    //upload bulk file
    public function bulk_upload(Request $request){
        $rules=[
            'import_file'=>'required|file',
        ];
        $message=[
            'import_file.required'=>'Please Upload Excel file',
        ];
        $this->validate($request, $rules, $message);
        $data=$request->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if($request->hasFile('import_file')) {
                $file = $request->file('import_file');
                    Excel::import(new BulkProductCategoryImport(), $file);
                }
            DB::commit();
            return response()->json(['success' => 'Added new record Successfully.']);

        }catch (\Illuminate\Database\QueryException $e){
            $code = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'errors'  => $e->errorInfo,
            ], 400);
        }
    }
}
