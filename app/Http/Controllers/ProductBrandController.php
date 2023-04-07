<?php

namespace App\Http\Controllers;

use App\Models\Product\Brand;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use Excel;
use App\Imports\BulkBrandImport;
use DB;
class ProductBrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product.Product_Details.productbrand');
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
            'brand_name'=>'required',
        ];
        $message=[
            'brand_name.required'=>'Brand Name Required',
            'brand_image.required'=>'Brand Image Required',
        ];
        $this->validate($request, $rules, $message);
        $data=$request->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                Brand::create($data);
            } else {
                Brand::where('id', $id)->update($data);
            }
            DB::commit();
            return response()->json(['success' => 'Added new record Successfully.']);

        }catch (\Illuminate\Database\QueryException $e){
            $code = $e->errorInfo[1];
            return response()->json([
                'success' => 'false',
                'errors'  => $e->errorInfo,
            ], 400);
        }
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
        return Brand::find($id);
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
    //@dispaly data in list
    public function get_data(Request $request){
        // return Brand::paginate();
        $count = $request->per_page;
        if ($count > 0) {
            $per_page = $count;

        } else if ($count == '0') {
            $per_page = Brand::all()->count();

        } else {
            $per_page = 25;
        }
        // $result = DB::table('brands')
        //     ->select('brands.*', 'brands.brand_name')
        //     ->when($request->pn, function ($query) use ($request) {
        //         $query->where('products.name', 'LIKE', '%' . $request->pn . '%');
        //     })

        //     ->orderBy('products.id', 'DESC')
        //     ->paginate($per_page);
        return $result;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Brand::destroy($id);
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
                Excel::import(new BulkBrandImport(), $file);
            }
            DB::commit();
            return response()->json(['success' => 'Added new record Successfully.']);

        }catch (\Illuminate\Database\QueryException $e){
            $code = $e->errorInfo[1];
            return response()->json([
                'success' => 'false',
                'errors'  => $e->errorInfo,
            ], 400);
            DB::rollBack();
        }
    }
}
