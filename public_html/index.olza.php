<?php

if(isset($_POST)) {
  $email="olzalogistic@gmail.com";
  if (isset($_POST['name']) && isset($_POST['content']) ) {
    $name=$_POST['name'];
    $mes=strip_tags(trim($_POST['content']));
  
    if (!empty($_POST['phone-number'])) $phone=$_POST['phone-number']; else $phone='brak';
  
    $emailFrom=$_POST['email'];
  
    $body = "Imię i nazwisko: ".$name."\r\nEmail: ".$emailFrom."\r\nTelefon: ".$phone."\r\nWiadomość: ".$mes."\r\n";
    if(mail("$email" ,"Olzalogistic", $body, "From: $emailFrom \r\n"
          ."Reply-To: $emailFrom \r\n"
          ."X-Mailer: PHP/" . phpversion())) $info = '<p style="color: #00CC00;">Wiadomość została wysłana</p>';
    else $info = '<p style="color: #FF0000;">Wiadomość nie została wysłana</p>';
  }
}

if(isset($_GET['p'])) {
  switch($_GET['p']) {
    case 'kontakt' : $file = 'contact.php'; break;
    case 'start' : $file = 'start.php'; break;
    case 'dla_biznesu' : $file = 'dla_biznesu.php'; break;
    case 'dla_indywidualnego' : $file = 'dla_indywidualnego.php'; break;
    case 'uslugi_dodatkowe' : $file = 'uslugi_dodatkowe.php'; break;
    case 'o_firmie' : $file = 'o_firmie.php'; break;
    case 'cennik' : $file = 'cennik.php'; break;
    case 'referencje' : $file = 'referencje.php'; break;
    case 'jak_dzialamy' : $file = 'jak_dzialamy.php'; break;
    case 'formularz' : $file = 'formularz.php'; break;   
    default: $file = 'start.php'; break;
  }
} else {
  $file = 'start.php';
}

?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nivo-slider.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css?v=2.1.5">
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
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
                    <li><a href="/cennik">Cennik</a></li>
                    <li><a href="/kontakt">Kontakt</a></li>
                </ul>
            </nav>
            <div class="head-contact">
                
             <span class="call-us"> Infolinia Polska: <strong>+48 536 511 471</strong></span>
            </div><!--/.head-contact-->
        </header>

<?php 
      if(file_exists($file))include $file;
?>

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
                    <li><img src="img/partners.png" alt="" id="prn"></li>
                </ul>
            </div>
        </footer>
        <div class="copyright">
        <p>Wykonanie oraz obsługa techniczna: <a href="http://nanei.pl"><img src="img/nanei.jpg"></a></p>
            <div style="display: none"><strong>Kodowanie front-endu: <a href="http://bpcoders.pl">BPCoders.pl</a></strong></div>
        </div>
    </main>
    <div id="dhtmltooltip"></div>
    <script src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript" src="js/tooltip.js"></script>
    <script src="js/main.js"></script>
    <script src="js/logotypy.js"></script>
</body>
</html>



































