<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user_management_view', ['only' => ['index']]);
        $this->middleware('permission:new_user_create', ['only' => ['create','store']]);
        $this->middleware('permission:new_user_edit', ['only' => ['edit']]);
        $this->middleware('permission:new_user_delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->where('type','!=','support')->where('type','!=','super_admin')->paginate(5);

        return view('Users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name')->all();
        return view('Users.create',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'password' => 'required',
            'roles' => 'required',
            'WHID' => 'required',
        ]);

        $input = $request->except('_token','id','_method','confirm-password','roles','profile_photo_path');

        if ($image = $request->file('profile_photo_path')) {
            $destinationPath = 'storage/app/public/users_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['profile_photo_path'] = $profileImage;
        }

        $input['warehouses'] = implode(',',$request->warehouses);
        $input['password'] = Hash::make($input['password']);
        DB::beginTransaction();
        try {
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            DB::commit();
            return redirect()->route('users.index')
                ->with('success','User created successfully');

        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            DB::rollBack();
            return back()->with('error', $e->getMessage());

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
        $user = User::find($id);
        return view('Users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('Users.edit',compact('user','roles','userRole'));
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'WHID'=>'required',
            'warehouses'=>'required'
        ],[
            'warehouses.required' => ' Atleast Access of one Location is required!',
        ]);

        $input = $request->except('_token','id','_method','confirm-password','roles','profile_photo_path');

        if ($image = $request->file('profile_photo_path')) {
            $destinationPath = 'storage/app/public/users_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['profile_photo_path'] = $profileImage;
        }

        $input['warehouses'] = implode(',',$request->warehouses);

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        if(!isset($request->type) && is_null($request->type)){
            $input['type'] = $request->type;
        }

        DB::beginTransaction();
        try {
            User::where('id',$id)->update($input);
            $user = User::find($id);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
            DB::commit();
            return redirect()->route('users.index')
                ->with('success','User updated successfully');
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if((Auth::user()->type=='admin' ||  Auth::user()->type=='end_user') && ($user->type=="admin" || $user->type=="super_admin" || $user->type=="support") ){
            return back()->with('error','You are not allowed to delete Admin.');
        }
        User::find($id)->delete();

        return back()->with('success','User deleted successfully');
    }

    public function resetPassword_view(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withErrors(['token' => 'Link Expired!']);
        }

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->select('email')->first();
        if(!$updatePassword)
            return redirect('/login')->withErrors(['token' => 'Link Expired!']);

        return view('auth.reset-password',['token'=>$request->token,'email'=>$updatePassword->email]);
    }



}
