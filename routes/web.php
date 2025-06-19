<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lien-he', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/lien-he', [ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/test-contact-email', [ContactController::class, 'testContactEmail'])->name('contact.test-email');
