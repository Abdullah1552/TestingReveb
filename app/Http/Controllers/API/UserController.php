<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\Api\Authentication\ForgetPasswordRequest;
use App\Http\Requests\Api\Authentication\ResetPasswordRequest;
use Faker\Core\Number;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Authentication\LoginRequest;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token=  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $response=[
                'user'=>$user,
                'token'=>$token
            ];
            return response($response, 200);

        }
        else{
            return $this->respondWithError('Password is Incorrect', 401);
        }

    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        //$success['token'] =  $user->createToken('MyApp')-> accessToken;
        $token=  $user->createToken('MyApp')->plainTextToken;
        //$success['name'] =  $user->name;
        //return response()->json(['success'=>$success], $this-> successStatus);
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response, 200);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
    public function logoutApi(Request $request)
    {
        Auth()->user()->tokens()->delete();
        return response(['message'=>'logout Successfully']);

    }
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        //to generate random string for reset link
        $token = Str::random(64);

        //to generate OTP for reset link
        $OTP = substr(str_shuffle("0123456789"), 0, 6);

        DB::beginTransaction();
        try {
            DB::table('password_resets')->where(['email' => $request->email])->delete();
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'OTP' => $OTP,
                'created_at' => Carbon::now()
            ]);
            $data = [
                'email' => $request->email,
                'token' => $token,
                'OTP' => $OTP,
            ];

            Mail::send('email.forgetPassword',$data , function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            DB::commit();
            return $this->respondWithMessage("We have e-mailed your reset password link!");
        }catch (\Exception $e){
            DB::rollBack();
            return $this->respondWithError($e->getMessage(), 505);
        }


    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->select('email')->first();
        if(!$updatePassword)
            return $this->respondWithError('Link Expired!', 498);

        DB::beginTransaction();
        try {

            DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();
            DB::table('users')->where('email', $updatePassword->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::commit();

            return $this->respondWithMessage("Password has been changed.");
        }catch (\Exception $e){
            DB::rollBack();
            return $this->respondWithError($e->getMessage(), 505);
        }

    }

}
