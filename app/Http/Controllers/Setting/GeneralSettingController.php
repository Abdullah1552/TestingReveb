<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use DB;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.general_setting.index');
    }


    public function businessSettingSaveData(Request $request)
    {
        $rules = [
            'name' => 'required',
            'logo' => 'required',
        ];
        $message=[
            'name.required'=>'Name Required',
            'logo.required'=>'Logo Required',
        ];
        $this->validate($request, $rules, $message);
        $data['name'] = $request->name;
        $data['start_date'] = $request->start_date;
        $data['default_profit_percent'] = $request->default_profit_percent;
        $data['currency'] = $request->currency;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['start_date'] = $request->start_date;
        $data['date_formate'] = $request->date_formate;
        $data['financial_year_start_month'] = $request->financial_year_start_month;
        $data['transaction_edit_days'] = $request->transaction_edit_days;
        $data['time_formate'] = $request->time_formate;
        $data['time_zone'] = $request->time_zone;
        if ($image = $request->file('logo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['logo'] = $profileImage;

        }
        DB::beginTransaction();
        try {
            if ($request->id === 0)
            {
                BusinessSetting::create($data);
                DB::commit();
                return response()->json(['success'=>'Added new record Successfully.']);
            }
            else{
                BusinessSetting::where('id', $request->id)->update($data);
                DB::commit();
                return response()->json(['success'=>'Updated record Successfully.']);
            }
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
            DB::rollBack();
        }
    }

    public function editBusinessSetting()
    {
       $data =   BusinessSetting::first()->get();
        return response()->json([
            'status' => 'true',
            'data'  => $data,
        ], 200);
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
}
