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
    <div class="modal-dialog" role="document">
        <form id="customer-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Customer Group *</label>
                                <select class="form-control js-example-basic-single"  name="customer_group_id">
                                    <option value="">Select</option>
                                    {!! App\Models\CustomerGroup::dropdown() !!}
                                </select>
                            </div>
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Name *</label>
                                <input class="form-control" id="" name="name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Email</label>
                                <input class="form-control" autocomplete="off" id="" name="email" type="email" placeholder="example@exampl.com">
                            </div>
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Phone Number </label>
                                <input class="form-control" id="" name="phone_number" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12 pf">
                                <label for="inputdefault">Address </label>
                                <textarea name="address" class="form-control" style="height: 81px"></textarea>
                            </div>
                            {{--<div class="form-group col-md-3 m-t-25" >--}}
                            {{--<label >Add User</label>&nbsp;--}}
                            {{--<input type="checkbox" name="checkbox" id="add-user" value="0" style="user-select: auto;">--}}
                            {{--</div>--}}

                        </div>
                    </div>
                {{--<div class="row user-fields">--}}
                {{--<div class="col-md-12">--}}
                {{--<div class="form-group col-md-3 pf">--}}
                {{--<label for="inputdefault">User Name</label>--}}
                {{--<input type="text" class="form-control" name="user_email">--}}
                {{--</div>--}}
                {{--<div class="form-group col-md-3 pf">--}}
                {{--<label for="inputdefault">Password</label>--}}
                {{--<input type="password" class="form-control" name="password">--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <!-- Form Control starts -->

                    <!-- Form Control ends -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>
