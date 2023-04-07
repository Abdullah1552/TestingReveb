<div id="mySidenav" class="csidenav sidebar">
    <ul class="sidebar-menu" style="overflow: inherit;">
        <li class="nav-level">Reports</li>
        <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-bar-chart"></i><span> Simple Reports</span><i class="icon-arrow-down"></i></a><ul class="treeview-menu"><li class="">
                    <a class="waves-effect waves-dark" href="reports/simple_sale_register"><i class="icon-arrow-right"></i> Simple Sale Register</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/client_rep_cat_wise"><i class="icon-arrow-right"></i> Client Report Cat Wise</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Summery Report</a>
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Best Seller Report</a>
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Product reports</a>
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Daily Sale</a>
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Purchase report</a>
                    <a class="waves-effect waves-dark" href="{{url('summery-report')}}"><i class="icon-arrow-right"></i> Product Quantity Alert</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/client_wise_sale_reg"><i class="icon-arrow-right"></i> Client Wise Sale Reg</a>
                </li><li class="">
                    <a class="waves-effect waves-dark" href="reports/invoice_rep"><i class="icon-arrow-right"></i> Invoice Reports</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/sale_reg_payable_only"><i class="icon-arrow-right"></i> Sale Reg Payable Only</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="waves-effect waves-dark" href="#!"><i class="fa fa-bar-chart"></i><span> Ledger Reports</span><i class="icon-arrow-down"></i></a>
            <ul class="treeview-menu">
                <li class="">
                    <a class="waves-effect waves-dark" href="{{ url('reports/finance/ledger') }}"><i class="icon-arrow-right"></i> Ledger</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/ledger_reports/cash_flow_statement"><i class="icon-arrow-right"></i> Cash Flow Statement</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/ledger_reports/day_book"><i class="icon-arrow-right"></i> Day Book</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/ledger_reports/db_summary"><i class="icon-arrow-right"></i> Day Book Summary</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="waves-effect waves-dark" href="#!">
                <i class="fa fa-bar-chart"></i><span> Financial Reports</span>
                <i class="icon-arrow-down"></i>
            </a>
            <ul class="treeview-menu">
                <li class="">
                    <a class="waves-effect waves-dark" href="{{ url('reports/finance/cash_register') }}">
                        <i class="icon-arrow-right"></i>Cash Register List
                    </a>
                </li>
                <li class="{{ request()->is('accounts/reports/trail_balance') ? 'active' : '' }}">
                    <a class="waves-effect waves-dark" href="{{ url('accounts/reports/trail_balance') }}"><i class="icon-arrow-right"></i> Trial Balance</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="{{ url('accounts/reports/day_book') }}"><i class="icon-arrow-right"></i> Accounts Day Book </a>
                </li>
                <li class="{{ request()->is('accounts/reports/income_statement')?'active':'' }}">
                    <a class="waves-effect waves-dark" href="{{ url('accounts/reports/income_statement') }}"><i class="icon-arrow-right"></i> Income Statement</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="{{ url('accounts/reports/balance_sheet') }}"><i class="icon-arrow-right"></i> Balance Sheet</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/financials/profit_loss_acc"><i class="icon-arrow-right"></i> Profit & Loss A/C</a>
                </li>
                <li class="">
                    <a class="waves-effect waves-dark" href="reports/financials/expenses_summary"><i class="icon-arrow-right"></i> Expenses Summary</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
