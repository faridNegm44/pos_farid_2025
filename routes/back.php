<?php

use App\Models\Back\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Start Auth Route
Route::group(['namespace' => 'App\Http\Controllers\Back'], function(){
    Route::get('/login', function(){
        // $settings = Setting::first();
        return view('back.auth.login');
    });

    Route::post('login_post' , 'HomeController@login_post');
});


// Route::group(['prefix' => 'admin/forget_password'], function(){
//     Route::get('/', function(){
//         return view('back.auth.forget_password');
//     });
// });

// clear_cache
Route::get('clear_cache', function() {
    Artisan::call('cache:clear');
    return "cleared cache";
});

 //404
 Route::fallback(function () {
     return view('back.404');
});
// , 'middleware' => 'checkLogin' , 'middleware' => 'throttle'
Route::group(['prefix' => '/', 'namespace' => 'App\Http\Controllers\Back', 'middleware' => 'checkLogin'], function(){

    Route::get('/', 'HomeController@index');

    Route::get('logout' , 'HomeController@logout');



    ////////////////////////////////////////////////////////////////////////////////
    // Admin Home Page
    Route::get('/temp-dark', function(){
    return view('back.temp_dark.index');
    });

    // users Routes
    Route::group(['prefix' => 'users'] , function (){
        Route::get('/' , 'UsersController@index');
        Route::post('/store' , 'UsersController@store');
        Route::get('/edit/{id}' , 'UsersController@edit');
        Route::post('/update/{id}' , 'UsersController@update');
        Route::get('/destroy/{id}' , 'UsersController@destroy');
        
        Route::get('datatable' , 'UsersController@datatable');
    });

    // units Routes
    Route::group(['prefix' => 'units'] , function (){
        Route::get('/' , 'UnitsController@index');
        Route::post('/store' , 'UnitsController@store');
        Route::get('/edit/{id}' , 'UnitsController@edit');
        Route::post('/update/{id}' , 'UnitsController@update');
        Route::get('/destroy/{id}' , 'UnitsController@destroy');
        
        Route::get('datatable' , 'UnitsController@datatable');
    });
    
    // productsCategories Routes
    Route::group(['prefix' => 'productsCategories'] , function (){
        Route::get('/' , 'ProductCategoyController@index');
        Route::post('/store' , 'ProductCategoyController@store');
        Route::post('/store' , 'ProductCategoyController@store');
        Route::get('/edit/{id}' , 'ProductCategoyController@edit');
        Route::post('/update/{id}' , 'ProductCategoyController@update');
        Route::get('/destroy/{id}' , 'ProductCategoyController@destroy');
        
        Route::get('datatable' , 'ProductCategoyController@datatable');
    });
    
    // products_sub_category Routes
    Route::group(['prefix' => 'products_sub_category'] , function (){
        Route::get('/' , 'ProductSubCategoyController@index');
        Route::post('/store' , 'ProductSubCategoyController@store');
        Route::post('/store' , 'ProductSubCategoyController@store');
        Route::get('/edit/{id}' , 'ProductSubCategoyController@edit');
        Route::post('/update/{id}' , 'ProductSubCategoyController@update');
        Route::get('/destroy/{id}' , 'ProductSubCategoyController@destroy');
        
        Route::get('datatable' , 'ProductSubCategoyController@datatable');
    });

    // taswea_client_supplier Routes
    Route::group(['prefix' => 'taswea_client_supplier'] , function (){
        Route::get('/' , 'TasweaClientSupplierController@index');
        Route::post('/store' , 'TasweaClientSupplierController@store');
        Route::get('/getCurrentRemainingMoney/{clientOrSupplier}' , 'TasweaClientSupplierController@getCurrentRemainingMoney');
        
        Route::get('datatable' , 'TasweaClientSupplierController@datatable');
    });

    // taswea_products Routes
    Route::group(['prefix' => 'taswea_products'] , function (){
        Route::get('/' , 'TasweaProductsController@index');
        Route::post('/store' , 'TasweaProductsController@store');
        Route::get('/getCurrentProductQuantity/{id}' , 'TasweaProductsController@getCurrentProductQuantity');
        
        Route::get('datatable' , 'TasweaProductsController@datatable');
    });

    // companies Routes
    Route::group(['prefix' => 'companies'] , function (){
        Route::get('/' , 'CompanyController@index');
        Route::post('/store' , 'CompanyController@store');
        Route::get('/edit/{id}' , 'CompanyController@edit');
        Route::post('/update/{id}' , 'CompanyController@update');
        Route::get('/destroy/{id}' , 'CompanyController@destroy');
        
        Route::get('datatable' , 'CompanyController@datatable');
    });

    // financialYears Routes
    Route::group(['prefix' => 'financialYears'] , function (){
        Route::get('/' , 'FinancialYearsController@index');
        Route::post('/store' , 'FinancialYearsController@store');
        Route::get('/edit/{id}' , 'FinancialYearsController@edit');
        Route::post('/update/{id}' , 'FinancialYearsController@update');
        Route::get('/destroy/{id}' , 'FinancialYearsController@destroy');
        
        Route::get('datatable' , 'FinancialYearsController@datatable');
    });


    // stores Routes
    Route::group(['prefix' => 'stores'] , function (){
        Route::get('/' , 'StoreController@index');
        Route::post('/store' , 'StoreController@store');
        Route::get('/edit/{id}' , 'StoreController@edit');
        Route::post('/update/{id}' , 'StoreController@update');
        Route::get('/destroy/{id}' , 'StoreController@destroy');
        
        Route::get('datatable' , 'StoreController@datatable');
    });


    
    // financial_treasury Routes
    Route::group(['prefix' => 'financial_treasury'] , function (){
        Route::get('/' , 'FinancialTreasuryController@index');
        Route::post('/store' , 'FinancialTreasuryController@store');
        Route::get('/edit/{id}' , 'FinancialTreasuryController@edit');
        Route::post('/update/{id}' , 'FinancialTreasuryController@update');
        Route::get('/destroy/{id}' , 'FinancialTreasuryController@destroy');
        
        Route::get('datatable' , 'FinancialTreasuryController@datatable');
    });


    // clients Routes
    Route::group(['prefix' => 'clients'] , function (){
        Route::get('/' , 'ClientsController@index');
        Route::post('/store' , 'ClientsController@store');
        Route::get('/edit/{id}' , 'ClientsController@edit');
        Route::post('/update/{id}' , 'ClientsController@update');
        Route::get('/destroy/{id}' , 'ClientsController@destroy');
        
        Route::post('store_client_from_pos_page' , 'ClientsController@storeClientFromPosPage');
        Route::post('/import' , 'ClientsController@import');
        Route::get('datatable' , 'ClientsController@datatable');

        //تقرير عن حركة عميل
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsClientsController@index');
            Route::post('result' , 'ReportsClientsController@result');
            Route::get('result/pdf' , 'ReportsClientsController@result_pdf'); // خاص بتقرير عن حركة الجةة pdf
            Route::get('account_statement' , 'ReportsClientsController@account_statement'); // خاص بكشف الحساب
            Route::get('account_statement/pdf' , 'ReportsClientsController@account_statement_pdf'); // خاص بكشف الحساب pdf
        });
    });
    

    // suppliers Routes
    Route::group(['prefix' => 'suppliers'] , function (){
        Route::get('/' , 'SuppliersController@index');
        Route::post('/store' , 'SuppliersController@store');
        Route::get('/edit/{id}' , 'SuppliersController@edit');
        Route::post('/update/{id}' , 'SuppliersController@update');
        Route::get('/destroy/{id}' , 'SuppliersController@destroy');
        
        Route::post('store_client_from_pos_page' , 'SuppliersController@storeClientFromPosPage');
        Route::post('/import' , 'SuppliersController@import');
        Route::get('datatable' , 'SuppliersController@datatable');

        //تقرير عن حركة مورد
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsSuppliersController@index');
            Route::post('result' , 'ReportsSuppliersController@result');
            Route::get('result/pdf' , 'ReportsSuppliersController@result_pdf');
        });
    });
    

    // treasury_bills Routes
    Route::group(['prefix' => 'treasury_bills'] , function (){
        Route::get('/' , 'TreasuryBillsController@index');
        Route::get('/create' , 'TreasuryBillsController@create');

        Route::post('/store' , 'TreasuryBillsController@store');
        Route::get('/edit/{id}' , 'TreasuryBillsController@edit');
        Route::post('/update/{id}' , 'TreasuryBillsController@update');
        Route::get('datatable' , 'TreasuryBillsController@datatable');

        //تقرير عن حركة الخزائن المالية
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsTreasuryBills@index');
            Route::post('result' , 'ReportsTreasuryBills@result');
            Route::get('result/pdf' , 'ReportsTreasuryBills@result_pdf');
        });
    });
    
    // products Routes
    Route::group(['prefix' => 'products'] , function (){
        Route::get('/' , 'ProductController@index');
        Route::post('/store' , 'ProductController@store');
        Route::get('/edit/{id}' , 'ProductController@edit');
        Route::get('/get_sub_categories/{id}' , 'ProductController@get_sub_categories');
        
        Route::post('/update/{id}' , 'ProductController@update');
        Route::get('/destroy/{id}' , 'ProductController@destroy');
        Route::get('datatable' , 'ProductController@datatable');
        
        Route::get('/getProductsByStore/{store}' , 'ReportsProductsController@getProductsByStore');

        //تقرير عن حركة صنف
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsProductsController@index');
            Route::post('result' , 'ReportsProductsController@result');
            Route::get('result/pdf' , 'ReportsProductsController@result_pdf');
        });
        
        //تقرير عن كشكول النواقص
        Route::group(['prefix' => 'report/stock_alert'] , function (){
            Route::get('/' , 'ReportsProductsStockAlertController@index');
            Route::post('result' , 'ReportsProductsStockAlertController@result');
            Route::get('result/pdf' , 'ReportsProductsStockAlertController@result_pdf');
        });
    });

    // pos Routes
    Route::group(['prefix' => 'pos'] , function (){
        Route::get('/' , 'PosController@index');
        Route::get('/create' , 'PosController@create');
        Route::post('/store' , 'PosController@store');
        Route::get('/edit/{id}' , 'PosController@edit');
        Route::post('/update/{id}' , 'PosController@update');
        Route::get('/destroy/{id}' , 'PosController@destroy');
        
        Route::get('datatable' , 'PosController@datatable');
    });


    // expenses
    Route::group(['prefix' => 'expenses'] , function (){
        Route::get('/' , 'ExpensesController@index');
        Route::post('/store' , 'ExpensesController@store');
        Route::get('/edit/{id}' , 'ExpensesController@edit');
        Route::post('/update/{id}' , 'ExpensesController@update');
        Route::get('/destroy/{id}' , 'ExpensesController@destroy');
        
        Route::get('datatable' , 'ExpensesController@datatable');
        //تقرير عن المصروفات
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsExpensesController@index');
            Route::post('result' , 'ReportsExpensesController@result');
            Route::get('result/pdf' , 'ReportsExpensesController@result_pdf');
        });
    });

    // transfer_between_storages
    Route::group(['prefix' => 'transfer_between_storages'] , function (){
        Route::get('/' , 'TransferBetweenStoragesController@index');
        Route::post('/store' , 'TransferBetweenStoragesController@store');
        Route::get('/edit/{id}' , 'TransferBetweenStoragesController@edit');
        Route::post('/update/{id}' , 'TransferBetweenStoragesController@update');
        Route::get('/show/{id}' , 'TransferBetweenStoragesController@show');
        
        Route::get('/get_last_money_on_treasury/{transaction_from}/{transaction_to}' , 'TransferBetweenStoragesController@get_last_money_on_treasury');
        
        Route::get('datatable' , 'TransferBetweenStoragesController@datatable');
    });

    // transfer_between_stores
    Route::group(['prefix' => 'transfer_between_stores'] , function (){
        Route::get('/' , 'TransferBetweenStoresController@index');
        Route::post('/store' , 'TransferBetweenStoresController@store');
        Route::get('/edit/{id}' , 'TransferBetweenStoresController@edit');
        Route::post('/update/{id}' , 'TransferBetweenStoresController@update');
        Route::get('/show/{id}' , 'TransferBetweenStoresController@show');
        
        Route::get('/get_products/{transfer_from}' , 'TransferBetweenStoresController@get_products');
        Route::get('/get_product_stores/{product}' , 'TransferBetweenStoresController@get_product_stores');
        
        Route::get('datatable' , 'TransferBetweenStoresController@datatable');
    });


    // Get Info Of client || supplier || treasury || store || product || transfer || expense
    Route::group(['prefix' => 'get_info'] , function (){
        Route::get('/client_or_supplier/{id}' , 'GetInfoController@client_or_supplier');
        //Route::get('/client_or_supplier/{id}' , 'GetInfoController@clientInfo');

        Route::get('/treasury/{id}' , 'GetInfoController@treasury');
    });
    // Get Info Of client || supplier || treasury || store || product || transfer || expense


    
    // purchases Routes
    Route::group(['prefix' => 'purchases'] , function (){
        Route::get('/' , 'PurchaseBillController@index');
        Route::get('/create' , 'PurchaseBillController@create');
        Route::post('/store' , 'PurchaseBillController@store');
        Route::get('/edit/{id}' , 'PurchaseBillController@edit');
        Route::get('/show/{id}' , 'PurchaseBillController@show');
        Route::post('/update/{id}' , 'PurchaseBillController@update');
        Route::get('/destroy/{id}' , 'PurchaseBillController@destroy');
        
        Route::get('datatable' , 'PurchaseBillController@datatable');

        //تقرير عن فواتير مشتريات  
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsPurchaseBillsController@index');
            Route::post('result' , 'ReportsPurchaseBillsController@result');
            Route::get('result/pdf' , 'ReportsPurchaseBillsController@result_pdf');
            Route::get('result/pdf/{id}' , 'ReportsPurchaseBillsController@result_pdf_internal');
        });
    });


    // purchases_return Routes  مرتجع مشتريات
    Route::group(['prefix' => 'purchases_return'] , function (){
        Route::get('/' , 'PurchaseReturnBillController@index');
        Route::get('/{id}' , 'PurchaseReturnBillController@create');
        Route::post('/store/{id}' , 'PurchaseReturnBillController@store');

        Route::get('/show/{id}' , 'PurchaseReturnBillController@show');
        Route::post('/update/{id}' , 'PurchaseReturnBillController@update');
        Route::get('/destroy/{id}' , 'PurchaseReturnBillController@destroy');
        
        Route::get('datatable' , 'PurchaseReturnBillController@datatable');

        //تقرير عن فواتير مرتجع مشتريات  
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsPurchaseReturnBillsController@index');
            Route::post('result' , 'ReportsPurchaseReturnBillsController@result');
            Route::get('result/pdf' , 'ReportsPurchaseReturnBillsController@result_pdf');
            Route::get('result/pdf/{id}' , 'ReportsPurchaseReturnBillsController@result_pdf_internal');
        });
    });

    
    // sales Routes
    Route::group(['prefix' => 'sales'] , function (){
        Route::get('/' , 'SaleBillController@index');
        Route::get('/create' , 'SaleBillController@create');
       
        Route::post('/store' , 'SaleBillController@store');
       
        Route::get('/edit/{id}' , 'SaleBillController@edit');
        Route::get('/show/{id}' , 'SaleBillController@show');
        Route::post('/update/{id}' , 'SaleBillController@update');
        Route::get('/destroy/{id}' , 'SaleBillController@destroy');
        
        Route::get('datatable' , 'SaleBillController@datatable');
        
        //تقرير عن فواتير مبيعات  
        Route::group(['prefix' => 'report'] , function (){
            Route::get('/' , 'ReportsSaleBillsController@index');
            Route::post('result' , 'ReportsSaleBillsController@result');
            Route::get('result/pdf' , 'ReportsSaleBillsController@result_pdf');
            Route::get('result/pdf/{id}' , 'ReportsSaleBillsController@result_pdf_internal');
            
            Route::get('print_receipt/{id}', 'SaleBillController@print_receipt'); // طباعة ريسيت فاتورة البيع
        });
    });
    
    
    
    // search_products Routes
    Route::group(['prefix' => 'search_products'] , function (){
        Route::get('/{data}' , 'SearchController@search_products');
    });



    // start get all products contains char this search
    Route::get('search_products_by_selectize' , 'SearchController@search_products_by_selectize');
    Route::get('search_suppliers_by_selectize' , 'SearchController@search_suppliers_by_selectize');
    Route::get('search_clients_by_selectize' , 'SearchController@search_clients_by_selectize');
    // end get all products contains char this search



    // settings Routes
    Route::group(['prefix' => 'settings'] , function (){
        Route::get('/' , 'SettingController@index');
        Route::post('/update' , 'SettingController@update');

        Route::get('datatable' , 'SettingController@datatable');
    });


    
});