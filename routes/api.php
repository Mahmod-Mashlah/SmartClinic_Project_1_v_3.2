<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\personLogController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\BookAdateController;
use App\Http\Controllers\PatiantController;
use App\Http\Controllers\LikeController;



use App\Http\Controllers\VisitController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\AdvertsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
            // protected routes
    Route::post('createAccount', [personLogController::class, 'createAccount']);
    Route::post('login', [personLogController::class, 'login']);

    Route::post('searchUser', [personLogController::class, 'search']);
    Route::post('searchDoctor', [DoctorController::class, 'search']);
    Route::post('searchClinic', [ClinicController::class, 'search']);
    Route::post('searchPatiant', [PatiantController::class, 'search']);

    Route::get('clinics/', [ClinicController::class, 'index']);
    Route::get('clinics/show/{id}', [ClinicController::class, 'show']);


    Route::get('doctors/', [DoctorController::class, 'index']);
    Route::get('doctors/{id}', [DoctorController::class, 'show']);


////////////////////////////////////////////////////////////////////////////////////////

    Route::prefix("book_adates")->group(function () {
        Route::get('/', [BookAdateController::class, 'index']);
        Route::post('/', [BookAdateController::class, 'store']);
        Route::get('/{id}', [BookAdateController::class, 'show']);
        Route::post('/{id}', [BookAdateController::class, 'update']);
        Route::delete('/{id}', [BookAdateController::class, 'destroy']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::put('update', [personLogController::class, 'update']);
        Route::delete('logout', [personLogController::class, 'logout']);
        Route::get('logout', [personLogController::class, 'Address']);
        Route::get('logout', [personLogController::class, 'Communication']);
        Route::get('profile/{id}', [personLogController::class, 'profile']);



        Route::prefix("doctors")->group(function () {
            Route::post('/', [DoctorController::class, 'addDoctor']);
            Route::post('/{id}', [DoctorController::class, 'update']);
            Route::delete('/{id}', [DoctorController::class, 'destroy']);

            Route::prefix("/{doctor_id}/likes")->group(function () {
                Route::get('/', [LikeController::class, 'index']);
                Route::post('/', [LikeController::class, 'store']);
        });   });

        Route::prefix("clinics")->group(function () {
            Route::post('/', [ClinicController::class, 'Add_Clinc']);
            Route::post('/{id}', [ClinicController::class, 'update']);
            Route::delete('/{id}', [ClinicController::class, 'destroy']);
            Route::get('getClinicPatiants/{id}', [ClinicController::class, 'get_clinic_patiants']);
            Route::get('getclinicDoctors/{id}', [ClinicController::class, 'get_clinic_doctors']);
        });

        Route::prefix("patiants")->group(function () {
            Route::get('/', [PatiantController::class, 'index']);
            Route::get('get_patiant_dates/{id}', [PatiantController::class, 'get_patiant_dates']);
            Route::post('/', [PatiantController::class, 'addPatiant']);
            Route::get('/{id}', [PatiantController::class, 'show']);
            Route::post('/{id}', [PatiantController::class, 'update']);
            Route::delete('/{id}', [PatiantController::class, 'destroy']);
            Route::get('/{id}', [PatiantController::class, 'profile']);
         });
    });







Route::prefix("secretaries")->group(function () {
    Route::get('/', [SecretaryController::class, 'index']);
    Route::post('/', [SecretaryController::class, 'store']);
    Route::get('/{id}', [SecretaryController::class, 'show']);
    Route::put('/{id}', [SecretaryController::class, 'update']);
    Route::delete('/{id}', [SecretaryController::class, 'destroy']);
});

























///////////////////////////////////////////////////////////////////////////////////
// Mahmod Routes :


//////////////////middleware for the Adverts :


/*  */

// Employee Routes :

Route::get('/employees', [EmployeeController::class, 'index']);//
Route::post('/employee', [EmployeeController::class, 'store']);//
Route::get('/employees/{id}',[EmployeeController::class,'show']);//
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);//
Route::put('/employees/{id}', [EmployeeController::class, 'update']);//
Route::get('/employees/search/status/{status}', [EmployeeController::class, 'statusSearch']);//
Route::get('/employees/search/jobTitles/{jobTitle}', [EmployeeController::class, 'jobTitleSearch']);//
Route::get('/employees/search/startDate/{startDate}', [EmployeeController::class, 'startDateSearch']);//



// Adverts Routes :

    Route::get('/adverts', [AdvertsController::class, 'index']);
    Route::post('/advert', [AdvertsController::class, 'store']);
    Route::delete('/adverts', [AdvertsController::class, 'destroy']);
    Route::put('/adverts/{id}', [AdvertsController::class, 'edit']);
    Route::get('/adverts/search/{name}', [AdvertsController::class, 'search']);
    //Route::get('/Internal_procedures/search/date/{date}', [TreatmentController::class, 'dateSearch']);//
    //Route::get('/Internal_procedures/search/note/{note}', [TreatmentController::class, 'noteSearch']);//


// Treatments Routes :   المعالجة

        //  Treatment المعالجة نفسها
    Route::get('/treatments',[TreatmentController::class,'index']);
    Route::post('/treatment',[TreatmentController::class,'store']);
    Route::get('/treatments/{id}',[TreatmentController::class,'show']);
    Route::post('/treatments/{id}',[TreatmentController::class,'update']);
    Route::delete('/treatments/{id}',[TreatmentController::class,'destroy']);
    //Route::get('/treatments/search/date/{date}', [TreatmentController::class, 'dateSearch']);//

    // Diagnosis Routes التشخيص

    Route::get('/diagnosis',[TreatmentController::class,'diagnosis_index']);
    Route::post('/diagnosis',[TreatmentController::class,'diagnosis_store']);
    Route::get('/diagnosis/{id}',[TreatmentController::class,'diagnosis_show']);
    Route::post('/diagnosis/{id}',[TreatmentController::class,'diagnosis_update']);
    Route::delete('/diagnosis/{id}',[TreatmentController::class,'diagnosis_destroy']);
    Route::get('/diagnosis/search/name/{name}', [TreatmentController::class, 'nameSearch']);//
    Route::get('/diagnosis/search/type/{type}', [TreatmentController::class, 'typeSearch']);//

        //examination Routes الفحص

    Route::get('/examinations',[TreatmentController::class,'examination_index']);
    Route::post('/examination',[TreatmentController::class,'examination_store']);
    Route::get('/examinations/{id}',[TreatmentController::class,'examination_show']);
    Route::post('/examinations/{id}',[TreatmentController::class,'examination_update']);
    Route::delete('/examinations/{id}',[TreatmentController::class,'examination_destroy']);
    Route::get('/examinations/search/name/{name}', [TreatmentController::class, 'examinations_nameSearch']);//
    Route::get('/examinations/search/type/{type}', [TreatmentController::class, 'examinations_typeSearch']);//

        // Internal_procedures الاجراءات الداخلية


    Route::get('/internal_procedures', [TreatmentController::class, 'internal_procedures_index']); //
    Route::post('/internal_procedure', [TreatmentController::class, 'internal_procedures_store']); //
    Route::get('internal_procedures/{id}',[TreatmentController::class,'internal_procedures_show']);//
    Route::delete('/internal_procedures/{id}', [TreatmentController::class, 'internal_procedures_destroy']);//
    Route::post('/internal_procedures/{id}', [TreatmentController::class, 'internal_procedures_update']);//

    Route::get('/internal_procedures/search/name/{name}', [TreatmentController::class, 'internal_procedures_nameSearch']);//
    Route::get('/internal_procedures/search/type/{type}', [TreatmentController::class, 'internal_procedures_typeSearch']);//
    Route::get('/internal_procedures/search/place/{place}', [TreatmentController::class, 'internal_procedures_placeSearch']);//


        // Visit Routes :

    Route::get('visits', [VisitController::class, 'index']); //
    Route::post('visit', [VisitController::class, 'store']); //
    Route::get('/visits/{id}',[VisitController::class,'show']);//
    Route::delete('visits/{id}', [VisitController::class, 'destroy']);//
    Route::post('visits/{id}', [VisitController::class, 'update']);//
    Route::get('/visits/search/date/{date}', [VisitController::class, 'dateSearch']);//
    Route::get('/visits/search/note/{note}', [VisitController::class, 'noteSearch']);//
    Route::get('/visits/search/day/{day}', [VisitController::class, 'daySearch']);//

        //Report Routes :

    Route::get('reports', [ReportController::class, 'index']);//
    Route::post('report', [ReportController::class, 'store']);//
    Route::delete('reports/{id}', [ReportController::class, 'destroy']);//
    Route::post('reports/{id}', [ReportController::class, 'update']);//
    Route::get('/reports/search/{id}', [ReportController::class, 'idSearch']);//


    Route::get('/prescriptions', [TreatmentController::class, 'prescription_index']); //
    Route::post('/prescription', [TreatmentController::class, 'prescription_store']); //
    Route::get('/prescriptions/{id}',[TreatmentController::class,'prescription_show']);//
    Route::post('/prescriptions/{id}', [TreatmentController::class, 'prescription_update']);//
    Route::delete('/prescriptions/{id}', [TreatmentController::class, 'prescription_destroy']);//
    // Route::get('/prescriptions/search/date/{date}', [TreatmentController::class, 'prescription_dateSearch']);//
    // Route::get('/prescriptions/search/note/{note}', [TreatmentController::class, 'prescription_noteSearch']);//
    // Route::get('/prescriptions/search/day/{day}', [TreatmentController::class, 'prescription_daySearch']);//



    Route::get('/medicines', [TreatmentController::class, 'medicine_index']); //
    Route::post('/medicine', [TreatmentController::class, 'medicine_store']); //
    Route::get('/medicines/{id}',[TreatmentController::class,'medicine_show']);//
    Route::post('/medicines/{id}', [TreatmentController::class, 'medicine_update']);//
    Route::delete('/medicines/{id}', [TreatmentController::class, 'medicine_destroy']);//
    // Route::get('/medicines/search/date/{date}', [TreatmentController::class, 'medicine_dateSearch']);//
    // Route::get('/medicines/search/note/{note}', [TreatmentController::class, 'medicine_noteSearch']);//
    // Route::get('/medicines/search/day/{day}', [TreatmentController::class, 'medicine_daySearch']);//


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
