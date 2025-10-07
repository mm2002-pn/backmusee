<style>
    .centered {
         text-align: center;
    }
    .bold{
        font-weight: bold;
    }

    .w-200{
        width: 200px;
    }
</style>
<div>
    <br>
    <h4>RAPPORT DE DEMANDE PAR DEPARTEMENT</h4> <br>
</div>
<div>
    @if ($filters != null)
        <h5>Période de début : {{ ( (count($data) > 0) && isset($filters['dateDebut']) ) ? $filters['dateDebut'] : "" }}</h5> 
        <h5>Période de fin : {{ ( (count($data) > 0) && isset($filters['dateFin']) ) ? $filters['dateFin'] : "" }}</h5> 
        <h5>Département : {{ ( (count($data) > 0) && isset($filters['departement_id']) ) ? $data[0]->departement : "" }}</h5> 
        <h5>Type de demande : {{ ( (count($data) > 0) && isset($filters['typedemande_id'])) ? $data[0]->typedemande : "" }}</h5> 
        @php($niveau = "")
        @if ((count($data) > 0) && isset($filters['niveau_id']))

            @switch($filters['niveau_id'])
                @case(1)
                    @php($niveau = 'Niveau 1')
                    @break
                @case(2)
                    @php($niveau = 'Niveau 2')
                    @break
                @case(50)
                    @php($niveau = 'Niveau 3 / Validation finale')
                    @break
                @default
                    
            @endswitch
        @endif
        <h5>Niveau de validation :  {{$niveau}} </h5>  <br>
        
    @endif
</div>
{{-- @dd($filters) --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col"  style=" text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;"  class="px-6 py-3 bold centered w-200">
                    Département
                </th>

                <th scope="col"  style="text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;" class="px-6 py-3 bold">
                    Type de demande
                </th>

                <th scope="col"  style="text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;" class="px-6 py-3 bold">
                    Nombre de jours 
                </th>
                <th scope="col"  style="text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;" class="px-6 py-3 bold">
                    Nombre d'heures 
                </th>

                <th scope="col"  style="text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255);width: 250px;" class="px-6 py-3 bold">
                    Nombre d'employés
                </th>

            </tr>
        </thead>
        <tbody>
            {{-- @dd($data); --}}
                @foreach ($data as $item)
                    
                    <tr>
                        
                        <td class="px-6 py-4" style="width: 250px;">
                            {{$item->departement}}
                        </td>
                        <td class="px-6 py-4"  style="width: 250px;">
                            {{$item->typedemande}}
                        </td>
                        <td class="px-6 py-4"  style="width: 250px;">
                            {{$item->nombre_jours}}
                        </td>
                        <td class="px-6 py-4"  style="width: 250px;">
                            {{$item->nombre_heures}}
                        </td>
                        <td class="px-6 py-4"  style="width: 250px;">
                            {{$item->nombre_employes}}
                        </td>
                    
                    
                    </tr>

                @endforeach


        </tbody>
    </table>
</div>
