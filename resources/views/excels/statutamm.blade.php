<table>
    <thead>
        <tr>
            <th style="background: yellow">CODE PRODUIT</th>
            <th style="background: yellow">DESIGNATION SALAMA</th>
            <th style="background: yellow">Nom commercial du produit</th>
            <th style="background: yellow">Fournisseur</th>
            <th style="background: yellow">Laboratoire titulaire</th>
            <th style="background: yellow">Laboratoire Fabriquant</th>
            <th style="background: yellow">Numéro d'AMM</th>
            <th style="background: yellow">Date de délivrance de l'AMM</th>
            <th style="background: yellow">Date d'expiration AMM</th>
            <th style="background: yellow">Statut Enregistrement</th>
        </tr>
    </thead>
    <tbody>
        @foreach($statutamm as $item)
        <tr>
            <td>{{ $item['codeproduit'] ?? '' }}</td>
            <td>{{ $item['designationsalama'] ?? '' }}</td>
            <td>{{ $item['nomcommercial'] ?? '' }}</td>
            <td>{{ $item['fournisseur']['nom'] ?? '' }}</td>
            <td>{{ $item['laboratoiretitulaire'] ?? '' }}</td>
            <td>{{ $item['laboratoirefabriquant'] ?? '' }}</td>
            <td>{{ $item['numeroamm'] ?? '' }}</td>
            <td>{{ $item['datedelivranceamm'] ?? '' }}</td>
            <td>{{ $item['dateexpirationamm'] ?? '' }}</td>
            <td>{{ $item['etat_text'] ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
