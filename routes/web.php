<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\FrontendController::class, 'homepage'])->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', [App\Http\Controllers\AuthLogout::class, 'logout'])->name('logout.perform');
 });

//User
 Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'user_delete'])->name('user.delete');
 Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'user_edit'])->name('user.edit');
 Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'user_update'])->name('user.update');
 Route::post('/delete/check', [App\Http\Controllers\UserController::class, 'delete_check'])->name('delete.check');

//user category

Route::get('/category/insert/form', [App\Http\Controllers\CategoryController::class, 'category_insert_form'])->name('category_insert.form');
Route::post('/category/insert/success', [App\Http\Controllers\CategoryController::class, 'category_insert'])->name('category.insert');
Route::get('/category/show', [App\Http\Controllers\CategoryController::class, 'category_show'])->name('category.show');
Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/edit/confirm/{id}', [App\Http\Controllers\CategoryController::class, 'category_edit_confirm'])->name('category_edit.confirm');

//tag
Route::get('/add/tag/form', [App\Http\Controllers\TagController::class, 'add_tag_form'])->name('add_tag.form');
Route::post('/tag/insert', [App\Http\Controllers\TagController::class, 'tag_insert'])->name('tag.insert');
Route::get('/tag/delete/{id}', [App\Http\Controllers\TagController::class, 'tag_delete'])->name('tag.delete');
Route::get('/tag/edit/form/{id}', [App\Http\Controllers\TagController::class, 'tag_edit_form'])->name('tag_edit.form');
Route::post('/tag/update/{id}', [App\Http\Controllers\TagController::class, 'tag_update'])->name('tag.update');


//Role
Route::get('/role', [App\Http\Controllers\RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [App\Http\Controllers\RoleController::class, 'permission_store'])->name('permission.store');
Route::get('/permission/edit/{id}', [App\Http\Controllers\RoleController::class, 'permission_edit'])->name('permission.edit');
Route::post('/permission/update/{id}', [App\Http\Controllers\RoleController::class, 'permission_update'])->name('permission.update');

Route::get('role/with/permission/edit/{id}/{name}', [App\Http\Controllers\RoleController::class, 'role_with_permission_edit'])->name('role_with_permission.edit');
Route::get('/permission/delete/{id}', [App\Http\Controllers\RoleController::class, 'permission_delete'])->name('permission.delete');
Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [App\Http\Controllers\RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/remove/role/{id}', [App\Http\Controllers\RoleController::class, 'remove_role'])->name('remove.role');
Route::get('/edit/user/role/permission/{id}', [App\Http\Controllers\RoleController::class, 'edit_user_role_permission'])->name('edit_user.role.permission');
Route::post('/permission/update', [App\Http\Controllers\RoleController::class, 'update_permission'])->name('permission.update');


//add Post

Route::get('/add/post', [App\Http\Controllers\PostController::class, 'add_post'])->name('add.post');
Route::post('/add/post/store', [App\Http\Controllers\PostController::class, 'post_store'])->name('post.store');
Route::get('/post/list', [App\Http\Controllers\PostController::class, 'post_list'])->name('post.list');
Route::get('/post/details/admin/{id}', [App\Http\Controllers\PostController::class, 'post_details'])->name('post.details');

//delete Post

Route::post('/delete/post', [App\Http\Controllers\PostController::class, 'delete_post'])->name('delete.post');

//edit post

Route::get('/edit/post/{id}', [App\Http\Controllers\PostController::class, 'post_edit'])->name('post.edit');
Route::post('/edit/post/confirm/{id}', [App\Http\Controllers\PostController::class, 'edit_post'])->name('edit.post');

//Frontend
Route::get('/homepage', [App\Http\Controllers\FrontendController::class, 'homepage'])->name('homepage');
Route::get('/categorywise/blog/show/{id}/{name}', [App\Http\Controllers\FrontendController::class, 'categorywise_blog_show'])->name('categorywise_blog.show');
Route::post('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

//writer post
Route::get('/writter/post/{id}', [App\Http\Controllers\FrontendController::class, 'writer_post'])->name('writer.post');

//author List
Route::get('/author/list', [App\Http\Controllers\FrontendController::class, 'author_list'])->name('author.list');

//post details
Route::get('/post/details/{id}', [App\Http\Controllers\FrontendController::class, 'post_even_details'])->name('post_even.details');

//guest register
Route::get('/guest/register', [App\Http\Controllers\GuestController::class, 'guest_register'])->name('guest.register');
Route::post('/guest/register/store', [App\Http\Controllers\GuestController::class, 'guest_store'])->name('guest.store');
//guest loginControllers
Route::get('/guest/login', [App\Http\Controllers\GuestController::class, 'guest_login'])->name('guest.login');
Route::post('/guest/login/confirm', [App\Http\Controllers\GuestController::class, 'guest_login_confirm'])->name('guest.login.confirm');


//guest logout
Route::get('/logout/guest', [App\Http\Controllers\GuestController::class, 'logout_guest'])->name('logout.guest');

//google Login
Route::get('/google/redirect', [App\Http\Controllers\GuestController::class, 'redirect_provider'])->name('google.redirect');
Route::get('google/callback', [App\Http\Controllers\GuestController::class, 'provider_to_application'])->name('google.callback');

//guest pass reset

Route::get('/guest/pass/reset/req', [App\Http\Controllers\GuestController::class, 'guest_pass_reset_req'])->name('guest.pass.reset.req');
Route::post('/guest/pass/req/send', [App\Http\Controllers\GuestController::class, 'guest_pass_req_send'])->name('guest.pass.req.send');
Route::get('/guest/pass/reset/form/{token}', [App\Http\Controllers\GuestController::class, 'guest_pass_reset_form'])->name('guest.pass.reset.form');
Route::post('/guest/pass/reset/confirm', [App\Http\Controllers\GuestController::class, 'guest_pass_reset_confirm'])->name('guest.pass.reset.confirm');


//Comments
Route::post('/comment/store', [App\Http\Controllers\CommentsController::class, 'comment_store'])->name('comment.store');
Route::post('/comments/store', [App\Http\Controllers\CommentsController::class, 'comment_stores'])->name('comment.stores');

//search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');


//pagination
Route::get('custom-pagination', [TestController::class, 'index']);
