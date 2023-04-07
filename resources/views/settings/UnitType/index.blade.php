@extends('layouts.app')
@section('content')
    <style type="text/css">
        .select2-selection--single {
            border: 0px !important;
            border-radius: 0px !important;
            border-bottom: 1px solid #aaa !important;
            width: 100% !important;
        }
        .select2 {
            width: 100% !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Unit Type List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item">Unit Type List </li>
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
                                @can('unit_type_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table ">
                                        <tr style="background-color: #eeeeee">
                                            <th scope="col"><input type="checkbox" /> #</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data">
                                        </tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>

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
    @include('settings.UnitType.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('unit_type.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#unit-form").serialize(),
                success:function (data) {
                    $("#unit-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("unit-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#zone-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(''+value+'');
                    });
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_unit_types') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data){
                        htmlData+='<tr id="'+data[i].id+'">';
                        htmlData+='<td><input type="checkbox"> '+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data[i].unit_name+'</td>';
                        htmlData+='<td>';
                        @can('unit_type_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('unit_type_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data[i].id+'\', \'{{ url('/unit_type/') }}/'+data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        @endcan
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('unit_type') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#unit-form input[name~='id']").val(data.id);
                    $("#unit-form input[name~='unit_code']").val(data.unit_code);
                    $("#unit-form input[name~='unit_name']").val(data.unit_name);
                    $("#unit-form select[name~='base_unit']").val(data.base_unit);
                    $('.loader-bg').hide();
                    $(".js-example-basic-single").select2();
                }
            })
        }
    </script>
@endsection
