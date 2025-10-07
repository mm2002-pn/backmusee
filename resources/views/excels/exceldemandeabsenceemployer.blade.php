
<div>
    <br>
    <h4>RAPPORT DE DEMANDE D'ABSENCE PAR EMPLOYER</h4> <br>
</div>
<div>
   @if ($filters != null)
    <h5>Période de début : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5> 
    <h5>Période de fin : {{ ( (count($data) > 0) && isset($filters['dateFin']) ) ? $filters['dateFin'] : "" }}</h5> 
    <h5>Département : {{ ( (count($data) > 0) && isset($filters['departement_id']) && isset($data) ) ? $data[0]['departement']['designation'] : "" }}</h5> 
  @endif
</div>
{{-- @dd($filters) --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                   Matricule
                </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Employé
                </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Département
                </th>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Absence déductible (en heures)
                </th>
                <th scope="col"   class="px-6 py-3 bold"  style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Absence non déductible (en heures)
                </th>
               
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                    <th scope="row" style="width: 250px;" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$data[$i]['matricule']}}
                    </th>
                   
                    <td class="px-6 py-4"  style="width: 250px">
                        {{$data[$i]['nomComplet']}}
                    </td>
                   
                    <td class="px-6 py-4" style="width: 250px">
                        {{$data[$i]['departement'] ? $data[$i]['departement']['designation'] : "--"}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px">
                       {{($data[$i]['absence_deductible'] == null) ? 0 : $data[$i]['absence_deductible']}} 
                    </td>

                    <td class="px-6 py-4" style="width: 250px" >
                        {{($data[$i]['absence_non_deductible'] == null) ? 0 : $data[$i]['absence_non_deductible']}} 
                    </td>
                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
