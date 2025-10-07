<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>QR Codes des Œuvres</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .oeuvre {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .oeuvre img.photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }

        .oeuvre .infos {
            flex: 1;
        }

        .oeuvre .qrcode {
            text-align: center;
        }

        .oeuvre .qrcode img {
            width: 120px;
            height: 120px;
        }
    </style>
</head>

<body>
    <h2>QR Codes des Œuvres du Musée</h2>

    @foreach ($oeuvres as $oeuvre)
    <div class="oeuvre">
        <img src="{{ public_path($oeuvre['image_url']) }}" class="photo" alt="{{ $oeuvre['designation'] }}">
        <div class="infos">
            <strong>{{ $oeuvre['titre_fr'] }}</strong><br>
            <small>{{ $oeuvre['artiste'] }}</small><br>
            <small>{{ $oeuvre['origine'] }} - {{ $oeuvre['date_creation'] }}</small><br>
            <small>{{ $oeuvre['description_fr'] }}</small>
        </div>
        <div class="qrcode">
            <img src="data:image/png;base64,{{ $oeuvre['qr_code_image'] }}" alt="QR {{ $oeuvre['qr_code'] }}">
            <div><small>{{ $oeuvre['qr_code'] }}</small></div>
        </div>
    </div>
    @endforeach
</body>

</html>