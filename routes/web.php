<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\LessonController as StudentLessonController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Public pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Student courses (public catalog)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{module}', [CourseController::class, 'show'])->name('courses.show');

// Authenticated student routes
Route::middleware(['auth'])->group(function () {
    // User dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // My courses
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('student.courses.my');
    
    // Access code entry
    Route::get('/courses/{module}/access', [CourseController::class, 'accessForm'])->name('student.courses.access');
    Route::post('/courses/{module}/access', [CourseController::class, 'verifyAccess'])->name('student.courses.verify');
    
    // Lessons
    Route::get('/lessons/{lesson}', [StudentLessonController::class, 'show'])->name('student.lessons.show');
    Route::post('/lessons/{lesson}/complete', [StudentLessonController::class, 'complete'])->name('student.lessons.complete');
    
    // Quizzes
    Route::post('/quizzes/{quiz}/submit', [StudentQuizController::class, 'submit'])->name('student.quizzes.submit');
    
    // Progress tracking
    Route::get('/progress', [ProgressController::class, 'index'])->name('student.progress');

    // Tickets
    Route::resource('tickets', TicketController::class)->except(['edit', 'update', 'destroy']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin,formateur'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Module management
    Route::resource('modules', ModuleController::class);
    
    // Chapter management
    Route::resource('chapters', ChapterController::class);
    
    // Lesson management
    Route::resource('lessons', LessonController::class);
    
    // Quiz management
    Route::resource('quizzes', QuizController::class);
    
    // User management (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
    
    // Ticket management
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}', [AdminTicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [AdminTicketController::class, 'destroy'])->name('tickets.destroy');
    
    // Purchase management
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
});

require __DIR__.'/auth.php';
