<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CBMController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JCBcontroller;
use App\Http\Controllers\MPUcontroller;
use App\Http\Controllers\onecardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UPIController;
use App\Http\Controllers\VisaDataController;
use Illuminate\Support\Facades\Route;

// Admin Middleware
// Route::middleware('admin')->group(function ()
// {
// // Route::get('/register', [AuthController::class,"registerhome"])->name("registerhome");
// // Route::post('/register',[AuthController::class,"register"])->name("register");
// Route::post('/registerinfo',[AuthController::class,"registerinfo"])->name("registerinfo");
// });

// Guest Middleware
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, "registerhome"])->name("registerhome");
    Route::post('/register', [AuthController::class, "register"])->name("register");
    Route::get('/login', [AuthController::class, "loginhome"])->name("loginhome");
    Route::post('/login', [AuthController::class, "login"])->name("login");
    Route::get('/forgetpasswordhome', [AuthController::class, "forgetpasswordhome"])->name("forgetpasswordhome");
    Route::post('/forgetpasswordvalidate', [AuthController::class, "forgetpasswordvalidate"])->name("forgetpasswordvalidate");
    Route::post('/updatePassword/{id}', [AuthController::class, "updatePassword"])->name("updatePassword");
});


Route::get('/logout', [AuthController::class, "logout"])->name("logout");
// Route::post('/print',[onecardController::class,"d"])->name("d");


// Auth Middleware
Route::middleware('auth')->group(function () {
    Route::get('/cardsettlement', [HomeController::class, "home"])->name("home");
    // Route::get('/', [HomeController::class, "home"])->name("home");
    Route::get('/JCB', [HomeController::class, "JCBHome"])->name("JCBHome");
    Route::get('/MPU', [HomeController::class, "MPUHome"])->name("MPUHome");
    Route::get('/UPI', [UPIController::class, "UPIHome"])->name("UPIHome");

    Route::post('/jcbupload', [JCBcontroller::class, "jcb"])->name("jcb");
    Route::get('/jcbdownload', [JCBcontroller::class, "download"])->name("download");

    Route::post('/mpuupload', [MPUcontroller::class, "mpu"])->name("mpu");
    Route::post('/upiupload', [UPIController::class, "UPIupload"])->name("UPIupload");
    Route::get('/upidownload', [UPIController::class, "upidownload"])->name("upidownload");


    //Download Button//
    //11C
    Route::get('/IND11Cdownload', [DownloadController::class, "downloadIND11c"])->name("downloadIND11c");
    //ACOM
    Route::get('/ACOMdownload', [DownloadController::class, "downloadACOM"])->name("downloadACOM");
    //ICOM
    Route::get('/ICOMdownload', [DownloadController::class, "downloadICOM"])->name("downloadICOM");
    //11S
    Route::get('/inc11sdownload', [DownloadController::class, "downloadinc11s"])->name("downloadinc11s");
    //11s_901
    Route::get('/inc11s_901download', [DownloadController::class, "downloadinc11s_901"])->name("downloadinc11s_901");
    //SCOM
    Route::get('/SCOMdownload', [DownloadController::class, "downloadincSCOM"])->name("downloadincSCOM");
    //SCOM_901902
    Route::get('/SCOM_901902download', [DownloadController::class, "downloadincSCOM_901902"])->name("downloadincSCOM_901902");
    //AERR
    Route::get('/AERRdownload', [DownloadController::class, "downloadAerr"])->name("downloadAerr");
    //INC11E
    Route::get('/INC11Edownload', [DownloadController::class, "downlodINC11E"])->name("downlodINC11E");
    //IERR
    Route::get('/IERRdownload', [DownloadController::class, "downlodIERR"])->name("downlodIERR");
    //01C
    Route::get('/downlod01C', [DownloadController::class, "downlod01C"])->name("downlod01C");
    //01S_900
    Route::get('/downlodijc01_900', [DownloadController::class, "downlodijc01_900"])->name("downlodijc01_900");
    //01S_902
    Route::get('/downlodijc01_902', [DownloadController::class, "downlodijc01_902"])->name("downlodijc01_902");
    //INC_01C
    Route::get('/downlodinc01c/{name}', [DownloadController::class, "downlodinc01c"])->name("downlodinc01c");


    Route::get('/pdf', [PdfController::class, "pdf"])->name("pdf");

    //Visa Data Record
    Route::get('/visa', [VisaDataController::class, "visa"])->name("visa");
    Route::post('/visa', [VisaDataController::class, "insert"])->name("insert");
    Route::get('/visaall', [VisaDataController::class, "show"])->name("showall");
    Route::get('/visaedit/{id}', [VisaDataController::class, "visaedit"])->name("visaedit");
    Route::post('/visaupdate/{id}', [VisaDataController::class, "visaupdate"])->name("visaupdate");
    Route::post('/visadownload', [VisaDataController::class, "visadownload"])->name("visadownload");

    Route::get('/ccy', [VisaDataController::class, "ccy"])->name("ccy");
    Route::post('/ccy', [VisaDataController::class, "ccyinsert"])->name("ccyinsert");

    //Onecard ATM
    Route::get('/atm', [onecardController::class, "atmhome"])->name("atmhome");
    Route::post('/atmprint', [onecardController::class, "atmprint"])->name("print");
    Route::get('/atmdownload/{startdate}/{enddate}', [onecardController::class, "atmdownload"])->name("atmdownload");

    // Onecard Customer Outstanding
    Route::get('/outstanding', [onecardController::class, "cohome"])->name("cohome");
    Route::post('/outstandingprint', [onecardController::class, "coprint"])->name("coprint");
    Route::get('/codownload/{date}/{branch}', [onecardController::class, "codownload"])->name("codownload");

    // MOB_Card_List
    Route::get('/cardlist', [onecardController::class, "cardhome"])->name("cardhome");
    Route::post('/cardlistprint', [onecardController::class, "cardprint"])->name("cardprint");
    Route::get('/carddownload/{startdate}/{enddate}/{brand}', [onecardController::class, "cardlistdownload"])->name("cardlistdownload");

    // MOB_Credit_Card_status
    Route::get('/creditlist', [onecardController::class, "credithome"])->name("credithome");
    Route::post('/creditlistprint', [onecardController::class, "creditlistprint"])->name("creditlistprint");
    Route::get('/creditdownload/{date}', [onecardController::class, "creditdownload"])->name("creditdownload");


    // Acquiring ONUS
    Route::get('/onus', [onecardController::class, "onushome"])->name("onushome");
    Route::post('/onusprint', [onecardController::class, "onusprint"])->name("onusprint");
    Route::get('/onusdownload/{startdate}/{enddate}', [onecardController::class, "onusdownload"])->name("onusdownload");


    // PSSD_01
    Route::get('/pssd01', [CBMController::class, "pssd01home"])->name("pssd01home");
    Route::post('/pssd01print', [CBMController::class, "pssd01print"])->name("pssd01print");
    Route::get('/pssd01download/{date}', [CBMController::class, "pssd01download"])->name("pssd01download");

    // PSSD_02
    Route::get('/pssd02input', [CBMController::class, "pssd02input"])->name("pssd02input");
    Route::post('/fileinsert', [CBMController::class, "fileinsert"])->name("fileinsert");
    Route::get('/pssd02', [CBMController::class, "pssd02home"])->name("pssd02home");
    Route::post('/pssd02print', [CBMController::class, "pssd02print"])->name("pssd02print");
    Route::get('/pssd02download/{date}', [CBMController::class, "pssd02download"])->name("pssd02download");


    // PSSD_04
    Route::get('/pssd04', [CBMController::class, "pssd04home"])->name("pssd04home");
    Route::post('/pssd04print', [CBMController::class, "pssd04print"])->name("pssd04print");
    Route::get('/pssd04download/{date}', [CBMController::class, "pssd04download"])->name("pssd04download");

    Route::get('/AnnualFee', [onecardController::class, "annualfeehome"])->name("annualfeehome");
    Route::post('/AnnualFeePrint', [onecardController::class, "AnnualFeePrint"])->name("AnnualFeePrint");
    Route::get('/AnnualFeedownload/{month1}/{date2}/{date1}', [onecardController::class, "AnnualFeedownload"])->name("AnnualFeedownload");

    Route::get('/export', [onecardController::class, "export"])->name("export");

    //Merchant
    Route::get('/import', [ExcelImportController::class, "import"])->name("import");
    Route::get('/delete', [ExcelImportController::class, "delete"])->name("delete");
    Route::post('/import', [ExcelImportController::class, "importfile"])->name("importfile");


    // User Control
    Route::get('/usercontol', [AdminController::class, "home"])->name("userhome");
    Route::get('/edituser/{id}', [AdminController::class, "edituser"])->name("edituser");
    Route::post('/editUpdateUser/{id}', [AdminController::class, "editUpdateUser"])->name("editUpdateUser");
    Route::get('/deleteUser/{id}', [AdminController::class, "deleteUser"])->name("deleteUser");
});

// Admin
Route::middleware('admin')->group(function () {
    Route::get('/edituser/{id}', [AdminController::class, "edituser"])->name("edituser");
    Route::post('/editUpdateUser/{id}', [AdminController::class, "editUpdateUser"])->name("editUpdateUser");
    Route::get('/deleteUser/{id}', [AdminController::class, "deleteUser"])->name("deleteUser");
});
