<?php 

include_once('Security.php');

class Proveedores extends Security {

    public function index(){
        $data['lista_proveedores'] = $this->modelProveedores->get_all();
        $data["viewName"] = "admin_proveedores";

        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
        }
        $this->load->view('template', $data);
    }

    public function insert () {
        $nombre = $this->input->get_post('ins_nombre');
        $apellido1 = $this->input->get_post('ins_apellido1');
        $apellido2 = $this->input->get_post('ins_apellido2');
        $dni = $this->input->get_post('ins_dni');
        $telf = $this->input->get_post('ins_telefono');

        $r = $this->modelProveedores->insert($nombre, $apellido1, $apellido2, $dni, $telf);

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
        
        $r = $this->modelProveedores->delete($id);

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

    public function update ($id) {
        $nombre = $this->input->get_post('upd_nombre');
        $apellido1 = $this->input->get_post('upd_apellido1');
        $apellido2 = $this->input->get_post('upd_apellido2');
        $dni = $this->input->get_post('upd_dni');
        $telf = $this->input->get_post('upd_telefono');

        $r = $this->modelProveedores->update($id,$nombre, $apellido1, $apellido2, $dni, $telf);

    }

    
}