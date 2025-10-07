<!DOCTYPE html>
<html lang="fr">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 10px;
        }

        .excel-table th,
        .excel-table td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .excel-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .header-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .section-title {
            background-color: #2E75B5;
            color: white;
            padding: 8px;
            margin-top: 15px;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }

        .label {
            font-weight: bold;
            background-color: #e9ecef;
            width: 25%;
        }

        .centered-title {
            text-align: center;
            font-weight: bold;
            background-color: #2E75B5;
            color: white;
            padding: 8px;
        }

        .decision-cell {
            text-align: center;
            font-weight: bold;
        }

        .yes-no-table {
            width: 100%;
            border-collapse: collapse;
        }

        .yes-no-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        .observation-cell {
            width: 30%;
        }

        .small-text {
            font-size: 10px;
        }

        .signature-area {
            margin-top: 30px;
            border-top: 1px dashed #2E75B5;
            padding-top: 15px;
        }

        .info-cell {
            height: 25px;
        }
    </style>
</head>

<body>
    <!-- En-tête -->
    <div class="header-section">
        <h3>GRILLE D'ÉVALUATION DES DOSSIERS PHARMACEUTIQUES ET ÉCHANTILLONS</h3>
    </div>

    <!-- Informations générales -->
    <table class="excel-table">
        <tr>
            <td class="label">Date:</td>
            <td>{{ $data['date'] ?? '' }}</td>
            <td class="label">Evaluateur(s):</td>
            <td>{{ $data['evaluators'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <td class="label">Numéro de la demande :</td>
            <td>{{ $data['request_number'] ?? '' }}</td>
            <td class="label">Date de la demande :</td>
            <td>{{ $data['request_date'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Nom commercial du produit:</td>
            <td>{{ $data['product_name'] ?? '' }}</td>
            <td class="label">DCI :</td>
            <td>{{ $data['dci'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Dosage par dose unitaire :</td>
            <td>{{ $data['dosage'] ?? '' }}</td>
            <td class="label">Forme :</td>
            <td>{{ $data['form'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Conditionnement :</td>
            <td>{{ $data['packaging'] ?? '' }}</td>
            <td class="label"></td>
            <td></td>
        </tr>
        <tr>
            <td class="label">Numéro de lot :</td>
            <td>{{ $data['lot_number'] ?? '' }}</td>
            <td class="label">Date de fabrication :</td>
            <td>{{ $data['manufacturing_date'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Date de peremption :</td>
            <td>{{ $data['expiry_date'] ?? '' }}</td>
            <td class="label"></td>
            <td></td>
        </tr>
        <tr>
            <td class="label">Précautions particulières de conservation :</td>
            <td colspan="3">{{ $data['storage_conditions'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Spécialité de référence :</td>
            <td colspan="3">{{ $data['reference_specialty'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Fabricant du produit à evaluer :</td>
            <td colspan="3">{{ $data['manufacturer'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Titulaire AMM :</td>
            <td colspan="3">{{ $data['marketing_authorization_holder'] ?? '' }}</td>
        </tr>
    </table>

    <!-- 1- FABRICANT -->
    <div class="section-title">1- FABRICANT</div>

    <!-- A- Identité du Fabricant -->
    <div class="section-title">A- Identité du Fabricant</div>
    <table class="excel-table">
        <tr>
            <td class="label">Nom :</td>
            <td colspan="3">{{ $data['manufacturer_name'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Référence Licence de fabrication:</td>
            <td colspan="3">{{ $data['manufacturing_license_ref'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Adresses des sites de Fabrication :</td>
            <td colspan="3">{{ $data['manufacturing_sites'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Adresses des sites de libération des lots:</td>
            <td colspan="3">{{ $data['batch_release_sites'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Téléphone :</td>
            <td>{{ $data['manufacturer_phone'] ?? '' }}</td>
            <td class="label">Site web :</td>
            <td>{{ $data['manufacturer_website'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Courriel :</td>
            <td colspan="3">{{ $data['manufacturer_email'] ?? '' }}</td>
        </tr>
    </table>

    <!-- B- Certificat de Bonnes Pratiques de Fabrication (BPF) -->
    <div class="section-title">B- Certificat de Bonnes Pratiques de Fabrication (BPF)</div>
    <table class="excel-table">
        <tr>
            <td class="label">Nom et adresse de l'Autorité Réglementaire émettrice du pays d'origine :</td>
            <td colspan="3">{{ $data['regulatory_authority'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Date:</td>
            <td>{{ $data['gmp_certificate_date'] ?? '' }}</td>
            <td class="label">N° Référence:</td>
            <td>{{ $data['gmp_certificate_ref'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <th width="60%"></th>
            <th width="10%">OUI</th>
            <th width="10%">NON</th>
            <th width="20%">Remarques et Observations</th>
        </tr>
        <tr>
            <td>Adresse physique du site de fabrication indiquée de façon explicite et suffisamment précise</td>
            <td class="decision-cell">{{ $data['gmp_address_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_address_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_address_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Site de fabrication autorisé à fabriquer la forme pharmaceutique</td>
            <td class="decision-cell">{{ $data['gmp_form_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_form_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_form_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Site de fabrication autorisé à effectuer les opérations de fabrication (fabrication du produit fini, conditionnement, libération de lots…)</td>
            <td class="decision-cell">{{ $data['gmp_operations_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_operations_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_operations_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Existence d'une autorisation spécifique si nécessaire (pour vaccins, hormones, antibiotiques etc,)</td>
            <td class="decision-cell">{{ $data['gmp_specific_auth_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_specific_auth_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_specific_auth_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Cohérence des données avec celles mentionnées sur le conditionnement</td>
            <td class="decision-cell">{{ $data['gmp_packaging_consistency_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_packaging_consistency_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_packaging_consistency_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Certificat en cours de validité</td>
            <td class="decision-cell">{{ $data['gmp_validity_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_validity_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_validity_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Signé, cachet lisible,copie certifiée conforme à l'original/document original (signature électronique accompagnée du QR code qu'on peut lire / scanner et relié à l'autorité émettrice)</td>
            <td class="decision-cell">{{ $data['gmp_signature_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_signature_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_signature_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Correction et/ou surcharge lisibles et validées par une signature</td>
            <td class="decision-cell">{{ $data['gmp_correction_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_correction_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_correction_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Traduction du document dans une langue compréhensible (français, anglais)</td>
            <td class="decision-cell">{{ $data['gmp_translation_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['gmp_translation_not_ok'] ?? '' }}</td>
            <td>{{ $data['gmp_translation_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <!-- DÉCISION 1 -->
    <table class="excel-table">
        <tr>
            <td class="centered-title">DÉCISION 1</td>
            <td class="decision-cell">{{ $data['decision1_favorable'] ?? '' }} Favorable</td>
            <td class="decision-cell">{{ $data['decision1_deferred'] ?? '' }} Différé</td>
            <td></td>
        </tr>
    </table>

    <!-- 2- CERTIFICAT DE PRODUIT PHARMACEUTIQUE (CPP) -->
    <div class="section-title">2- CERTIFICAT DE PRODUIT PHARMACEUTIQUE (CPP)</div>
    <table class="excel-table">
        <tr>
            <td class="label">Nom et adresse de l'Autorité Réglementaire émettrice du pays d'origine :</td>
            <td colspan="3">{{ $data['cpp_regulatory_authority'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Date:</td>
            <td>{{ $data['cpp_date'] ?? '' }}</td>
            <td class="label">Référence:</td>
            <td>{{ $data['cpp_reference'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <th width="60%"></th>
            <th width="10%">OUI</th>
            <th width="10%">NON</th>
            <th width="20%">Remarques et Observations</th>
        </tr>
        <tr>
            <td>Informations requises par les recommandations OMS complètes</td>
            <td class="decision-cell">{{ $data['cpp_requirements_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_requirements_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_requirements_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Concerne bien le produit en question</td>
            <td class="decision-cell">{{ $data['cpp_product_match_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_product_match_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_product_match_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Correspond bien au site de fabrication indiqué</td>
            <td class="decision-cell">{{ $data['cpp_site_match_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_site_match_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_site_match_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Cohérence des données avec celles mentionnées sur le conditionnement</td>
            <td class="decision-cell">{{ $data['cpp_packaging_consistency_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_packaging_consistency_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_packaging_consistency_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Certificat en cours de validité</td>
            <td class="decision-cell">{{ $data['cpp_validity_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_validity_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_validity_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Signé, cachet lisible,copie certifiée conforme à l'original/document original (signature électronique accompagnée du QR code qu'on peut lire / scanner et relié à l'autorité émettrice)</td>
            <td class="decision-cell">{{ $data['cpp_signature_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_signature_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_signature_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Correction et/ou surcharge lisibles et validées par une signature</td>
            <td class="decision-cell">{{ $data['cpp_correction_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_correction_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_correction_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Traduction du document dans une langue compréhensible (français, anglais)</td>
            <td class="decision-cell">{{ $data['cpp_translation_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['cpp_translation_not_ok'] ?? '' }}</td>
            <td>{{ $data['cpp_translation_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <!-- DÉCISION 2 -->
    <table class="excel-table">
        <tr>
            <td class="centered-title">DÉCISION 2</td>
            <td class="decision-cell">{{ $data['decision2_favorable'] ?? '' }} Favorable</td>
            <td class="decision-cell">{{ $data['decision2_deferred'] ?? '' }} Différé</td>
            <td></td>
        </tr>
    </table>

    <!-- 3- STATUT D'APPROBATION DU PRODUIT -->
    <div class="section-title">3- STATUT D'APPROBATION DU PRODUIT</div>

    <!-- AMM pays d'origine -->
    <table class="excel-table">
        <tr>
            <th>AMM pays d'origine</th>
            <th>Pays</th>
            <th>N°</th>
            <th>Date</th>
            <th>Remarques et Observations</th>
        </tr>
        <tr>
            <td></td>
            <td>{{ $data['home_country_amm_country'] ?? '' }}</td>
            <td>{{ $data['home_country_amm_number'] ?? '' }}</td>
            <td>{{ $data['home_country_amm_date'] ?? '' }}</td>
            <td>{{ $data['home_country_amm_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <th width="60%"></th>
            <th width="10%">OUI</th>
            <th width="10%">NON</th>
            <th width="20%">Remarques et Observations</th>
        </tr>
        <tr>
            <td>AMM correspondant au produit faisant l'objet de la demande</td>
            <td class="decision-cell">{{ $data['home_country_match_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['home_country_match_not_ok'] ?? '' }}</td>
            <td>{{ $data['home_country_match_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>AMM en cours de validité</td>
            <td class="decision-cell">{{ $data['home_country_validity_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['home_country_validity_not_ok'] ?? '' }}</td>
            <td>{{ $data['home_country_validity_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Signé, cachet lisible,copie certifiée conforme à l'original/document original (signature électronique accompagnée du QR code qu'on peut lire / scanner et relié à l'autorité émettrice)</td>
            <td class="decision-cell">{{ $data['home_country_signature_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['home_country_signature_not_ok'] ?? '' }}</td>
            <td>{{ $data['home_country_signature_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Correction et/ou surcharge lisibles et validées par une signature</td>
            <td class="decision-cell">{{ $data['home_country_correction_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['home_country_correction_not_ok'] ?? '' }}</td>
            <td>{{ $data['home_country_correction_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Traduction du document dans une langue compréhensible (français, anglais)</td>
            <td class="decision-cell">{{ $data['home_country_translation_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['home_country_translation_not_ok'] ?? '' }}</td>
            <td>{{ $data['home_country_translation_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <!-- AMM pays tiers -->
    <table class="excel-table">
        <tr>
            <th>AMM pays tiers</th>
            <th>Pays</th>
            <th>N°</th>
            <th>Date</th>
            <th>Remarques et Observations</th>
        </tr>
        <tr>
            <td></td>
            <td>{{ $data['third_country_amm_country'] ?? '' }}</td>
            <td>{{ $data['third_country_amm_number'] ?? '' }}</td>
            <td>{{ $data['third_country_amm_date'] ?? '' }}</td>
            <td>{{ $data['third_country_amm_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <th width="60%"></th>
            <th width="10%">OUI</th>
            <th width="10%">NON</th>
            <th width="20%">Remarques et Observations</th>
        </tr>
        <tr>
            <td>AMM correspondant au produit faisant l'objet de la demande</td>
            <td class="decision-cell">{{ $data['third_country_match_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['third_country_match_not_ok'] ?? '' }}</td>
            <td>{{ $data['third_country_match_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>AMM en cours de validité</td>
            <td class="decision-cell">{{ $data['third_country_validity_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['third_country_validity_not_ok'] ?? '' }}</td>
            <td>{{ $data['third_country_validity_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Signé, cachet lisible,copie certifiée conforme à l'original/document original (signature électronique accompagnée du QR code qu'on peut lire / scanner et relié à l'autorité émettrice)</td>
            <td class="decision-cell">{{ $data['third_country_signature_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['third_country_signature_not_ok'] ?? '' }}</td>
            <td>{{ $data['third_country_signature_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Correction et/ou surcharge lisibles et validées par une signature</td>
            <td class="decision-cell">{{ $data['third_country_correction_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['third_country_correction_not_ok'] ?? '' }}</td>
            <td>{{ $data['third_country_correction_remarks'] ?? '' }}</td>
        </tr>
        <tr>
            <td>Traduction du document dans une langue compréhensible (français, anglais)</td>
            <td class="decision-cell">{{ $data['third_country_translation_ok'] ?? '' }}</td>
            <td class="decision-cell">{{ $data['third_country_translation_not_ok'] ?? '' }}</td>
            <td>{{ $data['third_country_translation_remarks'] ?? '' }}</td>
        </tr>
    </table>

    <table class="excel-table">
        <tr>
            <td class="label">Si produit non enregistré dans le pays d'origine ni enregistré dans un pays tiers , raison de l'absence d'AMM indiquée et acceptable</td>
            <td colspan="3">{{ $data['no_amm_reason'] ?? '' }}</td>
        </tr>
    </table>

    <!-- DÉCISION 3 -->
    <table class="excel-table">
        <tr>
            <td class="centered-title">DÉCISION 3</td>
            <td class="decision-cell">{{ $data['decision3_favorable'] ?? '' }} Favorable</td>
            <td class="decision-cell">{{ $data['decision3_deferred'] ?? '' }} Différé</td>
            <td class="decision-cell">{{ $data['decision3_unfavorable'] ?? '' }} Défavorable</td>
        </tr>
    </table>

    <!-- Les autres sections continueraient de la même manière... -->

    <!-- AVIS DU COMITÉ D'EVALUATION -->
    <div class="section-title">AVIS DU COMITÉ D'EVALUATION</div>
    <table class="excel-table">
        <tr>
            <td rowspan="3">
                ADMIN:<br><br>
                CLINIQUE:<br><br>
                QUALITÉ:
            </td>
            <td class="decision-cell">{{ $data['committee_favorable'] ?? '' }} Favorable</td>
            <td>Noms des évaluateurs</td>
            <td>Signature et cachet</td>
        </tr>
        <tr>
            <td class="decision-cell">{{ $data['committee_deferred'] ?? '' }} Différé (nécéssitant de compléments d'information ou d'éclaircissements)</td>
            <td>{{ $data['evaluator_names'] ?? '' }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="decision-cell">{{ $data['committee_unfavorable'] ?? '' }} Défavorable</td>
            <td>Validé par:<br>{{ $data['validator_name'] ?? '' }}</td>
            <td>Signature et cachet</td>
        </tr>
    </table>

    <!-- Signatures finales -->
    <table class="excel-table signature-area">
        <tr>
            <td class="label">EVALUATEUR ADMINISTRATIF</td>
            <td>{{ $data['admin_evaluator'] ?? '' }}</td>
            <td class="label">EVALUATEUR QUALITE</td>
            <td>{{ $data['quality_evaluator'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">EVALUATEUR CLINIQUE</td>
            <td>{{ $data['clinical_evaluator'] ?? '' }}</td>
            <td class="label">REPRESENTANT SALAMA</td>
            <td>{{ $data['salama_representative'] ?? '' }}</td>
        </tr>
    </table>
</body>

</html>