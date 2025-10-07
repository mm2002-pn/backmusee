@if (Auth::user()->can('liste-visite'))

<div>
    <div class=" card-module-info mb-4 ">
        <div class="card-info-icon   rounded">
            <i class="fas fa-users"></i>
        </div>
        <div class="idee d  w-100">
            <div class="idee-info">
                <p class="me-2">Fiche Visite</p>
                <span class="user-count bg-white">@{{ dataPage['visites'].length }}</span>
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
                    <div class="col-md-6  ">
                        <div class="form-group mx-0 px-0">
                            <label for="date_list_visite">Date debut</label>
                            <input id="date_list_visite" type="date" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group mx-0 px-0">
                            <label for="datefin_list_visite">Date fin</label>
                            <input id="datefin_list_visite" type="date" class="form-control" name="datefin">
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <select id="pointdevente_list_visite" select2 style="width: 100%">

                            <option value="" disabled selected>Rechercher par point de vente</option>
                            <option ng-repeat="item in dataPage['pointdeventes']" value="@{{ item.id }}">
                                @{{ item.intitule }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <select id="commercial_list_visite" select2 style="width: 100%">
                            <option value="" disabled selected>Rechercher par Commercial</option>
                            <option ng-repeat="item in dataPage['users']" ng-if='item.role.iscommercial' value="@{{ item.id }}">@{{ item.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <select id="zone_list_visite" select2 style="width: 100%">
                            <option value="">Rechercher par zone</option>
                            <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                                @{{ item.designation }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <select id="voiture_list_visite" select2 style="width: 100%">
                            <option value="">Rechercher par voiture</option>
                            <option ng-repeat="item in dataPage['voitures']" value="@{{ item.id }}">
                                @{{ item.marque }}
                            </option>
                        </select>
                    </div>
                </div>

            </div>


            <div class="card-footer bg-white">
                <div class="row bg-white shadow-none align-items-center p-3">
                    <!-- Section PDF/Excel -->
                    <div class="col-md-6 col-12 d-flex justify-content-start align-items-center mb-3 mb-md-0">
                        <button class="btn btn-danger me-2 rounded-pill btn-custom">
                            <i class="fa fa-file-pdf"></i> PDF
                        </button>
                        <a ng-show="filters" href="excels.excelbilanfiche/@{{ filters }}" class="btn btn-warning btn-custom text-dark me-2 rounded-pill">
                            <i class="fa fa-file-excel"></i> Excel
                        </a>

                        @if (Auth::user()->can('liste-validation'))
                        <a ng-show="filters" href="#!/list-validation/@{{ filters }}" class="btn btn-custom btn-warning text-dark rounded-pill">
                            <i class="fa fa-check-circle"></i> Validations Quantités
                        </a>
                        @endif


                    </div>

                    <!-- Section Annuler/Filtrer -->
                    <div class="col-md-6 col-12 d-flex justify-content-end align-items-center">
                        <button class="btn btn-outline-dark mx-2 rounded-pill btn-custom" ng-click="emptyform('visite', true)">
                            <i class="fa fa-times"></i> Annuler
                        </button>
                        <button class="btn btn-dark rounded-pill btn-custom" ng-click="pageChanged('visite');activefilter()">
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
                        <th>CODE</th>
                        <th>DATE</th>
                        <th>POINT DE VENTE</th>
                        <th>COMMERCIAL</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x" ng-repeat="item in dataPage['visites']">
                        <td> @{{ item.id }}</td>
                        <td> @{{ item.date }}</td>
                        <td> @{{ (item.pointdevente.designation) ? item.pointdevente.designation: '.........' }}</td>
                        <td> @{{ (item.commercial.name) ? item.commercial.name: '........' }}</td>

                        <td>
                            <div class="gooey-menu">
                                <input type="checkbox" class="open-menus" name="open-menus" style="display:none;" id="chc-@{{ item.id }}" />
                                <label for="chc-@{{ item.id }}">
                                    <div class="button">
                                        <div class="burger"></div>
                                    </div>
                                </label>

                                <!-- <div data-toggle="modal" ng-click="customRedirect('list-detailfichevisite',item.id)" class="button press">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </div> -->

                                <div class="button press" ng-click="deleteElement('visite',item.id)">
                                    <i style="margin-left: 5%;margin-top: 25%;" class="fa fa-trash"></i>
                                </div>
                                <a data-toggle="modal" href="pdf.generate-pdf-ventecaisse/@{{ item.id }}" target="_blank" class="button press">
                                    <i class="fa fa-file-pdf" aria-hidden="true"></i>
                                </a>

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
                <select style="width: 70px" select2 ng-model="paginations['visite'].entryLimit" ng-change="pageChanged('visite')" class="select_2">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="">
                <nav aria-label="Page navigation">
                    <ul style="width: 100%" class="pagination" uib-pagination total-items="paginations['visite'].totalItems" ng-model="paginations['visite'].currentPage" max-size="paginations['visite'].maxSize" items-per-page="paginations['visite'].entryLimit" ng-change="pageChanged('visite')" previous-text="‹" next-text="›" first-text="«" last-text="»" boundary-link-numbers="true" rotate="false">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endif