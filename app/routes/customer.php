<?php

$authUser=function () use($app) {
    if(!isset($_SESSION['user']['id_customer']) )
    $app->redirect('/logowanie');    
};

$app->get('/user/', $authUser, function () use ($app) {
    $app->redirect('/user/zamowienia');
});

$app->get('/user/faktury', $authUser, function () use ($customer) {
    
    $invoices = Model::factory('Invoice')->filter('getCustomerInvoices',$_SESSION['user']['id_customer'])->find_many();
    if (count($invoices)>0){
      
      $invsArray = array();
      $inv = array();
    
      foreach($invoices as $invoice) {
        if($invoice instanceof Invoice) {
          $inv['id'] = $invoice->id_invoice;
          $inv['date'] = $invoice->date;
          $inv['name'] = $invoice->name;
          
          $invsArray[] = $inv;
        }    
      }    
    }    

    $customer->render('faktury.php',array('invoices'=>$invsArray));
    
});

$app->get('/user/faktury/szczegoly/:id', $authUser, function ($id) use ($customer) {
  $orders = Model::factory('Order')->where('id_invoice',$id)->where('id_customer',$_SESSION['user']['id_customer'])->find_many();
    if (count($orders)>0){
      
      $ordsArray = array();
      $ord = array();
          
      foreach($orders as $order) {
        if($order instanceof Order) {
        
          $courier = Model::factory('Courier')->find_one($order->id_courier);
        
          $ord['id'] = $order->id_order;
          $ord['tracking'] = $order->tracking;
          $ord['date'] = $order->date;
          $ord['amount'] = $order->price;
          $ord['courier'] = $courier->name;
          $ord['delivery'] = $order->delivery_type;
          $ord['payment'] = $order->payment;
          
          $ordsArray[] = $ord;
        }    
      }    
    }    
    $customer->render('zamowienia.php',array('orders'=>$ordsArray));
   
});

$app->get('/user/faktury/pobierz/:id', $authUser, function ($id) use ($customer) {
  $invoice = Model::factory('Invoice')->find_one();
  $order = $invoice->orders()->find_one();
        
  if($order instanceof Order && $order->id_customer==$_SESSION['user']['id_customer']) {
  $filePath = $GLOBALS['REALPATH'];        
          
  $fileName = 'test.pdf';//$invoice->filename.'.pdf';
  if(substr($filePath,-1)!="/") $filePath .= "/";
  $pathOnHd = $filePath . $fileName;

    if ($download = fopen ($pathOnHd, "r")) {
        $size = filesize($pathOnHd);
        $fileInfo = pathinfo($pathOnHd);
        $ext = strtolower($fileInfo["extension"]);

        switch ($ext) {
            case "pdf":
                    header("Content-type: application/pdf"); 
                    header("Content-Disposition: attachment; filename=\"{$fileInfo["basename"]}\"");
                break;
            default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"{$fileInfo["basename"]}\"");
        }

        header("Content-length: $size");

        while(!feof($download)) {
            $buffer = fread($download, 2048);
            echo $buffer;
        }
        fclose ($download);
    }
    exit;
  }

   
});

$app->get('/user/faktury/generuj', $authUser, function () use ($customer) {
    
   
$users = \Model::factory('Customer')->where('onetime',0)->find_many();
foreach($users as $user) {
    if($user instanceof \Customer) {
        \lib\InvoicePDF::generateLastMonth($user);
    }
}


});



/*
 * Orders ......................................................................
 */

$app->get('/user/zamowienia', $authUser, function () use ($customer) {
    $user = Model::factory('Customer')->find_one($_SESSION['user']['id_customer']);
    $orders = $user->orders()->order_by_desc('date')->find_many();
    
      
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
         
    $customer->render('zamowienia.php',array('orders'=>$ordsArray));
   
});

  $app->get('/user/zamowienia/dostawa/:id', $authUser, function ($id) use ($customer) {
  
  $order = Model::factory('Order')->find_one($id);
  $delivery = Model::factory('Delivery')->where('id_order',$id)->find_one();
  $del = array();              
    
  if($delivery instanceof Delivery && $order->id_customer==$_SESSION['user']['id_customer']) {
    
    $del['invoice'] = $order->id_invoice;    
        
    $del['id'] = $delivery->id_del;
    $del['date'] = $delivery->date;
    
    $del['from_cmp'] = $delivery->from_company;
    $del['from_nip'] = $delivery->from_nip;
    $del['from_name'] = $delivery->from_name;
    $del['from_lname'] = $delivery->from_lname;
    $del['from_addr'] = $delivery->from_street.' '.$delivery->from_no;
    if(!empty($delivery->from_no2))$del['from_addr'] .= '/'.$delivery->from_no2;   
    $del['from_city'] = $delivery->city;
    $del['from_zip'] = $delivery->from_zip;
    $del['from_country'] = $delivery->from_country;
    $del['from_email'] = $delivery->from_email;
    $del['from_phone'] = $delivery->from_phone;
    
    $del['to_cmp'] = $delivery->to_company;
    $del['to_nip'] = $delivery->to_nip;
    $del['to_name'] = $delivery->to_name;
    $del['to_lname'] = $delivery->to_lname;
    $del['to_addr'] = $delivery->to_street.' '.$delivery->to_no;
    if(!empty($delivery->to_no2))$del['to_addr'] .= '/'.$delivery->to_no2;   
    $del['to_city'] = $delivery->city;
    $del['to_zip'] = $delivery->to_zip;
    $del['to_country'] = $delivery->to_country;
    $del['to_email'] = $delivery->to_email;
    $del['to_phone'] = $delivery->to_phone;
    
  }    
       
  $customer->render('dostawa.php',array('delivery'=>$del));    
});

?>