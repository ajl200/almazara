<?php 

include_once('Security.php');

class Estadisticas extends Security {

    public function index(){
        $data['localidades'] = $this->modelAportaciones->get_localidades();

        $data["viewName"] = "maps";
        $this->load->view('template', $data);
    }

}