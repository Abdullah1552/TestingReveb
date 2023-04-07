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
                    <h5>Product Brand</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Products</a> </li>
                        <li class="breadcrumb-item">Product Brand </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            {{-- <div class="row">
                <div class="card">
                    <form id="form">
                        <div class="card-block">
                            @can('brand_create')
                            <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                            <button type="button" onclick="import_file()" class="btn btn-mini btn-info pull-right"><i class="fa fa-file-o"></i> Import Excel File</button>
                            @endcan
                            <div class="col-sm-12 table-responsive pad0">
                                <table class="table table-bordered">
                                    <tr style="background-color: #eeeeee">
                                        <th>#</th>
                                        <th>Product Brand Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="get_data"></tbody>
                                </table>
                                <div class="pagination-panel pull-right"></div>
                                Commented
                                <ul class="pagination pull-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--card-block-->
                    </form>
                </div>
                <!--card-->
            </div> --}}
            <!-- Form Control ends -->
            <div class="col-md-12">
                <div class="card">
                    <div class="car-block">
                        <div class="card-header">
                            <form id="form">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input name="pn" class="form-control " placeholder="Search With Product Brand"   id="search">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label style="visibility: hidden">afafffsfafas</label>
                                        <button type="button" onclick="get_data(1)" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="card-block">
                                    {{-- <div class="btn-group pull-right">
                                        @can('product_create')
                                            <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right pullBtn">Add New</button>
                                        @endcan
                                        <button type="button" class="btn btn-mini btn-success pull-right exportToExcel"><i class="fa fa-file-excel-o"></i> </button>
                                    </div> --}}
                                    <div class="col-sm-12 table-responsive " style="padding-top: 25px">
                                        <table class="table table-bordered table2excel">
                                            <tr style="background-color: #eeeeee">
                                                <th>#</th>
                                                <th>Product Brand Name</th>

                                                <th class="noExl">Action</th>
                                            </tr>
                                            <tbody id="get_data"></tbody>
                                        </table>
                                        <div class="pagination-panel pull-right noExl"></div>

                                    </div>
                                </div>
                                <!--card-block-->
                            </form>
                        </div>
                    </div>
                </div>
                <!--card-->
            </div>
        </div>
    </div>
    </div>
    @include('Product.Product_Details.productbrandmodal');
    @include('Product.Product_Details.brand-import-file-modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#country-form input[name~='id']").val(0);
            document.getElementById("brand-form").reset();
        }
        //import file
        function import_file() {
            $("#import-file").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('product_brand.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#brand-form").serialize(),
                success:function (data) {
                    $("#brand--form input[name~='id']").val(0);
                    toastr.success('Operation successfully.');
                    document.getElementById("brand-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {

                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#brand-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        $(document).ready(function() {
    $('#search').on('keyup', function() {
        get_data(1); // Trigger the search function with the first page number
    });
});
        // function get_data(page){
        //     $.ajax({
        //         url:"{{ url('get_product_brand') }}?page="+page,
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         type:"POST",
        //         dataType:"JSON",
        //         success:function (data) {
        //             htmlData='';
        //             for(i in data.data){
        //                 htmlData+='<tr id="'+data.data[i].id+'">';
        //                 htmlData+='<td>'+(Number(i)+1)+'</td>';
        //                 htmlData+='<td>'+data.data[i].brand_name+'</td>';
        //                 htmlData+='<td>';
        //                 @can('brand_edit')
        //                 htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
        //                 @endcan
        //                     @can('brand_delete')
        //                 htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/product_brand/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
        //                 @endcan
        //                 htmlData+='</td>';
        //                 htmlData+='</tr>';
        //             }
        //             $("#get_data").html(htmlData);
        //             pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
        //         }
        //     })
        // }
        function get_data(page){
            $('.loader-bg').show();
            var searchKeyword = $('#search').val();
            $.ajax({
                url:"{{ url('get_brand_items') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:{
            "pn": searchKeyword // Pass the search keyword as data
        },
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        if(data.data[i].product_images!=null) {
                            thumbImg = data.data[i].product_images.split(',');
                        }else{
                            thumbImg=[''];
                        }
                        htmlData+='<tr id="'+data.data[i].id+'">';
                            htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].brand_name+'</td>';
                        htmlData+='<td>';
                        @can('product_edit')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan

                        @can('product_create')
                            htmlData+=' <a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+', \'clone\')"><i class="fa fa-clone"></i></a>';
                        @endcan

                        @can('product_delete')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/items/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger" style=""><i class="fa fa-trash-o"></i> </button>';
                        @endcan

                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                    $('.loader-bg').hide();
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('product_brand') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {

                    $("#brand-form input[name~='id']").val(data.id);
                    $("#brand-form input[name~='brand_name']").val(data.brand_name);
                    $('.loader-bg').hide();
                }
            })
        }
        //import file
        function import_file() {
            $("#import-file").modal();
        }
        //bulk upload form============================
        $('#bulk-form').submit(function(e) {
            e.preventDefault();
            formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: '{{ url('/bulk_product_brand') }}',
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
