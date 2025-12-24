<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get("/", [PageController::class, "home"])->name("home");

Route::controller(FeedbackController::class)->prefix('feedback')->name('feedback.')->group(function () {
    Route::get('/', 'showForm')->name('form');
    Route::post('/', 'store')->name('submit');
    Route::get('/data', 'index')->name('data');
    Route::get('/{feedback}/edit', 'edit')->name('edit');
    Route::put('/{feedback}', 'update')->name('update');
    Route::delete('/{feedback}', 'destroy')->name('destroy');
});

Route::resource('posts', PostController::class);

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');