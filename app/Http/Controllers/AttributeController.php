<?php

namespace App\Http\Controllers;

use App\Models\Product\Attribute;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attributes.index');
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
            'name'=>'required',
            'attr_value'=>'required',
        ];
        $message=[
            'name.required'=>'Category Required',
            'attr_value.required'=>'Attribute Value Required',
        ];
        $this->validate($request, $rules, $message);
        $data =[
            'name'=>$request->name,
            'attr_value'=>str_replace(' ','',$request->attr_value)
        ];
        $id=$request->id;
        $aData=[
            'name'=>$request->name,
        ];
        DB::beginTransaction();
        // try {
        //     $att = null;
        //     if ($id == '' || $id == 0) {
        //         if(woo_state()) {
        //             $att = \Codexshaper\WooCommerce\Models\Attribute::create($aData);
        //         }
        //         $data['w_id']=$att['id'];
        //         Attribute::create($data);
        //     } else {
        //         Attribute::where('id', $id)->update($data);
        //         $pid=Attribute::find($id);
        //         if(woo_state()) {
        //             \Codexshaper\WooCommerce\Models\Attribute::update($pid->w_id, $aData);
        //         }
        //     }
        //     DB::commit();
        //     return response()->json(['success' => 'Added new record Successfully.']);

        // }catch (\Illuminate\Database\QueryException $e){
        //     $code = $e->errorInfo[1];
        //     return response()->json([
        //         'success' => 'false',
        //         'errors'  => $e->errorInfo,
        //     ], 400);
        // }
        try {
            if ($id == '' || $id == 0) {
                if(woo_state()) {
                    $att = \Codexshaper\WooCommerce\Models\Attribute::create($aData);
                    $data['w_id']=$att['id'];
                }
                Attribute::create($data);
            } else {
                Attribute::where('id', $id)->update($data);
                $pid=Attribute::find($id);
                if(woo_state() && isset($pid->w_id)) {
                    \Codexshaper\WooCommerce\Models\Attribute::update($pid->w_id, $aData);
                }
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
    //@display data in list
    public function get_data(Request $request){
        return Attribute::paginate(100);
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
        return Attribute::find($id);
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
        $wID=Attribute::find($id);
        if(woo_state()){
            \Codexshaper\WooCommerce\Facades\Attribute::delete($wID->w_id, ['force'=>true]);
        }
        Attribute::destroy($id);
    }
}
