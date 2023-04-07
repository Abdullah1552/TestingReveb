<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\GeneralSettingController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/optimize', function() {
// //    $exitCode = Artisan::call('optimize');
//      \Artisan::call('queue:work');
//     //return '<h1>Reoptimized class loader</h1>';
// });

Route::get('/', function () {
    return Redirect::to('login');
});

Route::get('user_notification', function () {
    event(new \App\Events\UserNotification());
    $user=User::first();
    $user->notify(new \App\Notifications\UserNotification());
    return "Event has been sent!";
});
Route::get('/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword_view'])->name('resetPassword_view');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/summery-report', function () {
        return view('Reports.summary_report.index');
    });
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::get('whatsapp',function (){
        \App\Jobs\WhatsAppMessageJob::dispatch(5)->delay(now()->addSeconds(2));
    });
    Route::resource('products', ProductController::class);
    Route::resource('product_brand', ProductBrandController::class);
    Route::post('bulk_product_brand', 'ProductBrandController@bulk_upload');
    Route::post('get_product_brand', 'ProductBrandController@get_data');
    Route::get('print_barcode', 'BarcodeController@print_barcode');
    Route::get('generate_product_code', 'BarcodeController@generateProductBarcode');


    Route::resource('product_category', Products\ProductCategoryController::class);
    Route::post('bulk_product_category', 'Products\ProductCategoryController@bulk_upload');
    Route::post('get_product_category', 'Products\ProductCategoryController@get_data');
    Route::resource('root_coa', RootCoaController::class);
    Route::resource('head_acc', HeadAccCoaController::class);
    Route::resource('subheads', SubHeadController::class);
    Route::resource('trans_acc', AccountTransactionController::class);
    Route::post('get_trans_acc', [App\Http\Controllers\AccountTransactionController::class, 'get_data']);

    Route::get('warehouses/user/{id?}', [App\Http\Controllers\WhereHouseController::class, 'user_warehouses']);
    Route::resource('where_house', WhereHouseController::class);
    Route::post('get_where_house', 'WhereHouseController@get_data');
    Route::post('get_customers', [\App\Http\Controllers\People\CustomerController::class, 'get_data']);
    Route::resource('customer_types', CustomerTypeController::class);
    Route::post('get_customer_types', [App\Http\Controllers\CustomerTypeController::class, 'get_data']);
    Route::resource('suppliers', SupplierController::class);
    Route::post('get_suppliers', [\App\Http\Controllers\People\SupplierController::class, 'get_data']);
    Route::get('fetch_supplier_det/{id}', [\App\Http\Controllers\People\SupplierController::class, 'fetch_supplier_det']);
    //settins
    Route::resource('countries', SupplierController::class);
    Route::post('get_countries', [App\Http\Controllers\CountryController::class, 'get_data'])->name('get_countries');
    Route::resource('countries', CountryController::class);
    Route::resource('zone', ZoneController::class);
    Route::post('get_zones', [App\Http\Controllers\ZoneController::class, 'get_data'])->name('get_zones');
    Route::resource('cities', CityController::class);
    Route::post('get_cities', [App\Http\Controllers\CityController::class, 'get_data']);
    Route::resource('areas', AreaController::class);
    Route::post('get_areas', [App\Http\Controllers\AreaController::class, 'get_data']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('login');
    });
    Route::get('woocomerce', 'ItemController@woocomerce');

    Route::get('items/import-products', [\App\Http\Controllers\ItemController::class,'import']);
    Route::post('items/import-products', [\App\Http\Controllers\ItemController::class,'import']);
    Route::resource('items', ItemController::class);
    Route::get('product_code', 'ItemController@product_code');
    Route::post('get_items', [App\Http\Controllers\ItemController::class, 'get_data']);
    Route::post('get_brand_items', [App\Http\Controllers\ItemController::class, 'get_brand_data']);
    Route::post('get_category_items', [App\Http\Controllers\ItemController::class, 'get_category_data']);
    //get data against parent id
    Route::get('fetch_head_acc', [App\Http\Controllers\HeadAccCoaController::class, 'fetch_head_acc'])->name('fetch_head_acc');
    Route::resource('charges', ChargesController::class);
    Route::post('get_charges', [App\Http\Controllers\ChargesController::class, 'get_data']);
    Route::resource('transports', TransportController::class);
    Route::post('get_transports', [App\Http\Controllers\TransportController::class, 'get_data']);
    Route::resource('branches', BranchesController::class);
    Route::resource('setting', SettingController::class);
    Route::post('get_branches', [App\Http\Controllers\BranchesController::class, 'get_data']);
    Route::resource('banks', BankController::class);
    Route::resource('opening_inventory', OInventoryController::class);
    Route::post('get_opening_inventory', 'OInventoryController@get_data');
    Route::delete('delete_multiple_opening_inventory', 'OInventoryController@delete_multiple');
    Route::get('print_opening_inventory/{id}','OInventoryController@print_data');
    Route::resource('quotation', QuotationController::class);
    Route::post('get_quotation_details', [App\Http\Controllers\QuotationController::class, 'get_data']);
    Route::get('print_quotation/{id}', [App\Http\Controllers\QuotationController::class, 'print_quotation']);

    Route::resource('sale_invoice', SaleorderController::class);
    Route::post('get_sale_order_invoice', [App\Http\Controllers\SaleorderController::class,'get_data']);
    Route::get('print_sale/{id}','SaleorderController@print_sale');
    //website orders
    Route::resource('website_order',OrderController::class);
    Route::get('get_website_order',[\App\Http\Controllers\OrderController::class,'get_data']);

    Route::resource('rv', ReceiptVoucherController::class);
    Route::post('get_rv', 'ReceiptVoucherController@get_data');
    Route::resource('pv', PaymentVoucherController::class);
    Route::post('get_pv', 'PaymentVoucherController@get_data');
    Route::resource('jv', JournalVoucherController::class);
    Route::resource('gst_sale_invoice', GstSaleInvoiceController::class);
    Route::resource('purchase_invoice', PurchaseInvoiceController::class);
    Route::post('get_purchase_invoices', [App\Http\Controllers\PurchaseInvoiceController::class, 'get_data']);
    Route::resource('purchase_order', PurchaseOrderController::class);
    Route::post('load_product', 'PurchaseOrderController@loadProducts');
    Route::post('load_productPurchae', 'PurchaseOrderController@loadProductsPurchase');
    Route::get('print_purchase/{id}', 'PurchaseOrderController@print_purchase');
    //fetch sale invoices against client id
    Route::get('get_client_inv_list/{id}',[App\Http\Controllers\ReceiptVoucherController::class,'get_client_inv_list']);
    Route::post('get_purchaseorder', [App\Http\Controllers\PurchaseOrderController::class,'get_data']);
    Route::get('purchase_by_csv', [App\Http\Controllers\PurchaseOrderController::class,'purchaseByCsv'])->name('purchase_by_csv');
    Route::get('sale_by_csv', [App\Http\Controllers\SaleorderController::class,'saleByCsv'])->name('sale_by_csv');
    Route::resource('gate_pass', GatePassController::class);
    Route::post('get_gate_pass', [App\Http\Controllers\GatePassController::class, 'get_data']);
    Route::resource('cost_center', CostcentrController::class);
    Route::post('get_cost_center', [App\Http\Controllers\CostcentrController::class, 'get_data']);
    Route::resource('unit_type', UnitTypeController::class);
    Route::post('get_unit_types', [App\Http\Controllers\UnitTypeController::class, 'get_data']);
    Route::resource('designations', DesignationController::class);
    Route::post('get_designations', [App\Http\Controllers\DesignationController::class, 'get_data']);
    //pos
    Route::prefix('sale')->group(function (){
        Route::prefix('pos')->group(function (){

            Route::post('recent_sale_invoice', 'SaleorderController@recent_sale_invoice');
            Route::get('cash-register/get_data', [\App\Http\Controllers\Sale\CashRegisterController::class,'check_cash_register']);
            Route::post('cash-register/close', [\App\Http\Controllers\Sale\CashRegisterController::class,'close_register']);
            Route::resource('cash-register', Sale\CashRegisterController::class);


        });
        Route::resource('pos',Sale\PosController::class);
        Route::resource('gift_card', Sale\GiftCardController::class);
        Route::resource('coupon', Sale\CouponController::class);
        Route::resource('delivery', Sale\PosController::class);
        Route::get('gen_invoice/{id?}', 'Sale\PosController@gen_invoice');
        Route::post('fetch_product', 'Sale\PosController@fetch_product');
    });
    Route::prefix('product')->group(function (){
        Route::resource('stock_count', StockCountController::class);
        Route::resource('stock_count', StockCountController::class);
        Route::post('get_stock_count', 'StockCountController@get_data');
        Route::resource('attributes', AttributeController::class);
        Route::post('get_attributes', 'AttributeController@get_data');
        Route::resource('adjustment', AdjustmentController::class);
        Route::delete('delete_multiple_adjustments',[\App\Http\Controllers\AdjustmentController::class,'delete_multiple']);
        Route::post('get_adjustment', 'AdjustmentController@get_data');
        Route::get('print_adjustment/{id}','AdjustmentController@print_data');
        Route::get('check_wh_stock/{code}','StockCountController@check_wh_stock');
    });
    Route::prefix('settings')->group(function (){
        Route::resource('notifications', Setting\SendNotificationController::class);
        Route::resource('customer_group', Setting\CustomerGroupController::class);
        Route::post('get_customer_group', 'Setting\CustomerGroupController@get_data');
        Route::resource('brand', Setting\BrandController::class);
        Route::resource('currency', Setting\CurrencyController::class);
        Route::post('get_currency', 'Setting\CurrencyController@get_data');
        Route::resource('tax', Setting\TaxController::class);
        Route::post('get_tax', 'Setting\TaxController@get_data');
        Route::resource('updateprofile', Setting\UpdateProfileController::class);
        Route::resource('sms', Setting\SmsController::class);
        Route::resource('general_setting', Setting\GeneralSettingController::class);

        Route::post('business_setting', [GeneralSettingController::class,'businessSettingSaveData'])->name('businessSettingSaveData');
        Route::post('business_setting-edit', [GeneralSettingController::class,'editBusinessSetting'])->name('editBusinessSetting');


        Route::post('mail_setting/test-mail', [App\Http\Controllers\Setting\MailSettingController::class, 'test_mail']);
        Route::resource('mail_setting', Setting\MailSettingController::class);
        Route::post('get_mail_setting', [App\Http\Controllers\Setting\MailSettingController::class, 'get_data'])->name('get_mail_setting');
        Route::resource('sms_setting', Setting\SmsSettingController::class);
        Route::resource('reward_point_setting', Setting\RewardPointSettingController::class);
        Route::get('pos_setting/user/{id?}', [\App\Http\Controllers\Setting\PosSettingController::class,'user_setting']);
        Route::resource('pos_setting', Setting\PosSettingController::class);
        Route::resource('hrm_setting', Setting\HrmSettingController::class);
    });

    Route::prefix('transfers')->group(function (){
        Route::resource('transfer', TransferController::class);
        Route::post('get_transfers', 'TransferController@get_data');
        Route::delete('delete_multiple_transfers', 'TransferController@delete_multiple');
        Route::get('transfer_by_csv', [TransferController::class,'transferByCsv'])->name('transfer_by_csv');
        Route::get('print_transfers/{id}','TransferController@print_data');
    });
    Route::prefix('returns')->group(function (){

        Route::resource('sale_return', SaleReturnController::class);
        Route::post('get_sale_return', 'SaleReturnController@get_data');
        Route::get('sale_return_print/{id}','SaleReturnController@print_data');
        Route::resource('purchase_return', PurchaseReturnController::class);
        Route::post('get_purchase_return', 'PurchaseReturnController@get_data');
        Route::get('purchase_return_print/{id}','PurchaseReturnController@print_data');
    });

    Route::prefix('hrm')->group(function (){
        Route::post('get_departments', 'DepartmentController@get_data');
        Route::resource('department', DepartmentController::class);
        Route::resource('employee', EmployeeController::class);
        Route::post('get_employee', 'EmployeeController@get_data');

        Route::resource('attendance', AttendanceController::class);
        Route::resource('payroll', PayrollController::class);
        Route::post('get_payroll', 'PayrollController@get_data');
        Route::resource('holiday', HolidayController::class);
        Route::post('get_holiday', 'HolidayController@get_data');

    });
    Route::prefix('people')->group(function (){
        Route::resource('customers', People\CustomerController::class);
        Route::post('get_customers', [\App\Http\Controllers\People\CustomerController::class, 'get_data']);
        Route::resource('sale_persons', People\SalePersonController::class);
        Route::post('get_sale_person', 'People\SalePersonController@get_data');
        Route::resource('suppliers', People\SupplierController::class);
        Route::post('get_suppliers', 'SupplierController@get_data');

    });
    Route::prefix('user')->group(function (){
        Route::resource('permission', PermissionsController::class);
        Route::post('get_permission', 'PermissionsController@get_data');
    });
    Route::post('get_menu', 'RoleController@get_menu');
    Route::resource('discounts', DiscountController::class);
    Route::post('discount_on', [App\Http\Controllers\DiscountController::class,'discountOn']);
    Route::post('discount_on_category', [App\Http\Controllers\DiscountController::class,'discount_on_category']);
    Route::post('get_discounts', 'DiscountController@get_data');
    Route::Delete('delete_multiple_discounts', 'DiscountController@delete_multiple');
    Route::post('discounts/change-status', 'DiscountController@change_status');
    Route::POST('woocommerce_toggle',[\App\Http\Controllers\WoocommerceSettingController::class,'woocommerce_toggle']);
    Route::post('woocommerce_seetings/upload_products',[\App\Http\Controllers\WoocommerceSettingController::class,'upload_products']);
    Route::post('woocommerce_seetings/update-products',[\App\Http\Controllers\WoocommerceSettingController::class,'update_products']);
    Route::post('woocommerce_seetings/update-products-stock',[\App\Http\Controllers\WoocommerceSettingController::class,'update_products_stock']);
    Route::resource('woocommerce_seetings',WoocommerceSettingController::class);
    Route::resource('whatsapp_seetings',WhatsappSettingController::class);

    Route::prefix('reports')->group(function (){
        Route::prefix('finance')->group(function (){
            Route::get('ledger','Reports\FinanceReportController@ledger_report');
            Route::post('print_ledger','Reports\FinanceReportController@print_ledger');
            Route::get('cash_register','Reports\FinanceReportController@cash_register');
            Route::post('get_cash_register','Reports\FinanceReportController@get_cash_register');
            Route::post('print_cr','Reports\FinanceReportController@print_cash_register');
        });

    });
    Route::prefix('accounts')->group(function (){
       Route::prefix('reports')->group(function (){
          Route::get('trail_balance','Accounts\Reports\TraialBalanceController@index');
          Route::get('income_statement','Accounts\Reports\IncomeStatementController@index');
          Route::get('balance_sheet','Accounts\Reports\BalanceSheetController@index');
          Route::get('day_book','Accounts\Reports\AccountDayBookController@index');
          Route::get('view_account_day_book/{id}','Accounts\Reports\AccountDayBookController@view_account_day_book');
       });
    });
    Route::prefix('reports')->group(function (){
       Route::prefix('Inventory')->group(function (){
           Route::prefix('low_stock')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\LowStockController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\LowStockController::class,'get_records']);
           });
           Route::prefix('available_stock')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\AvailableStockController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\AvailableStockController::class,'get_records']);
           });
           Route::prefix('stock_transfer')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\StockTransferController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\StockTransferController::class,'get_records']);
           });
           Route::prefix('stock_adjustment')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\StockAdjustmentController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\StockAdjustmentController::class,'get_records']);
           });
           Route::prefix('opening_inventory')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\OpeningInventoryController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\OpeningInventoryController::class,'get_records']);
           });
           Route::prefix('product_stock_detail')->group(function (){
               Route::get('',[\App\Http\Controllers\Reports\inventory\ProductDetailController::class,'index']);
               Route::post('',[\App\Http\Controllers\Reports\inventory\ProductDetailController::class,'get_records']);
           });
          Route::get('income_statement','Accounts\Reports\IncomeStatementController@index');
          Route::get('balance_sheet','Accounts\Reports\BalanceSheetController@index');
          Route::get('day_book','Accounts\Reports\AccountDayBookController@index');
          Route::get('view_account_day_book/{id}','Accounts\Reports\AccountDayBookController@view_account_day_book');
       });
        Route::prefix('purchase')->group(function (){
            Route::prefix('invoice')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Purchase\PurchaseInvoiceController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Purchase\PurchaseInvoiceController::class,'get_records']);
            });
            Route::prefix('return')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Purchase\PurchaseReturnController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Purchase\PurchaseReturnController::class,'get_records']);
            });
            Route::prefix('product-wise-purchase')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Purchase\ProductPurchaseController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Purchase\ProductPurchaseController::class,'get_records']);
            });
            Route::prefix('consolidated-purchase')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Purchase\ConsolidatedPurchaseReport::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Purchase\ConsolidatedPurchaseReport::class,'get_records']);
            });
        });
        Route::prefix('sale')->group(function (){
            Route::prefix('invoice')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Sale\SaleInvoiceController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Sale\SaleInvoiceController::class,'get_records']);
            });
            Route::prefix('return')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Sale\SaleReturnController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Sale\SaleReturnController::class,'get_records']);
            });
            Route::prefix('product-wise-sale')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Sale\ProductSaleController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Sale\ProductSaleController::class,'get_records']);
            });
            Route::prefix('consolidated-sale')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Sale\ConsolidatedSaleReport::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Sale\ConsolidatedSaleReport::class,'get_records']);
            });
            Route::prefix('cash-register')->group(function (){
                Route::get('',[\App\Http\Controllers\Reports\Sale\CashRegisterController::class,'index']);
                Route::post('',[\App\Http\Controllers\Reports\Sale\CashRegisterController::class,'get_records']);
            });
        });

    });
});

// Stock fix routes
Route::get('/stock_check55432', 'QuickFixController@stock_check');



