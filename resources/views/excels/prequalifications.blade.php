<table>
    <thead>
        <tr>
            <th style="background: yellow">Année de préqualification</th>
            <th style="background: yellow">Année d'expiration préqual</th>
            <th style="background: yellow">Référence AOIP</th>
            <th style="background: yellow">Code</th>
            <th style="background: yellow">Catégorie</th>
            <th style="background: yellow">Dénomination</th>
            <th style="background: yellow">CDT</th>
            <th style="background: yellow">Fournisseur</th>
            <th style="background: yellow">Fabricant</th>
            <th style="background: yellow">Adresse du site</th>
            <th style="background: yellow">Pays du fabricant</th>
            <th style="background: yellow">Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prequalifications as $item)
        <tr>
            <td>{{ $item['anneeprequalification'] ?? '' }}</td>
            <td>{{ $item['anneeexpiration'] ?? '' }}</td>
            <td>{{ $item['referenceaoip'] ?? '' }}</td>
            <td>{{ $item['code'] ?? '' }}</td>
            <td>{{ $item['type'] ?? '' }}</td>
            <td>{{ $item['denomination'] ?? '' }}</td>
            <td>{{ $item['cdt'] ?? '' }}</td>
            <td>{{ $item['fournisseur']? $item['fournisseur']['nom'] : '' }}</td>
            <td>{{ $item['fabricant'] ? $item['fabricant']['designation'] : '' }}</td>
            <td>{{ $item['adresse'] ?? '' }}</td>
            <td>{{ $item['pays'] ? $item['pays']['designation'] : '' }}</td>
            <td>{{ $item['etat_text'] ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
