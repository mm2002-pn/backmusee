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
    <h4>ETATS DE DEMANDE</h4> <br>
</div>
<div>
    <h5>Periode de début : {{ ($filters['dateDebut'] != false) ? $filters['dateDebut'] : "" }}</h5>
    <h5>Periode de fin : {{ ($filters['dateFin'] != false) ? $filters['dateFin'] : "" }}</h5>
    <h5>Département : {{ ($filters['departement'] == true) ? $data[0]['departement']['designation'] : "" }}</h5> <br>
</div>
{{-- @dd($filters) --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" colspan="3" style=" text-align: center;background-color:#8f8f8f;color:rgb(255, 255, 255); width: 600px;"  class="px-6 py-3 bold centered w-200">
                   Employer
                </th>

                <th scope="col" colspan="{{count($typedemandes) * 2}}" style="text-align: center;background-color:#2b00ff;color:rgb(255, 255, 255); width: 800px;" class="px-6 py-3 bold">
                  Demande
                </th>

                {{-- <th scope="col" class="px-6 py-3 bold">
                    View demande
                </th> --}}
                
               
            </tr>
        </thead>
        <tbody>
            
                
                <tr>
                    
                    <td class="px-6 py-4" style=" width: 350px;" colspan="2">
                        Nom complet
                    </td>
                    <td class="px-6 py-4" style=" width: 250px;" colspan="1">
                        Profil
                    </td>
                    <td class="px-6 py-4" style=" width: 400px;text-align:center;background-color:green;" colspan="{{count($typedemandes)}}">
                        Validée
                    </td>
                    <td class="px-6 py-4" style=" width: 400px;text-align:center;background-color:red;" colspan="{{count($typedemandes)}}">
                        Non validée
                    </td>
                   
                </tr>
                <tr>
                    
                    <td class="px-6 py-4" style=" width: 350px;" colspan="2">
                       
                    </td>
                    <td class="px-6 py-4" style=" width: 250px;" colspan="1">
                       
                    </td>
                    @foreach ($typedemandes as $value )
                        <td class="px-6 py-4" style=" width: 100px;" colspan="1">
                            {{$value['designation']}}
                        </td>
                    @endforeach
                    @foreach ($typedemandes as $value )
                        <td class="px-6 py-4" style=" width: 100px;" colspan="1">
                            {{$value['designation']}}
                        </td>
                    @endforeach
                   
                   
                </tr>
                @for ($i = 0 ; $i < count($data); $i++)
                <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    
                  
                    <td class="px-6 py-4" style=" width: 350px;" colspan="2">
                        {{$data[$i]['nomComplet']}}
                     </td>
                     {{-- <td class="px-6 py-4" style=" width: 250px;">
                        Mbaye
                     </td> --}}
                     <td class="px-6 py-4" style=" width: 250px;">
                        {{$data[$i]['user']['role']['designation']}}
                     </td>
                     @foreach ($typedemandes as $val )

                         @foreach ($data[$i]['demandes_accepter'] as $value )
                     
                            @if ($value['id'] == $val['id'])
                                <td class="px-6 py-4" style=" width: 100px;">
                                    {{$value['valide']}}
                                </td>
                            @endif
                        
                        @endforeach

                    
                     @endforeach

                    @foreach ($typedemandes as $val )

                        @foreach ($data[$i]['demandes_nonaccepter'] as $value2 )
                    
                            @if ($value2['id'] == $val['id'])
                                <td class="px-6 py-4" style=" width: 100px;">
                                    {{$value2['annule']}}
                                </td>
                            @endif
                        
                        @endforeach

                    
                    @endforeach
                         
                    {{-- <td class="px-6 py-4">
                       demande
                    </td> --}}

                    {{-- <td class="px-6 py-4">
                        {{$data[$i]['viewdemande'] ?: '3'}}
                    </td> --}}

                    
                </tr>

            @endfor


        </tbody>
    </table>
</div>
