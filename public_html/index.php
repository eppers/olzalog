<?php
/*
 if(isset($_GET['enter']) && ($_SERVER['PHP_AUTH_USER'] != 'nadajto' || $_SERVER['PHP_AUTH_PW'] != 'admin12'))
 {
   header('WWW-Authenticate: Basic realm="Nadajto"');
   header('HTTP/1.0 401 Unauthorized');
   die(file_get_contents('index.html'));

 }
  elseif($_SERVER['PHP_AUTH_USER'] != 'nadajto')
 {
	die(file_get_contents('index.html'));
 }
*/


  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
 // Slim
require '../vendor/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// Twig
require "../vendor/Twig/lib/Twig/Autoloader.php";
Twig_Autoloader::register();

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => './templates/session',
    'cookies.secret_key' => 'nadajto12',
    'cookies.lifetime' => '20 minutes',
    'log.level' => \Slim\Log::DEBUG,
    'log.enabled' => false,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => '../logs',
        'name_format' => 'y-m-d'
    ))
));

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../cache/templates'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());


require '../vendor/Paris/idiorm.php';
require '../vendor/Paris/paris.php';
require '../vendor/PayU/openpayu.php';
require '../vendor/Fpdf/fpdf.php';
//require '../lib/Admin_class.php';
require '../lib/functions.php';
//require '../vendor/PHPMailer/class.phpmailer.php';
require '../lib/bootstrap.php';
require '../lib/Admin.php';
require '../lib/Customer.php';
require '../lib/InvoicePDF.php';
require '../lib/CourierManager.php';
require '../lib/CourierAdditional.php';
require '../lib/Tools.php';
require '../lib/Delivery.php';
require '../lib/UPS/Tools.php';
require '../lib/UPS/Label.php';
require '../lib/UPS/Parcel.php';
require '../lib/UPS/Delivery.php';
require '../lib/GLS/Tools.php';

require '../conf.php';

//Models

require '../models/Config.php';
require '../models/Country.php';
require '../models/City.php';
require '../models/Message.php';
require '../models/Order.php';
require '../models/OrderAdditional.php';
require '../models/Delivery.php';
require '../models/Parcel.php';
require '../models/Customer.php';
require '../models/Courier.php';
require '../models/CourierParcelDimension.php';
require '../models/CourierParcelWeight.php';
require '../models/CourierParcel.php';
require '../models/Price.php';
require '../models/Invoice.php';
require '../models/Insurance.php';
require '../models/Additional.php';
require '../models/User.php';

$admin = new \lib\Admin();
$admin->app=$app;

$customer = new \lib\Customer();
$customer->app=$app;

bootstrap_start();
$couriersArr = couriers_start();

require '../app/routes/session.php';
require '../app/routes/payu.php';
require '../app/routes/ups.php';
require '../app/routes/gls.php';
require '../app/routes/ajax.php';
require '../app/routes/customer.php';
require '../app/routes/admin.php';

define("FPDF_FONTPATH",$GLOBALS['REALPATH']."/vendor/Fpdf/font/");

 $conf = Model::factory('Config')->find_array();
  if(count($conf)>0) {
    	$GLOBALS['CONFIG'] = array();
	foreach($conf as $tmp) {
		$GLOBALS['CONFIG'][$tmp['variable']] = $tmp['value'];
	}
 } else {
	ShowWarning('<b>Brak danych konfiguracyjnych!</b><br>Serwis nie będzie działać poprawnie.');
 }
 
// Run app
$app->run();

?>