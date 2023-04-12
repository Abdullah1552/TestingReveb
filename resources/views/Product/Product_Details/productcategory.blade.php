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
                    <h5>Product Category</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Products</a> </li>
                        <li class="breadcrumb-item"> Product Category</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->

            {{-- <div class="row">
                <div class="card">
                    <form id="form">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category_id" class="form-control ">
                                    <option value="0">Select</option>
                                    {!! App\Models\Product\Category::dropdown() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label style="visibility: hidden">afafffsfafas</label>
                                <button type="button" onclick="get_data(1)" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                            </div>
                        </div>
                        </div>
                        <div class="card-block">
                            <div class="btn-group pull-right">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <button type="button" onclick="import_file()" class="btn btn-mini btn-info pull-right"><i class="fa fa-file-o"></i> Import Excel File</button>
                            </div>
                            <div class="col-sm-12 table-responsive pad0">
                                <table class="table table-bordered">
                                    <tr style="background-color: #eeeeee">
                                        <th>#</th>
                                        <th>Product Category Name</th>
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
                                        <label>Category Name</label>
                                        <input name="pn" class="form-control " placeholder="Search With Product Category"  id="search">
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
                                                {{-- <th>#</th> --}}
                                                <th scope="col" class="no-report"><input type="checkbox" id="select_all"  name="records[]" /> #</th>
                                                <th>Product Category Name</th>

                                                <th class="noExl">Action</th>
                                            </tr>
                                            <tbody id="get_data"></tbody>
                                            <tr>
                                                <td colspan="8" class="no-report" align="right"> <button type="button" onclick="del_multiple_rec('form','/delete_multiple_product_category')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> selected</button></td>
                                            </tr>
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
    @include('Product.Product_Details.productcategorymodal');
    @include('Product.Product_Details.import-file-modal')
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#country-form input[name~='id']").val(0);
            document.getElementById("charges-form").reset();
        }
        //import file
        function import_file() {
            $("#import-file").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('product_category.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#category-form").serialize(),
                success:function (data) {
                    $("#category-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("category-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    if(vali==undefined){
                        toastr.error(ajaxcontent.responseJSON.message);
                        $('.loader-bg').hide();
                    }
                    $.each(vali, function( index, value ) {
                        $("#category-form input[name~='" + index + "']").css('border', '1px solid red');
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
        function get_data(page){
            $('.loader-bg').show();
            var searchKeyword = $('#search').val();
            $.ajax({
                url:"{{ url('get_category_items') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:{
            "pn": searchKeyword // Pass the search keyword as data
        },
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox" class="checkbox"  name="records[]" value="'+data.data[i].id+'"> '+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/product_category/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('product_category') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#category-form input[name~='id']").val(data.id);
                    $("#category-form input[name~='name']").val(data.name);
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
    <script>
        $(document).ready(function(){
  $('#select_all').click(function(){
    $('.checkbox').prop('checked', $(this).prop('checked'));
  });
});
    </script>
@endsection
