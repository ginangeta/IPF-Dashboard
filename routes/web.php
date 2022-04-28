<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrganizationsController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/password-request', [AuthController::class, 'requestPassword'])->name('password.request');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
Route::post('/change-forgot-password', [AuthController::class, 'changeForgotPassword'])->name('password.changeforgot');
Route::post('/change-details', [AuthController::class, 'changeUserDetails'])->name('account.change');
Route::get('/newpassword', [AuthController::class, 'newpassword'])->name('password.new');
Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('/user-password-reset', [AuthController::class, 'userResetPassword'])->name('user-password-reset');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/user-history', [AuthController::class, 'userHistory'])->name('user.history');
Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/signup', [SiteController::class, 'signup'])->name('signup');

Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/profile', [SiteController::class, 'profile'])->name('profile');
Route::get('/application', [SiteController::class, 'application'])->name('application');
Route::post('/application', [SiteController::class, 'submitApplication'])->name('application');

Route::get('/points', [CustomersController::class, 'calPoints'])->name('calPoints');
Route::post('/customers', [CustomersController::class, 'storeCustomers'])->name('store.customers');
Route::post('/edit_customer', [CustomersController::class, 'editCustomer'])->name('edit.customer');
Route::get('/customers', [CustomersController::class, 'getCustomers'])->name('customers');
Route::get('/customers/{id}', [CustomersController::class, 'getCustomer'])->name('customer');
Route::post('/storeLead', [CustomersController::class, 'storeCustomerLeads'])->name('storeLead');
// Route::get('/customers_leads/{id}', [CustomersController::class, 'getCustomerLeadView'])->name('leads.view');
Route::get('/lead_application/{id}', [CustomersController::class, 'getCustomerLeadApplicationView'])->name('lead.application');

Route::get('/lead_quotation/{id}', [CustomersController::class, 'getCustomerLeadQuotationView'])->name('lead.quotation.view');
Route::post('/get_quotation', [CustomersController::class, 'getQuotation'])->name('lead.quotation');
// Route::get('/submit_lead_quotation/{id}', [CustomersController::class, 'submitQuotation'])->name('submit.lead.quotation');

Route::get('/lead_payment/{id}', [CustomersController::class, 'getLeadPaymentView'])->name('lead.payment');
Route::post('/application_payment', [CustomersController::class, 'submitApplicationPayment'])->name('application_payment');

Route::get('/customers_covers', [CustomersController::class, 'getCustomerCovers'])->name('customers.covers');
Route::get('/customers_cover/{id}', [CustomersController::class, 'getCustomerCovers'])->name('customers.cover');
Route::post('/customers_cover/{id}', [CustomersController::class, 'editCustomerCovers'])->name('edit.cover');

Route::get('/customers_payments', [CustomersController::class, 'getCustomerPayments'])->name('customers.payments');
Route::get('/customers_payments/{id}', [CustomersController::class, 'getCustomerPayments'])->name('customers.payment');

Route::get('/categories', [CategoriesController::class, 'getCategories'])->name('categories');
Route::post('/categories', [CategoriesController::class, 'storeCategories'])->name('categories');
Route::post('/edit_category/{id}', [CategoriesController::class, 'editCategories'])->name('edit.category');

Route::get('/products', [ProductsController::class, 'getProducts'])->name('products');
Route::post('/products', [ProductsController::class, 'storeProduct'])->name('products');

Route::get('/messages', [MessagesController::class, 'getMessages'])->name('messages');
Route::post('/store_template', [MessagesController::class, 'storeMessagesTemplate'])->name('store.template');
Route::post('/send_message', [MessagesController::class, 'sendMessage'])->name('send.message');
Route::get('/message_template', [MessagesController::class, 'getMessagesTemplate'])->name('message.template');
Route::get('/message_template/{id}', [MessagesController::class, 'getMessagesTemplate'])->name('message.template');

Route::get('/offers', [OffersController::class, 'getOffers'])->name('offers');
Route::post('/offers', [OffersController::class, 'storeOffer'])->name('offers');
Route::post('/edit_offers', [OffersController::class, 'editOffer'])->name('edit.offer');

Route::get('/organisations', [OrganizationsController::class, 'getOrganizations'])->name('organisations');
Route::post('/organisations', [OrganizationsController::class, 'storeOrganization'])->name('organisations');
Route::post('/edit_organisations', [OrganizationsController::class, 'editOrganization'])->name('edit.organisation');

Route::get('/users', [UsersController::class, 'getUsers'])->name('users');
Route::post('/users', [UsersController::class, 'storeUser'])->name('users');
Route::post('/edit_users', [UsersController::class, 'editUser'])->name('edit.user');
Route::post('/reset_user_password', [UsersController::class, 'resetUserPassword'])->name('reset.user.password');
