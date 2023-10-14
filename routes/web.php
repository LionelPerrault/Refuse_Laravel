<?php

use App\Http\Controllers\Admin\Click2MailController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\SourceListController;
use App\Http\Controllers\Admin\SystemMessages;
use App\Http\Controllers\Admin\UserAgreementController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Email;
// use App\Http\Controllers\Admin\PhoneController;


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
// Test comment1

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('db:wipe');
});

Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:cache');
});

Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:cache');
});

Route::get('/config-clear', function () {
    $exitCode1 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode3 = Artisan::call('view:clear');
    $exitCode4 = Artisan::call('config:cache');
    $exitCode5 = Artisan::call('view:cache');
    // $exitCode6 = Artisan::call('route:cache');

    // You can use the exit codes or any other logic you need here.
});
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/voicepostback', 'Admin\RvmController@voicepostback')->name('voicepostback');
Route::POST('/voicepostback', 'Admin\RvmController@voicepostback')->name('voicepostback');
Route::get('admin/email/unsub/{id}', 'Admin\SendGridEmailController@unsubMail');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('handle-call', 'Admin\VoiceController@handleIncomingCall')->name('voice.handle-call');
Route::get('access-token', 'Admin\VoiceController@generateAccessToken')->name('voice.access-token');

Route::resource('campaignlist', 'Admin\CampaignListController');

Route::group(['as' => 'admin.', 'middleware' => 'auth', 'prefix' => 'admin'], function () {





    Route::get('account/detail', 'AccountDetailController@index')->name('account.detail');



    Route::post('process-stripe-payment', 'StripePaymentController@processStripePayment')->name('process-stripe-payment');
    Route::post('store-transaction', 'StripePaymentController@paypalStore')->name('store-transaction');

    // SKIP TRACING
    Route::get('admin/skip-trace', 'Admin\GroupController@skipTrace')->name('admin.skip-trace');
    Route::post('admin/push-to-campaign', 'Admin\GroupController@pushToCampaign')->name('push-to-campaign');
    Route::post('admin/upload-google-drive', 'Admin\GroupController@uploadToGoogleDrive')->name('upload-google-drive');


    Route::get('task-list/show/{id}', 'TaskListController@show')->name('task-list.show');
    // Route::Get('/update-task-order', 'TaskController@updateOrder')->name('update.task.order');

    Route::post('/update-task-order', 'TaskListController@updateOrder')->name('update.task.order');

    Route::post('/update-tasks-order', 'TaskListController@updateOrders')->name('update.tasks.order');

    Route::post('/tasklists', 'TaskListController@storeLists')->name('tasklists.store');
    Route::get('/Google-Calender-setting', 'Admin\AccountController@googleCalendersetting')->name('googleCalendersetting.setting');
    Route::get('/communication-setting', 'Admin\SettingsController@CommunicationSetting')->name('CommunicationSetting.index');
    Route::put('/communication-setting-update', 'Admin\SettingsController@updateCommunicationSetting')->name('CommunicationSetting.update');
    Route::get('/api-settings', 'Admin\ApiSettingsController@index')->name('apisettings.index');
    // Route::get('/api-settings', 'Admin\ApiSettingsController@index')->name('apisettings.index');
    Route::get('/appointment-settings', 'Admin\SettingsController@AppointmentSettings')->name('AppointmentSetting.index');

    Route::get('/invitation', 'InvitationController@index')->name('invitation.index');
    Route::get('/invitation/create', 'InvitationController@create')->name('invitation.create');
    Route::post('/invitation', 'InvitationController@store')->name('invitation.store');
    Route::get('/invitation/accept/{token}', 'InvitationController@accept')->name('invitation.accept');
    Route::post('/invitation/destroy/{id}', 'InvitationController@destroy')->name('invitation.destroy');

    Route::get('formm', 'GoogleDriveController@index')->name('formm');
    Route::get('formms', 'Admin\RapidApiController@getZillowLinks')->name('formms');

    Route::get('/upload-form', 'GoogleDriveController@showUploadForm')->name('google.drive.form');

    // Handle the GOOGLE DRIVE file upload
    Route::post('/google-drive-login', 'GoogleDriveController@googleLogin')->name('google.drive.login');
    Route::get('/google-drive-callback', 'GoogleDriveController@handleGoogleCallback')->name('google-drive-callback');
    // Route::get('/googledrive-callback', 'GoogleDriveController@handleGoogleCallback')->name('googledrive-callback');


    // ZOOM MEETING ROUTES - 14-09-2023 (John Raj)

    Route::get('/zoom', 'ZoomController@index')->name('zoom.index');
    Route::get('/zoom/create', 'ZoomController@create')->name('zoom.create');
    Route::post('/zoom/store', 'ZoomController@store')->name('zoom.store');
    Route::get('/zoom/edit/{id}', 'ZoomController@edit')->name('zoom.edit');
    Route::post('/zoom/update/{id}', 'ZoomController@update')->name('zoom.update');
    Route::post('/zoom/destroy/{id}', 'ZoomController@destroy')->name('zoom.destroy');

    // user list
    Route::get('user-list/index', 'UserController@index')->name('user-list.index');
    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('user/store', 'UserController@store')->name('user.store');

    Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
    Route::post('user/update/{id}', 'UserController@update')->name('user.update');

    // roles list
    Route::get('roles/index', 'RoleController@index')->name('roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create');
    Route::post('roles/store', 'RoleController@store')->name('roles.store');
    Route::get('roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::post('roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');
    Route::post('roles/update/{id}', 'RoleController@update')->name('roles.update');

    // permission list
    Route::get('permissions/index', 'PermissionController@index')->name('permissions.index');
    Route::get('permissions/create', 'PermissionController@create')->name('permissions.create');
    Route::post('permissions/store', 'PermissionController@store')->name('permissions.store');
    Route::get('permissions/edit/{id}', 'PermissionController@edit')->name('permissions.edit');
    Route::post('permissions/update/{id}', 'PermissionController@update')->name('permissions.update');
    Route::post('permissions/destroy/{id}', 'PermissionController@destroy')->name('permissions.destroy');

    // scraping list route
    Route::get('/scraping/list', 'ScrapingSourceListController@index')->name('scraping.list');
    Route::get('scraping/create', 'ScrapingSourceListController@create')->name('scraping.create');
    Route::post('scraping/store', 'ScrapingSourceListController@store')->name('scraping.store');
    Route::get('scraping/edit/{id}', 'ScrapingSourceListController@edit')->name('scraping.edit');
    Route::post('scraping/update/{id}', 'ScrapingSourceListController@update')->name('scraping.update');
    Route::post('scraping/destroy/{id}', 'ScrapingSourceListController@destroy')->name('scraping.destroy');
    // user task
    Route::get('task-list/index', 'TaskListController@index')->name('task-list.index');
    Route::post('task-list/store', 'TaskListController@store')->name('task-list.store');
    Route::post('delete-tasks', 'TaskListController@delete')->name('delete-tasks');
    Route::post('delete-List', 'TaskListController@deleteList')->name('delete-List');
    Route::post('update-task', 'TaskListController@update')->name('update-task');


    Route::get('/account', 'Admin\AccountController@index')->name('account.index');
    Route::put('account/google-calendar', 'Admin\AccountController@updateGoogleCalendarSettings')->name('admin.calendar-settings.update');
    Route::get('/dashboard', 'Admin\AdminController@index')->name('dashboard');
    Route::get('/set-goals', 'Admin\AdminController@setGoals')->name('setgoals');
    Route::post('/save-goals', 'Admin\AdminController@saveGoals')->name('savegoals');
    Route::get('/create-goals', 'Admin\AdminController@createGoals')->name('create.goals');
    Route::get('/edit_goals/{id}', 'Admin\AdminController@editGoals')->name('edit.goals');
    Route::post('/update_goals/{id}', 'Admin\AdminController@updateGoals')->name('update.goals');
    Route::post('/delete_goals/{id}', 'Admin\AdminController@deleteGoals')->name('delete.goals');
    Route::post('goals', 'Admin\AdminController@getGoals')->name('goals');
    Route::get('/send-email', 'Admin\SendGridEmailController@sendMail')->name('sendMail');
    Route::get('/test-rvm', 'Admin\RvmController@sendrvm')->name('sendrvm');
    // Source list route
    Route::get('/source-list', 'Admin\SourceListController@index')->name('source.list');

    // Phone Numbers Route
    Route::get('/phones', 'Admin\PhoneController@index')->name('phone.numbers');
    Route::get('/phone/changeStatus', 'Admin\PhoneController@changeStatus');


    // ROLE SWITCH
    Route::get('user/switch/{user}', 'UserController@switchRole')->name('user.switch');
    Route::get('user/quit', 'UserController@quitRole')->name('user.quit')->middleware('auth');

    // skip tracing
    Route::post('/skip-trace', 'Admin\GroupController@skipTrace')->name('skip-trace');
    // Profile page route
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Campaigns
    Route::resource('/campaigns', Admin\CampaignController::class);
    Route::get('/campaign/changeStatus', 'Admin\CampaignController@changeStatus');
    Route::get('/leadcampaign/changeStatus', 'Admin\CampaignLeadController@changeStatus');
    Route::get('/leadcampaigns', 'Admin\CampaignLeadController@index')->name('leadcampaigns.index');
    // Route::get('/campaigns', [CampaignController::class, 'index'])->name('admin.campaign');
    //    Route::resource('account','Admin\RoleController');
    Route::get('/sendMail', [Click2MailController::class, 'index']);

    Route::resource('email-conversations', 'Admin\EmailConversation');
    Route::resource('account', 'Admin\AccountController');
    Route::resource('quick-response', 'Admin\QuickResponseController');
    Route::resource('lead-category', 'Admin\LeadCategoryController');
    Route::resource('dnc-database', 'Admin\DNCController');
    Route::resource('auto-reply', 'Admin\AutoReplyController');
    Route::resource('number', 'Admin\NumberController');
    Route::resource('single-sms', 'Admin\SingleSMSController');
    Route::resource('single-email', 'Admin\Email');
    Route::get('/bulk-category', 'Admin\BulkSMSController@bulkCategory')->name('bulksmscategory.index');
    Route::post('/bulk-category/store', 'Admin\BulkSMSController@bulkCategoryStore')->name('bulksmscategory.store');
    Route::resource('bulk-sms', 'Admin\BulkSMSController');
    Route::post('one-at-time/details', 'Admin\OneSMSController@showDetails')->name('one-at-time.details');
    Route::resource('one-at-time', 'Admin\OneSMSController');
    Route::resource('template', 'Admin\TemplateController');
    Route::resource('campaign', 'Admin\CampaignController');
    Route::resource('campaignlist', 'Admin\CampaignListController');
    //Route::resource('single-sms','Admin\SingleSMSController');
    Route::resource('campaignlistNew', 'Admin\CampaignListController');
    
    // Groups Routes
    Route::resource('group', 'Admin\GroupController');
    Route::get('groups/list/create', 'Admin\GroupController@newListForm')->name('group.list.create');
    Route::post('groups/list/map-csv', 'Admin\GroupController@mapCSV')->name('group.map-csv');
    Route::get('group-contacts-all', 'Admin\GroupController@getAllContacts')->name('group-contacts-all');
    Route::get('group-contacts/edit/{id}', 'Admin\GroupController@editContacts')->name('group-contacts.edit');
    Route::post('group-contacts/store', 'Admin\GroupController@StoreContacts')->name('StoreContacts');
    Route::post('group-contacts/store', 'Admin\GroupController@StoreContacts')->name('StoreContacts');


    Route::resource('auto-responder', 'Admin\AutoResponderController');
    Route::get('failed-sms', 'Admin\SMSController@failedSms')->name('sms.failed');
    Route::delete('failed-sms/destroy', 'Admin\SMSController@failedSmsDestroy')->name('failed-sms.destroy');
    Route::get('received-sms', 'Admin\SMSController@receivedSms')->name('sms.success');
    Route::get('receive', 'Admin\ReceiveController@index');
    Route::post('sms/thread', 'Admin\SMSController@saveThread')->name('thread.save');
    Route::get('sms/thread', 'Admin\SMSController@threads')->name('thread.show');
    Route::get('sms/{sms}', 'Admin\SMSController@show')->name('sms.show');
    Route::post('sms/add-to-dnc', 'Admin\SMSController@addToDNC')->name('sms.add-to-dnc');
    Route::resource('reply', 'Admin\ReplyController');
    Route::resource('blacklist', 'Admin\BlacklistController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('tag', 'Admin\TagController');
    Route::resource('rvm', 'Admin\CreateRvmController');
    Route::resource('market', 'Admin\MarketController');
    Route::resource('settings', 'Admin\SettingsController');
    Route::resource('script', 'Admin\ScriptController');
    Route::resource('adminsettings', 'Admin\AdminSettingsController');
    Route::get('/appointment', 'Admin\SettingsController@appointment')->name('settings.appointment.appointment');
    
    Route::get('get/template/{id}', 'Admin\TemplateController@getTemplate');
    Route::get('get/templatecontent/{id}', 'Admin\TemplateController@getTemplateContent');
    Route::get('schedual/campaign', 'Admin\CampaignListController@schedual');
    Route::get('/auto-reply/status_update/{id}', 'Admin\AutoReplyController@status_update');
    Route::get('compaign/copy/{id}', 'Admin\CampaignController@copy')->name('compaign.copy');
    Route::get('campaign/list/{id}', 'Admin\CampaignListController@compaignList')->name('campaign.list');
    Route::get('get/message/{type}/{id}', 'Admin\CampaignListConttroller@getTemplate');
    Route::get('contact.detail/{id}', 'Admin\GroupController@contactInfo')->name('contact.detail');
    Route::post('contact/detail/update', 'Admin\GroupController@updateinfo');
    Route::post('contact/detail/update/select2', 'Admin\GroupController@updatetags')->name('contact.detail.update.select2');

    // Upload Purchase  to google drive
    Route::post('contact/purchase-agreement', 'GoogleDriveController@uploadPurchaseAgreement')->name('contact.purchase_agreement');

    // Realtor API to fetch property's estimates
    Route::post('contact/get-property-id', 'Admin\RapidApiController@getPropertyId')->name('contact.property_id');
    Route::post('contact/get-property-estimates', 'Admin\RapidApiController@getPropertyEstimates')->name('contact.property_estimates');
    Route::post('contact/fetch-google-map', 'Admin\RapidApiController@getGoogleMapsLink')->name('contact.property_links');
    Route::post('contact/fetch-zillow-link', 'Admin\RapidApiController@getZillowPropertyURL')->name('contact.zillow_property_links');
 
    Route::get('load/script/{id}', 'Admin\GroupController@getScript');
    // Sachin 05092023
    Route::post('/reminder/{userAgreementId}', function ($userAgreementId) {
        //Log::info("here");
        Artisan::call("agreement:mail", ['userAgreementId' => $userAgreementId]);
        $response = [
            'success' => true,
            'message' => "Reminder sent successfully.",
        ];

        return response()->json($response, 200);
    });

    Route::get('/file-manager', [UserAgreementController::class, 'fileManager'])->name('user-agreement.files');
    Route::delete('/file-manager/delete', [UserAgreementController::class, 'deletefile'])->name('user-agreement.delete');
    Route::post('/mailcontactlist', 'Admin\GroupController@mailcontactlist')->name('mailcontactlist');
    // Sachin 05092023
    Route::resource('leadcampaign', 'Admin\CampaignLeadController');
    Route::resource('field', 'Admin\CustomFieldController');
    Route::resource('campaignlist', 'Admin\CampaignListController');
    Route::resource('campaignleadlist', 'Admin\CampaignLeadListController');
    //Route::resource('single-sms','Admin\SingleSMSController');
    Route::resource('campaignlistNew', 'Admin\CampaignListController');
    Route::resource('contactlist', 'Admin\ContactListController');
    Route::resource('group', 'Admin\GroupController');
    Route::resource('group', 'Admin\GroupController');
    Route::get('get/contacts/{id}', 'Admin\GroupController@getContacts');
    Route::get('group-contacts-all', 'Admin\GroupController@getAllContacts')->name('group-contacts-all');
    Route::resource('auto-responder', 'Admin\AutoResponderController');
    Route::get('failed-sms', 'Admin\SMSController@failedSms')->name('sms.failed');
    Route::delete('failed-sms/destroy', 'Admin\SMSController@failedSmsDestroy')->name('failed-sms.destroy');
    Route::get('received-sms', 'Admin\SMSController@receivedSms')->name('sms.success');
    Route::get('receive', 'Admin\ReceiveController@index');
    Route::post('sms/thread', 'Admin\SMSController@saveThread')->name('thread.save');
    Route::get('sms/thread', 'Admin\SMSController@threads')->name('thread.show');
    Route::get('sms/{sms}', 'Admin\SMSController@show')->name('sms.show');
    Route::post('sms/add-to-dnc', 'Admin\SMSController@addToDNC')->name('sms.add-to-dnc');
    Route::resource('reply', 'Admin\ReplyController');
    Route::resource('blacklist', 'Admin\BlacklistController');
    Route::resource('category', 'Admin\CategoryController');
    
    Route::resource('tag', 'Admin\TagController');
    // Get tags' contacts
    Route::get('tags/{tag}/contacts', 'Admin\TagController@showTagContacts')->name('tags.contacts');
    
    Route::resource('rvm', 'Admin\CreateRvmController');
    Route::resource('market', 'Admin\MarketController');
    Route::resource('settings', 'Admin\SettingsController');
    Route::post('settings/appointment-calendar-settings', 'Admin\SettingsController@updateAppointmentCalendarSettings')->name('admin.appointment.calendar-settings.update');


    Route::resource('script', 'Admin\ScriptController');
    Route::resource('adminsettings', 'Admin\AdminSettingsController');

    Route::get('get/template/{id}', 'Admin\TemplateController@getTemplate');
    Route::get('template/view/{id}', 'Admin\TemplateController@view');
    Route::get('get/templatecontent/{id}', 'Admin\TemplateController@getTemplateContent');
    Route::get('schedual/campaign', 'Admin\CampaignListController@schedual');
    Route::get('/auto-reply/status_update/{id}', 'Admin\AutoReplyController@status_update');

    Route::post('/save-temp-message', 'Admin\TemplateMessagesController@create')->name('template.savemsg');
    Route::delete('/del-temp-message', 'Admin\TemplateMessagesController@destroy')->name('template.msg.destroy');
    
    //gurpreet
    route::post('get/template_msg/', 'Admin\TemplateController@getTemplateWithCondition');
    route::post('get/template_con/', 'Admin\TemplateController@getTemplateWithoutCategory');

    Route::get('compaign/copy/{id}', 'Admin\CampaignController@copy')->name('compaign.copy');
    Route::get('campaign/list/{id}', 'Admin\CampaignListController@compaignList')->name('campaign.list');
    Route::get('compaignlead/copy/{id}', 'Admin\CampaignLeadController@copy')->name('compaignlead.copy');
    Route::get('compaignlead/list/{id}', 'Admin\CampaignLeadListController@compaignList')->name('compaignlead.list');
    Route::get('get/leadmessage/{type}/{id}', 'Admin\CampaignLeadListController@getTemplate');

    Route::get('get/message/{type}/{id}', 'Admin\CampaignListController@getTemplate');

    // 01092023 sneha
    Route::get('/systemmessages', 'Admin\SMSController@index')->name('systemmessages.index');
    Route::post('/systemmsg.update', 'Admin\SMSController@update')->name('systemmessages.update');
    Route::put('/systemmsg.updates/{id}', 'Admin\SMSController@update')->name('systemmsg.updates');
    Route::resource('/system-messages', SystemMessages::class);

    Route::put('/helpvideo.updates/{id}', 'Admin\TemplateController@helpvideo_update')->name('helpvideo.updates');
    // 01092023 sneha


    Route::get('contact.detail/{id}', 'Admin\GroupController@contactInfo')->name('contact.detail');
    Route::post('contact/detail/update', 'Admin\GroupController@updateinfo');

    Route::get('load/script/{id}', 'Admin\GroupController@getScript');


    // Sachin 05092023
    Route::post('/mailcontactlist', 'Admin\GroupController@mailcontactlist')->name('mailcontactlist');
    Route::post('/uploadcontract', 'Admin\GroupController@uploadcontract')->name('uploadcontract');
    Route::post('/uploadcontractedit', 'Admin\GroupController@uploadcontractedit')->name('uploadcontractedit');
    Route::get('/contractview', 'Admin\GroupController@contractview')->name('contractview');

    // Sachin 05092023
    Route::get('/formtemplates', 'Admin\FormTemplatesController@index')->name('formtemplates');
    Route::post('/form-templates-store', 'Admin\FormTemplatesController@store')->name('form-templates-store');
    Route::post('/update-form-templates', 'Admin\FormTemplatesController@update')->name('update-form-templates');
    Route::post('/delete-form-templates', 'Admin\FormTemplatesController@destroy')->name('delete-form-templates');

    // OPT Route
    Route::get('opt-list', 'Admin\OptController@index')->name('opt.list');
    Route::post('opt-store', 'Admin\OptController@storeOpt')->name('opt.store');
});
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

// Sachin 05092023
Route::get('/myHtml/{id}/{contactid}', 'Admin\GroupController@myHtml')->name('myHtml');
// Sachin 05092023

// Sachin 08092023

// Sachin 08092023
// Appointment Routes
Route::resource('/appointments', 'Admin\AppointmentController');
Route::resource('/manage-appointments', 'Admin\ViewAppointmentsController');

Route::post('/receive-sms', 'Admin\ReceiveController@store')->name('sms.receive');

Route::get('/manage-appointments', 'Admin\ViewAppointmentsController@index')->name('admin.manage-appointments');

Route::get('/appointment/{id?}', 'Admin\AppointmentController@index')->name('admin.appointment');
//Route::get('/appointments/{id}', 'Admin\AppointmentController@index')->name('admin.appointment');
Route::post('/appointments', 'Admin\AppointmentController@store')->name('appointment.store');
// Appointment Routes
Route::resource('/appointments', 'Admin\AppointmentController');
Route::post('/fetch-all-slots', 'Admin\AppointmentController@fetchAllSlotsForBooking')->name('appointments.fetchAllSlots');
Route::post('/cancel-appointment', 'Admin\AppointmentController@cancelAppointment')->name('appointments.cancelAppointment');
Route::post('/get-appointment', 'Admin\AppointmentController@getAppointments')->name('appointments.getAppointments');
Route::post('/reschdule-appointment', 'Admin\AppointmentController@reschduleAppointment')->name('appointments.reschduleAppointment');
/** google calendar routes */
Route::get('/google-calendar/connect', 'Admin\AppointmentController@connectGoogleCalendar')->name('connectGoogleCalendar');
Route::post('/google-calendar/connect', 'Admin\AppointmentController@storeGoogleCalendarCredentials')->name('storeGoogleCalendarCredentials');
Route::get('/google-calendar/auth-callback', 'Admin\AppointmentController@storeGoogleCalendarCredentials')->name('storeGoogleCalendarCredentials');
Route::get('/get-resources', 'Admin\AppointmentController@getResources');
/** end google calendar routes */

require __DIR__ . '/bhavesh.php';
Route::get('/phone/access-token', [PhoneCallController::class, 'getAccessToken']);
Route::get('/call', [PhoneCallController::class, 'index']);


Route::post('/make_call', 'CallingController@make_call')->name('make_call');
Route::post('/handle-call', 'CallingController@handleCall')->name('handleCall');


Route::get('/secure-payment/{token}', 'StripePaymentController@payment')->name('secure.payment');


Route::post('/payment/process', 'StripePaymentController@processPayment')->name('payment.process');
Route::get('/payment/success', 'StripePaymentController@paymentSuccess')->name('payment.success');

Route::get('/payment/failed', 'StripePaymentController@paymentFailed')->name('payment.failed');
Route::get('/payment/cancel', 'StripePaymentController@cancelPayment')->name('payment.cancel');
Route::post('/payment/create_intent', 'StripePaymentController@createPaymentIntent')->name('payment.create_intent');
Route::get('/oauth/gmail', 'GmailController@redirect')->name('gmail.login');
Route::get('/oauth/gmail/callback', 'GmailController@callback')->name('gmail.callback');
Route::get('/oauth/gmail/logout', 'GmailController@logout')->name('gmail.logout');


Route::get('/oauth/gmail', 'GmailController@redirect')->name('gmail.login');
Route::get('/oauth/gmail/callback', 'GmailController@callback')->name('gmail.callback');
Route::get('/oauth/gmail/logout', 'GmailController@logout')->name('gmail.logout');


