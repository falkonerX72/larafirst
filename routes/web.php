<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\CompareController;
use App\Models\Wishlist;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// User Frontend All Route 
Route::get('/', [UserController::class, 'Index']);
//catagories


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    Route::get('/user/schedule/request', [UserController::class, 'UserScheduleRequest'])->name('user.schedule.request');

    //user wish list all route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/user/wishlist', 'UserWishList')->name('user.wishlist');
        Route::get('/get-wishlist-property', 'GetWishlistProperty');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });
    Route::controller(CompareController::class)->group(function () {
        Route::get('/user/compare', 'UserCompare')->name('user.compare');
        Route::get('/get-compare-property', 'GetCompareProperty');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });
});

require __DIR__ . '/auth.php';


/// Admin Group Middleware 
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
}); // End Group Admin Middleware



/// Agent Group Middleware 
Route::middleware(['auth', 'role:agent'])->group(function () {

    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');

    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');

    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');

    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');

    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
}); // End Group Agent Middleware


Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');




Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);



/// Admin Group Middleware 
Route::middleware(['auth', 'role:admin'])->group(function () {


    // Property Type All Route 
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });

    // Property State All Route 
    Route::controller(StateController::class)->group(function () {

        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');
    });

    //testimonials
    Route::controller(TestimonialController::class)->group(function () {

        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial');
        Route::post('/store/testimonial', 'StoreTestimonial')->name('store.testimonial');
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('update.testimonial');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    });
    //blogs
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');

        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/blog/category/{id}', 'EditBlogCategory');
        // Route::post('/update/testimonial', 'UpdateTestimonial')->name('update.testimonial');
        Route::get('/delete/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    });
    //blog posts
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/post', 'AllPost')->name('all.post');
        Route::get('/add/post', 'AddPost')->name('add.post');
        Route::post('/store/post', 'StorePost')->name('store.post');
        Route::get('/edit/post/{id}', 'EditPost')->name('edit.post');
        Route::post('/update/post', 'UpdatePost')->name('update.post');
        Route::get('/delete/post/{id}', 'DeletePost')->name('delete.post');
    });


    // Amenities Type All Route 
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie');
        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie');
        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');
    });


    // Property All Route 
    Route::controller(PropertyController::class)->group(function () {

        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');

        Route::post('/update/property/thambnail', 'UpdatePropertyThambnail')->name('update.property.thambnail');

        Route::post('/update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');

        Route::get('/property/multiimg/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimg.delete');

        Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');

        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');

        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');

        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');

        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');

        Route::post('/active/property', 'ActiveProperty')->name('active.property');

        Route::get('/admin/package/history', 'AdminPackageHistory')->name('admin.package.history');

        Route::get('/package/invoice/{id}', 'PackageInvoice')->name('package.invoice');
        Route::get('/admin/property/message/', 'AdminPropertyMessage')->name('admin.property.message');


        Route::get('/admin/message/details/{id}', 'AdminMessageDetails')->name('admin.message.details');
    });



    // Agent All Route from admin 
    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/agent', 'AllAgent')->name('all.agent');
        Route::get('/add/agent', 'AddAgent')->name('add.agent');
        Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent');
        Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent');

        Route::get('/changeStatus', 'changeStatus');
    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/update/smpt/setting', 'UpdateSmtpSetting')->name('update.smpt.setting');
    });
    // Site Setting  All Route 
    Route::controller(SettingController::class)->group(function () {

        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');
    }); // End Group Admin Middleware
});





/// Agent Group Middleware 
Route::middleware(['auth', 'role:agent'])->group(function () {

    // Agent All Property  
    Route::controller(AgentPropertyController::class)->group(function () {

        Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
        Route::get('/agent/add/property', 'AgentAddProperty')->name('agent.add.property');

        Route::post('/agent/store/property', 'AgentStoreProperty')->name('agent.store.property');

        Route::get('/agent/edit/property/{id}', 'AgentEditProperty')->name('agent.edit.property');

        Route::post('/agent/update/property', 'AgentUpdateProperty')->name('agent.update.property');

        Route::post('/agent/update/property/thambnail', 'AgentUpdatePropertyThambnail')->name('agent.update.property.thambnail');

        Route::post('/agent/update/property/multiimage', 'AgentUpdatePropertyMultiimage')->name('agent.update.property.multiimage');

        Route::get('/agent/property/multiimg/delete/{id}', 'AgentPropertyMultiimgDelete')->name('agent.property.multiimg.delete');

        Route::post('/agent/store/new/multiimage', 'AgentStoreNewMultiimage')->name('agent.store.new.multiimage');

        Route::post('/agent/update/property/facilities', 'AgentUpdatePropertyFacilities')->name('agent.update.property.facilities');

        Route::get('/agent/details/property/{id}', 'AgentDetailsProperty')->name('agent.details.property');

        Route::get('/agent/delete/property/{id}', 'AgentDeleteProperty')->name('agent.delete.property');

        //check msg
        Route::get('/agent/property/message/', 'AgentPropertyMessage')->name('agent.property.message');

        Route::get('/agent/message/details/{id}', 'AgentMessageDetails')->name('agent.message.details');

        //shcedule request route
        Route::get('/agent/schedule/request', 'AgentScheduleRequest')->name('agent.schedule.request');

        Route::get('/agent/details/schedule/{id}', 'AgentDetailsSchedule')->name('agent.details.schedule');

        Route::post('/agent/update/schedule/', 'AgentUpdateSchedule')->name('agent.update.schedule');
    });



    // Agent Buy Package Route from admin 
    Route::controller(AgentPropertyController::class)->group(function () {

        Route::get('/buy/package', 'BuyPackage')->name('buy.package');

        Route::get('/buy/business/plan', 'BuyBusinessPlan')->name('buy.business.plan');
        Route::post('/store/business/plan', 'StoreBusinessPlan')->name('store.business.plan');

        Route::get('/buy/professional/plan', 'BuyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/professional/plan', 'StoreProfessionalPlan')->name('store.professional.plan');


        Route::get('/package/history', 'PackageHistory')->name('package.history');
        Route::get('/agent/package/invoice/{id}', 'AgentPackageInvoice')->name('agent.package.invoice');
    });
}); // End Group Agent Middleware

/// permission  Group controller
Route::controller(RoleController::class)->group(function () {

    Route::get('/all/permission', [RoleController::class, 'AllPermission'])->name('all.permission');
    Route::get('/add/permission', [RoleController::class, 'AddPermission'])->name('add.permission');
    Route::post('/store/permission', [RoleController::class, 'StorePermission'])->name('store.permission');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    Route::get('/import/permission', [RoleController::class, 'ImportPermission'])->name('import.permission');
    Route::get('/export', [RoleController::class, 'Export'])->name('export');
}); // End Group permission  controller



/// roles  Group controller
Route::controller(RoleController::class)->group(function () {

    Route::get('/all/roles', [RoleController::class, 'AllRoles'])->name('all.roles');
    Route::get('/add/roles', [RoleController::class, 'AddRoles'])->name('add.roles');
    Route::post('/store/roles', [RoleController::class, 'StoreRoles'])->name('store.roles');
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
    Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

    //assigning Roles

    Route::get('/add/roles/permission', [RoleController::class, 'AddRolesPermission'])->name('add.roles.permission');
    Route::get('/all/roles/permission', [RoleController::class, 'AllRolesPermission'])->name('all.roles.permission');
    Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
    Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
    Route::post('/store/roles/permission', [RoleController::class, 'StoreRolesPermission'])->name('store.roles.permission');
}); // End Group roles  controller

//admin user all route
Route::controller(AdminController::class)->group(function () {

    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
}); // End Group Admin Middleware









/// frontend property details

Route::get('/property/details/{id}/{slug}', [IndexController::class, 'PropertyDetails']);

//send msg from pro-details page

Route::post('/property/message', [IndexController::class, 'PropertyMessage'])->name('property.message');

//wish list ADD route

Route::post('/add-to-wishList/{property_id}', [WishlistController::class, 'AddToWishList']);

// compareADD route

Route::post('/add-to-compare/{property_id}', [CompareController::class, 'addToCompare']);

//agent details

route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');
// Agent Details Page in Frontend 
Route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');


// home page buy search option 
Route::post('/buy/property/search', [IndexController::class, 'BuyPropertySearch'])->name('buy.property.search');
// home page buy search option 
Route::post('/rent/property/search', [IndexController::class, 'RentPropertySearch'])->name('rent.property.search');
// home page buy search option 
Route::post('/all/property/search', [IndexController::class, 'AllPropertySearch'])->name('all.property.search');


//send msg from agent-details page
Route::post('/agent/details/message', [IndexController::class, 'AgentDetailsMessage'])->name('agent.details.message');
Route::post('/store/schedule/', [IndexController::class, 'StoreSchedule'])->name('store.schedule');
//get all rent data
Route::get('/rent/property', [IndexController::class, 'RentProperty'])->name('rent.property');
//get all buy data
Route::get('/buy/property', [IndexController::class, 'BuyProperty'])->name('buy.property');
//property type all data
Route::get('/property/type/{id}', [IndexController::class, 'PropertyType'])->name('property.type');
//list all catagories
Route::get('/all/property/featured', [IndexController::class, 'AllPropertyFeatured'])->name('all.property.featured');

//all catagories

Route::get('/all/category', [IndexController::class, 'AllCategory'])->name('all.category');

Route::get('/state/details/{id}', [IndexController::class, 'StateDetails'])->name('state.details');
//blog details
Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails'])->name('blog.details');
Route::get('/blog/cat/list/{id}', [BlogController::class, 'BlogCatList'])->name('blog.cat.list');
Route::get('/blog', [BlogController::class, 'BlogList'])->name('blog.list');
Route::post('/store/comment', [BlogController::class, 'StoreComment'])->name('store.comment');
Route::get('/admin/blog/comment/', [BlogController::class, 'AdminBlogComment'])->name('admin.blog.comment');
Route::get('/admin/comment/reply/{id}', [BlogController::class, 'AdminCommentReply'])->name('admin.comment.reply');
Route::post('/reply/message', [BlogController::class, 'ReplyMessage'])->name('reply.message');
