<!-- Sidebar -->
<div class="sidebar" data-background-color="white">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header intro-x " data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="https://mcn-sn.com/wp-content/uploads/2025/02/Logo_MCN_ang_Fran_Plan-de-travail-1-copie-4.png" alt="navbar brand" class="navbar-brand" height="70" width="70" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner  ">
        <div class="sidebar-content">
            <ul class="nav nav-secondary ">
                <li class="nav-item active ">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#!dashboard">
                                    <span class="sub-item">Graphe et Analyse</span>
                                </a>
                            </li>
                            <li>
                                <a href="#!performance">
                                    <span class="sub-item">Performance</span>
                                </a>
                            </li>

                        </ul>
                    </div>

                </li>
                <li class="nav-section ">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item intro-x " ng-repeat="page in Pages | filter: SearchText" ng-class="{ 'active': openmenu[page.parent_id] === true }">
                    <a ng-if="!(page.parent)" href="#!@{{ page.url }}">
                        <i ng-cloak class="@{{ page.icon }}"></i>
                        <p>@{{ page.titre }}</p>
                    </a>


                    <a data-bs-toggle="collapse" ng-if="page.parent && page.parent.length > 0" ng-click="dropmenu(page.parent_id)" href="#forms_@{{$index}}">
                        <i ng-cloak class="@{{ page.icon }}"></i>
                        <p>@{{ page.titre }}</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="forms_@{{$index}}">
                        <ul class="nav nav-collapse">

                            <li ng-repeat="page2 in page.parent">
                                <a href="#!@{{ page2.url }}" ng-if="!page2.sousparent_id">
                                    <span class="sub-item">@{{ page2.titre }}</span>
                                </a>

                                <a data-bs-toggle="collapse" ng-if="page2.sousparent_id" ng-click="dropmenu(page2.permission)" href="#forms_@{{page2.sousparent_id}}">
                                    <i ng-cloak class="sub-item"></i>
                                    <p style="margin-left: -40px !important;">@{{ page2.titre }}</p>
                                    <span class="caret"></span>
                                </a>

                                <div class="collapse" id="forms_@{{page2.sousparent_id}}" ng-if="page2.sousparent_id">
                                    <ul class="nav nav-collapse" ng-if="page2.sousparent_id">

                                        <li ng-repeat="page22 in page2.parent" ng-if="page22.soussparent_id && checkPermision(page22.permission) ">
                                            <a href="#!@{{ page22.url }}" ng-if="page22.soussparent_id">
                                                <span class="sub-item">@{{ page22.titre }}</span>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>