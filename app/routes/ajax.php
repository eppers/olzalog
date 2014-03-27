<?php
/*
 * TODO jezeli beda rozne ceny dla roznych rozmiarow
 */
session_start();
$app->post('/form/price/update', function () use ($app) {
    //underline determinates if price will be update for one courier or more (courierName_typeOfAdditionalOption)
    //wyszukanie ceny danej uslugi i pomniejszenie sumy o wartosc tej uslugi
    
    $couriers = \Model::factory('Courier')->find_many();
    $result = array();
    $type = 0;
    $weight = 1;
    $dim['length'] = 1;
    $dim['width'] = 1;
    $dim['height'] = 1;
    
    $formArray = explode('&', $app->request()->post('form'));
    //Parcel data
    if($key = array_find('pkg_weight',$formArray)) {
        $val = explode('=',$formArray[$key]);
        if(!empty($val[1]))
            $weight = $val[1];
    }
    
    foreach($dim as $key=>&$row) {
        if($keyTmp = array_find('pkg_'.$key,$formArray)) {
            $val = explode('=',$formArray[$keyTmp]);
            if(!empty($val[1]))
                $row = (int)$val[1];
        }
    }
   
    foreach($formArray as &$row) {
        $row = preg_replace("/[^a-zA-Z0-9\=_\-]/", "", $row);
        $arrayTemp = explode('=', $row);
        if($arrayTemp[0]=='rodzaj') {
            $type = $arrayTemp[1];
            foreach($couriers as $courier) {
                try {
                $cour = new \lib\CourierManager($courier->id_courier);
                $parcel = $cour->getParcel($dim['length'], $dim['width'], $dim['height'], $weight, $type);
                } catch(Exception $e) {
                    print json_encode(array('error'=>$e->getMessage()));
                    exit();
                }
                if($parcel) {
                    $result[$courier->id_courier]['price_net']= number_format($parcel->getPrice()-$parcel->getPrice()*$_SESSION['user']['discount']/100, 2, '.', '');
                    $result[$courier->id_courier]['price_brut'] = number_format($result[$courier->id_courier]['price_net']+$result[$courier->id_courier]['price_net']*$GLOBALS['CONFIG']['vat']/100, 2, '.', '');
                    $result[$courier->id_courier]['notstand'] = $parcel->getNotstand();
                } else {
                    continue;
                }
            }
           
           
        } elseif($arrayTemp[0]=='Notstand') {
            foreach($couriers as $courier) {
                if($result[$courier->id_courier]['notstand']==0) {
                    try {
                        $additional = new \lib\CourierAdditional($arrayTemp[0], $courier->name);
                           
                        $price2 = $additional->getPrice();

                        if(is_numeric($price2)) {
                            $result[$courier->id_courier]['price_net'] = number_format($result[$courier->id_courier]['price_net'] + ($price2-$price2*$_SESSION['user']['discount']/100), 2, '.', '');
                            $result[$courier->id_courier]['price_brut'] = number_format($result[$courier->id_courier]['price_net']+$result[$courier->id_courier]['price_net']*$GLOBALS['CONFIG']['vat']/100, 2, '.', '');
                        }
                    } catch(Exception $e) {
                        continue;
                    }
                }
            }
        } else {

     
        $arrayAdd=explode('_', $arrayTemp[0]);
        if (count($arrayAdd)>1) { //if a name contains string pkg or courier or string check (additional_check require additional_input)
            if($arrayAdd[0]=='pkg') {
                continue;
                
            } elseif($arrayAdd[1]=='check') {
                if($key = array_find($arrayAdd[0].'_input',$formArray)) {
                    $val = explode('=',$formArray[$key]);
                    if(!empty($val[1])) {
                        foreach($couriers as $courier) {
                            try {
                                $additional = new \lib\CourierAdditional($arrayAdd[0], $courier->name);
                                $price2 = $additional->getPrice($val[1]);
                                
                                if(is_numeric($price2)) {
                                    $result[$courier->id_courier]['price_net'] = number_format($result[$courier->id_courier]['price_net'] + ($price2-$price2*$_SESSION['user']['discount']/100), 2, '.', '');
                                    $result[$courier->id_courier]['price_brut'] = number_format($result[$courier->id_courier]['price_net']+$result[$courier->id_courier]['price_net']*$GLOBALS['CONFIG']['vat']/100, 2, '.', '');
                                }
                            } catch(Exception $e) {
                                continue;
                            }
                        }
                    }
                } 
            } else {
                //update price for one courier : ups_Insurance=360   
                //TODO if Insurance - pick the higher one
                $val = $arrayTemp[1];
                try {
                    $additional = new \lib\CourierAdditional($val[0], $arrayAdd[0]);
                    $price = $additional->getPrice($val[1]);
                    if(is_numeric($price)) {
                        $courierId = $additional->getCourier();
                        $result[$courierId]['price_net'] = number_format($result[$courierId]['price_net'] + ($price-$price*$_SESSION['user']['discount']/100), 2, '.', '');
                        $result[$courierId]['price_brut'] = number_format($result[$courierId]['price_net']+$result[$courierId]['price_net']*$GLOBALS['CONFIG']['vat']/100, 2, '.', '');
                        
                    }
                } catch(Exception $e) {
                    
                }
            }
        } else {
            //update price for one courier : ups_Insurance=360   
            //TODO if Insurance - pick the higher one
            $val = $arrayTemp[1];
            foreach($couriers as $courier) {
                try {
                    $additional = new \lib\CourierAdditional($arrayTemp[0], $courier->name);
                    $price = $additional->getPrice($val[1]);
                    if(is_numeric($price)) {
                        $courierId = $additional->getCourier();
                        $result[$courier->id_courier]['price_net'] = number_format($result[$courier->id_courier]['price_net'] + ($price-$price*$_SESSION['user']['discount']/100), 2, '.', '');
                        $result[$courier->id_courier]['price_brut'] = number_format($result[$courier->id_courier]['price_net']+$result[$courier->id_courier]['price_net']*$GLOBALS['CONFIG']['vat']/100, 2, '.', '');

                    }

                } catch(Exception $e) {
                    ;
                }
            }
        } 
        
      }
    }

    //TODO przygotowac wersje updatujaca wiecej kurierow
     echo json_encode($result);
}); 

$app->post('/api/ship/void',  function () use ($app) {
      $orderId = $app->request()->post('id');
      //print $_SESSION['admin'];
      try {
          if($_SESSION['admin']!=1) {

            $customer = Model::factory('Customer')->find_one($_SESSION['user']['id_customer']);
            $order = $customer->orders()->find_one(intval($orderId));
            if(!$order instanceof Order) { 
                throw new Exception('Nie masz uprawnienień do usuwania tego zamówienia'); 
            }
          } else {
            $order = Model::factory('Order')->find_one(intval($orderId)); 
            if(!$order instanceof Order) { 
                throw new Exception('Nie ma takiego zamówienia'); 
            }
          }

          $delivery = $order->delivery()->find_one();
          if(!$delivery instanceof Delivery || $delivery->status!='M') {
              throw new Exception('To zamówienie nie może zostać anulowane.'); 
          } else {
              $ups = new UPS\Tools();
              if(!$ups->delete_shipment($order->tracking)) {
                throw new Exception('To zamówienie nie może zostać anulowane2.'); 
              }
          }
      } catch(Exception $e) {
          $resp['error'] = $e->getMessage();
          print json_encode($resp);
          exit();
      }
      print json_encode('ok');
         
});

$app->get('/echocookie',  function () use ($app) {
      $lulok = $app->getEncryptedCookie('courier_prices'); // <<< returns NULL
      var_dump(json_decode($lulok)); 
      $aara=json_decode($lulok);
      print $aara->ups->price;
         
    });
$app->get('/echocookie2',  function () use ($app) {
      $lulok = $app->getEncryptedCookie('test_cookies2'); // <<< returns NULL
      print $lulok;

    });

?>
