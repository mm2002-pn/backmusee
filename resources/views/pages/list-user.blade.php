@if (Auth::user()->can('liste-user'))
<div>
    <div class=" card-module-info mb-4 ">
        <div class="card-info-icon   rounded">
            <i class="fas fa-users"></i>
        </div>
        <div class="idee d  w-100">
            <div class="idee-info">
                <p class="me-2">Utilisateurs</p>
                <span class="user-count bg-white">@{{ (paginations['user'].totalItems) }}</span>
            </div>
            <div class="add-button m-0 p-0 ">
                <button class="btn bg-theme-gradient btn-gradient dropdown-toggle" data-bs-toggle="dropdown">
                    Ajouter
                </button>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('user')">
                        <i class="fas fa-user-plus"></i> Ajouter un utilisateur
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('user', {is_file_excel:true, title: 'Ajouter plusieurs users'})">
                        <i class="fas fa-users"></i> Ajouter plusieurs utilisateurs
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card m-0 p-0 border-0">
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
                        <select id="searchoption_list_user" name="searchoption" select2 style="width: 100%">
                            <option value="">Rechercher par </option>
                            <option value="name">name </option>
                        </select>
                    </div>
                    <!-- Input de recherche -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <input type="text" class=" form-control filtre" id="searchtexte_list_user" ng-model="searchtexte_list_user" placeholder="Chercher par  nom">
                    </div>
                    <!-- Rechercher par profil -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <select id="role_list_user" select2 style="width: 100%">
                            <option value="">Rechercher par profil</option>
                            <option ng-repeat="item in dataPage['roles']" value="@{{ item.id }}">
                                @{{ item.name }}</option>
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
                        <button profil="button" class="btn btn-outline-dark mx-2 rounded-pill btn-custom" ng-click="emptyform('user', true)">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button profil="button" class="btn btn-dark rounded-pill btn-custom" ng-click="pageChanged('user');activefilter()">
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
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="alert intro-x" role="alert" ng-repeat="item in dataPage['users']">
                        <th scope="row"><img src="{{ asset('images/avatar.png') }}" class="product-img" alt="@{{ item.name }}"></th>
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.email }}</td>
                        <td>@{{ item.role.name }}</td>
                        <td>
                            <div class="gooey-menu">
                                <input type="checkbox" class="open-menus" name="open-menus" style="display:none;" id="chc-@{{ item.id }}" />

                                <label for="chc-@{{ item.id }}">
                                    <div class="button">
                                        <div class="burger"></div>
                                    </div>
                                </label>

                                @if (Auth::user()->can('modification-user'))

                                <div data-toggle="modal" class="button press" ng-click="showModalUpdate('user',item.id)">
                                    <i style="margin-left: 15%;margin-top: 25%;" class="fa fa-edit"></i>
                                </div>

                                @endif
                                @if (Auth::user()->can('suppression-user'))

                                <div class="button press" ng-click="deleteElement('user',item.id)">
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
                <select style="width: 70px" select2 id="page_user" ng-model="paginations['user'].entryLimit" ng-change="pageChanged('user')" class="select_2">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="">
                <nav aria-label="Page navigation">
                    <ul style="width: 100%" class="pagination" uib-pagination total-items="paginations['user'].totalItems" ng-model="paginations['user'].currentPage" max-size="paginations['user'].maxSize" items-per-page="paginations['user'].entryLimit" ng-change="pageChanged('user')" previous-text="‹" next-text="›" first-text="«" last-text="»" boundary-link-numbers="true" rotate="false">
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /PAGINATION -->
    </div>

</div>
@endif