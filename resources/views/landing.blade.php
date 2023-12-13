<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body >
    @include('customer.nav')

    <div id="contentMain">
        @yield('content')
    </div>


{{-- <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top mt-auto px-5">
    <div class="col-md-4 d-flex align-items-center">
      <span class="text-white">&copy; 2023 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a href="#"> <i class="fa-brands fa-facebook fa-lg"> </a></i></li>
      <li class="ms-3"><a href="#"> <i class="fa-brands fa-instagram fa-lg"> </a></i></li>
      <li class="ms-3"><a href="#"> <i class="fa-brands fa-twitter fa-lg"> </a></i></li>
    </ul>
</footer> --}}


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>

<style>
    body{
        font-family: 'Open Sans';
        background-color: rgb(63, 63, 63);
        /* background-image: url('https://source.unsplash.com/1600x900/?music,instruments'); */
        background-size: cover;
        backdrop-filter: 2px;
        overflow-x: hidden;
        height: 100vh;
    }
    /* #contentMain {
        min-height: 100vh;
    } */
    html {
        scroll-behavior: smooth;
    }

</style>
