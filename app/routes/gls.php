<?php

$app->get('/gls/send', function () use ($app) {

 
 $delivery = \Model::factory('Delivery')->where('id_order',275)->find_one();
        if($delivery instanceof \Delivery) {
            $order = $delivery->order()->find_one();
            $additionals = $order->additionals()->where('id_add',2)->find_one();
            print $additionals->price/$GLOBALS['CONFIG']['kurs_cz'];
            //print $additionals->price;
            //var_dump($additionals);
        }
               
});


$app->get('/gls/ship', function () use ($app) {

 
 print '<form action="" method="post"><input type="text" name="id"><input type="submit" value="OK"></form>';
               
});

$app->post('/gls/ship', function () use ($app) {
            $courierManager = new \lib\CourierManager(1);
            $courier = $courierManager->getCourier();
            $idOrder = intval($app->request()->post('id'));
            
            if(!$courier->ship_from_db($idOrder)) print "Kurierzy nie poszli";
            else {
            print "UPS poszedł <br>";
            $gls = new \GLS\Tools();
              if(!$gls->ship_from_db($idOrder)) print "GLS ni eposzedł";
              else print "GLS poszedł";
            }
            
            print "<a href='/gls/ship'>Powrót</a>";
    
});

$app->get('/gls/shipid', function () use ($app) {
    $gls = new \GLS\Tools();
    var_dump($gls->ship_from_db(296));
})
?>
