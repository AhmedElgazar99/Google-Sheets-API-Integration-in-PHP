<?php

use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\SheetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::prefix('aapi/v1')->group(function(){
//     Route::get('/any',[    ::class,'   ']);
// });

Route::get('/readsheet', [GoogleSheetController::class, 'readSheet']);//View the data of sheet

Route::post('/insert',[GoogleSheetController::class,'insert']);//insert data 

Route::post('/updatesheet/{idname}', [GoogleSheetController::class, 'updateSheetByIdname']);//update sheet by using Unique Name

Route::get('/getrow/{idname}', [GoogleSheetController::class, 'getRowByIdname']);//getRowByIdname

///////////////////////////////new///
//Route::get('/readnew', [SheetController::class, 'readnew']);//View the data of sheet