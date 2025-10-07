
<div>
    <br>
    <h4>EVOLUTION DES DEMANDES / JOURS</h4> <br>
</div>
<div>

</div>

{{-- <h5>Période de début : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5>  --}}
{{-- <h5>Période de fin : {{ ( (count($data) > 0) && isset($filters['dateFin']) ) ? $filters['dateFin'] : "" }}</h5>  --}}
@if ($filters)
    <h5>{{ ( (count($data) > 0) && isset($filters['rapport_id']) ) ? $filters['rapport_id']->intitule : "" }} : de {{ ( (count($data) > 0) && isset($filters['rapport_id']) ) ? $filters['rapport_id']->date_debut : "" }} à {{ ( (count($data) > 0) && isset($filters['rapport_id']) ) ? $filters['rapport_id']->date_fin : "" }}</h5> 
@endif
<br>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
               
                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                  Jour / date 
                </th>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;">
                    Nombre de demandes encours
                </th>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;">
                    Nombre de demandes invalidées
                  </th>
                  <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;">
                    Nombre de demandes validées
                  </th>
                  <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;">
                    Nombre total de demande
                  </th>
              

               
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
            
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                
                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['jour']}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['demandes'][0]['demande_encours']}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['demandes'][0]['demande_invalidee']}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['demandes'][0]['demande_validee']}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['demandes'][0]['total']}}
                    </td>
                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
