<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use App\Models\Product;
use App\Models\UnitType;
use Illuminate\Http\Request;
use Picqer\Barcode ;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;
use App\Models\Currency;

class BarcodeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:print_barcode_view', ['only' => ['print_barcode']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function print_barcode(){
        return view('barcode.print_barcode');
    }


    public function generateProductBarcode(Request $request)
    {
        $productCode = $request->code;
        $productName = $request->name;
        $productCost = $request->price;
        $brand = $request->brand;
        $category = $request->category;
        $PID=$request->PID;
        $unitType=Product::find($PID)->unit;
        $unit=UnitType::find($unitType)->unit_name;
        $generatorPNG = new BarcodeGeneratorPNG();
        $currency=BusinessSetting::first()->default_currency;
        $currency_sign=Currency::find($currency);
        $productBarcode = '<tr style="text-align: center !important;">
                              <th style="width:100px;height:100%;font-size:14px;text-align:center">
                              
                              <b style="display: none !important;" class="brand_name"> <b>'.$brand.'</b></span><br>
                              <span style="display: none !important;" class="category"> '.$category.'</span><br>
                              <span style="display: none !important;text-align: center !important;" class="productName">'.$productName.'</span>
                              <br>
                              <img style=" height: 75px !important;
                              width: 15%;" src="data:image/png;base64,'.base64_encode($generatorPNG->getBarcode($productCode, $generatorPNG::TYPE_CODE_128)) .'"
                              class="barcode-selector"
                              >
                             <br>
                              <span style="" class="productCode">'.$productCode.'</span>
                              <br> <span style="display: none !important;" class="productCost"> '.$currency_sign->code.' '.$productCost.'  /'.$unit.'</span>
                             </th>
                             </tr>';
        return response()->json($productBarcode);
    }
}
