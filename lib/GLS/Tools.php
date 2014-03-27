<?php


namespace GLS;
// interface with UPS
class Tools extends \lib\Tools{
    function ship_from_db($id) {
    
        $delivery = \Model::factory('Delivery')->where('id_order',$id)->find_one();
        if($delivery instanceof \Delivery) {
             $order = $delivery->order()->find_one();
    
             $url ="http://e-balik.cz/api";

             $parcel = \Model::factory('Order')->order_by_desc('gls_tracking')->limit(1)->find_array();
             if(count($parcel)>0)
                $parcelId = $parcel[0]['gls_tracking'];
print_r($parcelId);
             try {

                 if($parcelId<$GLOBALS['CONFIG']['gls_parcel_from'])
                     $parcelnr = $GLOBALS['CONFIG']['gls_parcel_from'];
                 elseif($parcelId>$GLOBALS['CONFIG']['gls_parcel_to'])
                     throw new Exception('Przedział paczek ma niższą wartość niż ostatnia wysłana paczka GLSem');
                 else {
                     $parcelnr = $parcelId+1;
                 }
                 

                 $pickup = date('Y-m-d',strtotime($delivery->date." +1 Weekday"));
                 

                   $date = new \DateTime();
                   $date->format('Y-m-d H:i:s');

                   $password = GLSpasswd;
                   $username = GLSuserid;
                   //$parcelnr = '90292194169'; // 90292194160 - 90292195159
                   $timestamp = $date->format('Y-m-d H:i:s');
                   $senderid = GLSaccountnum;

                $data = array(
                    'username' => $username,
                    'parcelnr' => $parcelnr, // 90292194160 - 90292195159
                    'senderid' => $senderid,
                    'sender_name' => 'NadajTo OlzaLogistic',
                    'sender_address' => 'Rozvojova 8',
                    'sender_city' => 'Cesky Tesin',
                    'sender_zipcode' => '73701',
                    'sender_country' => 'CZ',
                    'sender_contact' => 'Witold Biernat',
                    'sender_phone' => '+48536511471',

                    'consig_name' => $delivery->to_company,
                    'consig_address' => $delivery->to_street.' '.$delivery->to_no.' '.$delivery->to_no2,
                    'consig_city' => $delivery->to_city,
                    'consig_zipcode' => $delivery->to_zip,
                    'consig_country' => 'CZ',
                    'consig_contact' => $delivery->to_name.' '.$delivery->to_lname,
                    'consig_phone' => $delivery->to_phone,

                    'pickupdate' => $pickup,

                    'timestamp' => $timestamp,
                    'finalcheck' => SHA1(SHA1($password).$username.$senderid.$parcelnr.$timestamp),

                    'print_label' => 1,
                    'getpdf_response' => 'PDF'

                );
                $COD = $order->additionals()->where('id_add',2)->find_one();
                if($COD) {
                    $data['codamount'] = $COD->price_kc;
                }
                print_r ($data);


                

                $result = $this->init_api($data,$url);
                var_dump($result);
                
                if(strpos($result,'json_api_response')!==false && strpos($result,'error')!==false) {
                    throw new \Exception($result);
                } else {
                    if(file_put_contents($GLOBALS['REALPATH'].'/public_html/labels_gls/'.$parcelnr.'.pdf',$result)) {
                            //$GLOBALS['CONFIG']['em_address'];
                        
                        $order->gls_tracking = $parcelnr;
                        $order->save();
                        SendMail(array($delivery->from_email,'nadajtoolzalogistic@gmail.com','olzalogistic@gmail.com'), array(), 10, false, array('etykieta'=>$GLOBALS['REALPATH'].'/public_html/labels_gls/'.$parcelnr.'.pdf'));
                        return true;
                    } else throw new \Exception('Nie udało się wygenerować pliku pdf dla paczki nr: '.$parcelnr);
                }

            } catch( \Exception $e) {
                    SendMail('eppers.m@gmail.com', array('ERROR'=>$e->getMessage()), 8);
                    return false;
            }

        }
    
    }
    
    protected function init_api($data, $url) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
        
        return $result;
    }
}
?>
