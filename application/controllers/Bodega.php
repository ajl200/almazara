<?php 

include_once('Security.php');

class Bodega extends Security {

    public function index(){
        $data["viewName"] = "admin_bodega";
        $this->load->view('template', $data);
    }
}