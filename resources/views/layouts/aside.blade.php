<?php
$dashboard=['home'];
$accounts_arr=['root_coa', 'head_acc', 'subheads'];
?>
<aside class="main-sidebar hidden-print" style="position:absolute;" >
    <section class="sidebar" id="sidebar-scroll" style="background: #202020">
    <!-- sidebar profile Menu-->
        <ul class="nav sidebar-menu extra-profile-list">
            <li>
                <a class="waves-effect waves-dark" href="profile.html">
                    <i class="icon-user"></i>
                    <span class="menu-text">View Profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="javascript:void(0)">
                    <i class="icon-settings"></i>
                    <span class="menu-text">Settings</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="javascript:void(0)">
                    <i class="icon-logout"></i>
                    <span class="menu-text">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li class="nav-level" style="color:white;">Main Menu</li>
            @can('dashboard_view')
            <li class="treeview">
                <a class="waves-effect waves-dark" href="#!"><i class="icon-speedometer"></i><span> Dashboard</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if(in_array(Request::segment(1), $dashboard)) echo 'active' ?>">
                        <a class="waves-effect waves-dark" href="{{ route('home') }}"><i class="icon-arrow-right"></i> Main Dashboard </a></li>
                    {{--<li class="">--}}
                    {{--<a class="waves-effect waves-dark" href="dashboard"><i class="icon-arrow-right"></i> Dashboard 2 </a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            @endcan
            {{-- @can('quotation_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-ticket"></i><span> Quotation</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('quotation')) ? 'active': '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('quotation.index') }}"><i class="icon-arrow-right"></i> Quotation List </a>
                    </li>
                </ul>
            </li>
            @endcan --}}
            @can('product_view')
            <li class="treeview">
                <a class="waves-effect waves-dark" href="#!">
                    <i class="fa fa-product-hunt"></i>
                    <span>Products</span><i class="icon-arrow-down"></i>
                </a>
                <ul class="treeview-menu">
                    @can('product_attribute_view')
                    <li class="{{ (request()->is('product/attributes')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('attributes.index') }}"><i class="icon-arrow-right"></i> Product Attributes </a>
                    </li>
                    @endcan
                    <li class="{{ request()->is('unit_type') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('unit_type.index') }}"><i class="icon-arrow-right"></i> Unit Types </a>
                    </li>
                    {{-- <li class="{{ (request()->is('product/stock_count')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('stock_count.index')}}"><i class="icon-arrow-right"></i> Stock Count </a>
                    </li> --}}
                    <li class="{{ (request()->is('product_category')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('product_category.index')}}"><i class="icon-arrow-right"></i> Product Category </a>
                    </li>
                    <li class="{{ (request()->is('product_brand')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('product_brand.index')}}"><i class="icon-arrow-right"></i> Product Brand </a>
                    </li>
                    <li class="{{ (request()->is('items')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('items.index') }}"><i class="icon-arrow-right"></i> Product List </a>
                    </li>
                    <li class="{{ (request()->is('print_barcode')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ url('print_barcode') }}"><i class="icon-arrow-right"></i> Print Barcode </a>
                    </li>
                    <li class="{{ (request()->is('opening_inventory')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('opening_inventory.index') }}"><i class="icon-arrow-right"></i> Opening Inventory </a>
                    </li>
                    <li class="{{ (request()->is('product/adjustment')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('adjustment.index') }}"><i class="icon-arrow-right"></i> Adjustment </a>
                    </li>
                    @can('transfer_view')
                        @can('transfer_list_view')
                            <li class="{{ request()->is('transfers/transfer') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ route('transfer.index') }}"><i class="icon-arrow-right"></i> Transfer List </a>
                            </li>
                            {{--<li class="{{ request()->is('transfers/transfer_by_csv') ? 'active' : '' }}">--}}
                            {{--<a class="waves-effect waves-dark" href="{{ route('transfer_by_csv') }}"><i class="icon-arrow-right"></i> Import Transfer By Csv </a>--}}
                            {{--</li>--}}
                        @endcan
                    @endcan
                </ul>
            </li>
            @endcan
            @can('discount_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-percent"></i><span> Discount</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('discounts') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('discounts.index') }}"><i class="icon-arrow-right"></i> Product Discount </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('sale_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-ticket"></i><span> Sale</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @if(woo_state())
                        @can('website_order_view')
                        <li class="{{ (request()->is('website_order')?'active':'') }}">
                            <a class="waves-effect waves-dark" href="{{ route('website_order.index') }}"><i class="icon-arrow-right"></i>Website Order</a>
                        </li>
                        @endcan
                    @endif
                    @can('sale_view')
                    <li class="{{ (request()->is('sale_invoice')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('sale_invoice.index') }}"><i class="icon-arrow-right"></i>Sale Invoice </a>
                    </li>
                        @endcan
                        @can('pos_view')
                    <li class="{{ (request()->is('pos')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('pos.index') }}"><i class="icon-arrow-right"></i>POS </a>
                    </li>
                        @endcan
                        @can('import_sale_by_csv_view')
                    {{--<li class="{{ (request()->is('sale_by_csv')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('sale_by_csv') }}"><i class="icon-arrow-right"></i>Import Sale by CSV </a>
                    </li>--}}
                        @endcan
                        @can('gift_card_view')
                    {{--<li class="{{ (request()->is('sale/gift_card')?'active':'') }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('gift_card.index') }}"><i class="icon-arrow-right"></i>Gift Card List </a>--}}
                    {{--</li>--}}
                        @endcan
                        @can('coupon_view')
                    {{--<li class="{{ (request()->is('sale/coupon')?'active':'') }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('coupon.index') }}"><i class="icon-arrow-right"></i>Coupon List </a>--}}
                    {{--</li>--}}
                        @endcan
                    {{--<li class="{{ (request()->is('pos')?'active':'') }}">--}}
                    {{--<a class="waves-effect waves-dark" href="{{ route('pos.index') }}"><i class="icon-arrow-right"></i>Delivery List </a>--}}
                    {{--</li>--}}
                    @can('return_view')
                        @can('sale_return_view')
                        <li class="{{ request()->is('returns/sale_return') ? 'active' : '' }}">
                            <a class="waves-effect waves-dark" href="{{ route('sale_return.index') }}"><i class="icon-arrow-right"></i>Sale Return </a>
                        </li>
                        @endcan
                    @endcan
                    <li class="{{ request()->is('settings/reward_point_setting') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('reward_point_setting.index')}}"><i class="icon-arrow-right"></i> Reward Point Setting</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('purchase_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-ticket"></i><span> Purchase </span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('purchase_list_view')
                    <li class="{{ (request()->is('purchase_invoice')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('purchase_invoice.index') }}"><i class="icon-arrow-right"></i>Purchase Invoice </a>
                    </li>
{{--                    <li class="{{ (request()->is('purchase_by_csv')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('purchase_by_csv') }}"><i class="icon-arrow-right"></i>Import Purchase By CSV </a>
                    </li>--}}
                    @endcan
                    @can('return_view')
                        @can('purchase_return_view')
                        <li class="{{ request()->is('returns/purchase_return') ? 'active' : '' }}">
                            <a class="waves-effect waves-dark" href="{{ route('purchase_return.index') }}"><i class="icon-arrow-right"></i>Purchase Return </a>
                        </li>
                        @endcan
                    @endcan
                </ul>
            </li>
            @endcan
            @can('people_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-ticket"></i><span> People </span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('customer_group_view')
                    <li class="{{ request()->is('settings/customer_group') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('customer_group.index') }}"><i class="icon-arrow-right"></i> Customer Group</a>
                    </li>
                    @endcan
                    @can('customer_view')
                    <li class="{{ (request()->is('people/customers')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('customers.index') }}"><i class="icon-arrow-right"></i>Customer List </a>
                    </li>
                        @endcan
                        @can('sale_person_view')
                    <li class="{{ (request()->is('people/sale_persons')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('sale_persons.index') }}"><i class="icon-arrow-right"></i> Sale Person</a>
                    </li>
                        @endcan
                        @can('supplier_list_view')
                    <li class="{{ (request()->is('people/suppliers')?'active':'') }}">
                        <a class="waves-effect waves-dark" href="{{ route('suppliers.index') }}"><i class="icon-arrow-right"></i> Supplier List</a>
                    </li>
                            @endcan
                </ul>
            </li>
            @endcan
            {{-- @can('accounts_view')
            <li class="treeview <?php if(in_array(Request::segment(1), $accounts_arr)) echo 'active'; ?>">
                <a class="waves-effect waves-dark" href="#!"><i class="icon-calculator"></i>
                    <span> Accounts</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('root_account_view')
                    <li class="<?php if(Request::segment(1)=='root_coa') echo 'active' ?>">
                        <a class="waves-effect waves-dark" href="{{ url('root_coa') }}"><i class="icon-arrow-right"></i> Root Accounts </a>
                    </li>
                    @endcan
                    @can('head_account_view')
                    <li class="<?php if(Request::segment(1)=='head_acc') echo 'active' ?>">
                        <a class="waves-effect waves-dark" href="{{ route('head_acc.index') }}"><i class="icon-arrow-right"></i> Head Accounts </a>
                    </li>
                        @endcan
                        @can('subhead_account_view')
                    <li class="<?php if(Request::segment(1)=='subheads') echo 'active'; ?>">
                        <a class="waves-effect waves-dark" href="{{ route('subheads.index') }}"><i class="icon-arrow-right"></i> Sub Head Accounts </a>
                    </li>
                        @endcan
                        @can('new_transaction_account_view')
                    <li class="{{ (request()->is('trans_acc')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('trans_acc.index') }}"><i class="icon-arrow-right"></i> Add New Trans A/C </a>
                    </li>
                            @endcan
                </ul>
            </li>
            @endcan --}}
            {{-- @can('vouchers_view')
            <li class="treeview">
                <a class="waves-effect waves-dark" href="#!"><i class="icon-wallet"></i><span> Vouchers</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('receipt_vouhcer_view')
                    <li class="{{ request()->is('rv') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('rv.index') }}"><i class="icon-arrow-right"></i> Receipt Vouchers </a>
                    </li>
                    @endcan
                    @can('payment_voucher_view')
                    <li class="{{ request()->is('pv') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('pv.index') }}"><i class="icon-arrow-right"></i> Payment Vouchers </a>
                    </li>
                    @endcan
                    @can('journal_voucher_view')
                    <li class="{{ request()->is('jv') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('jv.index') }}"><i class="icon-arrow-right"></i> Journal Voucher </a>
                    </li>
                        @endcan
                </ul>
            </li>
            @endcan --}}
            {{-- @can('hrm_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-briefcase"></i><span> HRM</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('hrm_settings_view')
                    <li class="{{ request()->is('settings/hrm_setting') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('hrm_setting.index') }}"><i class="icon-arrow-right"></i> HRM Setting</a>
                    </li>
                    @endcan
                    @can('designation_view')
                    <li class="{{ request()->is('designations') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('designations.index') }}"><i class="icon-arrow-right"></i> Designations </a>
                    </li>
                        @endcan
                        @can('departments_view')
                    <li class="{{ request()->is('hrm/department') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('department.index') }}"><i class="icon-arrow-right"></i>Department </a>
                    </li>
                        @endcan
                    <li class="{{ request()->is('hrm/employee') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('employee.index') }}"><i class="icon-arrow-right"></i>Employee </a>
                    </li>
                        @can('attendance_view')
                    <li class="{{ request()->is('hrm/attendance') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('attendance.index') }}"><i class="icon-arrow-right"></i>Attendance </a>
                    </li>
                        @endcan
                        @can('payroll_view')
                    <li class="{{ request()->is('hrm/payroll') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('payroll.index') }}"><i class="icon-arrow-right"></i>Payroll </a>
                    </li>
                        @endcan
                        @can('holiday_view')
                    <li class="{{ request()->is('hrm/holiday') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('holiday.index') }}"><i class="icon-arrow-right"></i>Holiday </a>
                    </li>
                            @endcan
                </ul>
            </li>
            @endcan --}}
            @can('user_management_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-user"></i><span> User Management</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('users/create')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('users.create') }}"><i class="icon-arrow-right"></i> Create New User </a>
                    </li>
                    @can('new_user_view')
                    <li class="{{ (request()->is('users')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('users.index') }}"><i class="icon-arrow-right"></i> Users List </a>
                    </li>
                    <li class="{{ (request()->is('roles')) || (request()->is('roles/create')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('roles.index') }}"><i class="icon-arrow-right"></i> Roles </a>
                    </li>
                    <li class="{{ (request()->is('user/permission')) ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('permission.index') }}"><i class="icon-arrow-right"></i> Permissions </a>
                    </li>
                    <li class="">
                        <a class="waves-effect waves-dark" href="administration/login_his"><i class="icon-arrow-right"></i> Login History </a>
                    </li>
                        @endcan
                </ul>
            </li>
            @endcan
            @can('application_setup_view')
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-settings"></i>
                <span> Application Setup</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    @can('business_setting_view')
                    <li class="{{ request()->is('setting') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('setting.index') }}"><i class="icon-arrow-right"></i> Business Settings </a>
                    </li>
                    @endcan
                    @can('pos_setting_view')
                    <li class="{{ request()->is('settings/pos_setting') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('pos_setting.index') }}"><i class="icon-arrow-right"></i> POS Setting</a>
                    </li>
                        @endcan
                        @can('woocommerce_setting_view')
                    <li class="{{ request()->is('woocommerce_seetings') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('woocommerce_seetings.index') }}"><i class="icon-arrow-right"></i> Woocommerce Setting</a>
                    </li>
                        @endcan
                        {{-- @can('whatsapp_view')
                    <li class="{{ request()->is('whatsapp_seetings') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('whatsapp_seetings.index') }}"><i class="icon-arrow-right"></i> WhatsApp Setting</a>
                    </li>
                        @endcan --}}
                        @can('location_view')
                    <li class="{{ request()->is('where_house') ?'active':'' }}">
                        <a class="waves-effect waves-dark" href="{{ route('where_house.index') }}"><i class="icon-arrow-right"></i> Locations </a>
                    </li>
                        @endcan
                        {{-- @can('send_notification_view')
                    <li class="{{ request()->is('settings/notifications') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('notifications.index') }}"><i class="icon-arrow-right"></i> Send Notifications</a>
                    </li>
                        @endcan --}}
                        @can('currency_view')
                    <li class="{{ request()->is('settings/currency') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('currency.index') }}"><i class="icon-arrow-right"></i> Currency</a>
                    </li>
                        @endcan
                        @can('tax_view')
                    <li class="{{ request()->is('settings/tax') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('tax.index') }}"><i class="icon-arrow-right"></i> Tax</a>
                    </li>

                    {{--<li class="{{ request()->is('settings/sms') ? 'active' : '' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('sms.index') }}"><i class="icon-arrow-right"></i> Create SMS</a>--}}
                    {{--</li>--}}
                        @endcan
                    {{--<li class="{{ request()->is('settings/general_setting') ? 'active' : '' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('general_setting.index') }}"><i class="icon-arrow-right"></i> General Setting</a>--}}
                    {{--</li>--}}
                        @can('mail_setting_view')
                    <li class="{{ request()->is('settings/mail_setting') ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{ route('mail_setting.index') }}"><i class="icon-arrow-right"></i> Mail Setting</a>
                    </li>
                    {{--<li class="{{ request()->is('settings/sms_setting') ? 'active' : '' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('sms_setting.index') }}"><i class="icon-arrow-right"></i> SMS Setting</a>--}}
                    {{--</li>--}}
                        @endcan
                    {{--<li class="{{ request()->is('countries') ?'active':'' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('countries.index') }}"><i class="icon-arrow-right"></i> Countries </a></li>--}}
                    {{--<li class="{{ request()->is('cities')?'active':'' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('cities.index') }}"><i class="icon-arrow-right"></i> Cities </a></li>--}}
                </ul>
            </li>
            @endcan
                <li class="treeview {{explode('/',request()->getPathInfo())[1]=='reports'? 'active' : ''}}"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-bar-chart"></i><span> Reports</span><i class="icon-arrow-down"></i></a><ul class="treeview-menu"><li class="">
                    <li class="treeview ">
                        <a class="waves-effect waves-dark" href="#"><i class="fa fa-houzz"></i><span> Inventory Report</span><i class="icon-arrow-down"></i></a>
                        <ul class="treeview-menu">
                            <li class=" {{ request()->is('reports/Inventory/low_stock') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/low_stock') }}"><i class="icon-arrow-right"></i>Low Stock</a>
                            </li>
                            <li class=" {{ request()->is('reports/Inventory/available_stock') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/available_stock') }}"><i class="icon-arrow-right"></i> Available Stock</a>
                            </li>
                            <li class=" {{ request()->is('reports/Inventory/stock_transfer') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/stock_transfer') }}"><i class="icon-arrow-right"></i>Stock Transfer </a>
                            </li>
                            <li class=" {{ request()->is('reports/Inventory/stock_adjustment') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/stock_adjustment') }}"><i class="icon-arrow-right"></i> Stock adjustment</a>
                            </li>
                            <li class="{{ request()->is('reports/Inventory/opening_inventory') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/opening_inventory') }}"><i class="icon-arrow-right"></i> Opening Inventory</a>
                            </li>
                            <li class="{{ request()->is('reports/Inventory/product_stock_detail') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/Inventory/product_stock_detail') }}"><i class="icon-arrow-right"></i> Product Inventory Detail </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview ">
                        <a class="waves-effect waves-dark" href="#"><i class="fa fa-houzz"></i><span> Sale Report</span><i class="icon-arrow-down"></i></a>
                        <ul class="treeview-menu">
                            <li class=" {{ request()->is('reports/sale/invoice') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/sale/invoice') }}"><i class="icon-arrow-right"></i>Sale Invoice Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/sale/return') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/sale/return') }}"><i class="icon-arrow-right"></i>Sale Return Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/sale/product_sale') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/sale/product-wise-sale') }}"><i class="icon-arrow-right"></i>Product Wise Sale Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/sale/consolidated-sale') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/sale/consolidated-sale') }}"><i class="icon-arrow-right"></i>Consolidated Sale Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/sale/cash-register') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/sale/cash-register') }}"><i class="icon-arrow-right"></i>Cash Register Report</a>
                            </li>

                        </ul>
                    </li>

                    <li class="treeview ">
                        <a class="waves-effect waves-dark" href="#"><i class="fa fa-houzz"></i><span> Purchase Report</span><i class="icon-arrow-down"></i></a>
                        <ul class="treeview-menu">
                            <li class=" {{ request()->is('reports/purchase/invoice') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/purchase/invoice') }}"><i class="icon-arrow-right"></i>Purchase Invoice Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/purchase/return') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/purchase/return') }}"><i class="icon-arrow-right"></i>Purchase Return Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/purchase/product-wise-purchase') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/purchase/product-wise-purchase') }}"><i class="icon-arrow-right"></i>Product Wise Purchase Report</a>
                            </li>
                            <li class=" {{ request()->is('reports/purchase/consolidated-purchase') ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{ url('reports/purchase/consolidated-purchase') }}"><i class="icon-arrow-right"></i>Consolidated Purchase Report</a>
                            </li>

                        </ul>
                    </li>
                    {{-- <li class="treeview">
                        <a class="waves-effect waves-dark" href="#!"><i class="fa fa-money"></i><span>  Financial Reports</span><i class="icon-arrow-down"></i></a>
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
                    </li> --}}


                </li>

            {{--<li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-briefcase"></i><span> Business Accounts</span><i class="icon-arrow-down"></i></a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li class="{{ request()->is('branches') ? 'active' : '' }}">--}}
                        {{--<a class="waves-effect waves-dark" href="{{ route('branches.index') }}"><i class="icon-arrow-right"></i> Branch List </a>--}}
                    {{--</li></ul>--}}
            {{--</li>--}}

    </section>
</aside>

