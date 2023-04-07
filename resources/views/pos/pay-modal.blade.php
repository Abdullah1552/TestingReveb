
<div class="modal" id="pay">
    <div class="modal-dialog modal-lg">
        <form id="city-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Payment</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Total Amount: <span id="modal_total_amount" style="background-color: gainsboro"></span></b>
                        </div>
                    </div>
                    <div class="row m-t-30">
                        <div class="col-md-3">
                            <span>Paid</span>
                        </div>
                        <div class="col-md-3">
                            <span>Outstanding</span>
                        </div>
                        <div class="col-md-3">
                            <span>Received Amount</span>
                        </div>
                        <div class="col-md-3">
                            <span>Change return</span>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-md-3">
                            <b id="paid"></b>
                        </div>
                        <div class="col-md-3">
                            <b id="outStanding">0.00</b>
                        </div>
                        <div class="col-md-3">
                            <input name="change_cash" type="number" id="change" readonly onkeyup="cash_change(this)" class="form-control-sm">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control-sm" readonly id="write_off">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row m-t-20">
                                <div class="col-md-5">
                                    <span>Cash</span>
                                </div>
                                <div class="col-md-4">
                                    <input onkeyup="receivd_amount()" type="number" value="0.00" id="cash" class="form-control-sm">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8" style="width: 409px"><hr></div>
                            </div>
                            <div class="row m-t-5">
                                <div class="col-md-5">
                                    <span>Credit Card</span>
                                </div>

                                <div class="col-md-4">
                                    <input onkeyup="receivd_amount()" type="number" name="cash" value="0.00" id="credit-card" class="form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8" style="width: 409px"><hr></div>
                            </div>
                            <div class="row m-t-5">
                                <div class="col-md-5">
                                    <span>QR Code Payment</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" onkeyup="receivd_amount()" value="0.00" id="qr-code" class="form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8" style="width: 409px"><hr></div>
                            </div>
                            <div class="row m-t-5">
                                <div class="col-md-5">
                                    <span>Other</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" onkeyup="receivd_amount()" value="0.00" id="other-amount" class="form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">1</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">3</div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">4</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">5</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">6</div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">6</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">8</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">9</div>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">Del</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">0</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="simple-box bg-danger jumbotron-custom">.</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Modal footer -->
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" onclick="save_rec()" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

    </div>
    </form>
</div>

</div>
