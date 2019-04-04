<?php 

include_once('Security.php');

class Bodega extends Security {

    public function index(){
        $data['lista_bidones'] = $this->modelBodega->get_all();
        $data["viewName"] = "admin_bodega";
        $this->load->view('template', $data);
    }

}