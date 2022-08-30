<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParametersController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post("/authenticate", [LoginController::class, 'authenticate']);

Route::get("/contact", [ContactController::class, 'index']);
Route::post("/send-message", [ContactController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get("/admin/view-messages", [ContactController::class, 'listMessages']);
    Route::get("/admin/messages/{id}", [ContactController::class, 'message_details']);
    Route::delete("/admin/messages/{id}/delete", [ContactController::class, 'delete_message']);
    Route::post("/admin/messages/multiple-delete", [ContactController::class, 'deleteMultipleMessages'])->name('multiple-delete');

    Route::get("/admin/settings", [ParametersController::class, 'index']);
    Route::post("/admin/settings", [ParametersController::class, 'save_parameter']);

    Route::post("/logout", [LoginController::class, 'logout']);
});
