@if (Auth::user()->can('liste-unite'))
<div>
    <div class=" card-module-info mb-4 ">
        <div class="card-info-icon   rounded">
            <i class="fas fa-users"></i>
        </div>
        <div class="idee d  w-100">
            <div class="idee-info">
                <p class="me-2">unites</p>
                <span class="user-count bg-white">@{{ paginations['unite'].totalItems }}</span>
            </div>
            <div class="add-button m-0 p-0 ">
                <button class="btn bg-theme-gradient btn-gradient dropdown-toggle" data-bs-toggle="dropdown">
                    Ajouter
                </button>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('unite')">
                        <i class="fas fa-user-plus"></i> Ajouter un unite
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ng-click="showModalAdd('unite', {is_file_excel:true, title: 'Ajouter plusieurs unites'})">
                        <i class="fas fa-user-plus"></i> Ajouter plusieurs unites
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
                        <select id="searchoption_list_unite" name="searchoption" select2 style="width: 100%">
                            <option value="">Rechercher par </option>
                            <option value="designation">designation </option>
                        </select>
                    </div>

                    <!-- Input de recherche -->
                    <div class="col-md-4 col-12 mb-3 mb-md-0 px-2">
                        <input type="text" class=" form-control filtre" id="searchtexte_list_unite" ng-model="searchtexte_list_unite" placeholder="Chercher par  designation">
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
                        <button profil="button" class="btn btn-outline-dark mx-2 rounded-pill btn-custom" ng-click="emptyform('unite', true)">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button profil="button" class="btn btn-dark rounded-pill btn-custom" ng-click="pageChanged('unite');activefilter()">
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
                        <th>Designation</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class=" intro-x" ng-repeat="item in dataPage['unites']">
                        {{-- <td><img src="{{ asset('images/avatar.png') }}" class="product-img"
                        alt="@{{ item.designation }}"></td> --}}
                        <td> @{{ (item.designation) ? item.designation: '-------' }}</td>
                        <td> @{{ (item.description) ? item.description: '--------' }}</td>
                        <td> @{{ (item.code) ? item.code: '--------' }}</td>
                        <td>
                            <div class="gooey-menu">
                                <input type="checkbox" class="open-menus" name="open-menus" style="display:none;" id="chc-@{{ item.id }}" />

                                <label for="chc-@{{ item.id }}">
                                    <div class="button">
                                        <div class="burger"></div>
                                    </div>
                                </label>

                                @if (Auth::user()->can('modification-unite'))

                                <div data-toggle="modal" ng-click="showModalUpdate('unite',item.id)" class="button press">
                                    <i style="margin-left: 15%;margin-top: 25%;" class="fa fa-edit"></i>
                                </div>
                                @endif

                                @if (Auth::user()->can('suppression-unite'))

                                <div class="button press" ng-click="deleteElement('unite',item.id)">
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
                <select style="width: 70px" select2 ng-model="paginations['unite'].entryLimit" ng-change="pageChanged('unite')" class="select_2">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="">
                <nav aria-label="Page navigation">
                    <ul style="width: 100%" class="pagination" uib-pagination total-items="paginations['unite'].totalItems" ng-model="paginations['unite'].currentPage" max-size="paginations['unite'].maxSize" items-per-page="paginations['unite'].entryLimit" ng-change="pageChanged('unite')" previous-text="‹" next-text="›" first-text="«" last-text="»" boundary-link-numbers="true" rotate="false">
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /PAGINATION -->
    </div>
</div>
@endif