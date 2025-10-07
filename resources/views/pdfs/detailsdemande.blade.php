<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <title>PDF rapport de demande d'absence {{date('d/m/Y')}}</title>

    <style>
        @page {
            margin: 20px 0px;
        }

        table, th, td {
            border: 1px solid #585b5e;
            border-collapse: collapse;
            padding: .4rem;
        }

        th {
            font-size: 14px;
        }

        td {
            font-size: 12px;
        }

        .table {
            display: table;
            border-collapse: collapse;
            border: 1px  solid black;
            letter-spacing: 1px;
            font-size: 0.6rem;
            width: 100%;
        }

        .td, .th {
            border: 0.6px solid black;
            padding: 15px 5px;

        }

        .th {
            background-color: rgb(0 154 191);
            text-transform: uppercase;
            padding: 15px 5px;
            /* color: white; */
            font-weight: 600;
        }

        .td {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 5.1cm;
            margin-left: 1.0cm;
            margin-right: 1.0cm;
            margin-bottom: 5cm;
            /*margin-bottom: 1.2cm;*/
            /*font-size: 1.2em;*/
            /*font: 12pt/1.5 'Raleway','Cambria', sans-serif;*/
            font-weight: 400;
            background:  #fff;
            color: black;
            -webkit-print-color-adjust:  exact;
        }

        /** Define the header rules **/
        .header {
            position: fixed;
            top: 0.8cm;
            height: 2cm;
            left: 1cm;
            right: 1cm;
            width: 100%;
        }

        /** Define the footer rules **/
        .footer {
            position: fixed;
            bottom: -5px;
            height: 2.3cm;
            margin-left: 1.0cm;
            margin-right: 1.0cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        #break {
            display:inline;
        }
        #break:after {
            content:"\a";
            white-space: pre;
        }

        .box {
            display: flex;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .titre-top-0 {
            font-size: 24px;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .titre-top-1 {
            font-size: 20px;
            text-decoration: underline;
        }


        .titre-top-2 {
            font-size: 18px;
            line-height: 25px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .lh-25 {
            line-height: 25px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .wd-40 {
            width: 40%;
        }

        .wd-50 {
            width: 50%;
        }

        .wd-80 {
            width: 80%;
        }

        .wd-100 {
            width: 100%;
        }

        .mx-auto {
            margin: 0 auto;
        }

        .break-auto
        {
            page-break-inside: auto;
        }

        .break-before {
            page-break-before: always;
        }
        .no-break {
            page-break-inside: avoid;
        }

        .clearfix:after {
            content: " ";
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }

        .item-border-b {
            border-bottom: 2px solid #000000;
            padding-bottom: 3px;
        }
    </style>

</head>
<!--<header style="width:100%;">
    <div class="header" style="">
    </div>
</header>-->

<header style="width:100%;margin-top: -30px">
    <div class="header" style="">
        <img style="width: 10%" src="data:image/png;base64,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" alt="">
    </div>
</header>
<!-- footer -->
<div class="footer mb-60" style="width: 700px">
    <div>
        <img style="width: 10%;" src="data:image/png;base64,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" alt="">
    </div>
</div>
<body>
    {{-- <div style="font-size:13px;text-align: right; margin-right: 30px !important;margin-top: -60px">
        <div>Dakar, {{date('d/m/Y')}}<</div>
    </div> --}}
    <div style="font-size: 22px;font-weight: bold;text-align: center;margin: 30px 0 10px;text-transform: uppercase;margin-top: -60px">
        <div style="font-weight: 500;font-size: 18px;">DEMANDE D'ABSENCE : <em>{{ $data->typeDemande->designation}} </em> </div>
    </div>
    <br><br>
    <br><br>
    <br><br>
    {{-- @dd($data->user) --}}

    <div style="margin-top: -120px">
        <div style="font-size: 13px;font-weight: bold;text-align: left;margin-left: 30px !important;">

            <h3 style="text-transform: uppercase;">Infos employé</h3>
            <div class="" style="">

                <h5 ><b style="text-transform: uppercase;">Nom & prénom : </b> {{$data->user->prenom}} {{$data->user->nom}} </h5>
                <h5 ><b style="text-transform: uppercase;">Email : </b>{{$data->user->email}} </h5>
                <h5 ><b style="text-transform: uppercase;">Département : </b> {{$data->user->departement->designation}} </h5>
            </div>
        </div>
        <div style="font-size:13px;text-align: right; margin-right: 30px !important;margin-top: -220px;font-weight: bold;" class="mb-30">
            <h3 style="text-transform: uppercase;" >Infos demande</h3>
            <div >
                <h5 ><b style="text-transform: uppercase;text-align:right">Date de début : </b> {{ date('d-m-Y H:i:s', strtotime($data->dateDebut)) }}  </h5>
                <h5 ><b style="text-transform: uppercase;text-align:right">Date de fin  : </b> {{ date('d-m-Y H:i:s', strtotime($data->dateFin)) }}  </h5>
                <h5 ><b style="text-transform: uppercase;text-align:right">Durée : </b> {{ $duree->d }} Jours ,{{ $duree->h }} heures </h5>
            </div>

        </div>
        <div style="text-align: left;margin-left: 30px !important;font-size:12px" class="mb-30">
            <h5 ><b style="text-transform: uppercase;">Motif de la demande : </b> </h5>

            <div class="" style="color:
            #000000">
                <em>
                    {{$data->commentaire}}
                </em>
            </div>
        </div>
        
        <div style="font-size:13px;text-align: right; margin-right: 30px !important;margin-top: 20px;font-weight: bold;" class="mb-30">
            <em>
                <h4>L'ADMINISTRATION</h4>
            </em>
            <div>
                <img style="width: 10%;margin-right:2%" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAilBMVEXjJyf////hAADjICDjIyPiEhP85+fnWlriHh7iEBDiCwviFxf0u7zpYGH+9PX86urnRkf2x8fqa2v3zc3lPj763d352NnukpPlNDXsgIDzrq7mS0vkKyvrdHT0tbX97u7nUlPthIXwn6D2wcHwmJnujI3qbm/lODjpZGbyqKnxpKTtiIn40tLmTU6iRnFdAAAFgklEQVR4nO3ZiXKjOBQFUJAEFmAbg/clxlu2jvv/f2/0nliEY/d0VZx4hrqnuqvYjHRBSIJ4HgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8h6kkEkYcyEfX5HtIsVj2Z0URZoddnDy6Nven4nXm18J91LX7KIOV3xLuokfX6a7kIvQv7cWja3VHcjH8FND3n7sTUQXplYC+/9KZ/kb0rwb0/Y16dNXuQ/duBPSPHWmn4nwroT/pxE1Uk5sB/VUnhgyZH/uXtjObsIgfXbu7kPEnoupcF51opkF0SRyqZvqkH127OxDDz+oHcd6FIVHc7mh8/9T5hJ24h3JwyZkBdOI59HTQJrYdG/LV6CVveWoCDjsxHqr17cdw24k5jSdmNxOOym8ZSd2Ebc+jzFLVfstGHseJKvfYVVnuTKqN7rmS5kheawooi7go4Wsdnh7cCjgu3y2SsJIe6a6q1zQsykc06qd213meSDPJLezatD8wP462aXqO1Yg2Fm8cMd6a49MsVq/OScU4bdaygCbLpoTXsgQ6ydciiuxGwrIIL2g2zSh09E4t2D6jYtw8tRPpTuPNu1dsdqZCjXi9Tz9Qkpenwj1yJtyPKFNzXEyfjcp5f2yqV3wtodLF1YDLwLuaUGme9Eh1kdCfxa0XlVNClQurhENqxnp5JeFUuB8ZwthTikuw7ZROkgY3a/9X5OTad5pD/f5LCcfPc7I0A2Sy5/3zoEqYbiYT3raRVO/TYrL+5dPdayXkwbW8IGXCY3nSYJDnb3M651ueD6SXPPNRz8m9Enp69PkunpoXfEr4LhJCM4B4ygekUZ1QKMWz9QUnfI6U5CRuQrOeCU9tzL2c1gnn1Uml1sGb2fAWaG0e17LVhvHdEnpaHdv5ijdnKKSEK6GJR5Mgqpv5/6LrhGaeYE4QBlzv51jrTwnpB0rRzcnGTkJ+WbPdbm425DyH0hT2RIH13RJ6SgycQaM4aXe6RgmzpyVZ2I5pKky7Posy4fB0OGQcmev9a9fLqacI3YRP5vT7hEamp3OdcMbv28eebCcUfA38sjO/U0JTghidstS8Os1WeTMW1QlLI2Vvk6AIa+n2NOFOtD+JzN2e5mlOl2RhloLZZU/Ds98mIR+/58njSN0xIf3tKRbC/Isup9uthBF1IjqhWtCA4fSlaZ649d4Kz0m4pD3Jie7LvyWMzNUb2hJW8V0T3tRKGJj2OR7tJtQZbJRtpavVlsfUnaZ6p9Tew4nwWgmp91hOaaFJOM3GxnnQaqVcQmZLGHrqxxK+C6bKoaJsh0HZ00SRoHodBdX7Q9CMYKAvEprOlq6K5yS82tMkH04JZsD4qYTVh8XW9KMQZULPfnYNOaHJ7duNbsLAjoqZcBKeIsVaCVslmAGDE0b1cd+dkIeKdEoKfoJsQoN2zGzCJDpw9VsJkzi0z5yT8OAtmJtQt0vINSfc8HGbH0jIc9gRNS6x5kjc09DEmlttZBPaWddGtRIG1EX5Wn3uafy1ahJyCa9cws6n/jdups0f3/VRpUmoFn45+zZhaWrz252XnhNpE3rRiRtkK6GkS5LF3p8TcgnnsgS662vxQwntyzD/qXhpy+E+59j81SOcB3awNAmVpJuY085C8Dv23sQueGCgKxO2E/6mhC8+zRmCrV9/HuI+p+9cw29LqHq93ogfc7Uzi/V2s9zTv3tsNxFU/MYs0pujHJmFtVybHZI2DsybmDJryp5jp/jICj1fajHoDRaKS6i6FDpmp9fVYYPXb+trpJTluZVZbG+mLbI5oFpS9c5mo7K/VXZNNrzmF38ooS4DAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4P/kHyRGVyZBNwt7AAAAAElFTkSuQmCC" alt="">
            </div>
        </div>
     
      
    </div>
<div>

    {{-- <table class="table mb-20">
        <tr class="tr">
            <th class="whitespace-no-wrap">N°</th>
            <th class="whitespace-no-wrap">Descriptif</th>
            <th class="whitespace-no-wrap">Locataire</th>
            <th class="whitespace-no-wrap">Adresse appartement </th>
            <th class="whitespace-no-wrap">Montant loyer </th>
        </tr>


    </table> --}}

</div>

<script type="text/php">
    if (isset($pdf)) {
        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Verdana");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width) / 2;
        $y = $pdf->get_height() - 35;
        $pdf->page_text($x, $y, $text, $font, $size);

    }
</script>
</body>



</html>









