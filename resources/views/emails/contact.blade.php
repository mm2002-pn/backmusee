<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    <div style="text-align: center;margin-top: 20px">
       <img style="width: 150px" alt="" src="http://199.247.7.51/dmd_back/assets/images/logo/logo.png">
    </div>

    <h2>Demande d'accès</h2>
    <p>
        Bienvenue {{ $nomClient }} Votre demande d'accès a bien été prise en compte.
        Vous recevrez un email dès qu'elle sera validée par l'administration
    </p>
    <ul style="padding: 7px 0">
      <li style="list-style-type: none;"><strong>Code</strong> : {{ $codeClient }}</li>
      <li style="list-style-type: none;"><strong>Nom</strong> : {{ $nomClient }}</li>
    </ul>

    <div style="font-style: italic">L'equipe DMD</div>

  </body>
</html>
