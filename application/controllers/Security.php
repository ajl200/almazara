<?php
    class Security extends CI_Controller {
            public function __construct(){
                parent::__construct();
                $this->load->model('modelUser');
                $this->load->model('modelProveedores');
                if (isset($this->session->userdata['loguedIn'])) {
                    
                } else {
                    redirect(base_url("index.php"));
                }
                
            }
    
    }
