<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TestimonialPageController;
use App\Http\Controllers\Backend\BlogPageController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ContactPageController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\AboutPageController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\HomePageController;
use App\Http\Controllers\Backend\ProjectPageController;
use App\Http\Controllers\Backend\ProjectCategoryController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\CommentController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Laravel Breeze, must be auth -> access dashboard
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// group middleware
Route::middleware('auth')->group(function () {
    // Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
        Route::get('/edit/profile', 'editProfile')->name('edit.profile');
        Route::post('/store/profile', 'storeProfile')->name('store.profile');

        Route::get('/change/password', 'changePassword')->name('change.password');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });

    // Blog Category All Route
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('/blog/category/all', 'BlogCategoryAll')->name('blog.category.all');
        Route::get('/blog/category/add', 'BlogCategoryAdd')->name('blog.category.add');
        Route::post('/blog/category/store', 'BlogCategoryStore')->name('blog.category.store');
        Route::get('/blog/category/edit/{id}', 'BlogCategoryEdit')->name('blog.category.edit');
        Route::post('/blog/category/update', 'BlogCategoryUpdate')->name('blog.category.update');
        Route::get('/blog/category/delete/{id}', 'BlogCategoryDelete')->name('blog.category.delete');
    });

    // Blog All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/all', 'BlogAll')->name('blog.all');
        Route::get('/blog/add', 'BlogAdd')->name('blog.add');
        Route::post('/blog/store', 'BlogStore')->name('blog.store');
        Route::get('/blog/edit/{id}', 'BlogEdit')->name('blog.edit');
        Route::post('/blog/update', 'BlogUpdate')->name('blog.update');
        Route::get('/blog/delete/{id}', 'BlogDelete')->name('blog.delete');
        Route::get('/blog/view/{id}', 'BlogView')->name('blog.view');
    });

    // Project Category All Route
    Route::controller(ProjectCategoryController::class)->group(function () {
        Route::get('/project/category/all', 'ProjectCategoryAll')->name('project.category.all');
        Route::get('/project/category/add', 'ProjectCategoryAdd')->name('project.category.add');
        Route::post('/project/category/store', 'ProjectCategoryStore')->name('project.category.store');
        Route::get('/project/category/edit/{id}', 'ProjectCategoryEdit')->name('project.category.edit');
        Route::post('/project/category/update', 'ProjectCategoryUpdate')->name('project.category.update');
        Route::get('/project/category/delete/{id}', 'ProjectCategoryDelete')->name('project.category.delete');
    });
    
    // ProjectAll Route
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/project/all', 'ProjectAll')->name('project.all');
        Route::get('/project/add', 'ProjectAdd')->name('project.add');
        Route::post('/project/store', 'ProjectStore')->name('project.store');
        Route::get('/project/edit/{id}', 'ProjectEdit')->name('project.edit');
        Route::post('/project/update', 'Projectupdate')->name('project.update');
        Route::get('/project/delete/{id}', 'ProjectDelete')->name('project.delete');
        Route::get('/project/view/{id}', 'ProjectView')->name('project.view');
    });

    // Testimonial All Route
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/testimonial/all', 'TestimonialAll')->name('testimonial.all');
        Route::get('/testimonial/add', 'TestimonialAdd')->name('testimonial.add');
        Route::post('/testimonial/store', 'TestimonialStore')->name('testimonial.store');
        Route::get('/testimonial/edit/{id}', 'TestimonialEdit')->name('testimonial.edit');
        Route::post('/testimonial/update', 'TestimonialUpdate')->name('testimonial.update');
        Route::get('/testimonial/delete/{id}', 'TestimonialDelete')->name('testimonial.delete');
    });

    // Testimonial Page All Route
    Route::controller(TestimonialPageController::class)->group(function () {
        Route::get('/testimonial/page/edit', 'TestimonialPageEdit')->name('testimonial.page.edit');
        Route::post('/testimonial/page/update', 'TestimonialPageUpdate')->name('testimonial.page.update');
    });

    // Blog Page All Route
    Route::controller(BlogPageController::class)->group(function () {
        Route::get('/blog/page/edit', 'BlogPageEdit')->name('blog.page.edit');
        Route::post('/blog/page/update', 'BlogPageUpdate')->name('blog.page.update');
    });

    // Contact All Route
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact/edit', 'ContactEdit')->name('contact.edit');
        Route::post('/contact/update', 'ContactUpdate')->name('contact.update');
    });

    // Contact Page All Route
    Route::controller(ContactPageController::class)->group(function () {
        Route::get('/contact/page/edit', 'ContactPageEdit')->name('contact.page.edit');
        Route::post('/contact/page/update', 'ContactPageUpdate')->name('contact.page.update');
    });

    // Message All Route
    Route::controller(MessageController::class)->group(function () {
        Route::get('/message/all', 'MessageAll')->name('message.all');
        Route::get('/message/view/{id}', 'MessageView')->name('message.view');
        Route::get('/message/delete/{id}', 'MessageDelete')->name('message.delete');
        Route::get('/contact/read/all', 'ContactReadAll')->name('read.all.contact');

        Route::get('/hire/all', 'HireAll')->name('hire.all');
        Route::get('/hire/view/{id}', 'HireView')->name('hire.view');
        Route::get('/hire/delete/{id}', 'HireDelete')->name('hire.delete');
        Route::get('/hire/read/all', 'HireReadAll')->name('read.all.hire');
    });

    // About Page All Route
    Route::controller(AboutPageController::class)->group(function () {
        Route::get('/about/page/edit', 'AboutPageEdit')->name('about.page.edit');
        Route::post('/about/page/update', 'AboutPageUpdate')->name('about.page.update');
    });

    // Project Page All Route
    Route::controller(ProjectPageController::class)->group(function () {
        Route::get('/project/page/edit', 'ProjectPageEdit')->name('project.page.edit');
        Route::post('/project/page/update', 'ProjectPageUpdate')->name('project.page.update');
    });

    // Home Page All Route
    Route::controller(HomePageController::class)->group(function () {
        Route::get('/home/page/edit', 'HomePageEdit')->name('home.page.edit');
        Route::post('/home/page/update', 'HomePageUpdate')->name('home.page.update');
    });

    // Skill All Route
    Route::controller(SkillController::class)->group(function () {
        // SKILL
        Route::get('/skill/all', 'SkillAll')->name('skill.all');
        Route::get('/skill/add', 'SkillAdd')->name('skill.add');
        Route::post('/skill/store', 'SkillStore')->name('skill.store');
        Route::get('/skill/edit/{id}', 'SkillEdit')->name('skill.edit');
        Route::post('/skill/update', 'SkillUpdate')->name('skill.update');
        Route::get('/skill/delete/{id}', 'SkillDelete')->name('skill.delete');

        // Programming Language
        Route::get('/programming_language/all', 'ProgrammingLanguageAll')->name('programming_language.all');
        Route::get('/programming_language/add', 'ProgrammingLanguageAdd')->name('programming_language.add');
        Route::post('/programming_language/store', 'ProgrammingLanguageStore')->name('programming_language.store');
        Route::get('/programming_language/edit/{id}', 'ProgrammingLanguageEdit')->name('programming_language.edit');
        Route::post('/programming_language/update', 'ProgrammingLanguageUpdate')->name('programming_language.update');
        Route::get('/programming_language/delete/{id}', 'ProgrammingLanguageDelete')->name('programming_language.delete');

        // EDUCATION
        Route::get('/education/all', 'EducationAll')->name('education.all');
        Route::get('/education/add', 'EducationAdd')->name('education.add');
        Route::post('/education/store', 'EducationStore')->name('education.store');
        Route::get('/education/edit/{id}', 'EducationEdit')->name('education.edit');
        Route::post('/education/update', 'EducationUpdate')->name('education.update');
        Route::get('/education/delete/{id}', 'EducationDelete')->name('education.delete');

        // AWARD
        Route::get('/award/all', 'AwardAll')->name('award.all');
        Route::get('/award/add', 'AwardAdd')->name('award.add');
        Route::post('/award/store', 'AwardStore')->name('award.store');
        Route::get('/award/edit/{id}', 'AwardEdit')->name('award.edit');
        Route::post('/award/update', 'AwardUpdate')->name('award.update');
        Route::get('/award/delete/{id}', 'AwardDelete')->name('award.delete');

        // EXPERIENCE
        Route::get('/experience/all', 'ExperienceAll')->name('experience.all');
        Route::get('/experience/add', 'ExperienceAdd')->name('experience.add');
        Route::post('/experience/store', 'ExperienceStore')->name('experience.store');
        Route::get('/experience/edit/{id}', 'ExperienceEdit')->name('experience.edit');
        Route::post('/experience/update', 'ExperienceUpdate')->name('experience.update');
        Route::get('/experience/delete/{id}', 'ExperienceDelete')->name('experience.delete');

        // ABOUT ME
        Route::get('/about/edit', 'AboutEdit')->name('about.edit');
        Route::post('/about/update', 'AboutUpdate')->name('about.update');

        // HIGHLIGHT
        Route::get('/highlight/all', 'HighlightAll')->name('highlight.all');
        Route::get('/highlight/add', 'HighlightAdd')->name('highlight.add');
        Route::post('/highlight/store', 'HighlightStore')->name('highlight.store');
        Route::get('/highlight/edit/{id}', 'HighlightEdit')->name('highlight.edit');
        Route::post('/highlight/update', 'HighlightUpdate')->name('highlight.update');
        Route::get('/highlight/delete/{id}', 'HighlightDelete')->name('highlight.delete');
    });

    // Comment All Route
    Route::controller(CommentController::class)->group(function () {
        Route::get('/comment/all', 'AllComment')->name('comment.all');
        Route::get('/comment/view/{id}', 'CommentView')->name('comment.view');
        Route::get('/comment/delete/{id}', 'CommentDelete')->name('comment.delete');
    });
}); // end group middleware
