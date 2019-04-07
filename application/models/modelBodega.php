<?php 

class modelBodega extends CI_Model {

    public function get_all() {
        
        $query = $this->db->query("SELECT bidon.id as id, bidon.litros_max as litros_max, bidon.litros_almacenados as litros_almacenados, bidon.id_variedad as id_variedad, bidon.eco as eco, variedad.id as id_variedad, variedad.variedad as variedad FROM bidon inner join variedad on bidon.id_variedad = variedad.id group by bidon.id"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
}