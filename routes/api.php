<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\TestimonialPageController;
use App\Http\Controllers\Backend\BlogPageController;
use App\Http\Controllers\Backend\ContactPageController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\AboutPageController;
use App\Http\Controllers\Backend\HomePageController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\VisitorController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectPageController;
use App\Http\Controllers\Backend\ProjectCategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blog/all', [BlogController::class, 'AllBlog']);
Route::get('/blog/{id}', [BlogController::class, 'BlogDetails']);

Route::get('/blog/category/all', [BlogCategoryController::class, 'AllBlogCategory']);
Route::get('/blog/category/{id}', [BlogCategoryController::class, 'AllBlogByCategory']);

Route::get('/project/category/all', [ProjectCategoryController::class, 'AllProjectCategory']);
Route::get('/project/category/{id}', [ProjectCategoryController::class, 'AllProjectByCategory']);

Route::get('/project/all', [ProjectController::class, 'AllProject']);
Route::get('/project/{id}', [ProjectController::class, 'ProjectDetails']);

Route::get('/comment/all', [CommentController::class, 'CommentAll']);
Route::post('/comment/store', [CommentController::class, 'CommentStore']);
Route::get('/comment/like/{id}', [CommentController::class, 'CommentLike']);
Route::get('/comment/unlike/{id}', [CommentController::class, 'CommentUnLike']);

Route::get('/testimonial/all', [TestimonialPageController::class, 'GetTesttimonialData']);
Route::get('/blog-page/all', [BlogPageController::class, 'GetBlogData']);
Route::get('/contact-page/all', [ContactPageController::class, 'GetContactData']);
Route::get('/contact/all', [ContactController::class, 'AllContact']);
Route::get('/about-page/all', [AboutPageController::class, 'GetAboutData']);
Route::get('/home-page/all', [HomePageController::class, 'GetHomeData']);
Route::get('/project-page/all', [ProjectPageController::class, 'GetProjectData']);

Route::get('/skill/all', [SkillController::class, 'AllSkill']);
Route::get('/about/all', [SkillController::class, 'AllAbout']);

// store message
Route::post('/message/store', [MessageController::class, 'MessageStore']);
Route::post('/hire-message/store', [MessageController::class, 'HireMessageStore']);

// visitor
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);