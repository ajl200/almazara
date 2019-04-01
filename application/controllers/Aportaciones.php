<?php 

include_once('Security.php');

class Aportaciones extends Security {

    public function index(){
        $data["viewName"] = "admin_aportaciones";
        $data['lista_aportaciones'] = $this->modelAportaciones->get_all();

        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
        }

        $this->load->view('template', $data);
    }

    public function insert () {
        $id_prov = $this->input->get_post('prov_id'); 
        $kg = $this->input->get_post('ins_aportacion_kg'); 
        $variedad = $this->input->get_post('ins_variedad'); 
        $localidad = $this->input->get_post('ins_localidad'); 
        $eco = $this->input->get_post('cb_eco'); 
        $fecha = $this->input->get_post('prov_fecha');
        if ($eco == null){
            $eco = 0;
        }
        
        $r = $this->modelAportaciones->insert($id_prov, $kg, $variedad, $localidad, $eco, $fecha);
        $id_aportacion = $this->modelAportaciones->get_next_id();
        $r2 = $this->modelAportaciones->producir_aceite($id_aportacion);
        
        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        }
    }

    public function delete ($id) {
        $r = $this->modelAportaciones->delete($id);
        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Aportaciones/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Aportaciones/index');
        }
    }
        
}