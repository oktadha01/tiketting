<!DOCTYPE html>
<html>

<head>
    <title>PDF Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        .btn-group {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            height: auto;
            width: auto;
        }

        .btn-group{
            display: inline-block;
            margin: 5px;
            padding: 15px 25px;
            background-color: #222;
            color: #fff;
            text-transform: uppercase;
            cursor: pointer;
        }



        .nav {
            position: fixed;
            background-color: #222;
            -webkit-transition: .5s;
            -moz-transition: .5s;
            -o-transition: .5s;
            transition: .5s;
        }

        .nav .ul {
            margin: 0;
            padding: 0;
        }

        .nav .ul .li {
            list-style-type: none;
        }

        .nav .ul .li .a {
            text-decoration: none;
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-align: center;
            font-size: 20px;
        }




        .nav.left,
        .nav.right {
            height: 100%;
            width: 250px;
        }

        .nav.left {
            top: 0;
            left: -250px;
        }

        .nav.left.active {
            left: 0;
        }

        .nav.right {
            top: 0;
            right: -250px;
        }

        .nav.right.active {
            right: 0;
        }



        .nav.top,
        .nav.bottom {
            height: 100px;
            width: 100%;
        }

        .nav.top {
            top: -100px;
            left: 0px;
        }

        .nav.top.active {
            top: 0;
        }

        .nav.bottom {
            bottom: -100px;
            left: 0;
        }

        .nav.bottom.active {
            bottom: 0;
        }

        .nav.top .ul,
        .nav.bottom .ul {
            text-align: center;
        }

        .nav.top .ul .li,
        .nav.bottom .ul .li {
            display: inline-block;
            padding: 20px 25px;
        }

        /* Habib Pro Tag */
        .habibpro {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 15px 30px;
            background-color: #212121;
            color: #fff;
            box-shadow: -2.5px 5px 5px #555;
            font-family: 'Raleway', sans-serif;
            letter-spacing: 3px;
            display: inline-block;
            text-decoration: none;
        }

        .habibpro:hover {
            background-color: #FFC107;
            color: #222;
            -webkit-transition: .5s;
            -moz-transition: .5s;
            -o-transition: .5s;
            transition: .5s;
        }
    </style>
</head>

<body>
    <div class="btn-group">
        <div class="t-top"> <i class="fa fa-bars"></i> &nbsp; Top </div>
        <div class="t-right"> <i class="fa fa-bars"></i> &nbsp; Right </div>
        <div class="t-bottom"> <i class="fa fa-bars"></i> &nbsp; Bottom </div>
        <div class="t-left"> <i class="fa fa-bars"></i> &nbsp; Left </div>
    </div>

    <nav class="nav top">
        <ul class="ul">
            <li class="li"><a class="a" href="#">Home</a></li>
            <li class="li"><a class="a" href="#">About</a></li>
            <li class="li"><a class="a" href="#">Service</a></li>
            <li class="li"><a class="a" href="#">Contact</a></li>
        </ul>
    </nav>

    <nav class="nav right">
        <ul class="ul">
            <li class="li"><a class="a" href="#">Home</a></li>
            <li class="li"><a class="a" href="#">About</a></li>
            <li class="li"><a class="a" href="#">Service</a></li>
            <li class="li"><a class="a" href="#">Contact</a></li>
        </ul>
    </nav>

    <nav class="nav bottom">
        <ul class="ul">
            <li class="li"><a class="a" href="#">Home</a></li>
            <li class="li"><a class="a" href="#">About</a></li>
            <li class="li"><a class="a" href="#">Service</a></li>
            <li class="li"><a class="a" href="#">Contact</a></li>
        </ul>
    </nav>

    <nav class="nav left">
        <ul class="ul">
            <li class="li"><a class="a" href="#">Home</a></li>
            <li class="li"><a class="a" href="#">About</a></li>
            <li class="li"><a class="a" href="#">Service</a></li>
            <li class="li"><a class="a" href="#">Contact</a></li>
        </ul>
    </nav>

    <a href="https://youtu.be/f_8P_X4yQ7U" target="_blank" class="habibpro">
        VIDEO TUTORIAL
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $('.t-top').click(function() {
            $('.top').toggleClass('active');
        });
        $('.t-left').click(function() {
            $('.left').toggleClass('active');
        });
        $('.t-right').click(function() {
            $('.right').toggleClass('active');
        });
        $('.t-bottom').click(function() {
            $('.bottom').toggleClass('active');
        });
    </script>
</body>

</html>