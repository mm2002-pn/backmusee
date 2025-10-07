<style>
    body {
        text-align: center;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    h1 {
        font-size: 50px;
    }

    p {
        font-size: 20px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }
</style>

<div>
    <h1>Erreur </h1>
    <p>{{ $exception->getMessage() ? : 'Une erreur est survenue.' }}</p>
    <a href="{{ url('/') }}">Retour à l'accueil</a>
</div>