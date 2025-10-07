<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut de l'envoi FTP</title>
</head>

<body>
    <div style="text-align: center; margin-top: 50px;">
        @if ($status === 'success')
        <h1 style="color: green;">Succès</h1>
        @else
        <h1 style="color: red;">Erreur</h1>
        @endif
        <p>{{ $message }}</p>

        <div style="margin-top: 20px;">
            <a href="{{ url('/#!/list-ao') }}" style="padding: 10px 20px; background: #007BFF; color: white; text-decoration: none; border-radius: 5px;">
                Retour à l'accueil
            </a>
        </div>
    </div>
</body>

</html>