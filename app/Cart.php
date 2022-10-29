<?php

namespace App;

use Session;

class Cart {

    public $services = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public function __construct($oldCart) {
        if($oldCart) {
            $this->services = $oldCart->services;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($service, $id){
        //dd($this->groomings);
        $storedItem = ['qty'=>0, 'price'=>$service->price, 'service'=> $service];
        
        if ($this->services){
            if (array_key_exists($id, $this->services)){
                $storedItem = $this->services[$id];
                $this->totalPrice  -= $service->price;
                $this->totalQty --;
            } 
        }
        
        $storedItem['qty'] = 1;
        $storedItem['price'] = $service->price;
        $this->totalPrice += $service->price;
        $this->totalQty++;
       //$storedItem['qty'] += $service->qty;
        $this->services[$id] = $storedItem;
        
        
    }
    // public function reduceByOne($id){
    //     $this->groomings[$id]['qty']--;
    //     $this->groomings[$id]['price']-= $this->groomings[$id]['service']['sell_price'];
    //     $this->totalQty --;
    //     $this->totalPrice -= $this->groomings[$id]['service']['sell_price'];
    //     if ($this->groomings[$id]['qty'] <= 0) {
    //         unset($this->groomings[$id]);
    //     }
// }
 public function removeItem($id){
    //dd($this->groomings);
        $this->totalQty -= $this->services[$id]['qty'];
        $this->totalPrice -= $this->services[$id]['price'];
        unset($this->services[$id]);
    }
}