<style>
    .chart-container {
        position: relative;
        height: 65vh;
        width: 100%;
        margin: auto;
        padding: 15px;
        border: 1px solid #ddd;
    }

    #map {
        width: 100%;
        height: 100%;
    }
</style>
@if (Auth::user()->can('voir-map'))

<div  class="container-fluid">

    {{-- Filter --}}

    <div class="container">
        <div class="row justify-content-center my-3 shadow-none p-2 rounded">
            <div class="col-md-8 shadow-none">
                <div class="d-flex align-items-center shadow-none p-2 rounded">
                    <i class="fa fa-filter icons-color mx-2"></i>
                    <span class="mx-2">ZONES</span>
                    <select id="map_zone_filter" multiple class="fa fa-filter icons-color form-control " select2 style="width: 100%">
                        <option   >Rechercher par zone</option>
                        <option ng-repeat="item in dataPage['zones']" value="@{{ item.id }}">
                            @{{ item.designation }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row justify-content-center">
        <div class="  p-3  " style="width: 100%">
            <div class="chart-container">
                <div id="map"></div>
            </div>
        </div>
    </div>

</div>
@endif
