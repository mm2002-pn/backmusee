<?php

use App\Models\Outil;
use Illuminate\Http\Request;
use App\Models\CommentairePoste;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PdfExcelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\TypecontratController;
use App\Http\Controllers\TypedemandeController;
use App\Http\Controllers\TyperapportController;
use App\Http\Controllers\CommentairePosteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\ValidationDemandeController;
use App\Http\Controllers\SelectionCandidatureController;
use Illuminate\Support\Facades\Auth;

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

// === security API routes start ===
// Route::post("user", [UserController::class,'inscription']);

// Route::get('generate-excel-user' , [PdfExcelController::class, 'generate_excel_user']);
// Route::get('generate-excel-user/{filters}' , [PdfExcelController::class, 'generate_excel_user']);
//Route::get("/roleliste", [RoleController::class, 'roleListe']);


// === security API routes end ===


// === Public routes ===
Route::post('/login', [ClientController::class, 'login']);
Route::post('/register', [ClientController::class, 'register']); // Optionnel

// === Protected routes ===
Route::middleware(['auth:sanctum'])->group(function () {
    // Profile utilisateur
    Route::get('/profile', [ClientController::class, 'profile']);

    // Déconnexion
    Route::post('/logout', [ClientController::class, 'logout']);

    // Mettre à jour le profil (optionnel)
    Route::put('/profile', [ClientController::class, 'updateProfile']);

    // Commande
    Route::post('/commande', 'CommandeController@save');
});
Route::post('/soumission', 'SoumissionController@save');




Route::get('/upload-to-ftp/{filters}', [FileUploadController::class, 'uploadFileToFtp']);


Route::post('/deleteAll', 'PointdeventeController@deletePointdevente');
Route::get('/deleteAll', 'PointdeventeController@deletePointdevente');

Route::get('/activepdv', 'PointdeventeController@etatPoint');

// clientPdv

Route::get('/clientPdv', 'ClientController@clientPdv');


Route::get('/unitesage', 'UniteController@unitesage');
Route::get('/provincesage', 'ProvinceController@provincesage');
Route::get('/listArtileSage', 'ArticleController@listArtileSage');
Route::get('/da_ente_Sage', 'ArticleController@da_ente_Sage');
Route::get('/da_details_Sage', 'ArticleController@da_details_Sage');
Route::get('/fournisseur_Sage', 'ArticleController@fournisseur_Sage');
Route::get('/pays_Sage', 'ArticleController@pays_Sage');
Route::get('/fabricant_Sage', 'ArticleController@fabricant_Sage');
Route::post('/bcentete_Sage', 'SoumissionController@bcentete_Sage');
Route::get('/axesage', 'ProvinceController@axesage');
Route::get('/client_Sage', 'ClientController@client_Sage');
Route::get('/usersage', 'UserController@usersage');
//deletpdv

Route::get('/copieDa', 'DaController@copieDa');


Route::get('dtpdv', 'TypepointdeventeController@deletetpdv');


// affectCpdv
Route::get('affectcpdv', 'PointdeventeController@affectcpdv');

Route::get('instagram', 'InstagramController@index');

Route::post('/run-python', [PythonController::class, 'runPythonScript']);
Route::post('send-mail', [MailController::class, 'sendmail']);
