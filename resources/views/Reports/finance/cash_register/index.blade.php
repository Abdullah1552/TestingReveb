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
    {{--<script src="{{ URL::asset('public/assets/js/editor.js') }}"></script>--}}
    {{--<link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/css/editor.css') }}"/>--}}

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Reports</li>
                        <li class="breadcrumb-item">Finance</li>
                        <li class="breadcrumb-item active">Cash Register Report</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                            <div class="card-block">
                                <form id="form" action="{{ url('reports/finance/print_cr') }}" target="_blank" method="post">
                                    @CSRF
                                    <button type="submit" class="btn btn-mini btn-default pull-right"><i class="fa fa-print"></i> </button>
                                </form>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>User</th>
                                            <th>Location</th>
                                            <th>Cash in Hand</th>
                                            <th>Opended at</th>
                                            <th>Closed at</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>

                                </div>
                            </div>
                            <!--card-block-->
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('Items.modal');
    <script>
        $('#item-form').submit(function (e) {
            $('.loader-bg').show();
            var att=$("#attribute option:selected").text();
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('attribute',att);
            //formData.append('detail',detil);
            $.ajax({
                url:"{{ route('items.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function (data) {
                    $("#item-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("item-form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';

                    $.each(vali, function( index, value ) {
                        $("#item-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            })
        });
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('reports/finance/get_cash_register') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:$("#form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+data.data[i].staff.name+'</td>';
                        htmlData+='<td>'+data.data[i].location.WH_Name+'</td>';
                        htmlData+='<td>'+data.data[i].cash_in_hand+'</td>';
                        htmlData+='<td>'+data.data[i].created_at+'</td>';
                        htmlData+='<td>'+data.data[i].updated_at+'</td>';
                        htmlData+='<td>'+(data.data[i].status==0?'Open':'closed')+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+', \'clone\')"><i class="fa fa-clone"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/items/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
    </script>
@endsection
