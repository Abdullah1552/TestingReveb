@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>User List</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Administrator</a> </li>
                        <li class="breadcrumb-item">Role List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-check"></i> {{session('success')}}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa fa-cross"></i> {{session('error')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-block">
                <a href="{{ route('users.create') }}" class="btn btn-mini btn-primary pull-right">Add New</a>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Rights</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td><img src="{{ url('storage/app/public/users_images/'.$user->profile_photo_path) }}" width="60"></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-mini btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-mini btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                <button type="submit" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
