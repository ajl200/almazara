<?php 

include_once('Security.php');

class Aportaciones extends Security {

    public function index(){
        $data["viewName"] = "admin_aportaciones";
        $data['capacidad'] = $this->modelAportaciones->get_capacidad_bidones();
        $data['lista_variedades'] = $this->modelProveedores->get_variedades();
        $data['lista_localidades'] = $this->modelProveedores->get_localidades();
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
            $eco = '0';
        } else {
            $eco = '1';
        }
        $id_aportacion = $this->modelAportaciones->get_next_id('aportacion');
        $id_aceite = $this->modelAportaciones->get_next_id('aceite');
        $r = $this->modelAportaciones->insert($id_prov, $kg, $variedad, $localidad, $eco, $fecha,$id_aportacion,$id_aceite);

        if ($r == 0 || $r == 2 ) {
            //error
            if ($r == 2){
                $data["msg"] = "3";
            } else {
                $data["msg"] = "1";
            }
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        }
    }

    public function update (){
        $id_aportacion = $this->input->get_post('upd_aportacion_id'); 
        $kg = $this->input->get_post('upd_aportacion_kg'); 
        $variedad = $this->input->get_post('upd_variedad'); 
        $localidad = $this->input->get_post('upd_localidad'); 
        $eco = $this->input->get_post('upd_cb_eco'); 
        $fecha = $this->input->get_post('upd_aportacion_fecha');
        $dni = $this->input->get_post('upd_dni');

        $id_aceite = $this->input->get_post('upd_aceite_id'); 
        $id_proveedor = $this->input->get_post('upd_proveedor_id'); 
        //OBTENER EL ID DEL PROVEEDOR, ID_ACEITE DE ESA APORTACION.
        
        if ($eco == null){
            $eco = '0';
        } else {
            $eco = '1';
        }
        
        // $r = $this->modelAportaciones->delete_aceite_en_bidon($id_aceite);
        $r = $this->modelAportaciones->update($id_aportacion, $kg, $variedad, $localidad, $eco, $fecha, $dni, $id_aceite, $id_proveedor);
        // $r = $this->modelAportaciones->insert($id_prov, $kg, $variedad, $localidad, $eco, $fecha, $id_aportacion, $id_aceite);

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

    public function delete ($id, $id_aceite) {
        $r = $this->modelAportaciones->delete($id , $id_aceite);
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