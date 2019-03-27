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

    public function insert($nombre, $apellido1, $apellido2, $dni, $telf){
        $query = $this->db->query("INSERT INTO proveedores (id, nombre, apellido1, apellido2, dni, telf) VALUES (null,'$nombre', '$apellido1', '$apellido2', '$dni', $telf);"); 
        return $this->db->affected_rows();
    }
}
