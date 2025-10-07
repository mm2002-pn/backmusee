
<div>
    <h4>Liste des employers</h4>
</div>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                   Matricule
                </th>

                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Employer
                 </th>

                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Email
                </th>

                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Département
                </th>
                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Profil
                </th>

                <th scope="col" class="px-6 py-3 bold" style="background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px">
                    Login
                </th>
               
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th style="width: 250px;" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$data[$i]['matricule']}}
                    </th>
                   
                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['nomComplet']}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['email']}}
                    </td>

                   
                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['departement'] ? $data[$i]['departement']['designation'] : "--"}}
                    </td>
                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['user'] ? $data[$i]['user']['role']['designation'] : "--"}}
                    </td>

                    <td class="px-6 py-4" style="width: 250px;">
                        {{$data[$i]['user'] ? $data[$i]['user']['login'] : "--"}}
                    </td>

                    
                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
