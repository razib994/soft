<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/project_dashboard', 'DashboardController@projectDashboard')->name('admin.project_dashboard');
    Route::get('/colloections', 'DashboardController@collectionDashboard')->name('admin.colloections');
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    // Roles Controller
    Route::resource('roles', 'RolesController',['name','admin.roles']);
    Route::resource('users', 'UsersController',['name','admin.users']);
    Route::resource('admins', 'AdminsController',['name','admin.admins']);
    Route::resource('projects', 'ProjectsController',['name','admin.projects']);
    Route::resource('visitors', 'VisitorsController',['name','admin.visitors']);
    Route::resource('categories', 'CategoryController',['name','admin.categories']);
    Route::resource('professionals', 'ProfessionalController',['name','admin.professionals']);
    Route::resource('clients', 'ClientController',['name','admin.clients']);
    Route::resource('items', 'ItemController',['name','admin.items']);
    Route::resource('investmoneys', 'InvestMoneyController',['name','admin.investmoneys']);
    Route::resource('othersloans', 'OtherLoanController',['name','admin.othersloans']);
    Route::resource('otherof', 'OthersExpenditure',['name','admin.otherof']);
    Route::resource('bank_transfers', 'BankTransferController',['name','admin.bank_transfers']);
    Route::resource('bankloans', 'BankLoanController',['name','admin.bankloans']);

    Route::get('investmoneys/{id}/investmoneyadd','InvestAddController@index')->name('investmoneys.investmoneyadd');
    Route::get('investmoneys/{id}/create','InvestAddController@create')->name('investmoneys.created');
    Route::post('investmoneys/{id}/store','InvestAddController@store')->name('investmoneys.stored');
    Route::delete('investmoneys/{id}/investmoneyadd/{investor_id}','InvestAddController@destroy')->name('investmoneys.investmoneyadd.destroy');
    Route::get('investmoneys/{id}/investmoneyadd/{investor_id}','InvestAddController@edit')->name('investmoneys.investmoneyadd.edit');
    Route::put('investmoneys/{id}/investmoneyadd/{investor_id}','InvestAddController@update')->name('investmoneys.investmoneyadd.update');

    Route::get('investmoneysd/{id}/investmoneyexpense','InvestExpenseController@index')->name('investmoneysd.investmoneyexpense');
    Route::get('investmoneysd/{id}/create','InvestExpenseController@create')->name('investmoneysd.created');
    Route::post('investmoneysd/{id}/store','InvestExpenseController@store')->name('investmoneysd.stored');
    Route::delete('investmoneysd/{id}/investmoneyexpense/{investor_id}','InvestExpenseController@destroy')->name('investmoneysd.investmoneyexpense.destroy');
    Route::get('investmoneysd/{id}/investmoneyexpense/{investor_id}','InvestExpenseController@edit')->name('investmoneysd.investmoneyexpense.edit');
    Route::put('investmoneysd/{id}/investmoneyexpense/{investor_id}','InvestExpenseController@update')->name('investmoneysd.investmoneyexpense.update');

    Route::get('othersloan/{id}/loanadd','OtherLoanAddController@index')->name('othersloan.loanadd');
    Route::get('othersloan/{id}/create','OtherLoanAddController@create')->name('othersloan.created');
    Route::post('othersloan/{id}/store','OtherLoanAddController@store')->name('othersloan.stored');
    Route::delete('othersloan/{id}/loanadd/{investor_id}','OtherLoanAddController@destroy')->name('othersloan.loanadd.destroy');
    Route::get('othersloan/{id}/loanadd/{investor_id}','OtherLoanAddController@edit')->name('othersloan.loanadd.edit');
    Route::put('othersloan/{id}/loanadd/{investor_id}','OtherLoanAddController@update')->name('othersloan.loanadd.update');

    Route::get('othersloans/{id}/loanexpense','OtherLoanExpenseController@index')->name('othersloans.loanexpense');
    Route::get('othersloans/{id}/create','OtherLoanExpenseController@create')->name('othersloans.created');
    Route::post('othersloans/{id}/store','OtherLoanExpenseController@store')->name('othersloans.stored');
    Route::delete('othersloans/{id}/loanexpense/{investor_id}','OtherLoanExpenseController@destroy')->name('othersloans.loanexpense.destroy');
    Route::get('othersloans/{id}/loanexpense/{investor_id}','OtherLoanExpenseController@edit')->name('othersloans.loanexpense.edit');
    Route::put('othersloans/{id}/loanexpense/{investor_id}','OtherLoanExpenseController@update')->name('othersloans.loanexpense.update');

    Route::get('bankloans/{id}/bankloanadd','BankLoanAddController@index')->name('bankloans.bankloanadd');
    Route::get('bankloans/{id}/create','BankLoanAddController@create')->name('bankloans.created');
    Route::post('bankloans/{id}/store','BankLoanAddController@store')->name('bankloans.stored');
    Route::delete('bankloans/{id}/bankloanadd/{investor_id}','BankLoanAddController@destroy')->name('bankloans.bankloanadd.destroy');
    Route::get('bankloans/{id}/bankloanadd/{investor_id}','BankLoanAddController@edit')->name('bankloans.bankloanadd.edit');
    Route::put('bankloans/{id}/bankloanadd/{investor_id}','BankLoanAddController@update')->name('bankloans.bankloanadd.update');

    Route::get('bankloanex/{id}/bankloanexpense','BankLoanExpenseController@index')->name('bankloanex.bankloanexpense');
    Route::get('bankloanex/{id}/create','BankLoanExpenseController@create')->name('bankloanex.created');
    Route::post('bankloanex/{id}/store','BankLoanExpenseController@store')->name('bankloanex.stored');
    Route::delete('bankloanex/{id}/bankloanexpense/{investor_id}','BankLoanExpenseController@destroy')->name('bankloanex.bankloanexpense.destroy');
    Route::get('bankloanex/{id}/bankloanexpense/{investor_id}','BankLoanExpenseController@edit')->name('bankloanex.bankloanexpense.edit');
    Route::put('bankloanex/{id}/bankloanexpense/{investor_id}','BankLoanExpenseController@update')->name('bankloanex.bankloanexpense.update');
    // Profit Loss
    Route::get('/balance-pdf/{start_date}/{end_date}',[
        'as' => 'admin.balance-pdf',
        'uses' => 'ReportController@balance_report'
    ]);

    Route::get('/final-pdf/{start_date}/{end_date}',[
        'as' => 'admin.final-pdf',
        'uses' => 'ReportController@createPDFfinal'
    ]);
    Route::get('/cash-pdf/{start_date}/{end_date}',[
        'as' => 'admin.cash-pdf',
        'uses' => 'ReportController@createPDFcash'
    ]);
    Route::get('/expenditure-pdf/{start_date}/{end_date}',[
        'as' => 'admin.expenditure-pdf',
        'uses' => 'ReportController@createPDFexpenditure'
    ]);
    Route::get('/client-report-pdf',[
        'as' => 'admin.client-report-pdf',
        'uses' => 'ReportController@client_report_pdf'
    ]);
    Route::get('/withdraw-pdf/{start_date}/{end_date}',[
        'as' => 'admin.withdraw-pdf',
        'uses' => 'WidrawController@createPDFwithdraw'
    ]);
    Route::get('/deposit-pdf/{start_date}/{end_date}',[
        'as' => 'admin.deposit-pdf',
        'uses' => 'DepositController@createPDFdeposit'
    ]);
    Route::get('/banks-pdf/{id}/{start_date}/{end_date}',[
        'as' => 'admin.banks-pdf',
        'uses' => 'ReportController@createPDFbanks'
    ]);
    Route::get('/collection_pdf_statement/{start_date}/{end_date}',[
        'as' => 'admin.collection_pdf_statement',
        'uses' => 'ReportController@createPDFcollection'
    ]);
    Route::get('/bank-export-pdf/{start_date}/{end_date}',[
        'as' => 'admin.bank-export-pdf',
        'uses' => 'BankController@createPDFBanked'
    ]);
    Route::get('/bankloan/{start_date}/{end_date}',[
        'as' => 'admin.bankloan',
        'uses' => 'BankLoanController@createPDFBankLoan'
    ]);
    Route::get('/bank-loan-add/{id}/{start_date}/{end_date}',[
        'as' => 'admin.bank-loan-add',
        'uses' => 'BankLoanAddController@createPDFBankLoanAddpdf'
    ]);
    Route::get('/bank-loan-expense/{id}/{start_date}/{end_date}',[
        'as' => 'admin.bank-loan-expense',
        'uses' => 'BankLoanExpenseController@createPDFBankLoanExpensepdf'
    ]);

    Route::get('/pdf-project-wise-payments/{id}/{start_date}/{end_date}',[
        'as' => 'admin.pdf-project-wise-payments',
        'uses' => 'ProjectPaymentController@createPDFWise'
    ]);
    Route::get('/pdf-project-payments/{id}/{start_date}/{end_date}',[
        'as' => 'admin.pdf-project-payments',
        'uses' => 'ProjectPaymentController@createPDF'
    ]);

    Route::get('/pdf-clients-payments/{id}/{start_date}/{end_date}',[
        'as' => 'admin.pdf-clients-payments',
        'uses' => 'ClientPaymentsController@createPDF'
    ]);
    Route::get('/client_pdf/{id}',[
        'as' => 'admin.client_pdfs',
        'uses' => 'ReportController@pdfs'
    ]);
    Route::get('/project-balance-pdf/{start_date}/{end_date}',[
        'as' => 'admin.project-balance-pdf',
        'uses' => 'ReportController@createPDFprojectBlance'
    ]);
    Route::get('/export-pdf-visitor/{start_date}/{end_date}',[
        'as' => 'admin.export-pdf-visitor',
        'uses' => 'VisitorsController@createPDF'
    ]);
    Route::get('/profession-view/{id}',[
        'as' => 'admin.professions',
        'uses' => 'ProfessionalController@profession'
    ]);
    Route::get('/profession/{id}/{start_date}/{end_date}',[
        'as' => 'admin.profession',
        'uses' => 'ProfessionalController@createPDF'
    ]);


    Route::get('export-excel', 'ProjectsController@exportIntoEXCEL',['name','admin.export-excel']);
    Route::get('export-csv', 'ProjectsController@exportIntoCSV',['name','admin.export-csv']);
    Route::get('export-pdf', 'ProjectsController@exportPDF',['name','admin.export-pdf']);

    Route::get('export-excel-category', 'CategoryController@exportIntoEXCEL',['name','admin.export-excel-category']);
    Route::get('export-csv-category', 'CategoryController@exportIntoCSV',['name','admin.export-csv-category']);

    Route::get('export-excel-item', 'ItemController@exportIntoEXCEL',['name','admin.export-excel-item']);
    Route::get('export-csv-item', 'ItemController@exportIntoCSV',['name','admin.export-csv-item']);

    Route::get('export-excel-client', 'ClientController@exportIntoEXCEL',['name','admin.export-excel-client']);
    Route::get('export-csv-client', 'ClientController@exportIntoCSV',['name','admin.export-csv-client']);

    Route::get('export-excel-visitor', 'VisitorsController@exportIntoEXCEL',['name','admin.export-excel-visitor']);
    Route::get('export-csv-visitor', 'VisitorsController@exportIntoCSV',['name','admin.export-csv-visitor']);

    Route::get('export-excel-bank_data_sheet', 'VisitorsController@exportIntoEXCEL',['name','admin.export-excel-bank_data_sheet']);
    Route::get('export-csv-bank_data_sheet', 'VisitorsController@exportIntoCSV',['name','admin.export-csv-bank_data_sheet']);

    Route::get('withdraw-excel', 'WidrawController@exportIntoEXCEL',['name','admin.withdraw-excel']);
    Route::get('withdraw-csv', 'WidrawController@exportIntoCSV',['name','admin.withdraw-csv']);


    Route::get('deposit-excel', 'DepositController@exportIntoEXCEL',['name','admin.deposit-excel']);
    Route::get('deposit-csv', 'DepositController@exportIntoCSV',['name','admin.deposit-csv']);


    Route::get('category-pdf', 'CategoryController@createPDF',['name','admin.category-pdf']);
    Route::get('pdf-item', 'ItemController@createPDF',['name','admin.pdf-item']);
    Route::get('project-pdf', 'ProjectsController@createPDF',['name','admin.project-pdf']);
    Route::get('pdf-client', 'ClientController@createPDF',['name','admin.pdf-client']);

    Route::get('project-payments-export-csv', 'ProjectPaymentController@exportIntoCSV',['name','admin.project-payments-export-csv']);
    Route::get('project-payments-export-excel', 'ProjectPaymentController@exportIntoEXCEL',['name','admin.project-payments-export-excel']);

    Route::get('clients-payments-export-csv', 'ClientPaymentsController@exportIntoCSV',['name','admin.clients-payments-export-csv']);
    Route::get('clients-payments-export-excel', 'ClientPaymentsController@exportIntoEXCEL',['name','admin.clients-payments-export-excel']);

    Route::get('otherloan-export-csv', 'OtherLoanController@exportIntoCSV',['name','admin.otherloan-export-csv']);
    Route::get('otherloan-export-excel', 'OtherLoanController@exportIntoEXCEL',['name','admin.otherloan-export-excel']);
    Route::get('otherloan-export-pdf', 'OtherLoanController@createPDFotherloan',['name','admin.otherloan-export-pdf']);

    Route::get('bank_transfer-export-csv', 'BankTransferController@exportIntoCSV',['name','admin.bank_transfer-export-csv']);
    Route::get('bank_transfer-export-excel', 'BankTransferController@exportIntoEXCEL',['name','admin.bank_transfer-export-excel']);
    Route::get('bank_transfer-export-pdf', 'BankTransferController@createPDFBankTransfer',['name','admin.bank_transfer-export-pdf']);

    Route::get('bank-export-csv', 'BankController@exportIntoCSV',['name','admin.bank-export-csv']);
    Route::get('bank-export-excel', 'BankController@exportIntoEXCEL',['name','admin.bank-export-excel']);


//    Route::get('project-payments-export-excel', 'ProjectPaymentController@projectPaymentExcel',['name','admin.project-payments-export-excel']);
//    Route::get('pdf-project-payments', 'ProjectPaymentController@createPDF',['name','admin.pdf-project-payments']);

    // Bank
    Route::resource('banks', 'BankController',['name','admin.banks']);
    Route::resource('open_bank_amounts', 'OpenBankController',['name','admin.open_bank_amounts']);
    Route::resource('cashes', 'CashController',['name','admin.cashes']);
    Route::resource('open_cash_amounts', 'CashOpenController',['name','admin.open_cash_amounts']);

    Route::get('clients/{id}/payments','ClientPaymentsController@index')->name('clients.payments');
    Route::get('clients/{id}/create','ClientPaymentsController@create')->name('clients.created');
    Route::post('clients/{id}/store','ClientPaymentsController@store')->name('clients.stored');
    Route::delete('clients/{id}/payments/{clients_id}','ClientPaymentsController@destroy')->name('clients.payments.destroy');
    Route::get('clients/{id}/payments/{cliented_id}','ClientPaymentsController@edit')->name('clients.payments.edit');
    Route::put('clients/{id}/payments/{client_id}','ClientPaymentsController@update')->name('clients.payments.update');

    Route::get('projects/indivisual_Report/{id}','ProjectPaymentController@indivisual_Report')->name('projects.indivisual_Report');

    Route::get('projects/{id}/payments','ProjectPaymentController@index')->name('projects.payments');
    Route::get('projects/{id}/create','ProjectPaymentController@create')->name('projects.created');
    Route::post('projects/{id}/store','ProjectPaymentController@store')->name('projects.stored');
    Route::delete('projects/{id}/payments/{payment_id}','ProjectPaymentController@destroy')->name('projects.payments.destroy');
    Route::get('projects/{id}/payments/{payments_id}','ProjectPaymentController@edit')->name('projects.payments.edit');
    Route::put('projects/{id}/payments/{paymented_id}','ProjectPaymentController@update')->name('projects.payments.update');



    Route::get('GetSubCatAgainstMainCatEdit/{id}','ProjectPaymentController@GetSubCatAgainstMainCatEdit')->name('GetSubCatAgainstMainCatEdit');

    Route::resource('widraws', 'WidrawController',['name','admin.widraws']);
    Route::resource('deposits', 'DepositController',['name','admin.deposits']);

    Route::get('projects/clients_Report/{id}','ReportController@clients_Report')->name('projects.clients_Report');

    Route::get('/project-report', 'ReportController@projectReport')->name('admin.project-report');
    Route::get('/client-report', 'ReportController@clientReport')->name('admin.client-report');
    Route::get('/visitor-report', 'ReportController@visitorReport')->name('admin.visitor-report');
    Route::get('/collection-statement-report', 'ReportController@collectionStatement')->name('admin.collection-statement-report');
    Route::get('/payment-report', 'ReportController@paymentReport')->name('admin.payment-report');
    Route::get('/profit-loss', 'ReportController@profitLoss')->name('admin.profit-loss');
    Route::get('/project-balance-sheet', 'ReportController@projectBalanceSheet')->name('admin.project-balance-sheet');
    Route::get('/expenditure_summery', 'ReportController@expenditure_summery')->name('admin.expenditure_summery');
    Route::get('/cash_summery', 'ReportController@cashReport')->name('admin.cash_summery');
    Route::get('/final_blance_sheet', 'ReportController@finalBlanceSheetReport')->name('admin.final_blance_sheet');
    Route::get('/mains', 'ReportController@mains')->name('admin.mains');
    Route::get('/bank-report/{id}', 'ReportController@bankReport')->name('admin.bank-report');
    Route::get('/expenditure-bank-report/{id}', 'ReportController@expenditureBankReport')->name('admin.expenditure-bank-report');
    Route::get('/collection-bank-report/{id}', 'ReportController@collectionBankReport')->name('admin.collection-bank-report');
    Route::get('/collection-report-cash', 'ReportController@collectionCashReport')->name('admin.collection-report-cash');
    Route::get('/others_collection', 'OthersController@others_collection')->name('admin.others_collection');
    Route::get('/others_collection_index', 'OthersController@others_collection_index')->name('admin.others_collection_index');
    Route::get('/others/{id}', 'OthersController@edit')->name('admin.others');
    Route::delete('/othered/{id}', 'OthersController@destory')->name('admin.othered');
    Route::put('/others_update/{id}', 'OthersController@update')->name('admin.others_update');
    Route::post('/store', 'OthersController@insert_data')->name('admin.store');


    // Route::post('others/store', 'OthersExpenditure@store')->name('admin.others.store');
    // Route::get('others/create', 'OthersExpenditure@create')->name('admin.others.create');
    // Route::get('others/index', 'OthersExpenditure@index')->name('admin.others.index');
    // Login Routes
    Route::get('/login', 'Auth\LoginController@shologinForm')->name('admin.login');
    Route::post('/login/submit', 'Auth\LoginController@login')->name('admin.login.submit');

    // Logout Route
    Route::post('/logout/submit','Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Route
    Route::get('/password/reset','ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit','ForgetPasswordController@reset')->name('admin.password.update');

});
