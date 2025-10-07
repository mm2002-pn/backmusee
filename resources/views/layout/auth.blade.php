<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

<head>
    @include('includes.head')
</head>

<body class="">
   

    <!-- Start wrapper-->
    <div id="wrapper">

        @yield('content')

    </div><!--wrapper-->

    @include('includes.foot')
</body>

</html>
