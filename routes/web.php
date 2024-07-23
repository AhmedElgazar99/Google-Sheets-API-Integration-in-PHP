<?php

use App\Http\Controllers\contactuscontroller;
use App\Http\Controllers\filecontroller;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\welcomeController;
use App\Mail\basicmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lay', function () {
    return view('components.bootlayout');
});


///////////////////////////////////////////////////////////

Route::get('/photo',[filecontroller::class,'index'] )->name('photo');
Route::post('/photo/upload',[filecontroller::class,'upload'] )->name('photo.upload');



//////////////////////////////////////////////////////////////


//to solve page expired problem ---take csrf_token and put in header "X-CSRF-TOKEN" on postman
Route::get('/token', [NoteController::class,'token']);


//get all itemes
Route::get('/allnotes',[NoteController::class,'index2']);
//get item by id 
Route::get('/notes/{id}',[NoteController::class,'show']);
//update
Route::put('/notes/{id}',[NoteController::class,'update']);
//delete
Route::delete('/notes/{id}',[NoteController::class,'destroy']);
//store
Route::post('/notes',[NoteController::class,'store']);

////////////////
Route::get('/notes',[NoteController::class,'index']);


//mail use mailtrap website 
/**1-config mail 
 * 2-make email //php artisan make:mail 'name'
 * 3-mail::to
*/
Route::get('/mail',function(){
    Mail::to("elgazar123456147@gmail.com")->send(new basicmail('ahmed'));
    return "Email was sent";
});

Route::get('/contact',[contactuscontroller::class,'index'])->name('contact');
Route::post('/contact/send',[contactuscontroller::class,'store'])->name('contact.send');

