
<div>
    <h4>Liste des profils</h4>
</div>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bold">
                   Designation
                </th>

                <th scope="col" class="px-6 py-3 bold">
                    Notif user
                </th>

                <th scope="col" class="px-6 py-3 bold">
                    View demande
                </th>
                
               
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$data[$i]['designation']}}
                    </th>
                   
                    <td class="px-6 py-4">
                        {{$data[$i]['notifsuper'] ?: '0'}}
                    </td>

                    <td class="px-6 py-4">
                        {{$data[$i]['viewdemande'] ?: '3'}}
                    </td>

                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
