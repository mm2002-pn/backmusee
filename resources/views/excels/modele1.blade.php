<!DOCTYPE html>
<html lang="fr">
<head>
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .excel-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000000;
            margin-bottom: 20px;
        }

        .excel-table th, .excel-table td {
            border: 1px solid #000000;
            padding: 8px;
            vertical-align: top;
        }

        .excel-table th {
            background-color: #2E75B5;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .header-section {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #2E75B5;
            padding-bottom: 15px;
        }

        .section-title {
            background-color: #2E75B5;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
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
            padding: 10px;
        }

        .table-total {
            font-weight: bold;
            background-color: #2E75B5;
            color: white;
        }

        .rating-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }

        .rating-good {
            background-color: #d4edda;
            color: #155724;
        }

        .rating-medium {
            background-color: #fff3cd;
            color: #856404;
        }

        .rating-poor {
            background-color: #f8d7da;
            color: #721c24;
        }

        .result-box {
            background-color: #e9ecef;
            padding: 15px;
            border: 2px solid #000000;
            margin-top: 20px;
        }

        .signature-area {
            margin-top: 40px;
            border-top: 1px dashed #2E75B5;
            padding-top: 20px;
        }

        /* Styles pour augmenter les colonnes comme dans Excel */
        .col-A { width: 100% !important; }
        .col-B { width: 8% !important; }
        .col-C { width: 8% !important; }
        .col-D { width: 8% !important; }
        .col-E { width: 8% !important; }
        .col-F { width: 8% !important; }
        .col-G { width: 10%; }
        .col-H { width: 10%; }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header-section">
        <h4>SERVICE APPROVISIONNEMENT / SERVICE ASSURANCE QUALITE</h4>
        <h3>FICHE D'ÉVALUATION FOURNISSEUR ANNÉE 2025</h3>
    </div>

    <!-- Informations générales -->
    <table class="excel-table">
        <tr>
            <td colspan="8" class="centered-title">INFORMATIONS GÉNÉRALES</td>
        </tr>
        <tr>
            <td class="label">Date:</td>
            <td>{{ $data['date'] ?? '' }}</td>
            <td class="label">Evaluation n°:</td>
            <td>{{ $data['evaluation_number'] ?? '' }}</td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td class="label">Nom de l'évaluateur côté Approvisionnement:</td>
            <td>{{ $data['evaluator_appro_name'] ?? '' }}</td>
            <td class="label">Fonction:</td>
            <td>{{ $data['evaluator_appro_function'] ?? '' }}</td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td class="label">Nom de l'évaluateur côté Assurance Qualité:</td>
            <td>{{ $data['evaluator_quality_name'] ?? '' }}</td>
            <td class="label">Fonction:</td>
            <td>{{ $data['evaluator_quality_function'] ?? '' }}</td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td class="label">Marché évalué:</td>
            <td colspan="7">{{ $data['evaluated_market'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Informations sur le fournisseur -->
    <div class="section-title">INFORMATIONS SUR LE FOURNISSEUR</div>
    <table class="excel-table">
        <tr>
            <td class="label">Nom de l'entreprise:</td>
            <td colspan="7">{{ $data['company_name'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Adresse de l'entreprise:</td>
            <td colspan="7">{{ $data['company_address'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Téléphone:</td>
            <td>{{ $data['company_phone'] ?? '' }}</td>
            <td class="label">Email:</td>
            <td colspan="5">{{ $data['company_email'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Nom du dirigeant:</td>
            <td>{{ $data['manager_name'] ?? '' }}</td>
            <td class="label">Email du dirigeant:</td>
            <td colspan="5">{{ $data['manager_email'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Nom de l'interlocuteur:</td>
            <td>{{ $data['contact_name'] ?? '' }}</td>
            <td class="label">Poste de l'interlocuteur:</td>
            <td colspan="5">{{ $data['contact_position'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Email de l'interlocuteur:</td>
            <td colspan="7">{{ $data['contact_email'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Types produits:</td>
            <td colspan="7">{{ $data['product_types'] ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Statut du fournisseur (Local/Etranger):</td>
            <td>{{ $data['supplier_status'] ?? '' }}</td>
            <td class="label">Statut de production (Fabricants/Grossiste):</td>
            <td colspan="5">{{ $data['production_status'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Évaluation du fournisseur -->
    <div class="section-title">ÉVALUATION DU FOURNISSEUR</div>
    <table class="excel-table">
        <thead>
            <tr>
                <th class="col-A">CRITÈRES</th>
                <th class="col-B">NOTE</th>
                <th class="col-C">PONDÉRATION</th>
                <th class="col-D">NOTE PONDÉRÉE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>1. DÉLAI DE LIVRAISON /5pts</strong><br>
                    Conformité à 100%: 05 pts<br>
                    Conformité [90-99%]: 4 pts<br>
                    Conformité [80-89%]: 3 pts<br>
                    Conformité [70-79%]: 2 pts<br>
                    Conformité [&lt;70%]: 0 pt
                </td>
                <td>{{ $data['note1'] ?? '' }}</td>
                <td>0.2</td>
                <td>{{ isset($data['note1']) ? $data['note1'] * 0.2 : '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong>2. EXÉCUTION DU MARCHÉ (DÉSISTEMENT) /5pts</strong><br>
                    Désistement 0: 5 pts<br>
                    Désistement [1-25%]: 2,5 pts<br>
                    Désistement > 25%: 0 pts
                </td>
                <td>{{ $data['note2'] ?? '' }}</td>
                <td>0.15</td>
                <td>{{ isset($data['note2']) ? $data['note2'] * 0.15 : '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong>3. CONFORMITÉS AUX SPÉCIFICATIONS TECHNIQUES /5pts</strong><br>
                    SANS NC: 5pts<br>
                    Existence d'au moins 1 NC: 0pts
                </td>
                <td>{{ $data['note3'] ?? '' }}</td>
                <td>0.2</td>
                <td>{{ isset($data['note3']) ? $data['note3'] * 0.2 : '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong>4. EXISTENCE DE RÉCLAMATION CLIENT/SALAMA /5pts</strong><br>
                    Sans réclamation: 5 pts<br>
                    Existence de réclamation SALAMA: 2,5 pts<br>
                    Existence d'au moins 1 réclamation client: 0 pt
                </td>
                <td>{{ $data['note4'] ?? '' }}</td>
                <td>0.15</td>
                <td>{{ isset($data['note4']) ? $data['note4'] * 0.15 : '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong>5. RÉPONSES AUX RÉCLAMATIONS QUALITÉ ET ENREGISTREMENT /5pts</strong><br>
                    Réponse satisfaisante/ sans réclamation: 5 pts<br>
                    Réponse moyennement satisfaisante (délai et type): 2,5 pts<br>
                    Réponse non satisfaisante/ sans réponse: 0 pt
                </td>
                <td>{{ $data['note5'] ?? '' }}</td>
                <td>0.1</td>
                <td>{{ isset($data['note5']) ? $data['note5'] * 0.1 : '' }}</td>
            </tr>
            <tr>
                <td>
                    <strong>6. CONTRÔLE QUALITÉ POST MARKETING /5pts</strong><br>
                    Sans NC: 5 pts<br>
                    Existence de réclamation SALAMA: 2,5 pts<br>
                    Existence d'au moins 1 réclamation client: 0 pt
                </td>
                <td>{{ $data['note6'] ?? '' }}</td>
                <td>0.2</td>
                <td>{{ isset($data['note6']) ? $data['note6'] * 0.2 : '' }}</td>
            </tr>
            <tr class="table-total">
                <td><strong>TOTAL</strong></td>
                <td><strong>{{ $data['total_notes'] ?? '' }}</strong></td>
                <td><strong>1.0</strong></td>
                <td><strong>{{ $data['total_weighted'] ?? '' }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Résultats -->
    <div class="result-box">
        <div class="section-title">RÉSULTAT</div>
        <table class="excel-table">
            <tr>
                <td class="label">NOTE:</td>
                <td>{{ $data['final_score'] ?? '0%' }}</td>
                <td class="label">QUALIFICATION:</td>
                <td>
                    @if(isset($data['final_score']))
                        @if($data['final_score'] >= 80)
                            <span class="rating-badge rating-good">SATISFAISANT</span>
                        @elseif($data['final_score'] >= 50)
                            <span class="rating-badge rating-medium">MOYENNEMENT SATISFAISANT</span>
                        @else
                            <span class="rating-badge rating-poor">NON SATISFAISANT</span>
                        @endif
                    @else
                        <span class="rating-badge">NON ÉVALUÉ</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">MESURES:</td>
                <td colspan="3">
                    @if(isset($data['final_score']))
                        @if($data['final_score'] >= 80)
                            INTÉGRATION EN TANT QUE PARTENAIRE STRATÉGIQUE
                        @elseif($data['final_score'] >= 50)
                            REMERCIEMENTS ET ENCOURAGEMENTS
                        @else
                            AVERTISSEMENTS
                        @endif
                    @else
                        Veuillez compléter l'évaluation pour voir les mesures recommandées.
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Informations supplémentaires -->
    <table class="excel-table">
        <tr>
            <td colspan="4">
                <p><i class="fas fa-exclamation-triangle"></i> Si + 3 AVERTISSEMENTS = écartement pour une période de 1 an</p>
                <p><i class="fas fa-info-circle"></i> En cas de marché en cours, engagement sur l'amélioration des performances pour ces marchés et sur les critères évalués (délais, qualité, désistement….)</p>
            </td>
        </tr>
    </table>

    <!-- Signatures -->
    <div class="signature-area">
        <div class="section-title">SIGNATURES</div>
        <table class="excel-table">
            <tr>
                <td class="label">Evaluateur APPRO</td>
                <td>{{ $data['signature_appro'] ?? '' }}</td>
                <td class="label">Evaluateur QUALITE</td>
                <td>{{ $data['signature_quality'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Responsable Approvisionnement IS</td>
                <td>{{ $data['signature_supply'] ?? '' }}</td>
                <td class="label">Pharmacien Responsable</td>
                <td>{{ $data['signature_pharmacist'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="label">Directeur des Approvisionnements et Stocks</td>
                <td colspan="3">{{ $data['signature_director'] ?? '' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>