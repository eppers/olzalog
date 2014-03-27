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
                    <li><a href="/start">Start</a></li>
                    <li><a href="/jak_dzialamy">Jak działamy</a></li>
                    <li><a href="/o_firmie">O firmie</a></li>
                    <li><a href="/referencje">Referencje</a></li>
                    <li><a href="/cennik">Cennik dla biznesu</a></li>
                    <li><a href="/kontakt">Kontakt</a></li>
                </ul>
            </nav>
            <div class="head-contact">
                
             <span class="call-us"> Infolinia Polska: <strong>+48 536 511 471</strong></span>
            </div><!--/.head-contact-->
        </header>
        {% block content %} {% endblock %}
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
                    <li><a href="/dla_indywidualnego">Informacje ogólne</a></li>
                    <li><a href="/regulamin">Warunki wysyłki</a></li>
                    <li><a href="/reklamacje">Reklamacja</a></li>
                    <li><a href="/jak_przygotowac">Jak pakować</a></li>
                </ul>
            </div>
            
            <div class="grid-5">
                <ul>
                    <li>Usługi</li>
                    <li><a href="/formularz" class="">Nadaj paczkę</a></li>
                    <li><a href="/admin/" class="">Panel administracyjny</a></li>
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

{% if kontakt is defined %}
<!-- Google Code for Kontakt Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 980106973;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "Y1oRCLu89AcQ3f2s0wM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/980106973/?value=0&amp;label=Y1oRCLu89AcQ3f2s0wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
{% else %}
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 980106973;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/980106973/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
{%endif%}

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-25794576-10', 'olzalogistic.com');
  ga('send', 'pageview');

</script>
</body>
</html>