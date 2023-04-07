<div class="modal" id="recent-trans">
    <div class="modal-dialog modal-lg">
        <form id="city-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Recent Transaction <span class="badge badge-info">Today</span></h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#sale" role="tab">Sale</a>
                            <div class="slide"></div>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" data-toggle="tab" href="#draft" role="tab">Draft</a>--}}
                            {{--<div class="slide"></div>--}}
                        {{--</li>--}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sale" role="tabpanel">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice#</th>
                                    <th>Customer</th>
                                    <th>Location</th>
                                    <th>Created by</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="get_dataa"></tbody>
                            </table>
                        </div>
                        {{--<div class="tab-pane" id="draft" role="tabpanel">--}}
                            {{--<table class="table">--}}
                                {{--<tr>--}}
                                    {{--<th>Date</th>--}}
                                    {{--<th>Reference</th>--}}
                                    {{--<th>Customer</th>--}}
                                    {{--<th>Grand Total</th>--}}
                                    {{--<th>Action</th>--}}
                                {{--</tr>--}}
                                {{--<tbody>--}}
                                {{--@for($i=0; $i<5; $i++)--}}
                                    {{--<tr>--}}
                                        {{--<td>13-03-2022</td>--}}
                                        {{--<td>posr-20220313-080100</td>--}}
                                        {{--<td>walk-in-customer</td>--}}
                                        {{--<td>1878</td>--}}
                                        {{--<td>--}}
                                            {{--<a class="btn btn-mini btn-success" href="javascript:void(0)" onclick="edit(1)"><i class="fa fa-edit"></i></a>--}}
                                            {{--<button type="button" onclick="del_rec('1', 'http://localhost/revebe/purchase_order/1')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endfor--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>