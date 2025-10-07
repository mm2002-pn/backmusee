
<div>
    <br>
    <h4>DRAFT DASHOBARD</h4> <br>
</div>
<div>

</div>
{{-- @dd($filters) --}}
{{-- <h5>Période de début : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5> 
<h5>Période de fin : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5>  --}}
{{-- <h5>Département : {{ ( $data && isset($filters['departement_id']) && isset($data) ) ? $data[0]['departement']['designation'] : "" }}</h5>  --}}

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
               
                <th scope="col"   class="px-6 py-3 bold" style="background-color:green;color:rgb(255, 255, 255);">
                   Nombre de demande validée
                </th>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:blue;color:rgb(255, 255, 255);">
                   Nombre de demande encours
                </th>
                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);">
                    Nombre total de demande
                </th>
               
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
            
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                
                    <td class="px-6 py-4" >
                        {{$data[$i]['demande_validee']}}
                    </td>

                    <td class="px-6 py-4" >
                        {{$data[$i]['demande_encours']}}
                    </td>

                    <td class="px-6 py-4" >
                        {{-- {{$data[$i]['total']}} --}}
                        {{ intval($data[$i]['demande_validee']) + intval($data[$i]['demande_encours'])}}
                    </td>
                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
