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
                    <h5>Product Attributes</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Products</a> </li>
                        <li class="breadcrumb-item"> Product Attribute</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
                <div class="card">
                        <div class="card-block">
                            <div class="btn-group pull-right">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                            </div>
                            <div class="col-sm-12 table-responsive pad0">
                                <table class="table table-bordered">
                                    <tr style="background-color: #eeeeee">
                                        <th>#</th>
                                        <th>Attribute Name</th>
                                        <th>Attribute Values</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="get_data"></tbody>
                                </table>
                            </div>
                        </div>
                        <!--card-block-->
                </div>
                <!--card-->
        </div>
    </div>
    @include('attributes.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#form input[name~='id']").val(0);
            document.getElementById("form").reset();
        }
        //import file
        function import_file() {
            $("#import-file").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('attributes.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#form").serialize(),
                success:function (data) {
                    $("#form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    if(vali==undefined){
                        toastr.error(ajaxcontent.responseJSON.message);
                        $('.loader-bg').hide();
                        return false;
                    }
                    $.each(vali, function( index, value ) {
                        $("#form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
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
                url:"{{ url('product/get_attributes') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].attr_value+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/product/attributes/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('product/attributes') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#form input[name~='id']").val(data.id);
                    $("#form input[name~='name']").val(data.name);
                    $("#form input[name~='attr_value']").val(data.attr_value);
                    $('.loader-bg').hide();
                }
            })
        }
        //bulk upload form============================
        $('#bulk-form').submit(function(e) {
            e.preventDefault();
            formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: '{{ url('/bulk_product_category') }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Operation successfull.');
                    get_data();

                },error:function(ajaxcontent) {

                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            });
        });
    </script>
@endsection
