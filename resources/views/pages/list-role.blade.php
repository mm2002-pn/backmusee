@if (Auth::user()->can('liste-role'))
<div>
    <div class=" card-module-info mb-4 ">
        <div class="card-info-icon   rounded">
            <i class="fas fa-users"></i>
        </div>
        <div class="idee d  w-100">
            <div class="idee-info">
                <p class="me-2">Roles</p>
                <span class="user-count bg-white">@{{ paginations['role'].totalItems }}</span>
            </div>

            <div class="add-button m-0 p-0 ">
                <button class="btn bg-theme-gradient btn-gradient dropdown-toggle" data-bs-toggle="dropdown">
                    <!-- <i class="fa fa-plus"></i> -->
                    Ajouter
                </button>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('role')">
                        <i class="fas fa-user-plus"></i> Ajouter un
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAddMultiple('role')">
                        <i class="fas fa-users"></i> Ajouter plusieurs
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
                    <div class="col-md-4 col-12 px-2">
                        <select id="searchoption_list_role" select2 name="searchoption" class="form-select" style="width: 100%;">
                            <option value="">Rechercher par</option>
                            <option value="name">Designation</option>
                        </select>
                    </div>

                    <!-- Input de recherche -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <input type="text" class="form-control filtre" id="searchtexte_list_role" ng-model="searchtexte_list_role" placeholder="Chercher par designation">
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
                        <button profil="button" class="btn btn-outline-dark mx-2 rounded-pill btn-custom" ng-click="emptyform('role', true)">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button profil="button" class="btn btn-dark rounded-pill btn-custom" ng-click="pageChanged('role')">
                            <i class="fa fa-search"></i> Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-table">
        <div class="table-responsive">
            <table class="table ">
                <thead class="thead-dark" >
                    <tr>
                        <th>Désignation</th>
                        <th>Nombres de permissions</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in dataPage['roles']">
                        <td> @{{ item.name }}</td>
                        <td> @{{ item.permissions.length }}</td>
                        <td>
                            <div class="gooey-menu">
                                <input type="checkbox" class="open-menus" name="open-menus" style="display:none;" id="chc-@{{ item.id }}" />

                                <label for="chc-@{{ item.id }}">
                                    <div class="button">
                                        <div class="burger"></div>
                                    </div>
                                </label>
                                @if (Auth::user()->can('modification-role'))
                                <div data-toggle="modal" class="button press" ng-click="showModalUpdate('role',item.id)">
                                    <i style="margin-left: 15%;margin-top: 25%;" class="fa fa-edit"></i>
                                </div>
                                @endif
                                @if (Auth::user()->can('suppression-role'))
                                <div class="button press" ng-click="deleteElement('role',item.id)">
                                    <i style="margin-left: 5%;margin-top: 25%;" class="fa fa-trash"></i>
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
                <select style="width: 70px" select2 ng-model="paginations['role'].entryLimit" ng-change="pageChanged('role')" class="select_2">
                    <option value="10" selected>5</option>
                    <option value="25">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="">
                <nav aria-label="Page navigation bg-white">
                    <ul style="width: 100%" class="pagination bg-transparent shadow-none m-0 p-0" uib-pagination total-items="paginations['role'].totalItems" ng-model="paginations['role'].currentPage" max-size="paginations['role'].maxSize" items-per-page="paginations['role'].entryLimit" ng-change="pageChanged('role')" previous-text="‹" next-text="›" first-text="«" last-text="»" boundary-link-numbers="true" rotate="false">
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /PAGINATION -->
    </div>

</div>
@endif