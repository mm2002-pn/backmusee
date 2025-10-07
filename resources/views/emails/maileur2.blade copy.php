<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Demande de Contact - ETP</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 150px;
      margin-top: 20px;
    }

    h2 {
      font-size: 24px;
      color: #333;
      margin-top: 20px;
    }

    .content {
      font-size: 16px;
      color: #333;
      line-height: 1.6;
    }

    .content p {
      margin-bottom: 10px;
    }

    .info-list {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .info-list li {
      margin-bottom: 10px;
    }

    .info-list li strong {
      color: #2d6c86;
    }

    .footer {
      text-align: center;
      font-style: italic;
      margin-top: 30px;
      color: #777;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">
      <img alt="Logo ETP" src="https://etpsenegal.com/wp-content/uploads/2020/06/logo-etpp-.png">
    </div>

    <h2>Nouvelle Demande de Contact - ETP</h2>

    <div class="content">
      <p><strong>Informations de l'expéditeur :</strong></p>
      <ul class="info-list">
        <li><strong>Nom complet :</strong> {{ $nom }}</li>
        <li><strong>Email :</strong> {{ $from }}</li>
      </ul>

      <p><strong>Message :</strong></p>
      <p>{{ $texte }}</p>
    </div>

    <div class="footer">
      <p>L'équipe ETP</p>
    </div>
  </div>

</body>

</html>