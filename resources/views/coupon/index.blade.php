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
        .pf {
            padding-left: 5px !important;
            padding-right: 5px !important;
        }
        label {
            display: contents !important;
            color: #050505;
        }
        .form-group {
            margin-bottom: 0.3rem !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Sale</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Coupon</a> </li>
                        <li class="breadcrumb-item">Coupon Card </li>
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
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th scope="col"><input type="checkbox" /></th>
                                            <th>#</th>
                                            <th>Coupon Code</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Minimum Amount</th>
                                            <th>Qty</th>
                                            <th>Available</th>
                                            <th>Expired Date</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="">
                                        @for($i=0; $i<5; $i++)
                                            <tr id="2" style="user-select: auto;">
                                                <td><input type="checkbox"></td>
                                                <td>{{$i}}</td>
                                                <td>i love pakistan</td>
                                                <td><div class="badge badge-success">Fixed</div></td>
                                                <td>500</td>
                                                <td>100</td>
                                                <td>100</td>
                                                <td><div class="badge badge-success">49</div></td>
                                                <td><div class="badge badge-danger">31-12-2021</div></td>

                                                <td>admin</td>
                                                <td style="user-select: auto;">
                                                    <a class="btn btn-mini btn-primary" href="javascript:void(0)"  style="user-select: auto;">
                                                        <i class="fa fa-edit" style="user-select: auto;"></i>
                                                    </a> <button type="button" class="btn btn-mini btn-danger" style="user-select: auto;">
                                                        <i class="fa fa-trash-o" style="user-select: auto;"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
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
    @include('coupon.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('suppliers.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#supplier-form").serialize(),
                success:function (data) {
                    $("#suppliers-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("supplier-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data(1);
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        toastr.error(value);
                        $("#supplier-form input[name~='"+index +"']").css('border', '1px solid red');
                        $("#supplier-form select[name~='"+index +"']").parents('.form-group').find('.select2').css('border', '1px solid red');
                    });
                    $('.loader-bg').hide();
                }
            })
        }
//        $(document).ready(function () {
//            get_data();
//        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_suppliers') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].S_Name+'</td>';
                        htmlData+='<td>'+data.data[i].Owner_Mobile+'</td>';
                        htmlData+='<td>N/A</td>';
                        htmlData+='<td>'+data.data[i].S_Email+'</td>';
                        htmlData+='<td>'+data.data[i].Comp_Address+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/zone/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('suppliers') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#supplier-form input[name~='id']").val(data[0]['id']);
                    $("#supplier-form input[name~='S_Name']").val(data[0]['S_Name']);
                    $("#supplier-form input[name~='Company_Name']").val(data[0]['Company_Name']);
                    $("#supplier-form input[name~='Owner_Comp_Name']").val(data[0]['Owner_Comp_Name']);
                    $("#supplier-form input[name~='Owner_Mobile']").val(data[0]['Owner_Mobile']);
                    $("#supplier-form input[name~='Owner_email']").val(data[0]['Owner_email']);
                    $("#supplier-form input[name~='Comp_Address']").val(data[0]['Comp_Address']);
                    $("#supplier-form input[name~='King_Name']").val(data[0]['King_Name']);
                    $("#supplier-form input[name~='King_Relestion']").val(data[0]['King_Relestion']);
                    $("#supplier-form input[name~='S_Ntn']").val(data[0]['S_Ntn']);
                    $("#supplier-form input[name~='S_Stn']").val(data[0]['S_Stn']);
                    $("#supplier-form input[name~='Exmp_Certificate']").val(data[0]['Exmp_Certificate']);
                    $("#supplier-form input[name~='Tax_code_sro']").val(data[0]['Tax_code_sro']);
                    $("#supplier-form input[name~='Raw_material']").val(data[0]['Raw_material']);
                    $("#supplier-form input[name~='Finace_contact']").val(data[0]['Finace_contact']);
                    $("#supplier-form input[name~='Finance_mobile']").val(data[0]['Finance_mobile']);
                    $("#supplier-form input[name~='Bus_start']").val(data[0]['Bus_start']);
                    $("#supplier-form input[name~='Bank_acc']").val(data[0]['Bank_acc']);
                    $("#supplier-form input[name~='Raw_ml']").val(data[0]['Raw_ml']);
                    $("#supplier-form input[name~='Vendor_ref']").val(data[0]['Vendor_ref']);
                    $("#supplier-form select[name~='Payment_type']").val(data[0]['Payment_type']);
                    $("#supplier-form input[name~='Payment_condition']").val(data[0]['Payment_condition']);
                    $("#supplier-form input[name~='CNIC']").val(data[0]['CNIC']);
                    $("#supplier-form input[name~='S_Contact_Person']").val(data[0]['S_Contact_Person']);
                    $("#supplier-form input[name~='S_Mobile']").val(data[0]['S_Mobile']);
                    $("#supplier-form input[name~='S_Phone']").val(data[0]['S_Phone']);
                    $("#supplier-form input[name~='S_Email']").val(data[0]['S_Email']);
                    $("#supplier-form select[name~='S_CYID']").val(data[0]['S_CYID']);
                    $("#supplier-form input[name~='S_Adress_1']").val(data[0]['S_Adress_1']);
                    $("#supplier-form select[name~='PID']").val(data[0]['PID']);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection
