<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class MailSettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mail_setting_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data =   MailSetting::first();
        return view('settings.mail_setting.index');
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
        $rules = [
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_address' => 'required',
            'password' => 'required',
            'mail_from_name' => 'required',
            'encryption' => 'required',
        ];
        $message=[
            'mail_host.required'=>'Mail Host Required',
            'mail_port.required'=>'Mail Port Required',
            'mail_address.required'=>'Mail Address Required',
            'password.required'=>'Password Required',
            'mail_from_name.required'=>'Mail From Name Required',
            'encryption.required'=>'Encryption Required',
        ];
        $this->validate($request, $rules, $message);
        $data['mail_host'] = $request->mail_host;
        $data['mail_port'] = $request->mail_port;
        $data['password'] = $request->password;
        $data['mail_from_name'] = $request->mail_from_name;
        $data['encryption'] = $request->encryption;
        $data['mail_address'] = $request->mail_address;

        DB::beginTransaction();
        try {
            if ($request->id === '0')
            {

                MailSetting::create($data);
                DB::commit();
                return response()->json(['success'=>'Added new record Successfully.']);
            }
            else{
                MailSetting::where('id', $request->id)->update($data);
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

    public function get_data()
    {
        $data =   MailSetting::first()->get();
        return response()->json([
            'status' => 'true',
            'data'  => $data,
        ], 200);
    }

    public function test_mail(Request $request)
    {
        $rules = [
            'mail' => 'required|email'
        ];
        $this->validate($request, $rules, []);
        try{
            $details = [
                'subject' => 'Test Mail',
                'title' => 'Mail from Revebe\' POS ',
                'body' => 'This is for testing email using smtp'
            ];
            \Mail::to($request->mail)->send(new \App\Mail\CommonMail("Mails.common_mail",$details));
            return response()->json([
                'status' => true,
                'message' => "Test Email Successfully Sent to ".$request->mail,
            ], 200);
        }catch (\Exception $e){

            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ], 505);
        }
    }
}
