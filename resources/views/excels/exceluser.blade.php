
<div>
    <h4>Liste des utilisateurs</h4>
</div>
<style>
    .bold{
        font-weight: bold;
    }
</style>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bold">
                   Prénom
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Login
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Département
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Profil
                </th>
                <th scope="col" class="px-6 py-3 bold">
                    Téléphone
                </th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0 ; $i < count($data); $i++)
                
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$data[$i]['prenom']}}
                    </th>
                    <td class="px-6 py-4">
                        {{$data[$i]['nom']}}
                    </td>
                    <td class="px-6 py-4">
                        {{$data[$i]['email']}}
                    </td>
                    <td class="px-6 py-4">
                        {{$data[$i]['login']}}
                    </td>
                   
                    <td class="px-6 py-4">
                        {{$data[$i]['departement'] ? $data[$i]['departement']['designation'] : "--"}}
                    </td>
                    <td class="px-6 py-4">
                        {{$data[$i]['role'] ? $data[$i]['role']['designation'] : "--"}}
                    </td>
                    <td class="px-6 py-4">
                        {{$data[$i]['employer'] ? $data[$i]['employer']['telephone'] : '--'}}
                    </td>
                </tr>

            @endfor


        </tbody>
    </table>
</div>
