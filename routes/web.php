<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PdfExcelController;
use App\Http\Controllers\SoumissionController;
use Illuminate\Support\Facades\Route;


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



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () { });

Route::get('/{numero}', 'MainController@page');
Route::get("/", 'MainController@index')->name('home')->middleware('auth');;
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//role
Route::post('/role', 'RoleController@save');
Route::post('/role/import', 'RoleController@import');
Route::delete('/role/{id}', 'RoleController@delete');

//role
Route::post('/axe', 'AxeController@save');
Route::post('/axe/import', 'AxeController@import');
Route::delete('/axe/{id}', 'AxeController@delete');





//modepaiement
Route::post('/modepaiement', 'ModepaiementController@save');
Route::post('/modepaiement/import', 'ModepaiementController@import');
Route::delete('/modepaiement/{id}', 'ModepaiementController@delete');

//modepaiement
Route::post('/fournisseur', 'FournisseurController@save');
Route::post('/fournisseur/import', 'FournisseurController@import');
Route::delete('/fournisseur/{id}', 'FournisseurController@delete');

// user 
Route::post('/user', 'UserController@inscription');
Route::post('/user-connect', 'UserController@user_permission');
Route::post('/user/import', 'UserController@import');
Route::delete('/user/{id}', 'UserController@delete');

Route::post('/bcentete_Sage', 'SoumissionController@bcentete_Sage');



//typeclient
Route::post('/typeclient', 'TypeclientController@save');
Route::post('/typeclient/import', 'TypeclientController@import');
Route::delete('/typeclient/{id}', 'TypeclientController@delete');

//categorieclient
Route::post('/categorieclient', 'CategorieclientController@save');
Route::post('/categorieclient/import', 'CategorieclientController@import');
Route::delete('/categorieclient/{id}', 'CategorieclientController@delete');


//categorieclient
Route::post('/typelivraison', 'TypelivraisonController@save');
Route::post('/typelivraison/import', 'TypelivraisonController@import');
Route::delete('/typelivraison/{id}', 'TypelivraisonController@delete');



Route::post('/typefournisseur', 'TypefournisseurController@save');
Route::post('/typefournisseur/import', 'TypefournisseurController@import');
Route::delete('/typefournisseur/{id}', 'TypefournisseurController@delete');


//categorieclient
Route::post('/article', 'ArticleController@save');
Route::post('/article/import', 'ArticleController@import');
Route::delete('/article/{id}', 'ArticleController@delete');
Route::post('/article/status', 'ArticleController@status');

// prequalification
Route::post('/prequalification', 'PrequalificationController@save');
Route::post('/prequalification/import', 'PrequalificationController@import');
Route::delete('/prequalification/{id}', 'PrequalificationController@delete');
Route::post('/prequalification/status', 'PrequalificationController@status');

// statutamm
Route::post('/statutamm', 'StatutammController@save');
Route::post('/statutamm/import', 'StatutammController@import');
Route::delete('/statutamm/{id}', 'StatutammController@delete');
Route::post('/statutamm/status', 'StatutammController@status');


// remisedureedevie
Route::post('/remisedureedevie', 'RemisedureedevieController@save');
Route::post('/remisedureedevie/import', 'RemisedureedevieController@import');
Route::delete('/remisedureedevie/{id}', 'RemisedureedevieController@delete');
Route::post('/remisedureedevie/status', 'RemisedureedevieController@status');

//bailleur
Route::post('/bailleur', 'BailleurController@save');
Route::post('/bailleur/import', 'BailleurController@import');
Route::delete('/bailleur/{id}', 'BailleurController@delete');
Route::post('/bailleur/status', 'BailleurController@status');


//categorieclient
Route::post('/phasedepot', 'PhasedepotController@save');
Route::post('/phasedepot/import', 'PhasedepotController@import');
Route::delete('/phasedepot/{id}', 'PhasedepotController@delete');


Route::post('/da/status', 'DaController@statut');
Route::post('/da/soumission_upload', 'DaController@uploaddocument');
Route::post('/da/event', 'DaController@daEvent');
Route::delete('/da/documentspecification/{id}', 'DaController@deleteDadocumentspecification');


Route::post('/ao/status', 'AoController@status');
Route::get('/ao/publicationao', 'AoController@publicationao');
Route::get('/ao/getEtatTargetPriceAo', 'AoController@getEtatTargetPriceAo');
Route::get('/ao/clotureao', 'AoController@clotureao');
Route::get('/ao/ouvertureoffreao', 'AoController@ouvertureoffreao');
Route::get('/ao/createsoumission', 'AoController@soumission')->name('createsoumission');


Route::post('/soumission/status', 'SoumissionController@status');
Route::post('/soumission_upload', 'SoumissionController@uploaddocument');

Route::post('/soumissionarticle/status', 'SoumissionarticleController@status');
Route::post('/save_technical_evaluation', [SoumissionController::class, 'save_technical_evaluation']);



// documentspecification
Route::post('/documentspecification', 'DocumentspecificationController@save');
Route::post('/documentspecification/import', 'DocumentspecificationController@import');
Route::delete('/documentspecification/{id}', 'DocumentspecificationController@delete');


// client routes 
Route::post('/client', 'ClientController@save');
Route::post('/client/import', 'ClientController@import');
Route::delete('/client/{id}', 'ClientController@delete');
//client commercial excl
Route::get('/excels.statutamm/{filters}', 'PdfExcelController@generate_excel_statutamm')->name('generate_excel_statutamm');
Route::get('/excels.prequalification/{filters}', 'PdfExcelController@generate_excel_prequalification')->name('generate_excel_prequalification');

Route::get('/pdf.qrcode-oeuvre/{filters}', 'PdfExcelController@generate_pdf_qrcode_oeuvre');


// client pointdevente 
Route::post('/pointdevente', 'PointdeventeController@save');
Route::post('/pointdevente/import', 'PointdeventeController@import');
Route::post('/pointdevente/statut', 'PointdeventeController@statut');

Route::delete('/pointdevente/{id}', 'PointdeventeController@delete');
Route::post('/localisationpointvente', 'PointdeventeController@localisationpointvente');

// evaluationsfournisseur
Route::post('/evaluationsfournisseur', 'EvaluationsfournisseurController@save');
Route::post('/evaluationsfournisseur/import', 'EvaluationsfournisseurController@import');
Route::delete('/evaluationsfournisseur/{id}', 'EvaluationsfournisseurController@delete');
Route::post('/evaluationsfournisseur/status', 'EvaluationsfournisseurController@status');


// mesure
Route::post('/mesure', 'MesureController@save');
Route::post('/mesure/import', 'MesureController@import');
Route::delete('/mesure/{id}', 'MesureController@delete');


// mesure
Route::post('/tonnage', 'TonnageController@save');
Route::post('/tonnage/import', 'TonnageController@import');
Route::delete('/tonnage/{id}', 'TonnageController@delete');

// chauffeur
Route::post('/chauffeur', 'ChauffeurController@save');
Route::post('/chauffeur/import', 'ChauffeurController@import');
Route::delete('/chauffeur/{id}', 'ChauffeurController@delete');

// critere
Route::post('/critere', 'CritereController@save');
Route::post('/critere/import', 'CritereController@import');
Route::delete('/critere/{id}', 'CritereController@delete');

// ficheevaluation
Route::post('/ficheevaluation', 'FicheevaluationController@save');
Route::post('/ficheevaluation/import', 'FicheevaluationController@import');
Route::delete('/ficheevaluation/{id}', 'FicheevaluationController@delete');



// zone route
Route::post('/zone', 'ZoneController@save');
Route::post('/zone/import', 'ZoneController@import');
Route::delete('/zone/{id}', 'ZoneController@delete');



// planning route
Route::post('/planning', 'PlanningController@save');
Route::post('/planning/import', 'PlanningController@import');
Route::delete('/planning/{id}', 'PlanningController@delete');


// planning route
Route::post('/visite', 'VisiteController@save');
Route::post('/detaillivraison', 'VisiteController@upddateDetailLivraison');
// detailmateriel
Route::post('/detailmateriel', 'VisiteController@saveDetailMateriel');
Route::post('/visite/status', 'VisiteController@status');
Route::post('/visite/statut', 'VisiteController@statut');
Route::post('/vistee/import', 'VisiteController@import');
Route::delete('/visite/{id}', 'VisiteController@delete');
Route::get('/pdf.generate-pdf-caisse/{filters}', 'PdfExcelController@generate_pdf_caisse')->name('pdfcaisse');
Route::get('/pdf.generate-pdf-ventecaisse/{filters}', 'PdfExcelController@generate_pdf_ventecaisse')->name('pdfventecaisse');


Route::get('/generate-pdf-os', 'PdfExcelController@generate_pdf_os');


Route::delete('/detailmateriel/{id}', 'VisiteController@delete');
Route::delete('/detaillivraison/{id}', 'VisiteController@delete');




// demande  route
Route::delete('/demande/{id}', 'DemandeController@delete');



// PRODUIT route
Route::post('/produit', 'ProduitController@save');
Route::post('/produit/import', 'ProduitController@import');
Route::delete('/produit/{id}', 'ProduitController@delete');


// ENTENNE route
Route::post('/antenne', 'AntenneController@save');
Route::post('/antenne/import', 'AntenneController@import');
Route::delete('/antenne/{id}', 'AntenneController@delete');



// EQUIPEMENT route
Route::post('/equipement', 'EquipementController@save');
Route::post('/equipement/import', 'EquipementController@import');
Route::delete('/equipement/{id}', 'EquipementController@delete');


// EQUIPEMENT route
Route::post('/equipegestion', 'EquipegestionController@save');
Route::post('/equipegestion/import', 'EquipegestionController@import');
Route::delete('/equipegestion/{id}', 'EquipegestionController@delete');

Route::post('/equipegestionclient', 'EquipegestionclientController@save');
Route::post('/equipegestionclient/import', 'EquipegestionclientController@import');
Route::delete('/equipegestionclient/{id}', 'EquipegestionclientController@delete');

// VOITURE route
Route::post('/voiture', 'VoitureController@save');
Route::post('/voiture/import', 'VoitureController@import');
Route::delete('/voiture/{id}', 'VoitureController@delete');



// VOITURE route
Route::post('/commande', 'CommandeController@save');
Route::post('/commande/import', 'CommandeController@import');
Route::delete('/commande/{id}', 'CommandeController@delete');
Route::post('/commande/status', 'CommandeController@status');



// programme route
Route::post('/programme', 'ProgrammeController@save');
Route::post('/programme/import', 'ProgrammeController@import');
Route::delete('/programme/{id}', 'ProgrammeController@delete');
Route::post('/lignecommande', 'LignecommandeController@save');


// programme route
Route::post('/campagne', 'CampagneController@save');
Route::post('/campagne/import', 'CampagneController@import');
Route::delete('/campagne/{id}', 'CampagneController@delete');

// categorie route
Route::post('/unite', 'UniteController@save');
Route::post('/unite/import', 'UniteController@import');
Route::delete('/unite/{id}', 'UniteController@delete');

// categorie route
Route::post('/categorie', 'CategorieController@save');
Route::post('/categorie/import', 'CategorieController@import');
Route::delete('/categorie/{id}', 'CategorieController@delete');

// parking
Route::post('/parking', 'ParkingController@save');
Route::post('/parking/import', 'ParkingController@import');
Route::delete('/parking/{id}', 'ParkingController@delete');

// categorie route
Route::post('/categoriepointdevente', 'CategoriepointdeventeController@save');
Route::post('/categoriepointdevente/import', 'CategoriepointdeventeController@import');
Route::delete('/categoriepointdevente/{id}', 'CategoriepointdeventeController@delete');

// categorie route
Route::post('/typepointdevente', 'TypepointdeventeController@save');
Route::post('/typepointdevente/import', 'TypepointdeventeController@import');
Route::delete('/typepointdevente/{id}', 'TypepointdeventeController@delete');


// categorie route
Route::post('/typemarche', 'TypemarcheController@save');
Route::post('/typemarche/import', 'TypemarcheController@import');
Route::delete('/typemarche/{id}', 'TypemarcheController@delete');


// categorie route
Route::post('/typevehicule', 'TypevehiculeController@save');
Route::post('/typevehicule/import', 'TypevehiculeController@import');
Route::delete('/typevehicule/{id}', 'TypevehiculeController@delete');

// vehicule route
Route::post('/vehicule', 'VehiculeController@save');
Route::post('/vehicule/import', 'VehiculeController@import');
Route::delete('/vehicule/{id}', 'VehiculeController@delete');

// CategorietarifaireController route
Route::post('/categorietarifaire', 'CategorietarifaireController@save');
Route::post('/categorietarifaire/import', 'CategorietarifaireController@import');
Route::delete('/categorietarifaire/{id}', 'CategorietarifaireController@delete');



// PREFERENCE route
Route::post('/preference', 'PreferenceController@save');
Route::post('/preference/import', 'PreferenceController@import');
Route::delete('/preference/{id}', 'PreferenceController@delete');



Route::get('/affectZone', 'ClientController@affectZone')->name('affectZone');
Route::get('/pdf.generate-pdf-codeqr/{filters}', 'PdfExcelController@generate_pdf_qrcode')->name('pdfqrcode');

Route::get('/pdf.generate-pdf-os/{filters}', 'PdfExcelController@generate_pdf_os')->name('os');

Route::post("/user/connexion", 'UserController@login');
Route::post('/user/savetoken', 'UserController@saveToken');



Route::get('/excels.generate-excel-modele1/{data}', [PdfExcelController::class, 'generate_excel_modele1'])
    ->name('generate.excel.modele1');

Route::get('/excels.generate-excel-modele2/{data}', [PdfExcelController::class, 'generate_excel_modele2'])
    ->name('generate.excel.modele2');

Route::get('/excels.generate-excel-modele3/{data}', [PdfExcelController::class, 'generate_excel_modele3'])
    ->name('generate.excel.modele3');
