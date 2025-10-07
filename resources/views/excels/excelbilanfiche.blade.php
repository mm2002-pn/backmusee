<table>
    <thead>
        <tr>
            <th style="background: yellow">DOMAINE(VENTE)</th>
            <th style="background: yellow">TYPE DOCUMENT (BL)</th>
            <th style="background: yellow">N PIECE</th>
            <th style="background: yellow">DATE </th>
            <th style="background: yellow">TIERS </th>
            <th style="background: yellow">REFERENCE ARTICLE </th>  
            <th style="background: yellow">DESIGNATION ARTICLE</th>
            <th style="background: yellow">PRIX UNITAIRE</th>
            <th style="background: yellow">QUANTITE</th>
            <th style="background: yellow">DEPOT</th>
            <th style="background: yellow">COLLABORATEUR</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            @foreach($item['detaillivraisons'] as $detaillivraison)
            <tr>
                <td>0</td>
                <td>3</td>
                <td>neant</td>
                <td>{{ $item['date'] }}</td>
                <td>{{ $item['pointdevente']['numbcpttier'] }}</td>
                <td>{{ $detaillivraison['produit']['id'] }}</td>
                <td>{{ $detaillivraison['produit']['designation'] }}</td>
                <td>{{ $detaillivraison['produit']['prix'] }}</td>
                <td>{{ $detaillivraison['quantite'] }}</td>
                <td>{{ $item['planning']['voiture']['matricule'] }}</td>
                <td>{{ $item['commercial']['name'] }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
