<?php 

class modelProveedores extends CI_Model {
    
    public function get_all() {
        $query = $this->db->query("SELECT * FROM proveedores;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function get_variedades() {
        $query = $this->db->query("SELECT * FROM variedad;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            } 
        return  array_column($data, 'variedad' , 'id');
    }

    public function get_localidades() {
        $query = $this->db->query("SELECT id,localidad  FROM localidad;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
            
        return  array_column($data , 'localidad','id');
    }

    public function validar_dni($dni) {
        $query = $this->db->query("SELECT 1 FROM proveedores where dni = '$dni';"); 
        return $this->db->affected_rows();
    }


    public function insert($nombre, $apellido1, $apellido2, $dni, $telf){
        $query = $this->db->query("INSERT INTO proveedores (id_proveedor, nombre, apellido1, apellido2, dni, telf) VALUES (null,'$nombre', '$apellido1', '$apellido2', '$dni', '$telf');"); 
        return $this->db->affected_rows();
    }



    public function delete($id){
        $query = $this->db->query("DELETE FROM proveedores WHERE id_proveedor = '$id'"); 
        return $this->db->affected_rows();
    }

    public function update($id_proveedor,$nombre, $apellido1, $apellido2, $dni, $telf){
        $status = 0;
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM proveedores WHERE id_proveedor = '$id_proveedor'"); 
        $query = $this->db->query("INSERT INTO proveedores (id_proveedor, nombre, apellido1, apellido2, dni, telf) VALUES ($id_proveedor,'$nombre', '$apellido1', '$apellido2', '$dni', $telf);"); 
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $status = 1;
        }
        return $status;
    }
}
