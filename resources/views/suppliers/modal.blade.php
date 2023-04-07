<style>
    .modal-body {
        max-height: 100%;
    }
    .modal-header {
        padding: 5px;
        border: 0px;
    }
    .modal-content {
        background: #eee !important;
    }
    .form-group {
        margin-bottom: 0.3rem !important;
    }

    @media (min-width: 992px) {
        .modal-md {
            width: 100%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
    }
    .pf {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .table input[type="text"] {
        width: 100%;
        padding: 0px;
        font-size: 13px;
        text-transform: uppercase;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .card-header, .card-block {
        padding: 5px !important;
    }
    .card {
        margin-bottom: 5px !important;
    }
</style>
<div class="modal" id="new-sub_head">
    <div class="modal-dialog modal-md modal-sm">
        <form id="supplier-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Supplier Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body plr30">
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Owner Name <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="S_Name" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Owner Email <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="Owner_email" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Company Name <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="Company_Name" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Owner Mobile/PTCL <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="Owner_Mobile" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Owner Company Name <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="Owner_Comp_Name" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Company Address<sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="Comp_Address" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Next of King Name <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="King_Name" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Next of King Relestion <sup class="text-danger">*</sup></label>
                        <input class="form-control" id="" name="King_Relestion" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Contact Person</label>
                        <input class="form-control" id="" name="S_Contact_Person" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">CNIC</label>
                        <input class="form-control" autocomplete="off" id="" name="CNIC" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">NTN</label>
                        <input class="form-control" autocomplete="off" id="" name="S_Ntn" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">SRTN</label>
                        <input class="form-control" id="" name="S_Stn" type="text">
                    </div>
                    {{--<div class="form-group col-md-2 pf">--}}
                        {{--<label for="inputdefault">Phone</label>--}}
                        {{--<input class="form-control" id="" name="S_Phone" type="text">--}}
                    {{--</div>--}}
                    {{--<div class="form-group col-md-2 pf">--}}
                        {{--<label for="inputdefault">Mobile<sup class="text-danger">*</sup></label>--}}
                        {{--<input class="form-control" id="" name="S_Mobile" type="text">--}}
                    {{--</div>--}}
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">A/C Type</label>
                        <select class="form-control js-example-basic-single" id="" name="PID">
                            <option value="">Select A/c Type</option>
                            {!! App\Models\SubHead::AccountType() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">OB Type</label>
                        <select class="form-control js-example-basic-single" id="" name="OB_Type">
                            <option value="1">Dr</option>
                            <option value="2">Cr</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">OB Amount</label>
                        <input class="form-control" autocomplete="off" id="" name="OB" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Exemption Certificate</label>
                        <input class="form-control" autocomplete="off" id="" name="Exmp_Certificate" type="text" placeholder="Exemption Certificate">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Tax Code SRO</label>
                        <input class="form-control" autocomplete="off" id="" name="Tax_code_sro" type="text" placeholder="Tax Code SRO">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Raw Material</label>
                        <input class="form-control" autocomplete="off" id="" name="Raw_material" type="text" placeholder="Raw Material">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Finance Contact Persone</label>
                        <input class="form-control" autocomplete="off" id="" name="Finace_contact" type="text" placeholder="Finance Contact Persone">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Finance Mobile/PTCL</label>
                        <input class="form-control" autocomplete="off" id="" name="Finance_mobile" type="text" placeholder="Finance Contact Persone">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Finance Email</label>
                        <input class="form-control" id="" name="S_Email" type="text">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Vendor Type</label>
                        <select class="form-control" autocomplete="off" id="" name="Vendor_type">
                            {!! App\Helpers\helpers::vendor_type() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Business Start Date</label>
                        <input class="form-control" autocomplete="off" id="" name="Bus_start" type="text" placeholder="Business Start Date">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Bank A/C Details</label>
                        <input class="form-control" autocomplete="off" id="" name="Bank_acc" type="text" placeholder="Business Start Date">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Raw Material Loction</label>
                        <input class="form-control" autocomplete="off" id="" name="Raw_ml" type="text" placeholder="Raw Material Loction">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Vendor Refrance</label>
                        <input class="form-control" autocomplete="off" id="" name="Vendor_ref" type="text" placeholder="Vendor Refrance">
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Payment Type</label>
                        <select class="form-control"id="" name="Payment_type">
                            {!! App\Helpers\helpers::payment_type() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-2 pf">
                        <label for="inputdefault">Payment Condition</label>
                        <input class="form-control" autocomplete="off" id="" name="Payment_condition" type="text" placeholder="Payment Condition in Days">
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>