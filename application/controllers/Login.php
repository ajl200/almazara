<?php

include_once('Security.php');

class Login extends CI_Controller {
     
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //        
    public function index(){
        $this->load->model('modelSecurity');
        $this->load->model('modelUser');
        $data["noHeader"] = false;
        $data["viewName"] = "login";
        $this->load->view('template',$data);
    }
    
    public function logout() {
        $this->load->model('modelSecurity');
        $this->load->model('modelUser');
        $data["noHeader"] = false;
        $data["viewName"] = "login";
        $this->modelSecurity->destroy_session();
        $this->load->view('template',$data);
    }
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //

// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
    public function checkLogin(){
        $this->load->model('modelSecurity');
        $this->load->model('modelUser');
        $name = $this->input->get_post("name");
        $pass = $this->input->get_post("password");
        $r = $this->modelUser->checkLogin($name,$pass);

        if($r == 0){
            $data["noHeader"] = false;
            $data["msg"] = "<h5 class='error'>Usuario o contraseña incorrectos</h5>";
            $data["viewName"] = "login";
            $this->load->view('template',$data);
        }
        else{
            $id = $this->modelUser->get_id($name);
            $this->modelSecurity->create_session();
            $this->session->set_userdata("id", $id);
            $data["viewName"] = "admin_panel";
            $this->load->view('template',$data);
        }
    }
// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
}
