<table>
    <!-- En-tête du document -->
    <tr>
        <td colspan="13" style="font-size: 18px; font-weight: bold; text-align: center; background-color: #1a252f; color: white;">
            ÉTAT FINANCIER - COMPARATIF DES FOURNISSEURS
        </td>
    </tr>
    <tr>
        <td colspan="13"><strong>Date de génération :</strong> {{ date('d/m/Y H:i') }}</td>
    </tr>
    <tr>
        <td colspan="13"><strong>Référence AO :</strong> {{ $appelOffreReference ?? 'Non spécifié' }}</td>
    </tr>
    <tr>
        <td colspan="13"><strong>Article :</strong> {{ $articleDesignation ?? 'Tous les articles' }}</td>
    </tr>
    <tr><td colspan="13"></td></tr> <!-- Ligne vide pour l'espacement -->

    @if(!empty($soumissions) && is_array($soumissions) && count($soumissions) > 0)
        <!-- En-tête du tableau -->
        <tr style="background-color: #2c3e50; color: white; font-weight: bold;">
            <th>Classement</th>
            <th>Fournisseur</th>
            <th>Sélection</th>
            <th>Score</th>
            <th>Conditionnement</th>
            <th>Prix unitaire (Ar)</th>
            <th>Target Price (Ar)</th>
            <th>Marge (Ar)</th>
            <th>Qté demandée</th>
            <th>Qté proposée</th>
            <th>Écart qté</th>
            <th>Total (Ar)</th>
            <th>Statut</th>
        </tr>

        @php
            $totalGeneral = 0;
            $classement = 1;
        @endphp

        @foreach($soumissions as $soumission)
            @if(is_array($soumission))
            <tr @if(isset($soumission['isSelected']) && $soumission['isSelected']) style="background-color: #d4edda;" @endif>
                <!-- Classement -->
                <td>
                    @if(isset($soumission['isSelected']) && $soumission['isSelected'])
                        <strong>1er</strong>
                    @else
                        {{ $classement }}ème
                        @php $classement++; @endphp
                    @endif
                </td>

                <!-- Fournisseur -->
                <td>{{ $soumission['nom'] ?? 'N/A' }}</td>

                <!-- Sélection -->
                <td>
                    @if(isset($soumission['isSelected']) && $soumission['isSelected'])
                        ✅ Sélectionné
                    @else
                        ❌ Non sélectionné
                    @endif
                </td>

                <!-- Score -->
                <td>{{ $soumission['score'] ?? '0' }}%</td>

                <!-- Conditionnement -->
                <td>{{ $soumission['type'] ?? 'N/A' }}</td>

                <!-- Prix unitaire -->
                <td>{{ number_format($soumission['prix'] ?? 0, 2, ',', ' ') }}</td>

                <!-- Target Price -->
                <td>{{ number_format($soumission['targetprice'] ?? 0, 2, ',', ' ') }}</td>

                <!-- Marge -->
                <td style="color: {{ ($soumission['marge'] ?? 0) >= 0 ? '#28a745' : '#dc3545' }};">
                    {{ number_format($soumission['marge'] ?? 0, 2, ',', ' ') }}
                </td>

                <!-- Quantités -->
                <td>{{ number_format($soumission['quantitedemande'] ?? 0, 0, ',', ' ') }}</td>
                <td>{{ number_format($soumission['quantite'] ?? 0, 0, ',', ' ') }}</td>

                <!-- Écart -->
                <td style="color: {{ ($soumission['ecart'] ?? 0) >= 0 ? '#28a745' : '#dc3545' }};">
                    {{ number_format($soumission['ecart'] ?? 0, 0, ',', ' ') }}
                </td>

                <!-- Total -->
                <td><strong>{{ number_format(($soumission['prix'] ?? 0) * ($soumission['quantite'] ?? 0), 2, ',', ' ') }}</strong></td>

                <!-- Statut -->
                <td>
                    @if(isset($soumission['isSelected']) && $soumission['isSelected'])
                        <strong>RECOMMANDÉ</strong>
                    @else
                        Alternative
                    @endif
                </td>
            </tr>
            @php
                $totalGeneral += ($soumission['prix'] ?? 0) * ($soumission['quantite'] ?? 0);
            @endphp
            @endif
        @endforeach

        <!-- Ligne de total général -->
        <tr style="font-weight: bold; background-color: #e9ecef;">
            <td colspan="11" style="text-align: right;"><strong>TOTAL GÉNÉRAL :</strong></td>
            <td colspan="2"><strong>{{ number_format($totalGeneral, 2, ',', ' ') }} Ar</strong></td>
        </tr>

        <!-- Section analyse comparative -->
        <tr><td colspan="13"></td></tr>
        <tr style="background-color: #34495e; color: white; font-weight: bold;">
            <td colspan="13">ANALYSE COMPARATIVE</td>
        </tr>
        <tr style="background-color: #2c3e50; color: white; font-weight: bold;">
            <th>Fournisseur le moins cher</th>
            <th>Fournisseur sélectionné</th>
            <th>Écart de prix (Ar)</th>
            <th>Économie potentielle (Ar)</th>
            <th colspan="9">Recommandation</th>
        </tr>
        <tr>
            @php
                $moinsCher = collect($soumissions)->sortBy('prix')->first();
                $selectionne = collect($soumissions)->where('isSelected', true)->first();
                $ecartPrix = $selectionne ? $selectionne['prix'] - $moinsCher['prix'] : 0;
                $economie = $ecartPrix * ($selectionne ? $selectionne['quantite'] : 0);
                $recommandation = $ecartPrix > 0 ? 'Envisager de négocier avec ' . $moinsCher['nom'] : 'Choix optimal';
            @endphp
            <td>{{ $moinsCher['nom'] ?? 'N/A' }} ({{ number_format($moinsCher['prix'] ?? 0, 2, ',', ' ') }} Ar)</td>
            <td>{{ $selectionne ? $selectionne['nom'] : 'Aucun' }} ({{ $selectionne ? number_format($selectionne['prix'], 2, ',', ' ') : '0' }} Ar)</td>
            <td style="color: {{ $ecartPrix >= 0 ? '#dc3545' : '#28a745' }};">
                {{ number_format($ecartPrix, 2, ',', ' ') }}
            </td>
            <td style="color: {{ $economie >= 0 ? '#dc3545' : '#28a745' }};">
                {{ number_format($economie, 2, ',', ' ') }}
            </td>
            <td colspan="9">{{ $recommandation }}</td>
        </tr>

    @else
        <!-- Message si aucune donnée -->
        <tr>
            <td colspan="13" style="text-align: center; padding: 20px; color: #666;">
                <strong>AUCUNE DONNÉE DISPONIBLE</strong><br>
                Les données de soumission ne sont pas disponibles ou sont vides.
            </td>
        </tr>
    @endif
</table>