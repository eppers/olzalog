<?php
 
$authAdmin=function () use($app) {
    if(!isset($_SESSION['admin']) && !isset($_SESSION['id_user']) )
    $app->redirect('/logowanie');    
};

$app->get('/admin/', function () use ($app) {
    $app->redirect('/admin/zamowienia');
});


/*
 * Orders ......................................................................
 */

$app->get('/admin/zamowienia', $authAdmin, function () use ($admin) {
  $orders = Model::factory('Order')->order_by_desc('date')->find_many();
    
      
    foreach($orders as $order) {
        if($order instanceof Order) {
          $ord = array();
          $courier = Model::factory('Courier')->find_one($order->id_courier);
          $delivery = $order->delivery()->find_one();
          $additionals = $order->additionals()->find_many();

          $ord['id'] = $order->id_order;
          $ord['tracking'] = $order->tracking;
          $ord['date'] = $order->date;
          $ord['amount'] = $order->price;
          $ord['courier'] = $courier->name;
          $ord['delivery'] = $order->delivery_type;
          $ord['payment'] = $order->payment;
          foreach($additionals as $add) {
              if($add instanceof OrderAdditional) {
                  $addType = Model::factory('Additional')->find_one($add->id_add);
                  switch ($addType->type) {
                      case 'COD' : $ord['COD'] = (!empty($add->price))?$add->price : 0; break;
                      case 'ROD' : $ord['ROD'] = true; break;
                      case 'Insurance' : $ord['Insurance'] = (!empty($add->price))?$add->price : 0; break;
                      default: ;
                  }
              }
          }
        
          $ord['date_repay'] = date('Y-m-d', strtotime($delivery->date.' +4 Weekday'));    
          $ord['code']='';
          if($delivery instanceof Delivery) {
              if($delivery->status!='D' && $delivery->status!='MV' && $delivery->status!='ER' ) {
                   $upsDelivery = new UPS\Delivery($order->tracking);
                   $delivery->status = $upsDelivery->getStatus();
                   $ord['code'] = $delivery->status;

                   $delivery->save();
              }
          }
          $ord['status'] = \lib\Delivery::printStatus($delivery->status);
          $ordsArray[] = $ord;
        }       
    }    
         
    $admin->render('zamowienia.php',array('orders'=>$ordsArray));
   
});

$app->get('/admin/zamowienia/pobranie', $authAdmin, function () use ($admin) {
  $orders = Model::factory('Order')->order_by_desc('date')->where('payment',2)->find_many();
    
      
    foreach($orders as $order) {
        if($order instanceof Order) {

          $courier = Model::factory('Courier')->find_one($order->id_courier);
          $delivery = $order->delivery()->find_one();

          $ord['id'] = $order->id_order;
          $ord['tracking'] = $order->tracking;
          $ord['date'] = $order->date;
          $ord['amount'] = $order->price;
          $ord['courier'] = $courier->name;
          $ord['delivery'] = $order->delivery_type;
          $ord['payment'] = $order->payment;
          $ord['bank'] = $order->bank_account;
          $ord['date_repay'] = date('Y-m-d', strtotime($delivery->date.' +4 Weekday'));          

          $ordsArray[] = $ord;
        }       
    }    
         
    $admin->render('zamowienia.php',array('orders'=>$ordsArray));
   
});

$app->get('/admin/zamowienia/pobranie/:id', $authAdmin, function ($id) use ($admin) {
  $order = Model::factory('Order')->find_one($id);

    
        if($order instanceof Order) {

          $courier = Model::factory('Courier')->find_one($order->id_courier);
          $additional = \Model::factory('Additional')->where('type','COD')->find_many();
          $delivery = $order->delivery()->find_one();

          foreach($additional as $add ) {
              if($add instanceof Additional) {
                  $additionalOrder = Model::factory('OrderAdditional')->where('id_order',$id)->where('id_add',$add->id_add)->find_one();

                  $ord['id'] = $order->id_order;
                  $ord['bank'] = $order->bank_account;
                  $ord['price'] = $additionalOrder->price;
                  $ord['date_repay'] = date('Y-m-d', strtotime($delivery->date.' +4 Weekday'));
              }
          }

        }       
        
         
    $admin->render('zamowienia_pobranie.php',array('order'=>$ord));
   
});

$app->get('/admin/zamowienia/szczegoly/:id', $authAdmin, function ($id) use ($admin) {
  $order = Model::factory('Order')->find_one($id);
    
      

        if($order instanceof Order) {

          $delivery = $order->delivery()->find_one();
          $additionals = $order->additionals()->find_many();

          $ord['id'] = $order->id_order;
          $ord['tracking'] = $order->tracking;
          $ord['date'] = $order->date;
          $ord['amount'] = $order->price;
          $ord['delivery'] = $order->delivery_type;
          $ord['payment'] = $order->payment;
          foreach($additionals as $add) {
              if($add instanceof OrderAdditional) {
                  $addType = Model::factory('Additional')->find_one($add->id_add);
                  switch ($addType->type) {
                      case 'COD' : $ord['COD'] = (!empty($add->price))?$add->price : 0; break;
                      case 'ROD' : $ord['ROD'] = true; break;
                      case 'Insurance' : $ord['Insurance'] = (!empty($add->price))?$add->price : 0; break;
                      default: ;
                  }
              }
          }
        
          $ord['date_repay'] = date('Y-m-d', strtotime($delivery->date.' +4 Weekday'));    
          $ord['company'] = $delivery->to_company;
          $ord['name'] = $delivery->to_name;
          $ord['lname'] = $delivery->to_lname;
          $ord['addr'] = $delivery->to_street.' '.$delivery->to_no;
          if(!empty($delivery->to_no2)) $ord['addr'] .= $delivery->to_no2;
          $ord['city'] = $delivery->to_city;
          $ord['zip'] = $delivery->to_zip;
          $ord['phone'] = $delivery->to_phone;
          
          $ord['from_company'] = $delivery->from_company;
          $ord['from_name'] = $delivery->from_name;
          $ord['from_lname'] = $delivery->from_lname;
          $ord['from_addr'] = $delivery->from_street.' '.$delivery->from_no;
          if(!empty($delivery->from_no2)) $ord['from_addr'] .= $delivery->from_no2;
          $ord['from_city'] = $delivery->from_city;
          $ord['from_zip'] = $delivery->from_zip;
          $ord['from_phone'] = $delivery->from_phone;          
        }       
    
         
    $admin->render('zamowienia_szczegoly.php',array('order'=>$ord));
   
});
/**
 * Config ...................................
 */
 $app->get('/admin/config', $authAdmin, function () use ($admin) {
    $admin->render('config.php',array('config'=>$GLOBALS['CONFIG']));
 });
 
 $app->post('/admin/config', $authAdmin, function () use ($admin) {
    $config = Model::factory('Config')->find_many();
    
    foreach($config as $conf) {
      if($conf instanceof Config) {
      $val = $admin->app->request()->post($conf->variable);
        if(isset($val)) {
          $conf->value = clearName($val);
          $GLOBALS['CONFIG'][$conf->variable]=$conf->value;
        }
        $conf->save();
        $info = "Wartość została zmieniona";
      } else {
        $info = "Problem z konfigiem";
      }
    }
    
   $admin->render('config.php', array('config'=>$GLOBALS['CONFIG'], 'info'=>$info));

 });

/**
 * Customers ...................................
 */

$app->get('/admin/klienci', $authAdmin, function () use ($admin) {
  $customers = Model::factory('Customer')->where('onetime',0)->find_array(); 
   
    $admin->render('users.php',array('users'=>$customers));
   
});

$app->get('/admin/klienci/edytuj/:id', $authAdmin, function ($id) use ($admin) {
  $customer = Model::factory('Customer')->find_one($id);

    
        if($customer instanceof Customer) {

            $user['id'] = $customer->id_customer;
            $user['company'] = $customer->company;
            $user['name'] = $customer->name;
            $user['lname'] = $customer->lname;
            $user['addr'] = $customer->addr;
            $user['city'] = $customer->city;
            $user['zip'] = $customer->zip;
            $user['email'] = $customer->email;
            $user['phone'] = $customer->phone;
            $user['discount'] = $customer->discount;

        }       
 
         
    $admin->render('user.php',array('user'=>$user));
   
});

$app->post('/admin/klienci/edytuj', function () use ($app) {

    if($id = onlyNumber($app->request()->post('id'))) {

        if($customer instanceof Customer) {

            
            $customer->company = $app->request()->post('company');
            $customer->name = $app->request()->post('name') ;
            $customer->lname = $app->request()->post('lname') ;
            $customer->addr = $app->request()->post('addr') ;
            $customer->city = $app->request()->post('city') ;
            $customer->zip = $app->request()->post('zip') ;
            $customer->email = $app->request()->post('email');
            $customer->phone = $app->request()->post('phone');
            $customer->discount = $app->request()->post('discount');
            
            $customer->save();
        } 
   }      
  
   $app->redirect('/admin/klienci');
    
});

$app->get('/admin/ups/track/', $authAdmin, function () use ($admin) {
    $ups = new UPS\Delivery('1ze4854x6892504671');
    print $ups->getStatus();
    //$ups->quantumView();

});

$app->get('/admin/ups/void/', $authAdmin, function () use ($admin) {
    $ups = new UPS\Tools();
    if($res=$ups->delete_shipment('1ze4854x6892504671')) print $res;

});

$app->get('/admin/ups/php/', $authAdmin, function () use ($admin) {
print phpinfo();
});
