<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BloodController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Controller
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/donor/information/{donor_id}', [FrontendController::class, 'donor_info'])->name('donor.info');
Route::get('/single/blog/{blog_id}', [FrontendController::class, 'single_blog'])->name('single.blog');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/donor', [DonorController::class, 'donor'])->name('donor');
Route::post('/getSubcities', [DonorController::class, 'getSubcities']);
Route::get('/same/donor/{blood_id}', [DonorController::class, 'same_donor'])->name('same.donor');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/term', [FrontendController::class, 'term'])->name('term');
Route::get('/policy', [FrontendController::class, 'policy'])->name('policy');
Route::get('/ssl/commerz', [FrontendController::class, 'ssl_commerz'])->name('ssl.commerz');
Route::post('/donate/money', [FrontendController::class, 'donate_money'])->name('donate.money');

// Donor
Route::get('/donor/register', [DonorController::class, 'donor_register'])->name('donor.register');
Route::post('/donor/store', [DonorController::class, 'donor_store'])->name('donor.store');
Route::post('/donor/login', [DonorController::class, 'donor_login'])->name('donor.login');
Route::get('/donor/login/page', [DonorController::class, 'donor_login_page'])->name('donor.login.page');
Route::get('/donor/logout', [DonorController::class, 'donor_logout'])->name('donor.logout');
Route::get('/donor/profile', [DonorController::class, 'donor_profile'])->name('donor.profile');
Route::get('/edit/donor/profile', [DonorController::class, 'edit_donor_profile'])->name('edit.donor.profile');
Route::post('/donor/profile/update', [DonorController::class, 'donor_profile_update'])->name('donor.profile.update');
Route::post('/getUpazilas', [DonorController::class, 'getUpazilas']);
Route::get('/donor/download', [DonorController::class, 'donor_download'])->name('donor.download')->middleware();

// ==========Email Verify=============//
Route::get('/donor/email/verify/{token}', [DonorController::class, 'doner_email_verify'])->name('doner.email.verify');
Route::get('doner/send/email/verify/request',[DonorController::class, 'sent_email_verify_request'])->name('sent.verify.req');
Route::post('/email/verify/req/sent',[DonorController::class, 'email_verify_req_sent'])->name('email.verify.req.sent');




// Home Controller
Auth::routes();
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');
Route::get('/admin/logout', [HomeController::class, 'admin_logout'])->name('admin.logout');


// User Controller
Route::get('/user', [UserController::class, 'user'])->name('user')->middleware('auth');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete')->middleware('auth');
Route::get('/user/proflie', [UserController::class, 'user_profile'])->name('user.profile')->middleware('auth');
Route::post('/user/proflie/update', [UserController::class, 'profile_update'])->name('profile.update')->middleware('auth');
Route::post('/user/password/update', [UserController::class, 'password_update'])->name('password.update')->middleware('auth');
Route::post('/user/photo/update', [UserController::class, 'photo_update'])->name('photo.update')->middleware('auth');


// Navbar logo Controller
Route::get('/navbar/logo', [NavController::class, 'nav_logo'])->name('nav.logo')->middleware('auth');
Route::post('/navbar/logo/store', [NavController::class, 'logo_store'])->name('logo.store')->middleware('auth');
Route::get('/navbar/logo/delete/{logo_id}', [NavController::class, 'logo_delete'])->name('logo.delete')->middleware('auth');
Route::get('/navbar/logo/status/{logo_id}', [NavController::class, 'logo_status'])->name('logo.status')->middleware('auth');

// Navbar Menu Controller
Route::get('/navbar/menu', [NavController::class, 'nav_menu'])->name('nav.menu')->middleware('auth');
Route::post('/navbar/menu/store', [NavController::class, 'menu_store'])->name('menu.store')->middleware('auth');
Route::get('/navbar/menu/delete/{menu_id}', [NavController::class, 'menu_delete'])->name('menu.delete')->middleware('auth');
Route::get('/navbar/menu/eidt/{menu_id}', [NavController::class, 'menu_edit'])->name('menu.edit')->middleware('auth');
Route::post('/navbar/menu/update/', [NavController::class, 'menu_update'])->name('menu.update')->middleware('auth');

// Footer Controller
Route::get('/footer', [FooterController::class, 'footer'])->name('footer')->middleware('auth');
Route::post('/footer/update', [FooterController::class, 'footer_update'])->name('footer.update')->middleware('auth');
Route::get('/footer/icon', [FooterController::class, 'footer_icon'])->name('footer.icon')->middleware('auth');
Route::post('/footer/icon/store', [FooterController::class, 'footer_icon_store'])->name('footer.icon.store')->middleware('auth');
Route::get('/footer/icon/edit/{icon_id}', [FooterController::class, 'footer_icon_edit'])->name('footer.icon.edit')->middleware('auth');
Route::post('/footer/icon/update/', [FooterController::class, 'footer_icon_update'])->name('footer.icon.update')->middleware('auth');
Route::get('/footer/icon/delete/{icon_id}', [FooterController::class, 'footer_icon_delete'])->name('footer.icon.delete')->middleware('auth');
Route::post('/footer/img/store', [FooterController::class, 'footer_img_store'])->name('footer.img.store')->middleware('auth');
Route::get('/footer/image/delete/{img_id}', [FooterController::class, 'foot_img_delete'])->name('foot.img.delete')->middleware('auth');
Route::get('/edit/term', [FooterController::class, 'edit_term'])->name('edit.term')->middleware('auth');
Route::post('/term/update', [FooterController::class, 'term_update'])->name('term.update')->middleware('auth');
Route::get('/edit/policy', [FooterController::class, 'edit_policy'])->name('edit.policy')->middleware('auth');
Route::post('/pollicy/update', [FooterController::class, 'policy_update'])->name('policy.update')->middleware('auth');

// Banner Controller
Route::get('/banner', [NavController::class, 'banner_info'])->name('banner.info')->middleware('auth');
Route::post('/banner/update', [NavController::class, 'banner_update'])->name('banner.update')->middleware('auth');

// Blood Controller
Route::get('/blood', [BloodController::class, 'blood'])->name('blood')->middleware('auth');
Route::post('/blood/group/store', [BloodController::class, 'group_store'])->name('group.store')->middleware('auth');
Route::get('/blood/delete/{blood_id}', [BloodController::class, 'blood_delete'])->name('blood.delete')->middleware('auth');
Route::get('/donor/list', [BloodController::class, 'donor_list'])->name('donor.list')->middleware('auth');
Route::get('/donor/view/{donor_id}', [BloodController::class, 'donor_view'])->name('donor.view')->middleware('auth');
Route::get('/donor/delete/{donor_id}', [BloodController::class, 'donor_delete'])->name('donor.delete')->middleware('auth');
Route::get('/donor/history/{donor_id}', [BloodController::class, 'donor_history'])->name('donor.history');
Route::post('/donor/add/history/', [BloodController::class, 'donor_history_store'])->name('donor.history.store');
Route::get('/donor/history/Delete/{donor_id}', [BloodController::class, 'donor_history_delete'])->name('donor.history.delete')->middleware('auth');
Route::get('/donor/history/details/{donor_id}', [BloodController::class, 'donor_history_details'])->name('donor.history.details')->middleware('auth');
Route::get('/donation/img/delete/{image_id}', [BloodController::class, 'donation_img_delete'])->name('donation.img.delete')->middleware('auth');
Route::get('/donor/history/download/{donor_id}', [BloodController::class, 'donor_history_download'])->name('donor.history.download');


// About Controller
Route::get('/about/edit', [AboutController::class, 'about_edit'])->name('about.edit')->middleware('auth');
Route::post('/about/update', [AboutController::class, 'about_update'])->name('about.update')->middleware('auth');

// Achievement Controller
Route::get('/counter', [CounterController::class, 'counter'])->name('counter')->middleware('auth');
Route::post('/counter/store', [CounterController::class, 'counter_store'])->name('counter.store')->middleware('auth');
Route::get('/counter/delete/{counter_id}', [CounterController::class, 'counter_delete'])->name('counter.delete')->middleware('auth');
Route::get('/counter/edit/{counter_id}', [CounterController::class, 'counter_edit'])->name('counter.edit')->middleware('auth');
Route::post('/counter/update', [CounterController::class, 'counter_update'])->name('counter.update')->middleware('auth');


// Review Controller
Route::get('/review', [ReviewController::class, 'review'])->name('review')->middleware('auth');
Route::post('/review/store', [ReviewController::class, 'review_store'])->name('review.store')->middleware('auth');
Route::get('/review/delete/{review_id}', [ReviewController::class, 'review_delete'])->name('review.delete')->middleware('auth');
Route::get('/review/view/{review_id}', [ReviewController::class, 'review_view'])->name('review.view')->middleware('auth');

// Blog Controller
Route::get('/add/blog', [BlogController::class, 'add_blog'])->name('add.blog')->middleware('auth');
Route::post('/blog/store', [BlogController::class, 'blog_store'])->name('blog.store')->middleware('auth');
Route::get('/blog/view', [BlogController::class, 'view_blog'])->name('view.blog')->middleware('auth');
Route::get('/blog/delete/{blog_id}', [BlogController::class, 'blog_delete'])->name('blog.delete')->middleware('auth');
Route::get('/blog/edit/{blog_id}', [BlogController::class, 'blog_edit'])->name('blog.edit')->middleware('auth');
Route::post('/blog/update', [BlogController::class, 'blog_update'])->name('blog.update')->middleware('auth');

// Messeage
Route::post('/message/store', [ContactController::class, 'message_store'])->name('message.store');
Route::get('/message/list', [ContactController::class, 'message'])->name('message')->middleware('auth');
Route::get('/message/delete/{mesg_id}', [ContactController::class, 'mesg_delete'])->name('mesg.delete')->middleware('auth');
Route::get('/message/view/{mesg_id}', [ContactController::class, 'message_view'])->name('message.view')->middleware('auth');
Route::get('/message/solve/{mesg_id}', [ContactController::class, 'message_solve'])->name('message.solve')->middleware('auth');

// Dontaion List
Route::get('/donation', [DonorController::class, 'donation'])->name('donation')->middleware('auth');
Route::get('/donation/delete/{donate_id}', [DonorController::class, 'donation_delete'])->name('donation.delete')->middleware('auth');

// Rolemaneger
Route::get('/role', [RoleController::class, 'role'])->name('role')->middleware('auth');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store')->middleware('auth');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store')->middleware('auth');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role')->middleware('auth');
Route::get('/remove/role/{user_id}', [RoleController::class, 'remove_role'])->name('remove.role')->middleware('auth');
Route::get('/remove/delete/{role_id}', [RoleController::class, 'role_delete'])->name('role.delete')->middleware('auth');


// SSLCOMMERZ Start
Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('/email', function () {
    $recipientEmail = 'laraveldeveloper.bd@gmail.com';
    $message = 'Hello, World!';

    // Send the email with a basic text message
    $result = Mail::raw($message, function ($message) use ($recipientEmail) {
        $message->to($recipientEmail)->subject('Hello, World Email');
    });
    dd($result);
    return 'Email sent successfully with "Hello, World!" text.';
});
