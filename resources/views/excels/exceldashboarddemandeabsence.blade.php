
<div>
    <br>
    <h4>DASHOBARD</h4> <br>
</div>
<div>

</div>
{{-- @dd($filters) --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);">
                   Matricule
                </th>

                <th scope="col"   class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);">
                    Employé
                </th>

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

                    <th scope="row"   class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$data[$i]['matricule']}}
                    </th>
                   
                    <td class="px-6 py-4"  >
                        {{$data[$i]['nomComplet']}}
                    </td>
                   
                    <td class="px-6 py-4" >
                        {{$data[$i]['etat_demande'][0]['demande_validee']}}
                    </td>

                    <td class="px-6 py-4" >
                        {{$data[$i]['etat_demande'][0]['demande_encours']}}
                    </td>

                    <td class="px-6 py-4" >
                        {{$data[$i]['etat_demande'][0]['total']}}
                    </td>
                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
