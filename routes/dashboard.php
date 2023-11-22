<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RolesPrivilegesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmartSewaServicesController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\SmartHealthCheckup;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\HomeCareController;
use App\Http\Controllers\CriticalCareController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AppointmentDoctor;

Route::match(['get', 'post'], 'login', [EmployeeController::class, 'loginProcess'])->name('login.process');

Route::middleware(['loginAuth'])->group(function () {

    /* =====[ Dashboard ]===== */
    Route::get('dashboard-page', [EmployeeController::class, 'dashboardPage'])->name('dashboard.home');
    Route::get('dashboard-vendor', [EmployeeController::class, 'vendor_dashboard'])->name('dashboard.vendor');

    /* =====[ Employee Management ]===== */
    Route::match(['get', 'post'], 'employee-list', [EmployeeController::class, 'employeeList'])->name('list.employee');
    Route::match(['get', 'post'], 'employee-new', [EmployeeController::class, 'employeeNew'])->name('new.employee');

    Route::match(['get', 'post'], 'employee-edit/{id}', [EmployeeController::class, 'employeeEdit'])->name('edit.employee');
    Route::match(['get', 'post'], 'employee-action', [EmployeeController::class, 'employeeAction'])->name('action.employee');
    Route::post('states', [EmployeeController::class, 'statesList'])->name('states.ajax');
    Route::post('cities', [EmployeeController::class, 'CitiesList'])->name('cities.ajax');


    //SmartSewa Products
    Route::prefix('/products')->name('products.')->group(function(){
        Route::get('labtest',[ProductController::class,'labtest'])->name('labtest');
        Route::resource('labtests',LabTestController::class);
        Route::post('/labtests/update/{id}',[LabTestController::class,'update']);
        Route::resource('smarthealthcheckup',SmartHealthCheckup::class);
        Route::post('/smarthealthcheckup/update/{id}',[SmartHealthCheckup::class,'update']);
        Route::resource('organs',OrganController::class);
        Route::post('/organs/update/{id}',[OrganController::class,'update']);
        Route::resource('homecare',HomeCareController::class);
        Route::post('/homecare/update/{id}',[HomeCareController::class,'update']);
        Route::resource('criticalcare',CriticalCareController::class);
        Route::post('/criticalcare/update/{id}',[CriticalCareController::class,'update']);
        Route::resource('banner',BannerController::class);
        Route::post('/banner/update/{id}',[BannerController::class,'update']);
        Route::post('/banner/getlist',[BannerController::class,'getlist']);
        Route::post('/banner/changeStatus',[BannerController::class,'changeStatus']);
        Route::resource('appointmentdoctor',AppointmentDoctor::class);
        Route::post('/appointmentdoctor/update/{id}',[AppointmentDoctor::class,'update']);
    });

    /* =====[ Department and Privileges ]===== */
    Route::get('department-list', [RolesPrivilegesController::class, 'rolesList'])->name('list.roles');
    Route::match(['get', 'post'], 'department-new', [RolesPrivilegesController::class, 'rolesNew'])->name('new.roles');
    Route::match(['get', 'post'], 'department-edit/{id}', [RolesPrivilegesController::class, 'rolesEdit'])->name('edit.roles');
    Route::match(['get', 'post'], 'department-remove/{id}', [RolesPrivilegesController::class, 'rolesRemove'])->name('remove.roles');
    Route::match(['get', 'post'], 'privileges/{id}', [RolesPrivilegesController::class, 'privilegesList'])->name('privileges');


    /* =====[ Customer Management ]===== */
    Route::get('customer-list', [CustomerController::class, 'customersList'])->name('list.customers');
    Route::match(['get', 'post'], 'customer-new', [CustomerController::class, 'customerNew'])->name('new.customer');
    Route::match(['get', 'post'], 'customer-edit/{id}', [CustomerController::class, 'customerEdit'])->name('edit.customer');
    Route::match(['get', 'post'], 'customer-remove/{id}', [CustomerController::class, 'customersRemove'])->name('remove.customer');


    /* =====[ Hospital Management ]===== */
    Route::match(['get', 'post'], 'vendor-new-setup', [HospitalController::class, 'vendorNewSetup'])->name('vendor.new.setup');
    Route::match(['get', 'post'], 'vendor-new-step-01/{token}', [HospitalController::class, 'vendorNewToken01'])->name('vendor.new.step.01');
    Route::delete('hospitalDelete/{id}',[HospitalController::class,'hospitalDelete'])->name('vendor.hospital.delete');
    Route::get('hospitalEdit/{id}',[HospitalController::class,'hospitalEdit'])->name('vendor.hospital.edit');
    Route::post('hospitalUpdate',[HospitalController::class,'hospitalUpdate'])->name('vendor.hospital.update');
    Route::get('hospitalList',[HospitalController::class,'hospitalList'])->name('vendor.hospital.list');
    Route::post('hospitalFormSave',[HospitalController::class,'hospitalFormSave']);

    /* =====[ Vendor Management ]===== */
    Route::get('labs-list', [ClientsController::class, 'labsList'])->name('labs.list');
    Route::get('labs-diagnosis-csv', [ClientsController::class, 'labsDiagnosisCsv'])->name('labs.diagnosis.csv');
    Route::get('delete-lab-list/{id}',[ClientsController::class, 'deletelabsList'])->name('labs.delete');


    Route::match(['get', 'post'], 'vendor-new-path-lab', [VendorController::class, 'vendorNewPathLab'])->name('vendor.new.path.lab');
    Route::get('vendor-edit-path-lab/{id}', [VendorController::class, 'vendorEditPathLab'])->name('vendor.edit.path.lab');
    Route::get('vendor-show-path-lab/{id}', [VendorController::class, 'vendorShowPathLab'])->name('vendor.show.path.lab');
    Route::get('vendor-get-path-lab/{id}', [VendorController::class, 'vendorGetPathLab'])->name('vendor.get.path.lab');
    Route::post('vendor-update-path-lab/{id}',[VendorController::class, 'vendorUpdatePathLab'])->name('vendor.update.path.lab');
    // Route::match(['get', 'post'], 'vendor-new-path-lab-list', [VendorController::class, 'vendorNewPathLabList'])->name('vendor.new.path.lab');
    Route::match(['get', 'post'], 'vendor-new-radiology-diagnostics', [VendorController::class, 'vendorNewRadiologyDiagnostics'])->name('vendor.new.radiology.diagnostics');
    Route::get('vendor-list-radiology-diagnostics', [VendorController::class, 'vendorListRadiologyDiagnostics'])->name('vendor.list.radiology.diagnostics');
    Route::get('vendor-edit-radiology-diagnostics/{id}', [VendorController::class, 'vendorEditRadiologyDiagnostics'])->name('vendor.edit.radiology.diagnostics');
    Route::post('vendor-update-radiology-diagnostics/{id}', [VendorController::class, 'vendorUpdateRadiologyDiagnostics'])->name('vendor.update.radiology.diagnostics');
    Route::delete('vendor-delete-radiology-diagnostics/{id}', [VendorController::class, 'vendorDeleteRadiologyDiagnostics'])->name('vendor.delete.radiology.diagnostics');
    Route::match(['get', 'post'], 'vendor-new-hospitals-others', [VendorController::class, 'vendorNewHospitalsOthers'])->name('vendor.new.hospitals.others');


    //Doctor And Others
    Route::get('vendor-list-doctors-other', [VendorController::class, 'vendorListDoctorsOther'])->name('vendor.list.doctors.other');
    Route::get('vendor-new-doctors-other', [VendorController::class, 'vendorNewDoctorsOther'])->name('vendor.new.doctors.other');
    Route::get('vendor-edit-doctors-other/{id}', [VendorController::class, 'vendorEditDoctorsOther'])->name('vendor.edit.doctors.other');
    Route::post('vendor-update-doctors-other/{id}', [VendorController::class, 'vendorUpdateDoctorsOther'])->name('vendor.update.doctors.other');
    Route::post('vendor-save-doctors-other', [VendorController::class, 'vendorSaveDoctorsOther'])->name('vendor.save.doctors.other');
    Route::delete('vendor-delete-doctors-other/{id}', [VendorController::class, 'vendorDeleteDoctorsOther'])->name('vendor.delete.doctors.other');

    Route::match(['get', 'post'], 'vendor-new-healthcare-professionals', [VendorController::class, 'vendorNewHealthcareProfessionals'])->name('vendor.new.healthcare.professionals');
    Route::get('/vendor-list-healthcare-professionals',[VendorController::class,'vendorListHealthcareProfessionals'])->name('vendor.list.healthcare.professionals');
    Route::post('/vendor-save-healthcare-professionals',[VendorController::class,'vendorSaveHealthcareProfessionals'])->name('vendor.save.healthcare.professionals');
    Route::delete('/vendor-delete-healthcare-professionals/{id}',[VendorController::class,'vendorDeleteHealthcareProfessionals'])->name('vendor.delete.healthcare.professionals');
    Route::get('/vendor-edit-healthcare-professionals/{id}',[VendorController::class,'vendorEditHealthcareProfessionals'])->name('vendor.edit.healthcare.professionals');
    Route::post('/vendor-update-healthcare-professionals/{id}',[VendorController::class,'vendorUpdateHealthcareProfessionals'])->name('vendor.update.healthcare.professionals');
    Route::match(['get', 'post'], 'vendor-new-htm-consumables-suplliers', [VendorController::class, 'vendorNewHtmConsumablesSuplliers'])->name('vendor.new.htm.consumables.suplliers');
    Route::get('vendor-list-htm-consumables-suplliers', [VendorController::class, 'vendorListHtmConsumablesSuplliers'])->name('vendor.list.htm.consumables.suplliers');
    Route::post('vendor-save-htm-consumables-suplliers', [VendorController::class, 'vendorSaveHtmConsumablesSuplliers'])->name('vendor.save.htm.consumables.suplliers');
    Route::delete('vendor-delete-htm-consumables-suplliers/{id}', [VendorController::class, 'vendorDeleteHtmConsumablesSuplliers'])->name('vendor.delete.htm.consumables.suplliers');
    Route::get('vendor-edit-htm-consumables-suplliers/{id}', [VendorController::class, 'vendorEditHtmConsumablesSuplliers'])->name('vendor.edit.htm.consumables.suplliers');
    Route::post('vendor-update-htm-consumables-suplliers/{id}', [VendorController::class, 'vendorUpdateHtmConsumablesSuplliers'])->name('vendor.update.htm.consumables.suplliers');


    /* =====[ Client Management ]===== */
    Route::get('labs-diagnostics-list', [ClientsController::class, 'labsDiagnosticsList'])->name('labs.diagnostics.list');
    Route::get('list-end-custumers', [ClientsController::class, 'listendCustumers'])->name('list.end.custumers');
    Route::get('end-custumers', [ClientsController::class, 'endCustumers'])->name('end.custumers');
    Route::get('delete-list-end-custumers/{id}', [ClientsController::class, 'deletelistendCustumers']);
    Route::get('list-business-clients', [ClientsController::class, 'businessClientslist'])->name('list.business.clients');
    Route::get('delete-business-clients/{id}', [ClientsController::class, 'deletebusinessClientslist']);
    Route::get('edit-business-clients/{id}', [ClientsController::class, 'editbusinessClientslist']);
    Route::post('update-business-clients/{id}', [ClientsController::class, 'updatebusinessClientslist'])->name('update.businessClientslist');
    Route::get('business-clients', [ClientsController::class, 'businessClients'])->name('business.clients');


    /* =====[ Packages Management ]===== */
    Route::get('packages-list', [ClientsController::class, 'packagesList'])->name('packages.list');
    Route::get('create-diagnostics-packages', [ClientsController::class, 'createDiagnosticsPackages'])->name('create.diagnostics.packages');
    Route::post('save-diagnostics-packages',[ClientsController::class, 'saveDiagnosticsPackages']);
    Route::delete('delete-diagnostics-packages/{id}',[ClientsController::class, 'deleteDiagnosticsPackages']);
    Route::get('edit-diagnostics-packages/{id}', [ClientsController::class, 'editDiagnosticsPackages'])->name('edit.diagnostics.packages');
    Route::post('update-diagnostics-packages/{id}', [ClientsController::class, 'updateDiagnosticsPackages']);
    /* =====[ Order Management ]===== */

    Route::get('order-end-customer', [OrderController::class, 'end_customer_order'])->name('order.end.customer');
    Route::get('order-business-clients', [OrderController::class, 'business_clients_order'])->name('order.business.clients');
    Route::get('view-order-business-clients', [OrderController::class, 'business_clients_order_view'])->name('order.view.business.clients');
    Route::get('assign-lab', [OrderController::class, 'assign_lab'])->name('assign.lab');
    Route::get('assign-lab-form', [OrderController::class, 'assign_lab_form'])->name('assignlab.form');
    Route::post('pushData-to-lab', [OrderController::class, 'send_data_to_lab'])->name('sendData.labAPI');
    Route::get('lab-data', [OrderController::class, 'data_from_lab'])->name('lab.data');
    /* =====[ Payment History ]===== */

    Route::get('payment-end-customer', [PaymentHistoryController::class, 'end_customer_payment'])->name('payment.end.customer');
    Route::get('payment-business-clients', [PaymentHistoryController::class, 'business_clients_payment'])->name('payment.business.clients');

    /* =====[ Settings ]===== */

    Route::get('setting', [SettingController::class, 'index'])->name('setting.home');

    /* =====[ Wallet Details ]===== */

    Route::match(['get', 'post'], 'wallet-details/{id}', [WalletController::class, 'wallet_details'])->name('wallet.details');
    Route::match(['get', 'post'], 'add-wallet', [WalletController::class, 'add_money_in_wallet'])->name('wallet.addmoney');
    //Route::match(['get', 'post'], 'wallet-return', [WalletController::class, 'return_payment'])->name('wallet.returnurl');
    //Route::post('wallet-return', [WalletController::class, 'return_payment'])->name('wallet.returnurl');

    //Smartsewa services

    Route::post('smartsewa-endcustomer', [SmartSewaServicesController::class, 'endcustomer_service'])->name('new.endCustService');
    Route::match(['get', 'post'], 'edit-end-cust-service/{id}', [SmartSewaServicesController::class, 'get_data_edit'])->name('edit.endCustSer');
    Route::post('smartsewa-endcustomer-update', [SmartSewaServicesController::class, 'update_endcustomer_service'])->name('update.endCustService');
    Route::post('smartsewa-business-client', [SmartSewaServicesController::class, 'business_client_services'])->name('service.new.businessClinet');
    Route::delete('smartsewa-endcustomer-delete/{id}', [SmartSewaServicesController::class, 'delete_endcustomer_service']);
    Route::get('smartsewa-endcustomer-status/{id}', [SmartSewaServicesController::class, 'status_endcustomer_service']);

});
//Route::get('/return_payment', [WalletController::class, 'return_payment']);
Route::match(['get', 'post'], '/return_payment', [WalletController::class, 'return_payment']);
