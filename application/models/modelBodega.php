<?php 

class modelBodega extends CI_Model {

    public function get_all() {
        $query = $this->db->query("SELECT * FROM bidon;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
}