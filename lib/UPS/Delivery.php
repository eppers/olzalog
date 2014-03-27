<?php

namespace UPS;
/*
 * Class checking prices for parcels
 * and correction of parcel's dimensions
 */
class Delivery extends \lib\Delivery{
        
        function __construct($ptracknum) {
            $tool = new Tools;
            $resp = $tool->track($ptracknum);
            //print_r($resp);
            $this->setStatus($resp->Shipment->Package->Activity->Status->Type);
        }
        
        protected function setStatus($respStat) {
            switch($respStat) {
                case false: $this->status = 'ER'; break;
                case 'D': $this->status = 'D'; break;
                case 'P': $this->status = 'P'; break;
                case 'MB': $this->status = 'M'; break;
                case 'MV': $this->status = 'MV'; break;
                case 'I': $this->status = 'I'; break;
                default: $this->status = 'EL';
            }
            
        }
                
        function getStatus(){
            return $this->status;
        }

}
?>