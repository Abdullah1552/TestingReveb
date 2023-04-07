<?php

namespace App\Http\Controllers;

use App\Models\StockDetails;
use Illuminate\Http\Request;
use DB;

class StockCountController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:stock_count_view', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product.stock_count.index');
    }
    //@display data in list
    public function get_data(Request $request){
//        $result=DB::table('where_houses')
//            ->LeftJoin('stock_details','where_houses.id','stock_details.WHID')
//            ->LeftJoin('product_variants','stock_details.product_code','product_variants.item_code')
//            ->leftjoin('products','stock_details.product_id','products.id')
//            ->leftjoin('categories','products.product_category','categories.id')
//            ->select('products.name as name','stock_details.product_code as item_code','categories.name AS cat_name',
//                'where_houses.WH_Name',
//                DB::raw("(select IFNULL(sum(Qty),0) from stock_details where product_code=stock_details.product_code and WHID=where_houses.id and in_out=1) AS pq"),
//                DB::raw("(select IFNULL(sum(Qty),0) from stock_details where product_code=stock_details.product_code and WHID=where_houses.id and in_out=2) AS sq")
//            )->groupBy('stock_details.WHID')->groupBy('stock_details.product_code')
//            ->paginate(15);
        $result=DB::table('stock_details AS SD')
            ->leftjoin('products','SD.product_id','products.id')
            ->leftjoin('categories','products.product_category','categories.id')
            ->leftjoin('where_houses','SD.WHID','where_houses.id')
            ->select('products.name as name','SD.product_code as item_code',
                'categories.name AS cat_name','where_houses.WH_Name',
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS pq"),
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS sq")
                )
            ->when($request->pn, function($query)use ($request){
                $query->where('products.name','LIKE', '%'.$request->pn.'%');
            })
            ->when($request->pc, function ($query) use ($request){
                $query->where('SD.product_code',$request->pc);
            })
            ->when($request->category_id, function($query)use ($request){
                $query->where('products.product_category', $request->category_id);
            })
            ->when($request->wherehouse_id, function($query)use ($request){
                $query->where('where_houses.id', $request->wherehouse_id);
            })
            ->when($request->alert_qty, function($query)use ($request){
                $query->where('products.alert_qty', '<=' , $request->alert_qty);
            })
            ->groupBy('SD.product_code')
            ->groupBy('SD.WHID')

            ->paginate(15);
        return $result;
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
        //
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
        //
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
        //
    }
    /*
     * check stock details warehouse wise
     */
    public function check_wh_stock($product_code,$WHID=null){
        $result=DB::table('stock_details AS SD')
            ->join('products','SD.product_id','products.id')
            ->Join('categories','categories.id','=','products.product_category')
            ->join('where_houses','SD.WHID','where_houses.id')
            ->select('products.name as name','SD.product_code as item_code',
                'where_houses.WH_Name','categories.name as category_name',
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS pq"),
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS sq")
            )->where('SD.product_code',$product_code)
            ->when($WHID , function($query)use ($WHID){
                $query->where('SD.WHID',$WHID);
            })->groupBy('SD.WHID')
            ->get();
        return $result;
    }
}
