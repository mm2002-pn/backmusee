<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Résumé de la Demande</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #0056b3;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 22px;
            font-weight: bold;
        }

        .logo {
            text-align: center;
            margin: 20px 0;
        }

        .logo img {
            width: 130px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            font-size: 14px;
            margin: 10px 0;
            padding: 10px;
            background: #f9f9f9;
            border-left: 5px solid #0056b3;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Résumé de la Demande</div>
        <div class="logo">
            <img src="{{ asset('images/logo-etpp-.png') }}" alt="Logo">
        </div>
        <div class="content">
            <p><strong>Fonction :</strong> {{ $data['fonction'] ?? 'Non spécifié' }}</p>
            <p><strong>Téléphone :</strong> {{ $data['numbtel'] ?? 'Non spécifié' }}</p>
            <p><strong>Email :</strong> {{ $data['email'] ?? 'Non spécifié' }}</p>
            <p><strong>Email :</strong> {{ $data['email'] }}</p>
            <p><strong>Entreprise :</strong> {{ $data['companyName'] }}</p>
            <p><strong>SIRET :</strong> {{ $data['siret'] }}</p>
            <p><strong>Secteur d'activité :</strong> {{ $data['activitySector'] }}</p>
            <p><strong>Pays :</strong> {{ $data['pays']["label"] ?? "Non spécifié" }}</p>
            <p><strong>Site Web :</strong> {{ $data['website'] ?? "Non spécifié" }}</p>
            <p><strong>Type de demande :</strong> {{ $data['type_demande']["label"] ?? "Non spécifié" }}</p>
            <p><strong>Message :</strong> {{ $data['message'] }}</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} - Tous droits réservés.
        </div>
    </div>
</body>

</html>