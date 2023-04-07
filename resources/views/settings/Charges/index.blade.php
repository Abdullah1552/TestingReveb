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
                    <h5>Charges List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item">Charges List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Charges Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>
                                    {{--<ul class="pagination pull-right">--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
                                    {{--</ul>--}}
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
    @include('settings.Charges.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#country-form input[name~='id']").val(0);
            document.getElementById("charges-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('charges.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#charges-form").serialize(),
                success:function (data) {
                    $("#charges-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("charges-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {

                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#charges-form input[name~='" + index + "']").css('border', '1px solid red');
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
                url:"{{ url('get_charges') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data){
                        htmlData+='<tr id="'+data[i].id+'">';
                            htmlData+='<td>'+(Number(i)+1)+'</td>';
                            htmlData+='<td>'+data[i].Ch_Name+'</td>';
                            htmlData+='<td>';
                                htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data[i].id+')"><i class="fa fa-edit"></i></a>';
                                htmlData+=' <button type="button" onclick="del_rec(\''+data[i].id+'\', \'{{ url('/countries/') }}/'+data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                            htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    //pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('charges') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#charges-form input[name~='id']").val(data[0].id);
                    $("#charges-form input[name~='Ch_Name']").val(data[0].Ch_Name);
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection