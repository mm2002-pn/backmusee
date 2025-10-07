@extends('layout.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


<body ng-cloak ng-controller="ContentController" style="overflow: hidden">
    <input type="hidden" id="userLogged" value="{{ Auth::user() }}">

    <input type="hidden" id="userLogged_id" value="{{ Auth::user()->id }}">
    <div class="wrapper">
        @include('includes.sidebar')
        <div class="clearfix"></div>
        <div class="main-panel">
            @include('includes.topbar')
            <div class="container">
                <div class="page-inner" ng-view>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/index2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    @include('includes.foot')
</body>





<!-- LES MODALS -->
<!-- MODAL IMPORTER USER -->
<div class="modal fade importeruser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter plusieurs utilisateurs</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><strong>Importer un(des) fichier(s)</strong></label>
                        <div class="custom-file">
                            <input type="file" name="files[]" multiple class="custom-file-input form-control" id="customFile">
                            <label class="custom-file-label" for="customFile">Choisir</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button style="color:white;background-color: var(--sedima_jaune_sombre);" type="button" class="btn btn-dark">Sauvegarder</button>
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL AJOUT PRODUIT -->
<div id="modal_addproduit" class="modal fade addproduits" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addproduit" accept-charset="UTF-8" ng-submit="addElement($event,'produit')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_produit" name="id">

                    <div class="form-row">
                        <!-- NOM -->
                        <div class="form-group col-md-12">
                            <label for="nom_produit">Nom du produit</label>
                            <input type="text" class="form-control" id="nom_produit" name="nom" placeholder="Ex: Livre Art Royal Africain">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_produit">Description</label>
                            <textarea class="form-control" id="description_produit" name="description" rows="3" placeholder="Description du produit"></textarea>
                        </div>

                        <!-- PRIX -->
                        <div class="form-group col-md-6">
                            <label for="prix_produit">Prix (FCFA)</label>
                            <input type="number" class="form-control" id="prix_produit" name="prix" value="0" min="0">
                        </div>

                        <!-- CATÉGORIE -->
                        <div class="form-group col-md-6">
                            <label for="categorie_id_produit">Catégorie</label>
                            <select class="form-control" id="categorie_id_produit" name="categorie_id">
                                <option value="1">Livres</option>
                                <option value="2">Répliques</option>
                                <option value="3">Impressions</option>
                                <option value="4">Bijoux</option>
                                <option value="5">Vêtements</option>
                                <option value="6">Accessoires</option>
                            </select>
                        </div>

                        <!-- TYPE DE PRODUIT -->
                        <div class="form-group col-md-6">
                            <label for="type_produit">Type de produit</label>
                            <select class="form-control" id="type_produit" name="type_produit">
                                <option value="livre">Livre</option>
                                <option value="replique">Réplique</option>
                                <option value="impression">Impression</option>
                                <option value="bijou">Bijou</option>
                                <option value="vetement">Vêtement</option>
                                <option value="accessoire">Accessoire</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <!-- STOCK -->
                        <div class="form-group col-md-6">
                            <label for="stock_produit">Stock disponible</label>
                            <input type="number" class="form-control" id="stock_produit" name="stock" value="10" min="0">
                        </div>

                        <!-- IMAGE -->
                        <div class="form-group col-md-6">
                            <label for="image_url_produit">Image URL</label>
                            <input type="text" class="form-control" id="image_url_produit" name="image_url" placeholder="/images/boutique/produit.jpg">
                        </div>

                        <!-- ŒUVRE ASSOCIÉE -->
                        <div class="form-group col-md-6">
                            <label for="oeuvre_associee_produit">Œuvre associée</label>
                            <select class="form-control" id="oeuvre_associee_produit" name="oeuvre_associee">
                                <option value="">Aucune œuvre associée</option>
                                <option ng-repeat="oeuvre in dataPage['oeuvres']" value="@{{ oeuvre.id }}">@{{ oeuvre.designation }}</option>
                            </select>
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_produit">Statut</label>
                            <select class="form-control" id="statut_produit" name="statut">
                                <option value="disponible">Disponible</option>
                                <option value="rupture">Rupture de stock</option>
                                <option value="bientot">Bientôt disponible</option>
                                <option value="archive">Archivé</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL IMPORTER USER -->
<div id="modal_addlist" class="modal fade importerclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">@{{ currentTitleModal }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form id="form_addliste" method="post" ng-submit="addElement($event, currentTypeModal, {is_file_excel:true})" enctype="multipart/form-data" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

                        <div class="col-span-12 sm:col-span-12">
                            <label for="file_importexcelclient">Fichier</label>
                            <input type="file" accept=".csv, .xls, .xlsx" class="form-control filestyle required" data-buttonName="btn-shadow btn-transition btn-outline-danger p-2" data-buttonText="Choisir un fichier" data-placeholder="Aucun fichier choisi" data-iconName="fa fa-folder-open" id="file_liste" name="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style="color:white;background-color: var(--sedima_jaune_sombre);" type="submit" class="btn bg-dark">Sauvegarder</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL AJOUT USER -->
<div id="modal_adduser" class="modal fade addusers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body ">
                <form id="form_adduser" accept-charset="UTF-8" ng-submit="addElement($event,'user')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_user" name="id">

                    <!-- Informations générales titre -->
                    <div class="mt-2">
                        <h5 class="text-dark">Informations générales</h5>
                        <br>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="name_user">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="name_user" name="name" placeholder="Votre nom d'utilisateur">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role_user">Profil</label>
                            <div>
                                <select id="role_user" name="role" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['roles']" value="@{{ item.id }}">
                                        @{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role_user">Fournisseur</label>
                            <div>
                                <select id="fournisseur_user" name="fournisseur" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['fournisseurs']" value="@{{ item.id }}">
                                        @{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zone_user">Zone</label>
                            <div>
                                <select id="zone_user" name="zones[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telephone_user">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="telephone_user" name="telephone" placeholder="Votre telephone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_user">Ref X3</label>
                            <input type="text" class="form-control" id="code_user" name="code" placeholder="Votre code">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="compteclient_user">Code CD</label>
                            <input type="text" class="form-control" id="compteclient_user" name="compteclient" placeholder="Votre compteclient">
                        </div>
                    </div>
                    <div class="mt-4 mb-2">
                        <h5 class="text-dark">Compte</h5>
                        <br>
                    </div>
                    <!-- Compte -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email_user">Email</label>
                            <input type="email" class="form-control" id="email_user" name="email" placeholder="Votre adresse mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="login_user">Login</label>
                            <input type="login" class="form-control" id="login_user" name="login" placeholder="Votre adresse login">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password_user">Mot de passe</label>
                            <input type="password" class="form-control" id="password_user" name="password" placeholder="Votre mot de passe">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmpassword_user">Confirmer Mot de passe</label>
                            <input type="password" class="form-control" id="confirmpassword_user" name="password_confirmation" placeholder="Votre mot de passe">
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_user">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_user" aria-describedby="inputGroupFileAddon">

                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT EXPOSITION -->
<div id="modal_addexposition" class="modal fade addexpositions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter une exposition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addexposition" accept-charset="UTF-8" ng-submit="addElement($event,'exposition')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_exposition" name="id">

                    <div class="form-row">
                        <!-- TITRE -->
                        <div class="form-group col-md-12">
                            <label for="titre_exposition">Titre de l'exposition</label>
                            <input type="text" class="form-control" id="titre_exposition" name="titre" placeholder="Ex: L'Afrique : Berceau de l'Humanité">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_exposition">Description</label>
                            <textarea class="form-control" id="description_exposition" name="description" rows="3" placeholder="Description de l'exposition"></textarea>
                        </div>

                        <!-- DATES -->
                        <div class="form-group col-md-6">
                            <label for="date_debut_exposition">Date de début</label>
                            <input type="date" class="form-control" id="date_debut_exposition" name="date_debut">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_fin_exposition">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin_exposition" name="date_fin">
                        </div>

                        <!-- COLLECTION -->
                        <div class="form-group col-md-6">
                            <label for="collection_id_exposition">Collection associée</label>
                            <select class="form-control" id="collection_id_exposition" name="collection_id">
                                <option value="1">Origines Humaines</option>
                                <option value="2">Sciences et Technologies</option>
                                <option value="3">Art Royal</option>
                                <option value="4">Art Contemporain</option>
                            </select>
                        </div>

                        <!-- SALLE -->
                        <div class="form-group col-md-6">
                            <label for="salle_exposition">Salle</label>
                            <input type="text" class="form-control" id="salle_exposition" name="salle" placeholder="Ex: Salle 1 - Origines">
                        </div>

                        <!-- COMMISSAIRE -->
                        <div class="form-group col-md-6">
                            <label for="commissaire_exposition">Commissaire</label>
                            <input type="text" class="form-control" id="commissaire_exposition" name="commissaire" placeholder="Nom du commissaire">
                        </div>

                        <!-- IMAGE -->
                        <div class="form-group col-md-6">
                            <label for="image_url_exposition">Image URL</label>
                            <input type="text" class="form-control" id="image_url_exposition" name="image_url" placeholder="/images/expositions/exposition.jpg">
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_exposition">Statut</label>
                            <select class="form-control" id="statut_exposition" name="statut">
                                <option value="active">Active</option>
                                <option value="a_venir">À venir</option>
                                <option value="terminee">Terminée</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT ATELIER -->
<div id="modal_addatelier" class="modal fade addateliers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un atelier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addatelier" accept-charset="UTF-8" ng-submit="addElement($event,'atelier')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_atelier" name="id">
                    <input type="hidden" id="createur_id_atelier" name="createur_id" value="{{ Auth::user()->id }}">

                    <div class="form-row">
                        <!-- TITRE -->
                        <div class="form-group col-md-12">
                            <label for="titre_atelier">Titre de l'atelier</label>
                            <input type="text" class="form-control" id="titre_atelier" name="titre" placeholder="Ex: Initiation à la Sculpture sur Bois">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_atelier">Description</label>
                            <textarea class="form-control" id="description_atelier" name="description" rows="3" placeholder="Description de l'atelier"></textarea>
                        </div>

                        <!-- ANIMATEUR -->
                        <div class="form-group col-md-6">
                            <label for="animateur_atelier">Animateur</label>
                            <input type="text" class="form-control" id="animateur_atelier" name="animateur" placeholder="Nom de l'animateur">
                        </div>

                        <!-- DATE ET HEURE -->
                        <div class="form-group col-md-6">
                            <label for="date_atelier">Date et heure</label>
                            <input type="datetime-local" class="form-control" id="date_atelier" name="date_atelier">
                        </div>

                        <!-- DURÉE -->
                        <div class="form-group col-md-4">
                            <label for="duree_atelier">Durée</label>
                            <input type="text" class="form-control" id="duree_atelier" name="duree" placeholder="Ex: 3 heures">
                        </div>

                        <!-- PRIX -->
                        <div class="form-group col-md-4">
                            <label for="prix_atelier">Prix (FCFA)</label>
                            <input type="number" class="form-control" id="prix_atelier" name="prix" value="0" min="0">
                        </div>

                        <!-- PLACES MAX -->
                        <div class="form-group col-md-4">
                            <label for="places_max_atelier">Places maximum</label>
                            <input type="number" class="form-control" id="places_max_atelier" name="places_max" value="10" min="1">
                        </div>

                        <!-- NIVEAU -->
                        <div class="form-group col-md-6">
                            <label for="niveau_atelier">Niveau</label>
                            <select class="form-control" id="niveau_atelier" name="niveau">
                                <option value="debutant">Débutant</option>
                                <option value="intermediaire">Intermédiaire</option>
                                <option value="avance">Avancé</option>
                                <option value="tous_niveaux">Tous niveaux</option>
                            </select>
                        </div>

                        <!-- MATÉRIEL FOURNI -->
                        <div class="form-group col-md-6">
                            <label for="materiel_fourni_atelier">Matériel fourni</label>
                            <textarea class="form-control" id="materiel_fourni_atelier" name="materiel_fourni" rows="2" placeholder="Liste du matériel fourni"></textarea>
                        </div>

                        <!-- ŒUVRES ASSOCIÉES -->
                        <div class="form-group col-md-6">
                            <label for="oeuvres_ids_atelier">Œuvres étudiées</label>
                            <select class="form-control" id="oeuvres_ids_atelier" name="oeuvres_ids[]" multiple>
                                <option ng-repeat="oeuvre in dataPage['oeuvres']" value="@{{ oeuvre.id }}">@{{ oeuvre.designation }}</option>
                            </select>
                        </div>

                        <!-- QUIZ ASSOCIÉ -->
                        <div class="form-group col-md-6">
                            <label for="quiz_id_atelier">Quiz d'évaluation</label>
                            <select class="form-control" id="quiz_id_atelier" name="quiz_id">
                                <option value="">Aucun quiz</option>
                                <option ng-repeat="quiz in dataPage['quizs']" value="@{{ quiz.id }}">@{{ quiz.titre }}</option>
                            </select>
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_atelier">Statut</label>
                            <select class="form-control" id="statut_atelier" name="statut">
                                <option value="actif">Actif</option>
                                <option value="a_venir">À venir</option>
                                <option value="termine">Terminé</option>
                                <option value="annule">Annulé</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT QUIZ -->
<div id="modal_addquiz" class="modal fade addquizs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addquiz" accept-charset="UTF-8" ng-submit="addElement($event,'quiz')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_quiz" name="id">

                    <div class="form-row">
                        <!-- TITRE -->
                        <div class="form-group col-md-12">
                            <label for="titre_quiz">Titre du quiz</label>
                            <input type="text" class="form-control" id="titre_quiz" name="titre" placeholder="Ex: Quiz Art Royal Africain">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_quiz">Description</label>
                            <textarea class="form-control" id="description_quiz" name="description" rows="2" placeholder="Description du quiz"></textarea>
                        </div>

                        <!-- PARAMÈTRES -->
                        <div class="form-group col-md-4">
                            <label for="duree_limite_quiz">Durée limite (minutes)</label>
                            <input type="number" class="form-control" id="duree_limite_quiz" name="duree_limite" value="15" min="1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="score_max_quiz">Score maximum</label>
                            <input type="number" class="form-control" id="score_max_quiz" name="score_max" value="20" min="1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="difficulte_quiz">Difficulté</label>
                            <select class="form-control" id="difficulte_quiz" name="difficulte">
                                <option value="facile">Facile</option>
                                <option value="moyen">Moyen</option>
                                <option value="difficile">Difficile</option>
                            </select>
                        </div>

                        <!-- QUESTION 1 -->
                        <div class="col-md-12 mt-4">
                            <h6>Question 1</h6>
                            <div class="form-row border p-3 mb-3">
                                <div class="form-group col-md-12">
                                    <label for="question1_quiz">Question</label>
                                    <input type="text" class="form-control" id="question1_quiz" name="question1" placeholder="Entrez la question">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="type1_quiz">Type de question</label>
                                    <select class="form-control" id="type1_quiz" name="type1">
                                        <option value="choix_multiple">Choix multiple</option>
                                        <option value="vrai_faux">Vrai/Faux</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="points1_quiz">Points</label>
                                    <input type="number" class="form-control" id="points1_quiz" name="points1" value="5" min="1">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="bonne_reponse1_quiz">Bonne réponse</label>
                                    <input type="number" class="form-control" id="bonne_reponse1_quiz" name="bonne_reponse1" value="0" min="0" max="3">
                                </div>

                                <!-- RÉPONSES -->
                                <div class="form-group col-md-6">
                                    <label for="reponse1_1_quiz">Réponse 1</label>
                                    <input type="text" class="form-control" id="reponse1_1_quiz" name="reponse1_1" placeholder="Première réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse1_2_quiz">Réponse 2</label>
                                    <input type="text" class="form-control" id="reponse1_2_quiz" name="reponse1_2" placeholder="Deuxième réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse1_3_quiz">Réponse 3</label>
                                    <input type="text" class="form-control" id="reponse1_3_quiz" name="reponse1_3" placeholder="Troisième réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse1_4_quiz">Réponse 4</label>
                                    <input type="text" class="form-control" id="reponse1_4_quiz" name="reponse1_4" placeholder="Quatrième réponse">
                                </div>

                                <!-- EXPLICATION -->
                                <div class="form-group col-md-12">
                                    <label for="explication1_quiz">Explication (optionnel)</label>
                                    <textarea class="form-control" id="explication1_quiz" name="explication1" rows="2" placeholder="Explication de la réponse"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- QUESTION 2 -->
                        <div class="col-md-12 mt-3">
                            <h6>Question 2</h6>
                            <div class="form-row border p-3 mb-3">
                                <div class="form-group col-md-12">
                                    <label for="question2_quiz">Question</label>
                                    <input type="text" class="form-control" id="question2_quiz" name="question2" placeholder="Entrez la question">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="type2_quiz">Type de question</label>
                                    <select class="form-control" id="type2_quiz" name="type2">
                                        <option value="choix_multiple">Choix multiple</option>
                                        <option value="vrai_faux">Vrai/Faux</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="points2_quiz">Points</label>
                                    <input type="number" class="form-control" id="points2_quiz" name="points2" value="5" min="1">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="bonne_reponse2_quiz">Bonne réponse</label>
                                    <input type="number" class="form-control" id="bonne_reponse2_quiz" name="bonne_reponse2" value="0" min="0" max="3">
                                </div>

                                <!-- RÉPONSES -->
                                <div class="form-group col-md-6">
                                    <label for="reponse2_1_quiz">Réponse 1</label>
                                    <input type="text" class="form-control" id="reponse2_1_quiz" name="reponse2_1" placeholder="Première réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse2_2_quiz">Réponse 2</label>
                                    <input type="text" class="form-control" id="reponse2_2_quiz" name="reponse2_2" placeholder="Deuxième réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse2_3_quiz">Réponse 3</label>
                                    <input type="text" class="form-control" id="reponse2_3_quiz" name="reponse2_3" placeholder="Troisième réponse">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reponse2_4_quiz">Réponse 4</label>
                                    <input type="text" class="form-control" id="reponse2_4_quiz" name="reponse2_4" placeholder="Quatrième réponse">
                                </div>

                                <!-- EXPLICATION -->
                                <div class="form-group col-md-12">
                                    <label for="explication2_quiz">Explication (optionnel)</label>
                                    <textarea class="form-control" id="explication2_quiz" name="explication2" rows="2" placeholder="Explication de la réponse"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT ACTIVITÉ -->
<div id="modal_addactivite" class="modal fade addactivites" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter une activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addactivite" accept-charset="UTF-8" ng-submit="addElement($event,'activite')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_activite" name="id">

                    <div class="form-row">
                        <!-- TITRE -->
                        <div class="form-group col-md-12">
                            <label for="titre_activite">Titre de l'activité</label>
                            <input type="text" class="form-control" id="titre_activite" name="titre" placeholder="Ex: Atelier de Poterie Traditionnelle">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_activite">Description</label>
                            <textarea class="form-control" id="description_activite" name="description" rows="3" placeholder="Description de l'activité"></textarea>
                        </div>

                        <!-- TYPE D'ACTIVITÉ -->
                        <div class="form-group col-md-6">
                            <label for="type_activite">Type d'activité</label>
                            <select class="form-control" id="type_activite" name="type_activite">
                                <option value="atelier">Atelier</option>
                                <option value="visite_guidee">Visite guidée</option>
                                <option value="atelier_enfant">Atelier enfant</option>
                                <option value="spectacle">Spectacle</option>
                                <option value="conference">Conférence</option>
                                <option value="demonstration">Démonstration</option>
                            </select>
                        </div>

                        <!-- DURÉE -->
                        <div class="form-group col-md-6">
                            <label for="duree_activite">Durée</label>
                            <input type="text" class="form-control" id="duree_activite" name="duree" placeholder="Ex: 2 heures, 1 heure 30">
                        </div>

                        <!-- PUBLIC CIBLE -->
                        <div class="form-group col-md-6">
                            <label for="public_cible_activite">Public cible</label>
                            <select class="form-control" id="public_cible_activite" name="public_cible">
                                <option value="tous_publics">Tous publics</option>
                                <option value="adultes">Adultes</option>
                                <option value="enfants">Enfants</option>
                                <option value="familles">Familles</option>
                                <option value="scolaires">Scolaires</option>
                            </select>
                        </div>

                        <!-- CAPACITÉ -->
                        <div class="form-group col-md-6">
                            <label for="capacite_max_activite">Capacité maximum</label>
                            <input type="number" class="form-control" id="capacite_max_activite" name="capacite_max" value="20" min="1">
                        </div>

                        <!-- ANIMATEUR -->
                        <div class="form-group col-md-6">
                            <label for="animateur_activite">Animateur</label>
                            <input type="text" class="form-control" id="animateur_activite" name="animateur" placeholder="Nom de l'animateur">
                        </div>

                        <!-- PRIX -->
                        <div class="form-group col-md-6">
                            <label for="prix_activite">Prix (FCFA)</label>
                            <input type="number" class="form-control" id="prix_activite" name="prix" value="0" min="0">
                        </div>

                        <!-- MATÉRIEL FOURNI -->
                        <div class="form-group col-md-6">
                            <label for="materiel_fourni_activite">Matériel fourni</label>
                            <select class="form-control" id="materiel_fourni_activite" name="materiel_fourni">
                                <option value="true">Oui</option>
                                <option value="false">Non</option>
                            </select>
                        </div>

                        <!-- DATE ET HEURE -->
                        <div class="form-group col-md-6">
                            <label for="date_activite">Date et heure</label>
                            <input type="datetime-local" class="form-control" id="date_activite" name="date_activite">
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_activite">Statut</label>
                            <select class="form-control" id="statut_activite" name="statut">
                                <option value="active">Active</option>
                                <option value="a_venir">À venir</option>
                                <option value="terminee">Terminée</option>
                                <option value="annulee">Annulée</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT Roles -->
<div id="modal_addrole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content d-flex flex-column h-100">

            <div class="modal-header bg-themeModal border-0 ">
                <h5 class="modal-title">Ajouter un Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pb-0" style="flex: 1 1 auto; overflow-y: auto;">
                <form id="form_addrole" accept-charset="UTF-8" ng-submit="addElement($event,'role')">
                    {{ csrf_field() }}

                    <input type="hidden" id="id_role" name="id">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6 p-0 mx-3">
                            <label for="name_role"> rôle</label>
                            <input id="name_role" name="name" class="form-control" type="text" placeholder="Entrez un nouveau rôle">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6 p-0 mx-3">
                            <label for="nouveauname_role">Nouveau rôle</label>
                            <input id="nouveauname_role" name="nouveauname" class="form-control" type="text" placeholder="Entrez un nouveau rôle">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-check">
                            <input id="isplanning_role" name="isplanning" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="isplanning_role"> Peut avoir un planning ? </label>
                        </div>
                        <div class="form-check">
                            <input id="iscommercial_role" name="iscommercial" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="iscommercial_role"> Commercial ? </label>
                        </div>
                        <div class="form-check">
                            <input id="ischauffeur_role" name="ischauffeur" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="ischauffeur_role"> chauffeur ? </label>
                        </div>
                        <div class="form-check">
                            <input id="isadmin_role" name="isadmin" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="isadmin_role"> admin ? </label>
                        </div>
                        <div class="form-check">
                            <input id="estautoriser_role" name="estautoriser" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="estautoriser_role"> authorization Web ? </label>
                        </div>
                        <div class="form-check">
                            <input id="auth_mobile_role" name="auth_mobile" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="auth_mobile_role"> authorization Mobile ? </label>
                        </div>
                        <div class="form-check">
                            <input id="ischantenne_role" name="ischantenne" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="ischantenne_role"> chef d'antenne ? </label>
                        </div>
                    </div>

                    <div class="overflow-auto">
                        <div class="mb-3">
                            <label for="filter_permissions" class="form-label">Filtrer les permissions</label>
                            <input type="text" id="filter_permissions" class="form-control" ng-model="filterText" placeholder="Rechercher...">
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody id="lespermissions">
                                <tr ng-repeat="item in dataPage['permissions'] | filter:filterText">
                                    <td class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" id="permission_role_@{{ $index }}" data-permission-id="@{{ item.id }}" data-permission-name="@{{ item.name }}" name="selectedpermissions" ng-click="checkedInTab($event, item.id)">
                                        <label for="permission_role_@{{ $index }}" class="mb-0">@{{ item.display_name }}</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <!-- Footer à l'intérieur du formulaire -->
                    <div class="modal-footer border-0 sticky-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<style>
    .sticky-footer {
        position: sticky;
        bottom: 0;
        background-color: white;
        /* Assurez-vous que le fond est visible */
        z-index: 10;
        /* Pour s'assurer qu'il est au-dessus du contenu */
    }
</style>


<!-- MODAL AJOUT CLIENT -->
<div id="modal_addclient" class="modal fade addclients" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Fiche client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addclient" accept-charset="UTF-8" ng-submit="addElement($event,'client')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_client" name="id">

                    <div class="form-row ">
                        <div class="form-group col-md-12">
                            <label for="designation_client">Nom Client</label>
                            <input disabled type="text" class="form-control" id="designation_client" name="designation" placeholder="Votre designation">
                        </div>

                        <div class="col-md-6 form-group" ng-repeat="cpt in item_update.clienttypeclients">
                            <label style="font-weight: bolder !important;" for="typeclient_client">@{{cpt.typeclient.designation}}</label>
                            <input type="number" class="form-control" id="@{{cpt.id}}compte_client" name="@{{cpt.typeclient_id}}compte_client" ng-model="compte_client" value="@{{cpt.compte}}" placeholder="N° Compte  @{{cpt.typeclient.designation}}">
                        </div>


                    </div>

                    <!-- Compte -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email_client">Email</label>
                            <input type="email" class="form-control" id="email_client" name="email" placeholder="Votre adresse mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="login_client">Login</label>
                            <input type="login" class="form-control" id="login_client" name="login" placeholder="Votre adresse login">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password_client">Mot de passe</label>
                            <input type="password" class="form-control" id="password_client" name="password" placeholder="Votre mot de passe">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmpassword_client">Confirmer Mot de passe</label>
                            <input type="password" class="form-control" id="confirmpassword_client" name="password_confirmation" placeholder="Votre mot de passe">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>



<!-- MODAL AJOUT CLIENT -->
<div id="modal_addbailleur" class="modal fade addbailleurs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un bailleur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addbailleur" accept-charset="UTF-8" ng-submit="addElement($event,'bailleur')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_bailleur" name="id">
                    <input type="hidden" id="programme_id_bailleur" name="programme_id">

                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="designation_bailleur">Nom bailleur</label>
                            <input type="text" class="form-control" id="designation_bailleur" name="designation" placeholder="Votre designation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address_bailleur">Address</label>
                            <input type="text" class="form-control" id="address_bailleur" name="address" placeholder="Votre adresse address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pays_bailleur">pays</label>
                            <input type="text" class="form-control" id="pays_bailleur" name="pays" placeholder="Votre adresse pays">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_bailleur">contact</label>
                            <input type="text" class="form-control" id="contact_bailleur" name="contact" placeholder="Votre adresse contact">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel">Telephone </label>
                            <input type="tel" class="form-control" id="telephone_bailleur" name="telephone" placeholder="Votre  tel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel">FIX</label>
                            <input type="tel" class="form-control" id="fixe_bailleur" name="fixe" placeholder="Votre  tel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailcontact_bailleur">Email contact</label>
                            <input type="emailcontact" class="form-control" id="emailcontact_bailleur" name="emailcontact" placeholder="Votre adresse mail">
                        </div>
                    </div>

                    <!-- Compte -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email_bailleur">Email</label>
                            <input type="email" class="form-control" id="email_bailleur" name="email" placeholder="Votre adresse mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="login_bailleur">Login</label>
                            <input type="login" class="form-control" id="login_bailleur" name="login" placeholder="Votre adresse login">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password_bailleur">Mot de passe</label>
                            <input type="password" class="form-control" id="password_bailleur" name="password" placeholder="Votre mot de passe">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmpassword_bailleur">Confirmer Mot de passe</label>
                            <input type="password" class="form-control" id="confirmpassword_bailleur" name="password_confirmation" placeholder="Votre mot de passe">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>





<!-- MODAL AJOUT ŒUVRE -->
<div id="modal_addoeuvre" class="modal fade addoeuvres" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une œuvre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addoeuvre" accept-charset="UTF-8" ng-submit="addElement($event,'oeuvre')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_oeuvre" name="id">
                    <input type="hidden" id="programme_id_oeuvre" name="programme_id">

                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="designation_oeuvre">Nom œuvre</label>
                            <input type="text" class="form-control" id="designation_oeuvre" name="designation" placeholder="Nom de l'œuvre">
                        </div>

                        <!-- INFORMATIONS ESSENTIELLES -->
                        <div class="form-group col-md-6">
                            <label for="titre_fr_oeuvre">Titre français</label>
                            <input type="text" class="form-control" id="titre_fr_oeuvre" name="titre_fr" placeholder="Titre en français">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="titre_en_oeuvre">Titre anglais</label>
                            <input type="text" class="form-control" id="titre_en_oeuvre" name="titre_en" placeholder="Titre en anglais">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="titre_wo_oeuvre">Titre wolof</label>
                            <input type="text" class="form-control" id="titre_wo_oeuvre" name="titre_wo" placeholder="Titre en wolof">
                        </div>

                        <!-- DESCRIPTIONS MULTILINGUES -->
                        <div class="form-group col-md-12">
                            <label for="description_fr_oeuvre">Description française</label>
                            <textarea class="form-control" id="description_fr_oeuvre" name="description_fr" rows="3" placeholder="Description en français"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description_en_oeuvre">Description anglaise</label>
                            <textarea class="form-control" id="description_en_oeuvre" name="description_en" rows="3" placeholder="Description en anglais"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description_wo_oeuvre">Description wolof</label>
                            <textarea class="form-control" id="description_wo_oeuvre" name="description_wo" rows="3" placeholder="Description en wolof"></textarea>
                        </div>

                        <!-- INFORMATIONS ARTISTIQUES -->
                        <div class="form-group col-md-6">
                            <label for="artiste_oeuvre">Artiste</label>
                            <input type="text" class="form-control" id="artiste_oeuvre" name="artiste" placeholder="Nom de l'artiste">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_creation_oeuvre">Date de création</label>
                            <input type="text" class="form-control" id="date_creation_oeuvre" name="date_creation" placeholder="Ex: XIXe siècle">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="origine_oeuvre">Origine</label>
                            <input type="text" class="form-control" id="origine_oeuvre" name="origine" placeholder="Pays/région d'origine">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="materiaux_oeuvre">Matériaux</label>
                            <input type="text" class="form-control" id="materiaux_oeuvre" name="materiaux" placeholder="Matériaux utilisés">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="dimensions_oeuvre">Dimensions</label>
                            <input type="text" class="form-control" id="dimensions_oeuvre" name="dimensions" placeholder="Ex: 30cm x 25cm">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="localisation_salle_oeuvre">Localisation salle</label>
                            <input type="text" class="form-control" id="localisation_salle_oeuvre" name="localisation_salle" placeholder="Ex: Salle 1A - Art Royal">
                        </div>

                        <!-- FICHIERS MÉDIAS -->
                        <div class="form-group col-md-4">
                            <label for="image_url_oeuvre">Image URL</label>
                            <input type="text" class="form-control" id="image_url_oeuvre" name="image_url" placeholder="/images/œuvre.jpg">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="audio_fr_url_oeuvre">Audio français URL</label>
                            <input type="text" class="form-control" id="audio_fr_url_oeuvre" name="audio_fr_url" placeholder="/audio/œuvre_fr.mp3">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="audio_en_url_oeuvre">Audio anglais URL</label>
                            <input type="text" class="form-control" id="audio_en_url_oeuvre" name="audio_en_url" placeholder="/audio/œuvre_en.mp3">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="audio_wo_url_oeuvre">Audio wolof URL</label>
                            <input type="text" class="form-control" id="audio_wo_url_oeuvre" name="audio_wo_url" placeholder="/audio/œuvre_wo.mp3">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="video_url_oeuvre">Vidéo URL</label>
                            <input type="text" class="form-control" id="video_url_oeuvre" name="video_url" placeholder="/video/œuvre.mp4">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="qr_code_oeuvre">QR Code</label>
                            <input type="text" class="form-control" id="qr_code_oeuvre" name="qr_code" placeholder="Ex: MCN-OZOLUA-001">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT HORAIRE -->
<div id="modal_addhoraire" class="modal fade addhoraires" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un horaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addhoraire" accept-charset="UTF-8" ng-submit="addElement($event,'horaire')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_horaire" name="id">

                    <div class="form-row">
                        <!-- JOUR DE LA SEMAINE -->
                        <div class="form-group col-md-6">
                            <label for="jour_semaine_horaire">Jour de la semaine</label>
                            <select class="form-control" id="jour_semaine_horaire" name="jour_semaine">
                                <option value="lundi">Lundi</option>
                                <option value="mardi">Mardi</option>
                                <option value="mercredi">Mercredi</option>
                                <option value="jeudi">Jeudi</option>
                                <option value="vendredi">Vendredi</option>
                                <option value="samedi">Samedi</option>
                                <option value="dimanche">Dimanche</option>
                            </select>
                        </div>

                        <!-- HEURES D'OUVERTURE -->
                        <div class="form-group col-md-3">
                            <label for="heure_ouverture_horaire">Heure d'ouverture</label>
                            <input type="time" class="form-control" id="heure_ouverture_horaire" name="heure_ouverture" value="09:00">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="heure_fermeture_horaire">Heure de fermeture</label>
                            <input type="time" class="form-control" id="heure_fermeture_horaire" name="heure_fermeture" value="18:00">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT TARIF -->
<div id="modal_addtarif" class="modal fade addtarifs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un tarif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addtarif" accept-charset="UTF-8" ng-submit="addElement($event,'tarif')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_tarif" name="id">

                    <div class="form-row">
                        <!-- TYPE DE BILLET -->
                        <div class="form-group col-md-6">
                            <label for="type_billet_tarif">Type de billet</label>
                            <input type="text" class="form-control" id="type_billet_tarif" name="type_billet" placeholder="Ex: Adulte, Enfant, Étudiant...">
                        </div>

                        <!-- CATÉGORIE -->
                        <div class="form-group col-md-6">
                            <label for="categorie_tarif">Catégorie</label>
                            <select class="form-control" id="categorie_tarif" name="categorie">
                                <option value="adulte">Adulte</option>
                                <option value="enfant">Enfant</option>
                                <option value="etudiant">Étudiant</option>
                                <option value="senior">Senior</option>
                                <option value="groupe">Groupe</option>
                                <option value="famille">Famille</option>
                                <option value="gratuit">Gratuit</option>
                            </select>
                        </div>

                        <!-- PRIX -->
                        <div class="form-group col-md-6">
                            <label for="prix_tarif">Prix (FCFA)</label>
                            <input type="number" class="form-control" id="prix_tarif" name="prix" placeholder="5000" min="0" step="500">
                        </div>

                        <!-- CONDITIONS -->
                        <div class="form-group col-md-6">
                            <label for="conditions_tarif">Conditions</label>
                            <input type="text" class="form-control" id="conditions_tarif" name="conditions" placeholder="Ex: À partir de 18 ans, Sur présentation de carte...">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT ÉVÉNEMENT -->
<div id="modal_addevenement" class="modal fade addevenements" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter un événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addevenement" accept-charset="UTF-8" ng-submit="addElement($event,'evenement')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_evenement" name="id">

                    <div class="form-row">
                        <!-- TITRE -->
                        <div class="form-group col-md-12">
                            <label for="titre_evenement">Titre de l'événement</label>
                            <input type="text" class="form-control" id="titre_evenement" name="titre" placeholder="Ex: Journées Culturelles Panafricaines">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="form-group col-md-12">
                            <label for="description_evenement">Description</label>
                            <textarea class="form-control" id="description_evenement" name="description" rows="3" placeholder="Description détaillée de l'événement"></textarea>
                        </div>

                        <!-- TYPE D'ÉVÉNEMENT -->
                        <div class="form-group col-md-6">
                            <label for="type_evenement">Type d'événement</label>
                            <select class="form-control" id="type_evenement" name="type_evenement">
                                <option value="conference">Conférence</option>
                                <option value="atelier">Atelier</option>
                                <option value="concert">Concert</option>
                                <option value="nocturne">Nocturne</option>
                                <option value="exposition">Exposition temporaire</option>
                                <option value="visite_guidee">Visite guidée</option>
                                <option value="festival">Festival</option>
                                <option value="cine_debat">Ciné-débat</option>
                                <option value="congres">Congrès</option>
                                <option value="projection">Projection</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <!-- IMAGE -->
                        <div class="form-group col-md-6">
                            <label for="image_url_evenement">Image URL</label>
                            <input type="text" class="form-control" id="image_url_evenement" name="image_url" placeholder="/images/evenements/evenement.jpg">
                        </div>

                        <!-- DATES -->
                        <div class="form-group col-md-6">
                            <label for="date_debut_evenement">Date et heure de début</label>
                            <input type="datetime-local" class="form-control" id="date_debut_evenement" name="date_debut">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_fin_evenement">Date et heure de fin</label>
                            <input type="datetime-local" class="form-control" id="date_fin_evenement" name="date_fin">
                        </div>

                        <!-- TARIF ET PLACES -->
                        <div class="form-group col-md-4">
                            <label for="prix_supplement_evenement">Prix supplémentaire (FCFA)</label>
                            <input type="number" class="form-control" id="prix_supplement_evenement" name="prix_supplement" value="0" min="0">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="places_disponibles_evenement">Places disponibles</label>
                            <input type="number" class="form-control" id="places_disponibles_evenement" name="places_disponibles" value="50" min="1">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="reservations_requises_evenement">Réservation requise</label>
                            <select class="form-control" id="reservations_requises_evenement" name="reservations_requises">
                                <option value="false">Non</option>
                                <option value="true">Oui</option>
                            </select>
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_evenement">Statut</label>
                            <select class="form-control" id="statut_evenement" name="statut">
                                <option value="actif">Actif</option>
                                <option value="a_venir">À venir</option>
                                <option value="termine">Terminé</option>
                                <option value="annule">Annulé</option>
                            </select>
                        </div>

                        <!-- DIFFUSION LIVE -->
                        <div class="form-group col-md-6">
                            <label for="diffusion_live_evenement">Diffusion en direct</label>
                            <select class="form-control" id="diffusion_live_evenement" name="diffusion_live">
                                <option value="false">Non</option>
                                <option value="true">Oui</option>
                            </select>
                        </div>

                        <!-- INTERVENANTS -->
                        <div class="form-group col-md-12">
                            <label for="intervenants_evenement">Intervenants (séparés par des virgules)</label>
                            <input type="text" class="form-control" id="intervenants_evenement" name="intervenants" placeholder="Ex: Dr. Diallo, Prof. Ndiaye, Artiste Sow">
                        </div>

                        <!-- LIEU SPÉCIFIQUE -->
                        <div class="form-group col-md-12">
                            <label for="lieu_evenement">Lieu spécifique (optionnel)</label>
                            <input type="text" class="form-control" id="lieu_evenement" name="lieu" placeholder="Ex: Auditorium, Salle de conférence, Jardin du musée">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL AJOUT COLLECTION -->
<div id="modal_addcollection" class="modal fade addcollections" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une collection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addcollection" accept-charset="UTF-8" ng-submit="addElement($event,'collection')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_collection" name="id">
                    <input type="hidden" id="programme_id_collection" name="programme_id">

                    <div class="form-row ">
                        <!-- INFORMATIONS COLLECTION -->
                        <div class="form-group col-md-6">
                            <label for="nom_collection">Nom de la collection</label>
                            <input type="text" class="form-control" id="nom_collection" name="nom" placeholder="Nom de la collection">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="conservateur_collection">Conservateur</label>
                            <input type="text" class="form-control" id="conservateur_collection" name="conservateur" placeholder="Nom du conservateur">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description_collection">Description</label>
                            <textarea class="form-control" id="description_collection" name="description" rows="3" placeholder="Description de la collection"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_creation_collection">Date de création</label>
                            <input type="date" class="form-control" id="date_creation_collection" name="date_creation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="statut_collection">Statut</label>
                            <select class="form-control" id="statut_collection" name="statut">
                                <option value="publique">Publique</option>
                                <option value="privee">Privée</option>
                            </select>
                        </div>

                        <!-- SECTION AJOUT D'ŒUVRES À LA COLLECTION -->
                        <div class="col-md-12 mt-4">
                            <h6>Ajouter des œuvres à la collection</h6>

                            <div class="form-row border p-3 mb-3" ng-repeat="oeuvre in collectionOeuvres">
                                <div class="form-group col-md-5">
                                    <label>Œuvre</label>
                                    <select class="form-control" ng-model="oeuvre.oeuvre_id" name="oeuvres[]">
                                        <option value="">Sélectionner une œuvre</option>
                                        <option ng-repeat="item in dataPage['oeuvres']" value="@{{ item.id }}">@{{ item.designation }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Date d'ajout</label>
                                    <input type="date" class="form-control" ng-model="oeuvre.date_ajout" name="dates_ajout[]">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Ordre d'exposition</label>
                                    <input type="number" class="form-control" ng-model="oeuvre.ordre" name="ordres[]" placeholder="1, 2, 3...">
                                </div>

                                <div class="form-group col-md-1">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm" ng-click="removeOeuvreFromCollection($index)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-sm" ng-click="addOeuvreToCollection()">
                                <i class="fa fa-plus"></i> Ajouter une œuvre
                            </button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




<!-- MODAL AJOUT POINT DE VENTE -->
<div id="modal_addpointdevente" class="modal fade addpointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un point de vente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addpointdevente" accept-charset="UTF-8" ng-submit="addElement($event,'pointdevente')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_pointdevente">
                    <input type="hidden" name="gps" id="gps_pointdevente">
                    <input type="hidden" name="etat" id="etat_pointdevente">
                    <input type="hidden" name="ventedirect" id="ventedirect_pointdevente">

                    <div class="form-group col-md-6 py-2 m-0 p-0">
                        <p><i class="fa fa-map-marker"></i> <input type="text" id="gps_chaine_pointdevente" disabled placeholder="0.0 , 0.0">
                        </p>
                    </div>
                    <div class="form-check">
                        <input id="ventedirect_pointdevente" name="ventedirect" class="form-check-input" type="checkbox" value="0">
                        <label class="form-check-label" for="ventedirect_pointdevente">
                            ventedirect ?
                        </label>
                    </div>
                    <!-- <div class="form-check">
                        <input id="estdivers_pointdevente" name="estdivers" class="form-check-input" type="checkbox" value="1">
                        <label class="form-check-label" for="estdivers_pointdevente">
                            estdivers ?
                        </label>
                    </div> -->

                    <div class="form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">
                        <div class="form-group col-md-6">
                            <label for="intitule_pointdevente">INTITULE</label>
                            <input type="text" class="form-control" id="intitule_pointdevente" name="intitule" placeholder="INTITULE">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="numbcpttier_pointdevente">N COMPTER TIERS</label>
                            <input type="text" class="form-control" id="numbcpttier_pointdevente" name="numbcpttier" placeholder="N COMPTER TIERS">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="designation_pointdevente">Designation</label>
                            <input type="text" class="form-control" id="designation_pointdevente" name="designation" placeholder="Votre nom d'utilisateur">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_pointdevente" name="description" placeholder="Votre  description">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="latitude_pointdevente">latitude</label>
                            <input type="doubleval" class="form-control" id="latitude_pointdevente" name="latitude" placeholder="Votre nom d'utilisateur">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">longitude</label>
                            <input type="doubleval" class="form-control" id="longitude_pointdevente" name="longitude" placeholder="Votre  longitude">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mail">Address</label>
                            <input type="text" name="adresse" class="form-control" id="adresse_pointdevente" placeholder="Votre adresse ">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="mail">Tel</label>
                            <input type="tel" name="telephone" class="form-control" id="telephone_pointdevente" placeholder="Votre  tel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email_pointdevente">Email</label>
                            <input type="tel" name="email" class="form-control" id="email_pointdevente" placeholder="Votre email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="zone_pointdevente">Zone</label>
                            <select id="zone_pointdevente" style="width:100%" name="zone" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="client_pointdevente">client</label>
                            <select id="client_pointdevente" style="width:100%" name="client" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['clients']" value="@{{ item.id }}">
                                    @{{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="typepointdevente_pointdevente">typepointdevente</label>
                            <select id="typepointdevente_pointdevente" style="width:100%" name="typepointdevente" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['typepointdeventes']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="categoriepointdevente_pointdevente">categoriepointdevente</label>
                            <select id="categoriepointdevente_pointdevente" style="width:100%" name="categoriepointdevente" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['categoriepointdeventes']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>

                    </div>

                    <!-- Image -->
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="img_local" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="img_local_pointdevente">
                                    <input type="file" style="border: none;background: transparent" name="img_local" class="form-control w-50" id="img_local_pointdevente" aria-describedby="inputGroupFileAddon">
                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="images">Image Url</label>
                            <input type="text" class="form-control" id="images_produit" name="images" placeholder="Votre  images">
                        </div>
                    </div>

                    <div class="form-group col-md-6 py-2 m-0 p-0">
                        <img src="image.png" id="pdv_image_pointdevente" alt="Point de Vente" class="img-fluid img_modal">
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT Produit -->
<div id="modal_addarticle" class="modal fade addarticle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addarticle" accept-charset="UTF-8" ng-submit="addElement($event,'article')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_article">

                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">

                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input disabled type="text" class="form-control" id="designation_article" name="designation" placeholder="Votre nom designation">
                        </div>
                        <!--<div class="form-group col-md-6">
                            <label for="description_article">Description</label>
                            <input type="text" class="form-control" id="description_article" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="number">PRIX</label>
                            <input type="number" class="form-control" id="prix_article" name="prix" placeholder="Votre  prix">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="categorie_article">categorie</label>
                            <select id="categorie_article" style="width:100%" name="categorie_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['categories']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="unite_article">unite</label>
                            <select id="unite_article" style="width:100%" name="unite_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['unites']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>-->

                        <!--<div class="form-group col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_article">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_article" aria-describedby="inputGroupFileAddon">

                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>-->


                        <div class="col-md-12 mt-4">
                            <div class="my-3">
                                <div class="d-block d-md-flex align-items-center justify-content-between gap-2">
                                    <div class="mr-2 w-100">
                                        <label for="remisedureedevie_article" class="form-label m-0 p-0">Type remise:</label>
                                        <select ng-model="selectedElement.remisedureedevie" id="remisedureedevie_article" select2 class="form-select" style="width: 100%;">
                                            <option value="">Choisir</option>
                                            <option ng-repeat="item in dataPage['remisedureedevies']" value="@{{ item.id }}">
                                                @{{ (item.moinsnim !== null && item.moinsnim !== undefined) ? item.moinsnim : '-------' }}
                                                à
                                                @{{ (item.moismax !== null && item.moismax !== undefined) ? item.moismax : '-------' }} mois / @{{ item.etat_text }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mr-3 w-100">
                                        <input type="number" ng-model="selectedElement.remise_remisedureedevie" class="form-control" id="remise_article" placeholder="Valeur remise">
                                    </div>
                                    <div>
                                        <button class="btn mt-2 btn-outline-secondary text-end rounded" type="button" ng-click="addRemiseDureeVie()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Type remise</th>
                                        <th scope="col">Remise</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataInTabPane.remisedureedevie_article.data">
                                        <td>@{{ item.moinsnim }} à @{{ item.moismax }} mois</td>
                                        <td>@{{ item.remise_article }}</td>
                                        <td>
                                            <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'remisedureedevie_article',$index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="form-group col-md-6 py-2 m-0 p-0">
                        <img src="image.png" id="article_image_produit" alt="Point de Vente" class="img-fluid img_modal">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT Produit -->
<div id="modal_addcritere" class="modal fade addcritere" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un critere</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addcritere" accept-charset="UTF-8" ng-submit="addElement($event,'critere')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_critere">

                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">

                        <div class="form-group col-md-6">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation_critere" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">description</label>
                            <input type="text" class="form-control" id="description_critere" name="description" placeholder="Votre nom description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="points">points</label>
                            <input type="number" class="form-control" id="points_critere" name="points" placeholder="Votre nom points">
                        </div>


                        <div class="col-md-12 mt-4">
                            <div class="my-3">
                                <div class="d-block d-md-flex align-items-center justify-content-between gap-2">
                                    <div class="mr-3 w-100">
                                        <input type="text" ng-model="newEchelle.echelle_designation" class="form-control" id="echelle_designation_critere" placeholder="echelle Designation">
                                    </div>
                                    <div class="mr-3 w-100">
                                        <input type="number" ng-model="newEchelle.min" class="form-control" min="0" id="min_critere" placeholder="Pourcentage min">
                                    </div>
                                    <div class="mr-3 w-100">
                                        <input type="number" ng-model="newEchelle.max" class="form-control" min="0" id="max_critere" placeholder="Pourcentage max">
                                    </div>
                                    <div class="mr-3 w-100">
                                        <input type="number" ng-model="newEchelle.ordre" class="form-control" min="0" id="ordre_critere" placeholder="Ordre">
                                    </div>
                                    <div class="mr-3 w-100">
                                        <input type="number" ng-model="newEchelle.points" class="form-control" min="0" id="echelle_points_critere" placeholder="points" step="0.01" min="0">
                                    </div>
                                    <div>
                                        <button class="btn mt-2 btn-outline-secondary text-end rounded" type="button" ng-click="addElementInDataTabePane()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Plage</th>
                                        <th scope="col">Ordre</th>
                                        <th scope="col">points</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataInTabPane.echelleevaluations_critere.data | orderBy:'ordre'">
                                        <td>@{{ item.designation }}</td>
                                        <td>@{{ item.min }}% à @{{ item.max }}%</td>
                                        <td>@{{ item.ordre }}</td>
                                        <td>@{{ item.points }}</td>
                                        <td>
                                            <button class="btn shadow text-danger btn-light btn-sm" type="button" ng-click="deletObjetInDataTabePane(null,'echelleevaluations_critere',$index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="form-group col-md-6 py-2 m-0 p-0">
                        <img src="image.png" id="critere_image_produit" alt="Point de Vente" class="img-fluid img_modal">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT Produit -->
<div id="modal_addficheevaluation" class="modal fade addficheevaluation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter Modele d'evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addficheevaluation" accept-charset="UTF-8" ng-submit="addElement($event,'ficheevaluation')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_ficheevaluation">

                    <div class="form-row">
                        <div class="form-check">
                            <input id="isactive_ficheevaluation" name="isactive" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="isactive_ficheevaluation"> Est actif ? </label>
                        </div>
                        <div class="form-check">
                            <input id="modelfiche_ficheevaluation" name="modelfiche" class="form-check-input" type="radio" value="1">
                            <label class="form-check-label" for="modelfiche_ficheevaluation"> Marchee ? </label>
                        </div>
                        <div class="form-check">
                            <input id="modelfiche_ficheevaluation" name="modelfiche" class="form-check-input" type="radio" value="2">
                            <label class="form-check-label" for="modelfiche_ficheevaluation"> Fournisseur ? </label>
                        </div>
                    </div>
                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">
                        <div class="form-group col-md-6">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation_ficheevaluation" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Categorie</label>
                            <select id="TSSCOD_0_0_ficheevaluation" name="TSSCOD_0_0" select2 class="form-select" required>
                                <option value="">Categorie</option>
                                <option value="1">MÉDICAMENTS</option>
                                <option value="2">BIENS ET SERVICES</option>
                                <option value="3">PRESTATION INTELLECTUELLE</option>
                                <option value="4">TRANSITAIRE</option>
                                <option value="5">EXPERT</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="my-3">
                                <div class="d-block d-md-flex align-items-center justify-content-between gap-2">
                                    <div class="mr-3 w-100">
                                        <label for="">Critère</label>
                                        <select id="critere_ficheevaluation" name="critere_id" select2 class="form-select" ng-model="newCritere.critere_id">
                                            <option value="">Choisir un critère</option>
                                            <option ng-repeat="critere in dataPage['criteres']" value="@{{ critere.id }}">
                                                @{{ critere.designation }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mr-3 w-100">
                                        <label for="">Pondération</label>
                                        <input type="number" ng-model="newCritere.ponderation" id="ponderation_ficheevaluation" class="form-control" placeholder="Pondération" step="0.01" min="0" max="1">
                                    </div>
                                    <div class="mr-3 w-100">
                                        <label for="">Ordre</label>
                                        <input type="number" ng-model="newCritere.ordre" id="ordre_ficheevaluation" class="form-control" placeholder="Ordre" min="1">
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn mt-2 btn-outline-secondary text-end rounded" type="button" ng-click="addCritereToFiche()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Critère</th>
                                        <th scope="col">Pondération</th>
                                        <th scope="col">Ordre</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataInTabPane.ficheevaluations_ficheevaluation.data | orderBy:'ordre'">
                                        <td>
                                            <span>
                                                @{{ item.designation }}
                                            </span>
                                        </td>
                                        <td>@{{ item.ponderation }}</td>
                                        <td>@{{ item.ordre }}</td>
                                        <td>
                                            <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'ficheevaluations_ficheevaluation',$index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p>Workflow</p>


                        <div class="form-group col-md-5 ">
                            <label for="role_ficheevaluation">Profile</label>
                            <select id="role_ficheevaluation" select2 style="width: 100%;">
                                <option ng-repeat="item in dataPage['roles']" value="@{{ item.id }}">
                                    @{{ item.name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-5 ">
                            <label for="position_ficheevaluation">Position</label>
                            <input type="number" class="form-control" id="position_ficheevaluation" name="position_ficheevaluation" placeholder="Position">
                        </div>
                        <div class="form-group col-md-2">
                            <button type="button" class="btn bg-theme-gradient rounded-2 border-none px-2 py-1 dropdown-toggle mt-4" ng-click="addWorkflowFiche()">
                                <img src="{{ asset('images/icon_plus.png') }}" class="icon-size" alt="">
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Role</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataInTabPane.workflows_ficheevaluation.data | orderBy:'ordre'">
                                        <td>
                                            <span>
                                                @{{ item.designation }}
                                            </span>
                                        </td>
                                        <td>@{{ item.position }}</td>
                                        <td>
                                            <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'workflows_ficheevaluation',$index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<!-- MODAL AJOUT Statutamm -->
<div id="modal_addstatutamm" class="modal fade addstatutamm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un statutamm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addstatutamm" accept-charset="UTF-8" ng-submit="addElement($event,'statutamm')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_statutamm">

                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">
                        <div class="col-md-6 form-group">
                            <label for="article_statutamm">CODE ARTICLE</label>
                            <select id="article_statutamm" style="width:100%" name="codeproduit" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['articles']" value="@{{ item.code }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nomcommercial_statutamm">NOM COMMERCIAL</label>
                            <input type="text" class="form-control" id="nomcommercial_statutamm" name="nomcommercial" placeholder="Votre adresse nomcommercial">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="numeroamm_statutamm">Numero d'AMM</label>
                            <input type="text" class="form-control" id="numeroamm_statutamm" name="numeroamm" placeholder="Votre adresse numeroamm">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="datedelivranceamm_statutamm">date d'elivrance</label>
                            <input type="date" class="form-control" id="datedelivranceamm_statutamm" name="datedelivranceamm" placeholder="Votre adresse datedelivranceamm">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dateexpirationamm_statutamm">date date expiration amm</label>
                            <input type="date" class="form-control" id="dateexpirationamm_statutamm" name="dateexpirationamm" placeholder="Votre adresse dateexpirationamm">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="Fournisseur_statutamm">Fournisseur</label>
                            <select id="fournisseur_statutamm" style="width:100%" name="Fournisseur_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['fournisseurs']" value="@{{ item.id }}">
                                    @{{ item.nom }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="labofabricant_statutamm">labo fabricant</label>
                            <select id="labofabricant_statutamm" style="width:100%" name="laboratoirefabriquant_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['fabricants']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="labotitulaire_statutamm">labo titulaire</label>
                            <select id="labotitulaire_statutamm" style="width:100%" name="laboratoiretitulaire_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['fabricants']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>

                        <div class="col-md-5 form-group">
                            <label for="statut_statutamm">Statut</label>
                            <select id="statut_statutamm" style="width:100%" name="statut_detailstatuts_statutamm" select2>
                                <option value="">--------</option>
                                <option ng-value="0">Non valide </option>
                                <option ng-value="1">Valide </option>
                            </select>
                        </div>


                        <div class="col-md-5 form-group">
                            <label for="motif_statutamm">Motif statut</label>
                            <select id="motifs_detailstatuts_statutamm" style="width:100%" name="motifs_detailstatuts_statutamm" select2>
                                <option value="">--------</option>
                                <option ng-value="1">Expiré après 6mois date expiration</option>
                                <option ng-value="2">arrêt commercialisation</option>
                                <option ng-value="3">jusqu’à 6 mois après expiration</option>
                                <option ng-value="4">Encours renouvellement</option>
                            </select>
                        </div>


                        <div class="form-group col-md-2">
                            <button type="button" class="btn bg-theme-gradient rounded-2 border-none px-2 py-1 dropdown-toggle mt-4" ng-click="addstatutdetails()">
                                <img src="{{ asset('images/icon_plus.png') }}" class="icon-size" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Motif</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataInTabPane.detailstatuts_statutamm.data">
                                    <td class="text-dark">
                                        <div ng-if="item.statut==1">Valide</div>
                                        <div ng-if="item.statut==0">Non valide</div>
                                    </td>
                                    <td>
                                        <div ng-if="item.motifs==1">Expiré après 6mois date expiration</div>
                                        <div ng-if="item.motifs==2">arrêt commercialisation</div>
                                        <div ng-if="item.motifs==3">jusqu’à 6 mois après expiration</div>
                                        <div ng-if="item.motifs==4">Encours renouvellement</div>
                                    </td>
                                    <td>@{{ item.date }}</td>
                                    <td>
                                        <span ng-if="item.etat == 1" class="badge bg-success ms-2"><i class="fa fa-check"></i>Actif</span>
                                        <span ng-if="item.etat == 0" class="badge bg-danger ms-2"><i class="fa fa-check"></i>Non actif</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn shadow text-danger btn-light btn-sm" ng-click="addstatutdetails($index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <button type="button" ng-if="item.etat == 0" class="btn shadow text-success btn-light btn-sm" ng-click="addstatutdetails($index,1)">
                                            <i class="fas fa-thumbs-up"></i>
                                        </button>

                                        <button type="button" ng-if="item.etat == 1" class="btn shadow text-danger btn-light btn-sm" ng-click="addstatutdetails($index,0)">
                                            <i class="fas fa-thumbs-down"></i>
                                        </button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>




<!-- MODAL AJOUT Statutamm -->
<div id="modal_addprequalification" class="modal fade addprequalification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un prequalification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addprequalification" accept-charset="UTF-8" ng-submit="addElement($event,'prequalification')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_prequalification">

                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">
                        <div class="form-group col-md-6">
                            <label for="username">Annee prequalification</label>
                            <input type="number" class="form-control" id="anneeprequalification_prequalification" name="anneeprequalification" placeholder="Votre nom anneeprequalification">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="anneeexpiration_prequalification">Annee expiration prequalification</label>
                            <input type="number" class="form-control" id="anneeexpiration_prequalification" name="anneeexpiration" placeholder="Votre adresse anneeexpiration">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Reference AOIP</label>
                            <input type="text" class="form-control" id="referenceaoip_prequalification" name="referenceaoip" placeholder="Votre nom referenceaoip">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_prequalification">CODE</label>
                            <input type="text" class="form-control" id="code_prequalification" name="code" placeholder="Votre adresse code">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cdt_prequalification">CDT</label>
                            <input type="text" class="form-control" id="cdt_prequalification" name="cdt" placeholder="Votre adresse cdt">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="fabricant_prequalification">Fabricant</label>
                            <select id="fabricant_prequalification" style="width:100%" name="fabricant_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['fabricants']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="adresse_prequalification">Adresse</label>
                            <input type="text" class="form-control" id="adresse_prequalification" name="adresse" placeholder="Votre adresse adresse">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="Fournisseur_prequalification">Fournisseur</label>
                            <select id="Fournisseur_prequalification" style="width:100%" name="fournisseur_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['fournisseurs']" value="@{{ item.id }}">
                                    @{{ item.nom }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pays_prequalification">pays Fabriquant</label>
                            <select id="pays_prequalification" style="width:100%" name="pays_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['pays']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="article_prequalification">article </label>
                            <select id="article_prequalification" style="width:100%" name="article_id" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['articles']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="type_prequalification">Categorie</label>
                            <select id="type_prequalification" style="width:100%" name="type" select2>
                                <option value="">--------</option>
                                <option value="C">C</option>
                                <option value="M">M</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="statut_prequalification">Statut</label>
                            <select id="statut_prequalification" style="width:100%" name="statut" select2>
                                <option value="">--------</option>
                                <option ng-value="0">PREQUALIFIE</option>
                                <option ng-value="1">QUALIFIE</option>
                                <option ng-value="2">REQUALIFIE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT Produit -->
<div id="modal_addlignecommande" class="modal fade addlignecommande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un lignecommande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addlignecommande" accept-charset="UTF-8" ng-submit="addElement($event,'lignecommande')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_lignecommande">
                    <input type="hidden" name="programme_id" id="programme_id_lignecommande">
                    <input type="hidden" name="campagne_id" id="campagne_id_lignecommande">

                    <div class=" form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center">
                        <div class="col-md-12   form-group">
                            <label for="article_lignecommande" class="text-dark">article</label>
                            <select id="article_lignecommande" multiple style="width:100%" name="articles[]" select2>
                                <option selected>Choisir...</option>
                                <option ng-repeat="item in dataPage['articles']" value="@{{ item.id }}">
                                    @{{ item.designation }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addtypelivraison" class="modal fade addtypelivraison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un typelivraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypelivraison" accept-charset="UTF-8" ng-submit="addElement($event,'typelivraison')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typelivraison">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_typelivraison" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_typelivraison" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addtypevehicule" class="modal fade addtypevehicule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un typevehicule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypevehicule" accept-charset="UTF-8" ng-submit="addElement($event,'typevehicule')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typevehicule">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_typevehicule" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_typevehicule" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addvehicule" class="modal fade addvehicule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un vehicule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addvehicule" accept-charset="UTF-8" ng-submit="addElement($event,'vehicule')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_vehicule">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="matricule">matricule</label>
                            <input type="text" class="form-control" id="matricule_vehicule" name="matricule" placeholder="Votre nom matricule">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marque">marque</label>
                            <input type="text" class="form-control" id="marque_vehicule" name="marque" placeholder="Votre nom marque">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="volume">volume</label>
                            <input type="number" step="0.01" class="form-control" id="volume_vehicule" name="volume" placeholder="Votre nom volume">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_vehicule" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="typevehicule_vehicule"> Type vehicule</label>
                            <div>
                                <select id="typevehicule_vehicule" name="typevehicule_id" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['typevehicules']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tonnage_vehicule"> Tonnage</label>
                            <div>
                                <select id="tonnage_vehicule" name="tonnage_id" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['tonnages']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chauffeur_vehicule"> Chauffeur</label>
                            <div>
                                <select id="chauffeur_vehicule" name="chauffeur_id" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['chauffeurs']" value="@{{ item.id }}">
                                        @{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addparking" class="modal fade addparking" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un parking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addparking" accept-charset="UTF-8" ng-submit="addElement($event,'parking')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_parking">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fournisseur_parking"> Fournisseur</label>
                            <div>
                                <select id="fournisseur_parking" name="fournisseur" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['fournisseurs']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="vehicule_parking"> vehicule</label>
                            <div>
                                <select id="vehicule_parking" name="vehicule" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['vehicules']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="modal_addtypefournisseur" class="modal fade addtypelivraison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un typefournisseur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypefournisseur" accept-charset="UTF-8" ng-submit="addElement($event,'typefournisseur')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typefournisseur">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_typefournisseur" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_typefournisseur" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="modal_addtypeprocedure" class="modal fade addtypelivraison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un typeprocedure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypeprocedure" accept-charset="UTF-8" ng-submit="addElement($event,'typeprocedure')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typeprocedure">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_typeprocedure" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_typeprocedure" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addarticledoc" class="modal fade addarticledoc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form ng-submit="addDocDao()">
                    <div class="mb-3">
                        <label class="form-label">Nom du document</label>
                        <input type="text" class="form-control" ng-model="newTechDoc.designation" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fichier</label>
                        <input type="file" class="form-control" ng-model="newTechDoc.document" id="document_articledoc" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addcontrat" class="modal fade addcontrat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addcontrat" ng-submit="addElement($event,'contrat')" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_contrat">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_contrat" name="nomcontrat" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">File</label>
                            <input type="file" class="form-control" id="file_contrat" name="file" placeholder="Votre nom file">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT DOCUMENTS -->
<div id="modal_adddocument" class="modal fade adddocument" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_adddocument" accept-charset="UTF-8" ng-submit="addElement($event, 'document', {from:'modal', is_file_excel:false, index:null, status:null, champ:null, route:'da/soumission_upload', operation:'dadocument'})">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_document">
                    <div class="form-row">
                        <!-- <div class="form-group col-md-6">
                            <label for="documentspecification_document">Document</label>
                            <div>
                                <select id="documentspecification_document" name="documentspecification_id" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['documentspecifications']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_document" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">File</label>
                            <input type="file" class="form-control" id="file_document" name="file" placeholder="Votre nom file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- MODAL AJOUT DOCUMENTS -->
<div id="modal_addannexe" class="modal fade addannexe" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un annexe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addannexe" accept-charset="UTF-8" ng-submit="addElement($event, 'annexe', {from:'modal', is_file_excel:false, index:null, status:null, champ:null, route:'da/soumission_upload', operation:'daannexe'})">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_annexe">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="annexespecification_annexe">annexe</label>
                            <div>
                                <select id="annexespecification_annexe" name="annexespecification_id" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['documentspecifications']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addprogrammelivraison" class="modal fade addprogrammelivraison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un programmelivraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addprogrammelivraison" accept-charset="UTF-8" ng-submit="addElement($event,'programmelivraison')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_programmelivraison">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_programmelivraison" name="designation" placeholder="Votre nom designation">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addtier" class="modal fade addtier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un tier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtier" accept-charset="UTF-8" ng-submit="addElement($event,'tier')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_tier">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_tier" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_tier" name="description" placeholder="Votre adresse description">
                        </div>
                        <!-- Image -->
                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_tier">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_tier" aria-describedby="inputGroupFileAddon">

                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<div id="modal_addchauffeur" class="modal fade addchauffeur" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un chauffeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="form_addchauffeur" accept-charset="UTF-8" ng-submit="addElement($event,'chauffeur')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_chauffeur">
                    <div class="form-row">
                        <div class="form-check">
                            <input id="estinterne_chauffeur" name="estinterne" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="estinterne_chauffeur"> est Interne ? </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">nom</label>
                            <input type="text" class="form-control" id="nom_chauffeur" name="nom" placeholder="Votre nom nom">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">adresse</label>
                            <input type="text" class="form-control" id="adresse_chauffeur" name="adresse" placeholder="Votre adresse">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">email</label>
                            <input type="text" class="form-control" id="email_chauffeur" name="email" placeholder="Votre email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">telephone</label>
                            <input type="text" class="form-control" id="telephone_chauffeur" name="telephone" placeholder="Votre adresse telephone">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addprogramme" class="modal fade addprogramme" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un programme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addprogramme" accept-charset="UTF-8" ng-submit="addElement($event,'programme')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_programme">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_programme" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Mission</label>
                            <input type="text" class="form-control" id="mission_programme" name="mission" placeholder="Votre adresse mission">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Objectif</label>
                            <input type="text" class="form-control" id="objectif_programme" name="objectif" placeholder="Votre adresse objectif">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="programmelivraison_zone">Programme livraison</label>
                            <div>
                                <select id="programmelivraison_programme" name="programmelivraison" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['programmelivraisons']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="equipegestion_programme"> Equiep Gestion</label>
                            <div>
                                <select id="equipegestion_programme" name="equipegestion" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['equipegestions']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bailleur_programme"> bailleurs</label>
                            <div>
                                <select id="bailleur_programme" name="bailleurs[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['bailleurs']" value="@{{ item.id }}">
                                        @{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="articles_programme"> Articles</label>
                            <div>
                                <select id="articles_programme" name="articles[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['articles']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addoffretransport" class="modal fade addoffretransport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un offre d'expédition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addoffretransport" accept-charset="UTF-8" ng-submit="addElement($event,'offretransport')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_offretransport">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_offretransport" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Mission</label>
                            <input type="text" class="form-control" id="mission_offretransport" name="mission" placeholder="Votre adresse mission">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Objectif</label>
                            <input type="text" class="form-control" id="objectif_offretransport" name="objectif" placeholder="Votre adresse objectif">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="offretransportlivraison_zone">offretransport livraison</label>
                            <div>
                                <select id="offretransportlivraison_offretransport" name="offretransportlivraison" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['offretransportlivraisons']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="equipegestion_offretransport"> Equiep Gestion</label>
                            <div>
                                <select id="equipegestion_offretransport" name="equipegestion" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['equipegestions']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bailleur_offretransport"> bailleurs</label>
                            <div>
                                <select id="bailleur_offretransport" name="bailleurs[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['bailleurs']" value="@{{ item.id }}">
                                        @{{ item.nom }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="articles_offretransport"> Articles</label>
                            <div>
                                <select id="articles_offretransport" name="articles[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['articles']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addphasedepot" class="modal fade addphasedepot" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un phasedepot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addphasedepot" accept-charset="UTF-8" ng-submit="addElement($event,'phasedepot')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_phasedepot">
                    <input type="hidden" name="campagne_id" id="campagne_id_phasedepot">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">date debut</label>
                            <input type="date" class="form-control" id="datedeb_phasedepot" name="datedeb" placeholder="Votre nom datedeb">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">date fin</label>
                            <input type="date" class="form-control" id="datefin_phasedepot" name="datefin" placeholder="Votre adresse datefin">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">designation</label>
                            <input type="text" class="form-control" id="designation_phasedepot" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">description</label>
                            <input type="text" class="form-control" id="description_phasedepot" name="description" placeholder="Votre nom description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addcampagne" class="modal fade addcampagne" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un campagne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addcampagne" accept-charset="UTF-8" ng-submit="addElement($event,'campagne')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_campagne">
                    <input type="hidden" name="programme_id" id="programme_id_campagne">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_campagne" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Date</label>
                            <input type="date" class="form-control" id="date_campagne" name="date" placeholder="Votre nom date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Date Fin</label>
                            <input type="date" class="form-control" id="datefin_campagne" name="datefin" placeholder="Votre nom datefin">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="article_campagne"> Planning cyclique</label>
                            <div>
                                <select id="province_campagne" name="province" ng-model="provinceselect" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['provinces']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="article_campagne"> Articles</label>
                            <div>
                                <select id="article_campagne" name="articles[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['articles']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>


                        <!-- Image -->
                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_campagne">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_campagne" aria-describedby="inputGroupFileAddon">
                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->

<!-- MODAL AJOUT COMMANDE -->
<div id="modal_addcommande" class="modal fade addcommandes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title">Ajouter une commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_addcommande" accept-charset="UTF-8" ng-submit="addElement($event,'commande')">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_commande" name="id">

                    <div class="form-row">
                        <!-- CLIENT -->
                        <div class="form-group col-md-6">
                            <label for="utilisateur_id_commande">Client</label>
                            <select class="form-control" id="utilisateur_id_commande" name="utilisateur_id">
                                <option value="">Sélectionner un client</option>
                                <option ng-repeat="user in dataPage['utilisateurs']" value="@{{ user.id }}">@{{ user.nom }} @{{ user.prenom }}</option>
                            </select>
                        </div>

                        <!-- NUMÉRO COMMANDE -->
                        <div class="form-group col-md-6">
                            <label for="numero_commande">Numéro de commande</label>
                            <input type="text" class="form-control" id="numero_commande" name="numero_commande" value="CMD-MCN-@{{ currentDate | date:'yyyy-MM' }}-001" readonly>
                        </div>

                        <!-- ADRESSE LIVRAISON -->
                        <div class="form-group col-md-12">
                            <label for="adresse_livraison_commande">Adresse de livraison</label>
                            <textarea class="form-control" id="adresse_livraison_commande" name="adresse_livraison" rows="2" placeholder="Adresse complète de livraison"></textarea>
                        </div>

                        <!-- PRODUITS -->
                        <div class="col-md-12 mt-4">
                            <h6>Produits commandés</h6>

                            <div class="form-row border p-3 mb-3">
                                <div class="form-group col-md-6">
                                    <label for="produit1_commande">Produit</label>
                                    <select class="form-control" id="produit1_commande" name="produits[]">
                                        <option value="">Sélectionner un produit</option>
                                        <option ng-repeat="produit in dataPage['produits']" value="@{{ produit.id }}">@{{ produit.nom }} - @{{ produit.prix }} FCFA</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantite1_commande">Quantité</label>
                                    <input type="number" class="form-control" id="quantite1_commande" name="quantites[]" value="1" min="1">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="prix1_commande">Prix unitaire (FCFA)</label>
                                    <input type="number" class="form-control" id="prix1_commande" name="prix_unitaire[]" value="0" min="0">
                                </div>
                            </div>

                            <div class="form-row border p-3 mb-3">
                                <div class="form-group col-md-6">
                                    <label for="produit2_commande">Produit</label>
                                    <select class="form-control" id="produit2_commande" name="produits[]">
                                        <option value="">Sélectionner un produit</option>
                                        <option ng-repeat="produit in dataPage['produits']" value="@{{ produit.id }}">@{{ produit.nom }} - @{{ produit.prix }} FCFA</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantite2_commande">Quantité</label>
                                    <input type="number" class="form-control" id="quantite2_commande" name="quantites[]" value="1" min="1">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="prix2_commande">Prix unitaire (FCFA)</label>
                                    <input type="number" class="form-control" id="prix2_commande" name="prix_unitaire[]" value="0" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL -->
                        <div class="form-group col-md-6">
                            <label for="total_commande">Total (FCFA)</label>
                            <input type="number" class="form-control" id="total_commande" name="total" value="0" min="0" readonly>
                        </div>

                        <!-- STATUT -->
                        <div class="form-group col-md-6">
                            <label for="statut_commande">Statut</label>
                            <select class="form-control" id="statut_commande" name="statut">
                                <option value="en_attente">En attente</option>
                                <option value="payee">Payée</option>
                                <option value="en_preparation">En préparation</option>
                                <option value="expediee">Expédiée</option>
                                <option value="livree">Livrée</option>
                                <option value="annulee">Annulée</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addequipegestion" class="modal fade addequipegestion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un equipegestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addequipegestion" accept-charset="UTF-8" ng-submit="addElement($event,'equipegestion')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_equipegestion">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_equipegestion" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_equipegestion" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="personnel_equipegestion">Personnel</label>
                            <div>
                                <select id="personnel_equipegestion" name="personnels[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['users']" value="@{{ item.id }}">
                                        @{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addequipegestionclient" class="modal fade addequipegestionclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un equipe gestion client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addequipegestionclient" accept-charset="UTF-8" ng-submit="addElement($event,'equipegestionclient')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_equipegestionclient">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="personnel_equipegestionclient">Client</label>
                            <div>
                                <select id="client_equipegestionclient" name="clients[]" multiple select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['clients']" value="@{{ item.id }}">
                                        @{{ item.designation }} - @{{ item.COMPTE_0 }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="username">Nom équipe</label>
                            <input type="text" class="form-control " id="designation_equipegestionclient" name="designation" placeholder="Nom équipe">
                        </div>

                        <div class="form-group col-md-6 mt-3" style="float: right !important;">
                            <button type="button" class="btn bg-theme-gradient rounded-2 border-none px-2 py-1 dropdown-toggle mt-3" ng-click="valideEquipeGestion()">
                                Valider
                            </button>
                        </div>


                        <div class="form-group col-md-4" ng-if="typeclients && typeclients.length > 0">
                            <label for="personnel_detailequipegestionclient_equipegestionclient">Fonction</label>
                            <div>
                                <select id="role_detailequipegestionclient_equipegestionclient" select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['roles']" value="@{{ item.id }}">
                                        @{{ item.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-4" ng-if="typeclients && typeclients.length > 0">
                            <label for="username">Login</label>
                            <input type="text" class="form-control " id="login_detailequipegestionclient_equipegestionclient" placeholder="Login">
                        </div>

                        <div class="form-group col-md-4" ng-if="typeclients && typeclients.length > 0">
                            <label for="password_user">Mot de passe</label>
                            <input type="password" class="form-control" id="password_detailequipegestionclient_equipegestionclient" placeholder="Votre mot de passe">
                        </div>

                        <div class="form-row">
                            <div class="form-check" ng-repeat="item in typeclients">
                                <input id="@{{item.id}}_detailequipegestionclient_equipegestionclient" class="form-check-input" type="checkbox" value="1">
                                <label class="form-check-label" for="@{{item.id}}_detailequipegestionclient_equipegestionclient"> @{{item.designation}} </label>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mt-3" style="float: right !important;" ng-if="typeclients && typeclients.length > 0">
                            <button type="button" class="btn bg-theme-gradient rounded-2 border-none px-2 py-1 dropdown-toggle mt-3" ng-click="addcompteclient()">
                                Ajouter un compte
                            </button>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">Fonction</th>
                                        <th scope="col">Login</th>
                                        <th scope="col">Mot de passe</th>
                                        <th scope="col">Type client</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataInTabPane.detailequipegestionclient_equipegestionclient.data">
                                        <td class="text-dark">@{{ item.role.name }}</td>
                                        <td>@{{ item.login }}</td>
                                        <td>
                                            @{{ item.mdp }}
                                        </td>
                                        <td>

                                            <div ng-repeat="type in item.typeclients">
                                                @{{ type.designation }} /
                                            </div>

                                        </td>
                                        <td>
                                            <button type="button" class="btn shadow text-danger btn-light btn-sm" ng-click="addcompteclient('delete')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_adddocumentspecification" class="modal fade adddocumentspecification" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un documentspecification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_adddocumentspecification" accept-charset="UTF-8" ng-submit="addElement($event,'documentspecification')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_documentspecification">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_documentspecification" name="designation" placeholder="Votre nom designation">
                        </div>
                        <!--<div class="form-group col-md-6">
                            <label for="mail">nature</label>
                            <input type="text" class="form-control" id="nature_documentspecification" name="nature" placeholder="Votre adresse nature">
                        </div>-->

                        <div class="form-group col-md-6">
                            <input id="filedoc_remisedureedevie" name="typeduree" class="form-check-input" type="checkbox" value="1" ng-model="filedoc" ng-true-value="1" ng-false-value="0">
                            <label class="form-check-label" for="typeduree_remisedureedevie"> Document </label>
                        </div>

                        <div class="form-group col-md-6">
                            <input id="textdoc_remisedureedevie" name="typeduree" class="form-check-input" type="checkbox" value="1" ng-model="textdoc" ng-true-value="1" ng-false-value="0">
                            <label class="form-check-label" for="typeduree_remisedureedevie"> Text </label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="typemarche_documentspecification">Type marche</label>
                            <div>
                                <select id="typemarche_documentspecification" name="typemarche_id[]" multiple="[]" select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['typemarches']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="typemarche_documentspecification">Categorie marché</label>
                            <div>
                                <select id="categoriedas_documentspecification" name="categoriedas_id[]" multiple="[]" select2 class="form-control " style="width: 100%">
                                    <option ng-repeat="item in categoriedas" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="etape_documentspecification">Etape</label>
                            <div>
                                <select id="etape_documentspecification" name="etape" select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option value="{{ \App\Enums\Etape::SOUMISSION }}">{{ \App\Enums\Etape::getText(\App\Enums\Etape::SOUMISSION) }}</option>
                                    <option value="{{ \App\Enums\Etape::SUIVI_MARCHE }}">{{ \App\Enums\Etape::getText(\App\Enums\Etape::SUIVI_MARCHE) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="section_documentspecification">Section</label>
                            <div>
                                <select id="section_documentspecification" name="section" select2 class="form-control " style="width: 100%">
                                    <option selected disabled>Choisir...</option>
                                    <option value="{{ \App\Enums\Section::CAUTION }}">{{ \App\Enums\Section::getText(\App\Enums\Section::CAUTION) }}</option>

                                    <option value="{{ \App\Enums\Section::TRANSITE }}">{{ \App\Enums\Section::getText(\App\Enums\Section::TRANSITE) }}</option>
                                    <option value="{{ \App\Enums\Section::EXPERT }}">{{ \App\Enums\Section::getText(\App\Enums\Section::EXPERT) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- MODAL AJOUT ZONE -->
<div id="modal_addzone" class="modal fade addzone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une zone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="form_addzone" accept-charset="UTF-8" ng-submit="addElement($event,'zone')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_zone">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_zone" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_zone" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="antenne_zone">Antenne</label>
                            <div>
                                <select id="antenne_zone" name="antenne" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['antennes']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="antenne_zone">Zone parent</label>
                            <div>
                                <select id="parent_zone" name="parent" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addcategorie" class="modal fade addcategorie" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="form_addcategorie" accept-charset="UTF-8" ng-submit="addElement($event,'categorie')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_categorie">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_categorie">Designation</label>
                            <input type="text" class="form-control" id="designation_categorie" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_categorie">Description</label>
                            <input type="text" class="form-control" id="description_categorie" name="description" placeholder="Votre adresse description">
                        </div>

                        <div class="mr-3 w-100">
                            <label for="">Categorie</label>
                            <select id="categorie_categorie" name="categorie_id" select2 class="form-select">
                                <option value="">Choisir une categorie</option>
                                <option ng-repeat="categorie in dataPage['categories']" value="@{{ categorie.id }}">
                                    @{{ categorie.designation }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>







<!-- MODAL AJOUT remisedureedevie -->
<div id="modal_addremisedureedevie" class="modal fade addremisedureedevie" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une remisedureedevie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="form_addremisedureedevie" accept-charset="UTF-8" ng-submit="addElement($event,'remisedureedevie')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_remisedureedevie">
                    <div class="form-row">
                        <div class="form-check">
                            <input id="typeduree_remisedureedevie" name="typeduree" class="form-check-input" type="checkbox" value="1" ng-model="valeurremisedureedevie" ng-true-value="1" ng-false-value="0">
                            <label class="form-check-label" for="typeduree_remisedureedevie"> @{{valeurremisedureedevie==0 ?'normal':'courte durée'}} </label>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="moinsnim_remisedureedevie">Mois min</label>
                            <input type="text" class="form-control" id="moinsnim_remisedureedevie" name="moinsnim" placeholder="Votre adresse moinsnim">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="moismax_remisedureedevie">Mois max</label>
                            <input type="text" class="form-control" id="moismax_remisedureedevie" name="moismax" placeholder="Votre adresse moismax">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="remisepourcentage_remisedureedevie">Remise %</label>
                            <input type="number" class="form-control" min="0.00" id="remisepourcentage_remisedureedevie" name="remisepourcentage" placeholder="Votre adresse remisepourcentage">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="remisevaleur_remisedureedevie">Remise valeur</label>
                            <input type="number" class="form-control" id="remisevaleur_remisedureedevie" name="remisevaleur" placeholder="Votre adresse remisevaleur">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>







<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addcategoriepointdevente" class="modal fade addcategoriepointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une categoriepointdevente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addcategoriepointdevente" accept-charset="UTF-8" ng-submit="addElement($event,'categoriepointdevente')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_categoriepointdevente">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_categoriepointdevente">Designation</label>
                            <input type="text" class="form-control" id="designation_categoriepointdevente" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_categoriepointdevente">Description</label>
                            <input type="text" class="form-control" id="description_categoriepointdevente" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addtypepointdevente" class="modal fade addtypepointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une typepointdevente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypepointdevente" accept-charset="UTF-8" ng-submit="addElement($event,'typepointdevente')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typepointdevente">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_typepointdevente">Designation</label>
                            <input type="text" class="form-control" id="designation_typepointdevente" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_typepointdevente">Description</label>
                            <input type="text" class="form-control" id="description_typepointdevente" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addmesure" class="modal fade addmesure" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une mesure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addmesure" accept-charset="UTF-8" ng-submit="addElement($event,'mesure')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_mesure">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_mesure">Designation</label>
                            <input type="text" class="form-control" id="designation_mesure" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_mesure">Description</label>
                            <input type="text" class="form-control" id="description_mesure" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addtypeclient" class="modal fade addtypeclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une typeclient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypeclient" accept-charset="UTF-8" ng-submit="addElement($event,'typeclient')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typeclient">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_typeclient">Designation</label>
                            <input type="text" class="form-control" id="designation_typeclient" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_typeclient">Description</label>
                            <input type="text" class="form-control" id="description_typeclient" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addcategorieclient" class="modal fade addcategorieclient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une categorieclient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addcategorieclient" accept-charset="UTF-8" ng-submit="addElement($event,'categorieclient')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_categorieclient">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_categorieclient">Designation</label>
                            <input type="text" class="form-control" id="designation_categorieclient" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_categorieclient">Description</label>
                            <input type="text" class="form-control" id="description_categorieclient" name="description" placeholder="Votre adresse description">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT EQUIPEMENT -->
<div id="modal_addtypetier" class="modal fade addtypetier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter un typetier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypetier" accept-charset="UTF-8" ng-submit="addElement($event,'typetier')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typetier">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="designation_typetier" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="text" class="form-control" id="description_typetier" name="description" placeholder="Votre adresse description">
                        </div>
                        <!-- Image -->
                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_typetier">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_typetier" aria-describedby="inputGroupFileAddon">

                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addmodepaiement" class="modal fade addmodepaiement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une modepaiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addmodepaiement" accept-charset="UTF-8" ng-submit="addElement($event,'modepaiement')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_modepaiement">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_modepaiement">Designation</label>
                            <input type="text" class="form-control" id="designation_modepaiement" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="desc_modepaiement">desc</label>
                            <input type="text" class="form-control" id="desc_modepaiement" name="desc" placeholder="Votre adresse desc">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_modepaiement">code</label>
                            <input type="text" class="form-control" id="code_modepaiement" name="code" placeholder="Votre adresse code">
                        </div>
                        <!-- Image  -->
                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <label class="input-group-text shadow" for="image_modepaiement">
                                    <input type="file" style="border: none;background: transparent" name="image" class="form-control w-50" id="image_modepaiement" aria-describedby="inputGroupFileAddon">

                                    <i class="fas fa-image fa-lg"></i> Choisissez une Image
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imgurl">Image Url</label>
                            <input type="text" class="form-control" id="imgurl_modepaiement" name="imgurl" placeholder="Votre  imgurl">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT unite -->
<div id="modal_addunite" class="modal fade addunite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une unite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addunite" accept-charset="UTF-8" ng-submit="addElement($event,'unite')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_unite">
                    <!-- <div class="form-row">
                        <div class="form-check">
                            <input id="ispack_role" name="ispack" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="ispack_role"> pack ? </label>
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_unite">Designation</label>
                            <input type="text" class="form-control" id="designation_unite" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_unite">Description</label>
                            <input type="text" class="form-control" id="description_unite" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_unite">Code</label>
                            <input type="text" class="form-control" id="code_unite" name="code" placeholder="Votre adresse code">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT axe -->
<div id="modal_addaxe" class="modal fade addaxe" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une axe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addaxe" accept-charset="UTF-8" ng-submit="addElement($event,'axe')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_axe">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_axe">Designation</label>
                            <input disabled type="text" class="form-control" id="designation_axe" name="designation" placeholder="Votre nom designation">
                        </div>

                        <div class="form-group col-md-6 mt-4">
                            <select id="province_id_axe" name="province" class="form-select mt-4" select2 style="width: 50%">
                                <option value="">Choissir une province</option>
                                <option ng-repeat="item in dataPage['provinces']" value="@{{ item.id }}">
                                    @{{ item.province }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-6 mt-4">
                            <select id="tonnage_id_axe" name="tonnages[]" multiple="[]" class="form-select mt-4" select2 style="width: 50%">
                                <option ng-repeat="item in dataPage['tonnages']" value="@{{ item.id }}">
                                    @{{ item.designation }} / @{{ item.tonnage }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="modal_addfournisseur" class="modal fade addfournisseur" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Modification infos fournisseur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addfournisseur" accept-charset="UTF-8" ng-submit="addElement($event,'fournisseur')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_fournisseur">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_fournisseur">Designation</label>
                            <input disabled type="text" class="form-control" id="nom_fournisseur" placeholder="Votre nom designation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code_fournisseur">Score</label>
                            <input type="number" class="form-control" id="score_fournisseur" name="score" placeholder="Score fournisseur">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<!-- MODAL AJOUT typemarche -->
<div id="modal_addtypemarche" class="modal fade addtypemarche" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une typemarche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtypemarche" accept-charset="UTF-8" ng-submit="addElement($event,'typemarche')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_typemarche">
                    <div class="form-row">
                        <div class="form-check">
                            <input id="TSSCOD_0_0_1_ficheevaluation" name="type_marche" class="form-check-input" type="radio" value="1" ng-model="selectedTypeMarche" ng-change="onChangeTypeMarche()">
                            <label class="form-check-label" for="TSSCOD_0_0_1_ficheevaluation"> MEDICAMENT ? </label>
                        </div>
                        <div class="form-check">
                            <input id="TSSCOD_0_0_2_ficheevaluation" name="type_marche" class="form-check-input" type="radio" value="2" ng-model="selectedTypeMarche" ng-change="onChangeTypeMarche()">
                            <label class="form-check-label" for="TSSCOD_0_0_2_ficheevaluation"> BIENS ET SERVICES ? </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="designation_typemarche">Designation</label>
                            <input type="text" class="form-control" id="designation_typemarche" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="description_typemarche">Description</label>
                            <input type="text" class="form-control" id="description_typemarche" name="description" placeholder="Votre adresse description">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="code_typemarche">Code</label>
                            <input type="text" class="form-control" id="code_typemarche" name="code" placeholder="Votre adresse code">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="programmelivraison_zone">Parcours</label>
                            <div>
                                <select id="parcourmarche_id_typemarchedetails" name="parcourmarche_id_typemarchedetails" select2 class="form-control " style="width: 100%">
                                    <option selected>Choisir...</option>
                                    <option ng-repeat="item in dataPage['parcourmarches']" value="@{{ item.id }}">
                                        @{{ item.designation }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="code_typemarche">Position</label>
                            <input type="numer" class="form-control" id="position_typemarchedetails" name="position_typemarchedetails" placeholder="Votre adresse code">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="code_typemarche">Workflow</label>
                            <select id="role_typemarchedetails" select2 multiple=[] style="width: 100%;">
                                <option ng-repeat="item in dataPage['roles']" value="@{{ item.id }}">
                                    @{{ item.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="button" class="btn bg-theme-gradient rounded-2 border-none px-2 py-1 dropdown-toggle mt-4" ng-click="addtypemarchedetails()">
                                <img src="{{ asset('images/icon_plus.png') }}" class="icon-size" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Parcours</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Workflow</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataInTabPane.typemarchedetails_typemarche.data">
                                    <td class="text-dark">@{{ item.parcourmarche.designation }}</td>
                                    <td>@{{ item.position }}</td>
                                    <td>

                                        <div ng-repeat="role in item.roles">
                                            @{{ role.name }} /
                                        </div>

                                    </td>
                                    <td>
                                        <button type="button" class="btn shadow text-danger btn-light btn-sm" ng-click="addtypemarchedetails($index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT tonnage -->
<div id="modal_addtonnage" class="modal fade addtonnage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une tonnage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addtonnage" accept-charset="UTF-8" ng-submit="addElement($event,'tonnage')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_tonnage">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="designation_tonnage">Designation</label>
                            <input type="text" class="form-control" id="designation_tonnage" name="designation" placeholder="Votre nom designation">
                        </div>
                        <!--                        <div class="form-group col-md-6">-->
                        <!--                            <label for="tonnage_tonnage">Valeur</label>-->
                        <!--                            <input type="number" step="0.01" class="form-control" id="tonnage_tonnage" name="tonnage" placeholder="...........">-->
                        <!--                        </div>-->
                        <div class="mt-2 col-md-12">
                            <h5 class="text-dark">Tonnage (T)</h5>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="min_tonnage">Min</label>
                            <input type="number" step="0.01" class="form-control" id="min_tonnage" name="min" placeholder="...........">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="max_tonnage">Max</label>
                            <input type="number" step="0.01" class="form-control" id="max_tonnage" name="max" placeholder="...........">
                        </div>

                        <div class="mt-3 col-md-12">
                            <h5 class="text-dark">Volume(m3)</h5>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="min_tonnage">Min</label>
                            <input type="number" step="0.01" class="form-control" id="min_tonnage" name="min" placeholder="...........">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="max_tonnage">Max</label>
                            <input type="number" step="0.01" class="form-control" id="max_tonnage" name="max" placeholder="...........">
                        </div>


                        <!--                        <div class="form-group col-md-6">-->
                        <!--                            <label for="description_tonnage">Unite de mesure</label>-->
                        <!--                            <select id="unite_tonnage" class="form-select " name="unite_id" select2 style="width: 50%">-->
                        <!--                                <option value="">Unite de mesure</option>-->
                        <!--                                <option ng-repeat="item in dataPage['unites']" value="@{{ item.id }}">-->
                        <!--                                    @{{ item.designation }}-->
                        <!--                                </option>-->
                        <!--                            </select>-->
                        <!--                        </div>-->

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT antenne -->
<div id="modal_addantenne" class="modal fade addantenne" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une antenne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
                <form id="form_addantenne" accept-charset="UTF-8" ng-submit="addElement($event,'antenne')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_antenne">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_antenne">Designation</label>
                            <input type="text" class="form-control" id="designation_antenne" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_antenne">code</label>
                            <input type="text" class="form-control" id="code_antenne" name="code" placeholder="Votre adresse code">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_addcategorietarifaire" class="modal fade addcategorietarifaire" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une categorietarifaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addcategorietarifaire" accept-charset="UTF-8" ng-submit="addElement($event,'categorietarifaire')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_categorietarifaire">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="designation_categorietarifaire">Designation</label>
                            <input type="text" class="form-control" id="designation_categorietarifaire" name="designation" placeholder="Votre nom designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description_categorietarifaire">Description</label>
                            <input type="text" class="form-control" id="description_categorietarifaire" name="description" placeholder="Votre adresse description">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_adddetaillivraison" class="modal fade adddetaillivraison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une detaillivraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_adddetaillivraison" accept-charset="UTF-8" ng-submit="addElement($event,'detaillivraison')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_detaillivraison">
                    <input type="hidden" name="visite_id" id="visite_id_detaillivraison">
                    <div class="mb-3 " ng-cloak>
                        <label for="selectProduit" class="form-label me-2">Produit:</label>
                        <div class="d-flex align-items-center">
                            <div class="input-group flex-grow-1">
                                <select id="produit_detaillivraison" class="form-select " select2 style="width: 50%">
                                    <option value="">Choissir un produit</option>
                                    <option ng-repeat="item in dataPage['produits']" value="@{{ item.id }}">
                                        @{{ item.designation }}
                                    </option>
                                </select>
                                <input type="number" class="form-control " id="quantite_detaillivraison">
                            </div>
                            <button class="btn btn-outline-success rounded" type="button" id="ajouterProduit" ng-click="addProductIntTab2('produit_detaillivraison','produits','produit_detaillivraison','quantite_detaillivraison')">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index,item) in dataInTabPane.produit_detaillivraison.data">
                                    <td class="text-dark">@{{ item.designation }}</td>
                                    <td>@{{ item.quantity }}</td>
                                    <td>
                                        <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'produit_detaillivraison',index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJOUT CATEGORIE -->
<div id="modal_adddetailmateriel" class="modal fade adddetailmateriel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une detailmateriel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_adddetailmateriel" accept-charset="UTF-8" ng-submit="addElement($event,'detailmateriel')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_detailmateriel">
                    <input type="hidden" name="visite_id" id="visite_id_detailmateriel">

                    <div class="mb-3 " ng-cloak>

                        <div class="form-row row bg-transparent shadow-none  m-0 p-0 justify-content-between align-items-center">
                            <div class="col-12 col-md-5 mb-2  mt-3 mb-md-0 ">
                                <select id="type_detailmateriel" name="type" class="form-select " select2>
                                    <option value="" selected disabled>Type Livraison </option>
                                    <option value="2">
                                        Demande
                                    </option>
                                    <option value="1">
                                        Livraison
                                    </option>
                                    <option value="0">
                                        Recupereration
                                    </option>
                                </select>
                            </div>
                        </div>

                        <label for="selectProduit" class="form-label  mx-3">Equipement:</label>
                        <div class=" row bg-transparent shadow-none  m-0 p-0 justify-content-between align-items-center">
                            <div class="col-12 col-md-5 mb-2  mt-3 mb-md-0 ">
                                <select id="equipement_detailmateriel" class="form-select " select2 style="width: 50%">
                                    <option value="">Choissir un equipement</option>
                                    <option ng-repeat="item in dataPage['equipements']" value="@{{ item.id }}">
                                        @{{ item.designation }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-5    mb-2 mb-md-0">
                                <input type="number" class="form-control " id="quantite_detailmateriel">
                            </div>
                            <div class="col-12 col-md-2 text-end">
                                <button class="btn btn-outline-success w-50 rounded-pill btn-custom" type="button" id="ajouterProduit" ng-click="addProductIntTab2('equipement_detailmateriel','equipements','equipement_detailmateriel','quantite_detailmateriel')">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(index,item) in dataInTabPane.equipement_detailmateriel.data">
                                    <td class="text-dark">@{{ item.designation }}</td>
                                    <td>@{{ item.quantity }}</td>
                                    <td>
                                        <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'equipement_detailmateriel',index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- MODAL AJOUT PREFERENCE -->


<div id="modal_addpreference" class="modal fade addpreference" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Ajouter une preference</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body ">
                <form id="form_addpreference" accept-charset="UTF-8" ng-submit="addElement($event,'preference')">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_preference">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">NOMBRE UTILISATEUR</label>
                            <input type="text" class="form-control" id="nbreutilisateur_preference" name="nbreutilisateur" placeholder="Votre  nombre d'utilisateur">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">NINEA</label>
                            <input type="text" class="form-control" id="ninea_preference" name="ninea" placeholder="Votre  ninea">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Sauvegarder</button>
                        <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- MODAL Planning -->
<div id="modal_addplanning" class="modal fade addzone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Planning @{{ title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body ">
                <form id="form_addplanning" accept-charset="UTF-8" ng-submit="addElement($event,'planning')">


                    {{ csrf_field() }}
                    <input type="hidden" id="id_planning" name="id">
                    <input type="hidden" id="date_planning" name="date">
                    <input type="hidden" id="datesemaine_planning" name="datesemaine">
                    <input type="hidden" id="user_planning" name="user">

                    <div class="form-group py-3" id="update_jour_planning">
                        <label for="jours_planning">Jours</label>
                        <select id="jour_planning" select2 multiple=[] style="width: 100%;">
                            <option selected disabled>Choisir...</option>
                            <option ng-repeat="item in dataPage['planninghebdomadaires'][0].jours" value="@{{ item.id }}" ng-if="(item.id + 1 ) > dayFilter">
                                @{{ item.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group py-3">
                        <label for="SelectRole">Zones</label>
                        <select id="zone_planning" name="zone" select2 multiple=[] style="width: 100%;">
                            <option selected disabled>Choisir...</option>
                            <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                                @{{ item.designation }}
                            </option>
                        </select>
                    </div>


                    <div id="planning-comm-section" class="form-group row bg-transparent shadow-none py-2 justify-content-between align-items-center ">


                        <!-- <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle">
                                <caption></caption>
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Zone</th>
                                        <th>Activité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in dataIndetail">
                                        <th class="align-middle">
                                            @{{ item.zone_name }}
                                        </th>
                                        <td>
                                            <p ng-repeat="subitem in item.items">
                                                <span
                                                    ng-if="subitem.requette.designation && subitem.reglement.designation">
                                                    &rarr; @{{ subitem.requette.designation }}
                                                    <br>
                                                    &rarr; @{{ subitem.reglement.designation }}
                                                </span>
                                                <span
                                                    ng-if="!subitem.requette.designation && subitem.reglement.designation">
                                                    &rarr; @{{ subitem.reglement.designation }}
                                                </span>
                                                <span
                                                    ng-if="subitem.requette.designation && !subitem.reglement.designation">
                                                    &rarr; @{{ subitem.requette.designation }}
                                                </span>
                                            </p>

                                        </td>


                                    </tr>
                                </tbody>
                            </table>
                        </div> -->

                        <div class="row my-2 bg-transparent shadow-none">
                            <div class="col-md-6">
                                <label for="planninguser_planning"> Associer </label>
                                <select id="planninguser_planning" name="users[]" select2 style="width: 100%;" multiple>
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['users']" value="@{{ item.id }}">
                                        @{{ item.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="voiture_planning">Voiture</label>
                                <select id="voiture_planning" name="voiture" select2 style="width: 100%;">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['voitures']" value="@{{ item.id }}">
                                        @{{ item.marque }} @{{ item.matricule }}
                                    </option>
                                </select>
                            </div>



                            <div class=" col-md-4">
                                <label for="chauffeur_planning">Chauffeur:</label>
                                <select id="chauffeur_planning" name="chauffeur" select2 style="width: 100%;">
                                    <option selected disabled>Choisir...</option>
                                    <option ng-repeat="item in dataPage['users']" ng-if="item.role.ischauffeur == 1" value="@{{ item.id }}">
                                        @{{ item.name }}</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="montant_planning">Budget:</label>
                                <input type="text" id="montant_planning" class="form-control" name="budget" ng-model="montant">
                            </div>

                        </div>

                        <div class="form-group row bg-transparent shadow-none  justify-content-between align-items-center">
                            <label for="selectProduit" class="form-label me-2">Produit:</label>
                            <div class="form-group row bg-transparent shadow-none  justify-content-between align-items-center">
                                <div class="col-12 col-md-5 mb-2  mt-3 mb-md-0">
                                    <select id="produit_planning" class="form-select mt-4 w-100" select2>
                                        <option value="">Choisir un produit</option>
                                        <option ng-repeat="item in dataPage['produits']" value="@{{ item.id }}">
                                            @{{ item.designation }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-5 mb-2 mb-md-0">
                                    <input type="number" class="form-control w-100" id="quantite_planning" placeholder="Quantité">
                                </div>
                                <div class="col-12 col-md-2 text-end">
                                    <button class="btn btn-outline-success w-50 rounded-pill btn-custom" type="button" id="ajouterProduit" ng-click="addProductIntTab()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                        </div>




                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(index,item) in dataInTabPane.produit_planning.data">
                                        <td class="text-dark">@{{ item.designation }}</td>
                                        <td>@{{ item.quantity }}</td>
                                        <td>

                                            <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'produit_planning',index)">

                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row bg-transparent shadow-none  justify-content-between align-items-center ">
                            <label for="selectProduit" class="form-label me-2">Equipement:</label>
                            <div class="form-group row bg-transparent shadow-none  justify-content-between align-items-center">
                                <div class="col-12 col-md-5 mb-2  mt-3 mb-md-0">
                                    <select id="equipement_planning" class="form-select mt-4 w-100" select2>
                                        <option value="">Choisir un equipement</option>
                                        <option ng-repeat="item in dataPage['equipements']" value="@{{ item.id }}">
                                            @{{ item.designation }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-5 mb-2 mb-md-0">
                                    <input type="number" class="form-control w-100" id="quantiteequipement_planning" placeholder="Quantité">
                                </div>
                                <div class="col-12 col-md-2 text-end">
                                    <button class="btn btn-outline-success w-50 rounded-pill btn-custom" type="button" id="ajouterProduit" ng-click="addProductIntTab2('equipement_planning','equipements','equipement_planning','quantiteequipement_planning')">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Materiel</th>
                                        <th scope="col">qte</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="(index,item) in dataInTabPane.equipement_planning.data">
                                        <td class="text-dark">@{{ item.designation }}</td>
                                        <td>@{{ item.quantity }}</td>
                                        <td>

                                            <button class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'equipement_planning',index)">

                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>




                    <div id="planning-auther-section">
                        <!-- Champ Address -->
                        <div class="form-group">
                            <label for="address_planning">Address</label>

                            <div class="input-group flex-grow-1 ml-1">
                                <input type="text" id="address_planning" name="address" class="form-control" placeholder="Entrez l'adresse">
                            </div>
                        </div>
                        <!-- Champ Commentaire -->
                        <div class="form-group ">
                            <label for="commentaire_planning">Commentaire</label>
                            <div class="input-group flex-grow-1 ml-1">
                                <textarea id="commentaire_planning" class="form-control" name="commentaire" rows="4" placeholder="Entrez votre commentaire"></textarea>
                            </div>
                        </div>


                    </div>

            </div>




            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>






<div id="modal_adddemande" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Detail Demande </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body ">
                <form id="form_adddemande" accept-charset="UTF-8" class="py-3">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_demande" name="id">

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="pointdevente_demande">Pointdevente</label> <br>
                            <select select2 style="width: 100%" id="pointdevente_demande" name="pointdevente" class="form-control ">
                                <option selected disabled>Choisir...</option>
                                <option ng-repeat="item in dataPage['pointdeventes']" value="@{{ item.id }}">
                                    @{{ item.intitule }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="commercial_demande">Commercial</label> <br>
                            <select select2 id="commercial_demande" style="width: 100%" name="commercial" class="form-control ">
                                <option selected disabled>Choisir...</option>
                                <option ng-repeat="item in dataPage['users']" value="@{{ item.id }}">
                                    @{{ item.name }}
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group col-md-6 p-0 m-0">
                        <label for="date_demande">DATE</label>
                        <input type="date" class="form-control" id="date_demande" name="date">
                    </div>

                    <div class="table-responsive py-4">
                        <table class="table table-bordered text-center align-middle">
                            <caption></caption>
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>ELEMENT</th>
                                    <th>QUANTITE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataInTabPane.demandes_demande.data">
                                    <td>@{{ item.equipement.designation }}</td>
                                    <td>@{{ item.quantite }}</td>
                                    <td>
                                        <button type="button" class="btn shadow text-danger btn-light btn-sm" ng-click="deletObjetInDataTabePane(null,'demandes_demande',index)">

                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">

                    <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- MODAL EDIT USER -->
<div class="modal fade editusers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Modifier les informations de l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body black">
                <form style="color:black">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Example label</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Another label</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJOUT POINT DE VENTE -->
<div id="AjoutModal" class="modal fade editpointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Modifier un point de vente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body ">
                <form>
                    {{ csrf_field() }}
                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="username">Designation</label>
                            <input type="text" class="form-control" id="username" placeholder="Votre nom d'utilisateur">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Description</label>
                            <input type="password" class="form-control" id="mail" placeholder="Votre adresse mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mail">Address</label>
                            <input type="password" class="form-control" id="mail" placeholder="Votre adresse mail">
                        </div>


                        <div class="form-group2">
                            <label for="SelectRole">Client</label>
                            <select id="SelectRole" class=" " select2 style="width: 50%">
                                <option selected>Choisir...</option>
                                <option ng-repeat="client in clients " value="client.id">
                                    @{{ client.nom }}
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6" x-data="{ fileName: '' }">
                            <label for="image">Image</label>
                            <div class="input-group shadow">
                                <span class="input-group-text px-3 text-muted"><i class="fas fa-image fa-lg"></i></span>
                                <input type="file" id="formFile2">

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 py-2">
                        <button style="color:white;background-color: var(--sedima_jaune_sombre);" type="button" class="btn">Coordonne</button>
                        <label for="">Coordonne indisponible</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL EDIT roles -->
<div class="modal fade editroles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Modifier role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body black">
                <form style="color:black">

                    {{ csrf_field() }}
                    <div class="form-group2">
                        <label for="NewRole">Nouveau rôle</label>
                        <input id="NewRole" ng-model="newRole" class="form-control" type="text" placeholder="Entrez un nouveau rôle">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button style="color:white;background-color: var(--sedima_jaune_sombre);" ng-click="addRole()" type="button" class="btn">Sauvegarder</button>
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL DETAIL CLIENT POINTDEVENTE -->

<div class="modal fade detailpointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Detail Point De Vente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body black">
                <form style="color:black">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Designation</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Address</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">latitude</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">longitude</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>


                    <div class="form-group2">
                        <label for="SelectRole">Client</label>
                        <select id="SelectRole" class="form-control " select2>
                            <option selected>Choisir...</option>
                            <option ng-repeat="client in clients " value="client.id">
                                @{{ client.nom }}
                            </option>
                        </select>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>

        </div>
    </div>
</div>



<!-- MODAL DETAIL  POINTDEVENTE CLIENT -->

<div class="modal fade detailclientpointdevente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-themeModal">
                <h5 class="modal-title ">Detail Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body black">
                <form style="color:black">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nom</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Address</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Tel</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Email</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-submit">Sauvegarder</button>
                <button type="button" class="btn btn-fermer" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
            </div>

        </div>
    </div>
</div>





@endsection