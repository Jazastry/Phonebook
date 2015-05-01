<?php

class PhonesController extends \Controllers\BaseController {
    
    public function index() {
        $this->phones = array (
            array('id' => 1, "phone_name" => "Pesho", "phone_number" => "+234872634"),
            array('id' => 2, "phone_name" => "Mesho", "phone_number" => "+234872634"),
            array('id' => 3, "phone_name" => "Gesho", "phone_number" => "+234872634"),
            array('id' => 4, "phone_name" => "Resho", "phone_number" => "+234872634"),
            array('id' => 5, "phone_name" => "Sesho", "phone_number" => "+234872634")
        );
    }
    
    public function create() {
        
    }
}
