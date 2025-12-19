<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;


Route::get("/", [PageController::class, "home"]) -> name("home");

Route::get("/feedback", [FeedbackController::class, "showForm"]) -> name("feedback.form");
Route::post("/feedback", [FeedbackController::class, "submitForm"]) -> name("feedback.submit");

Route::get("/data", [FeedbackController::class, "showData"]) -> name("feedback.data");
