@if (Auth::user()->can('liste-client'))

<div>
    <div class=" card-module-info mb-4 ">
        <div class="card-info-icon   rounded">
            <i class="fas fa-users"></i>
        </div>
        <div class="idee d  w-100">
            <div class="idee-info">
                <p class="me-2">Clients</p>
                <span class="user-count bg-white">@{{ paginations['client'].totalItems }}</span>
            </div>

            <div class="add-button m-0 p-0 ">
                <button class="btn bg-theme-gradient btn-gradient dropdown-toggle" data-bs-toggle="dropdown">
                    <!-- <i class="fa fa-plus"></i> -->
                    Ajouter
                </button>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('client')">
                        <i class="fas fa-user-plus"></i> Ajouter un client
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('client', {is_file_excel:true, title: 'Ajouter plusieurs users'})">
                        <i class="fas fa-users"></i> Ajouter plusieurs clients
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="card mb-4  m-0 p-0 border-0">
        <div class="card-header m-0 p-0 bg-white  ">
            <div ng-click="filter()" class="d-flex justify-content-between align-items-center m-0 p-2">
                <p class="m-0"><i class="fa fa-filter icons-color"></i> Filtre</p>
                <div class="card-action">
                    <a class="arrow-content d-flex align-items-center justify-content-center p-3">
                        <i style="font-size: 21px;" class="fa fa-@{{ SearchIcon }}"></i>
                    </a>
                </div>
            </div>
        </div>

        <div ng-show='search' class="card-content">

            <div class="card-body bg-white">
                <div class="row w-100 m-auto bg-white shadow-none m-0 p-0 g-0 ">
                    <!-- Rechercher par -->
                    <div class="col-md-4 ">
                        <select id="searchoption_list_client" name="searchoption" select2 style="width: 100%">
                            <option value="">Rechercher par </option>
                            <option value="designation">designation </option>
                            <option value="numbcpttier">numero compte tier</option>
                            <option value="cptcollectif">numero compte collectif</option>

                        </select>
                    </div>

                    <!-- Input de recherche -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <input type="text" class=" form-control filtre" id="searchtexte_list_client" ng-model="searchtexte_list_client" placeholder="Chercher par adresse intitule">
                    </div>


                    <!-- Rechercher par profil -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <select id="typeclient_list_client" select2 style="width: 100%">
                            <option value="">Rechercher par type</option>
                            <option ng-repeat="item in dataPage['typeclients']" value="@{{ item.id }}">
                                @{{ item.designation }}</option>
                        </select>
                    </div>
                </div>

            </div>


            <div class="card-footer bg-white">
                <div class="row bg-white shadow-none  ">
                    <!-- Section PDF/Excel -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 text-center text-md-start">
                        <button profil="button" class="btn btn-danger me-2 rounded-pill btn-custom">
                            <i class="fa fa-file-pdf"></i> PDF
                        </button>
                        <button profil="button" class="btn btn-success rounded-pill btn-custom">
                            <i class="fa fa-file-excel"></i> Excel
                        </button>
                    </div>

                    <!-- Section Annuler/Filtrer -->
                    <div class="col-md-8 col-12 text-center text-md-end">
                        <button profil="button" class="btn btn-outline-dark mx-2 rounded-pill btn-custom" ng-click="emptyform('client', true)">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button profil="button" class="btn btn-dark rounded-pill btn-custom" ng-click="pageChanged('client')">
                            <i class="fa fa-search"></i> Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="card-table">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>COMPTE_0</th>
                        <th>Designation</th>
                        <th>Categorie client</th>
                        <th>Type client</th>
                        <th>Axe </th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class=" intro-x" ng-repeat="item in dataPage['clients']">
                        <td> @{{ item.COMPTE_0 }}</td>
                        <td> @{{ item.designation }}</td>
                        <td> @{{ item.categorieclient ? item.categorieclient.designation : '........' }}</td>
                        <td> @{{ item.TYPE_CLIENT_0}}</td>
                        <td> @{{ item.axe ? item.axe.designation : '........' }}</td>
                        <td>
                            <div class="gooey-menu">
                                <input type="checkbox" class="open-menus" name="open-menus" style="display:none;" id="chc-@{{ item.id }}" />

                                <label for="chc-@{{ item.id }}">
                                    <div class="button">
                                        <div class="burger"></div>
                                    </div>
                                </label>

                                <div data-toggle="modal" class="button press" ng-click="showModalCompteCLient('client',item.id)">
                                    <i style="margin-left: 15%;margin-top: 25%;" class="fa fa-info"></i>
                                </div>

                                @if (Auth::user()->can('modification-client'))

                                <div data-toggle="modal" class="button press" ng-click="showModalUpdate('client',item.id)">
                                    <i style="margin-left: 15%;margin-top: 25%;" class="fa fa-edit"></i>
                                </div>

                                @endif

                                @if (Auth::user()->can('suppression-client'))

                                <div class="button press">
                                    <i style="margin-left: 5%;margin-top: 25%;" class="fa fa-trash" ng-click="deleteElement('client',item.id)"></i>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class=" d-flex justify-content-between align-items-center">
            <div class="">
                <span>Affichage par</span>
                <select style="width: 70px" select2 ng-model="paginations['client'].entryLimit" ng-change="pageChanged('client')" class="select_2">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="">
                <nav aria-label="Page navigation">
                    <ul style="width: 100%" class="pagination" uib-pagination total-items="paginations['client'].totalItems" ng-model="paginations['client'].currentPage" max-size="paginations['client'].maxSize" items-per-page="paginations['client'].entryLimit" ng-change="pageChanged('client')" previous-text="‹" next-text="›" first-text="«" last-text="»" boundary-link-numbers="true" rotate="false">
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /PAGINATION -->
    </div>
</div>
@endif
