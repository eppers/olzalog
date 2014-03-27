<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>OlzaLogistic - Podaj dalej</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="/public/css/normalize.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/nivo-slider.css">
    <link rel="stylesheet" href="/public/css/jquery.fancybox.css?v=2.1.5">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="/public/css/datepicker.css">
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="/public/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="/public/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="/public/js/scripts.jquery.js"></script>
</head>
<body>

    <main role="main_container">
        <header>
            <h1><a href="/">OlzaLogistic - Podaj dalej</a></h1>
            <nav role="main-nav">
                <ul class="clearfix">
                    <li><a href="/admin/zamowienia">Zamówienia</a></li>
                    <li><a href="/admin/config">Konfig</a></li>
                </ul>
            </nav>
            <div class="head-contact">
                
             <span class="call-us"> Infolinia Polska: <strong>+48 536 511 471</strong></span>
            </div><!--/.head-contact-->
        </header>
        <div class="admin">
        {% block content %} {% endblock %}
        </div>
        <footer class="clearfix">
            <div class="grid-5">
                <ul>
                    <li>Oferta</li>
                    <li><a href="/dla_biznesu">Dla biznesu</a></li>
                    <li><a href="/dla_indywidualnego">Dla indywidualnych</a></li>
                    <li><a href="/uslugi_dodatkowe">Usługi dodatkowe</a></li>
                </ul>
            </div>
            
            <div class="grid-5">
                <ul>
                    <li>Wysyłka</li>
                    <li><a href="#" class="tooltip">Informacje ogólne</a></li>
                    <li><a href="#" class="tooltip">Warunki wysyłki</a></li>
                    <li><a href="#" class="tooltip">Reklamacja</a></li>
                    <li><a href="#" class="tooltip">Jak pakować</a></li>
                </ul>
            </div>
            
            <div class="grid-5">
                <ul>
                    <li>Usługi</li>
                    <li><a href="#" class="tooltip">Nadaj paczkę</a></li>
                    <li><a href="#" class="tooltip">Zlokalizuj przesyłkę</a></li>
                    <li><a href="#" class="tooltip">Panel administracyjny</a></li>
                </ul>
            </div>
            
            <div class="grid-5">
                <ul>
                    <li>O firmie</li>
                    <li><a href="/o_firmie">O firmie</a></li>
                    <li><a href="/jak_dzialamy">Jak to działa</a></li>
                    <li><a href="/kontakt">Kontakt</a></li>
                </ul>
            </div>
            
            <div class="grid-5">
                <ul>
                    <li>Kurierzy</li>
                    <li><img src="/public/img/partners.png" alt="" id="prn"></li>
                </ul>
            </div>
        </footer>
        <div class="copyright">
        <p>Wykonanie oraz obsługa techniczna: <a href="http://nanei.pl"><img src="/public/img/nanei.jpg"></a></p>
            <div style="display: none"><strong>Kodowanie front-endu: <a href="http://bpcoders.pl">BPCoders.pl</a></strong></div>
        </div>
    </main>
    <div id="dhtmltooltip"></div>

    <script src="/public/js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript" src="/public/js/tooltip.js"></script>
    <script src="/public/js/main.js"></script>
    <script src="/public/js/logotypy.js"></script>

</body>
</html>