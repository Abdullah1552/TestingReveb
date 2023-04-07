@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">User Management</a> </li>
                        <li class="breadcrumb-item">Role List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                <div class="col-sm-12 table-responsive pad0">
                                    @can('role_create')
                                    <a href="{{ route('roles.create') }}" class="btn btn-mini btn-primary pull-right">Add New</a>
                                    @endcan
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                        @foreach ($roles as $key => $role)
                                            <tr id="{{ $role->id }}">
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    {{--<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}
                                                    @can('role_edit')
                                                        <a class="btn btn-info btn-mini" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                    @endcan
                                                    @can('role_delete')
                                                    <button type="button" onclick="del_rec('{{ $role->id }}','{{ url('roles') }}/{{$role->id}}')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>
                                                    @endcan
                                                    {{--@endcan--}}
                                                    {{--@can('role-delete')--}}
                                                        {{--{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}--}}
                                                        {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-mini']) !!}--}}
                                                        {{--{!! Form::close() !!}--}}
                                                    {{--@endcan--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                            <!--card-block-->
                        </form>
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    {{--@if (count($errors) > 0)--}}
    {{--<div class="alert alert-danger">--}}
    {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
    {{--<ul>--}}
    {{--@foreach ($errors->all() as $error)--}}
    {{--<li>{{ $error }}</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--@endif--}}
@endsection