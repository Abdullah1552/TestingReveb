<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\TransAccount;
use function Symfony\Component\VarDumper\Dumper\esc;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee_view', ['only' => ['index']]);
        $this->middleware('permission:employee_create', ['only' => ['create','store']]);
        $this->middleware('permission:employee_edit', ['only' => ['edit']]);
        $this->middleware('permission:employee_delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hrm.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {   $rules = [
        'dep_id' => 'required',
    ];
        $message=[
            'dep_id.required'=>'Department Required',

        ];
        $this->validate($request, $rules, $message);
          $request->validate([
            'emp_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('emp_photo')) {
            $destinationPath = 'public/assets/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $emp_photo = $profileImage;
        }

        $userData['email'] = $request['user_email'];
        $userData['password'] = $request['password'];
        $data=request()->except(['_token', 'password','role_id']);
        $id=$request->id;
        if($id=='' || $id==0){
            $data['emp_photo']= $emp_photo;

            $ret=Employee::create($data);
            User::create($userData);

        }else{
            $ret=Employee::where('id', $id)->update($data);
            User::create($userData);
        }
        if($ret){
            return response()->json(['success'=>'Added new record Successfully.']);
        }
    }
    /*list data*/
    public function get_data(){

        $result=Employee::with('departments')->paginate();
        return $result;
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

        return Employee::find($id);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Employee::destroy($id);
    }
}
