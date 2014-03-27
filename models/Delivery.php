<?php

class Delivery extends Model{
        
    public static $_table = 'deliveries';
    public static $_id_column = 'id_del';
      
    public function order() {
        return $this->belongs_to('Order','id_order');
    }
}
?>
