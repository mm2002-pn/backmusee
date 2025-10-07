
<div>
    <br>
    <h4>Reporting des demandes en jours et par employe étalé</h4> <br>
</div>
<div>
   @if ($filters != null)
    <h5>Période de début : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5> 
    <h5>Période de fin : {{ ( (count($data) > 0) && isset($filters['dateFin']) ) ? $filters['dateFin'] : "" }}</h5> 
    <h5>Département : {{ ( (count($data) > 0) && isset($filters['departement_id']) && isset($data[0]['absentEmployees']) ) ? $data[0]['absentEmployees'][0]['departement'] : "" }}</h5> 
    <h5>Type de demande : {{ ( (count($data) > 0) && isset($filters['typedemande_id']) && isset($data[0]['absentEmployees']) ) ? $data[0]['absentEmployees'][0]['typedemande'] : "" }}</h5> 
  @endif
</div>
{{-- @dd($data[0]['absentEmployees']) --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                   Date 
                </th>

                <th scope="col"  class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Matricule
                 </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Employé
                </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Type de demande
                </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Département
                </th>
               
            </tr>
        </thead>
        <tbody>
            
            @foreach ($data as $day)
            @foreach ($day['absentEmployees'] as $employee)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" style="width: 250px;" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $day['jour'] }}
                    </th>
                    
                    <td class="px-6 py-4" style="width: 250px">
                        {{ $employee['matricule'] ?? "--" }}
                    </td>
        
                    <td class="px-6 py-4" style="width: 250px">
                        {{ $employee['nomComplet'] ?? "--" }}
                    </td>
        
                    <td class="px-6 py-4" style="width: 250px">
                        {{ $employee['typedemande'] ?? "--" }}
                    </td>
        
                    <td class="px-6 py-4" style="width: 250px">
                        {{ $employee['departement'] ?? "--" }}
                    </td>
                </tr>
            @endforeach
        @endforeach
        
        </tbody>
    </table>
</div>
