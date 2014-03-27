<?php

namespace UPS;
// Shipping Label definition
class Label {
	private static $ship_tool;
  	public static $outputFileName = "labels/";

	public static function save($response){
		$ext=self::$ship_tool->EPLlabel=='PNG' ? "gif" : "txt";
		$labelName=self::$ship_tool->trackingnumber.".".$ext;
		$fp = fopen(self::$outputFileName.$labelName, 'wb');   	        	        
		fwrite($fp, base64_decode($response->ShipmentResults->PackageResults->ShippingLabel->GraphicImage));
		fclose($fp);
    
    	  return $labelName;      
	}

	public static function set_epl(){
		$labelimageformat['Code'] = 'EPL';
    	$labelstocksize['Height']=6;
    	$labelstocksize['Width']=4;
    	$labelspecification['LabelStockSize']=$labelstocksize;
    	$labelspecification['LabelImageFormat'] = $labelimageformat;
      
      self::$ship_tool->EPLlabel = 'TXT';
      
    	return $labelspecification;
	}

	public static function set_png(){
		  $labelimageformat['Code'] = 'GIF';
    	$labelimageformat['Description'] = 'GIF';
   		$labelspecification['LabelImageFormat'] = $labelimageformat;
      
      self::$ship_tool->EPLlabel = 'PNG';
      
      return $labelspecification;
   	}
    
    public static function set_tracking($tracking){
		        
      self::$ship_tool->trackingnumber = $tracking;

    }    
    
    public static function get_tracking(){
		        
      $tracking = self::$ship_tool->trackingnumber;
      
      return $tracking;

    } 
}
?>