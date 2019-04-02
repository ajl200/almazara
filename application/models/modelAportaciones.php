
<?php 
class modelAportaciones extends CI_Model{

    public function get_all(){
        $query = $this->db->query("SELECT *,aportacion.id as id FROM `aportacion` left join proveedores on aportacion.id_proveedor = proveedores.id inner join variedad on aportacion.id_variedad = variedad.id inner join localidad on aportacion.id_localidad = localidad.id;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function insert($id_prov, $kg, $variedad, $localidad, $eco , $fecha){
        $query = $this->db->query("INSERT INTO aportacion (id, id_proveedor, kilos , id_variedad, id_localidad, eco, fecha) VALUES (null, '$id_prov', '$kg', '$variedad', '$localidad', $eco, '$fecha');"); 
        return $this->db->affected_rows();
    }

    public function get_last_id(){
        $query = $this->db->query("SELECT id from aportacion order by id desc limit 1");
        return $query;
    }

    public function get_last_kg(){
        $query = $this->db->query("SELECT kilos from aportacion order by id desc limit 1");
        return $query;
    }

    function get_next_id(){
        $query = $this->db->query("SHOW TABLE STATUS LIKE 'aportacion';");
        $next_auto_increment = $query->result_array()[0]['Auto_increment'];
     return $next_auto_increment;
    }


    public function producir_aceite($id_aportacion){
        $query = $this->db->query("SELECT kilos from aportacion order by id desc limit 1");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
        }

        $litros = round($data[0]['kilos'] / 5);
        $acidez = 1;
        $query = $this->db->query("INSERT INTO aceite (id, id_aportacion, litros, acidez) VALUES (null, '$id_aportacion', '$litros', '$acidez');"); 

        return $this->db->affected_rows();
    }

    public function delete($id){
        $query = $this->db->query("DELETE FROM aportacion WHERE id = '$id'"); 
        return $this->db->affected_rows();
    }

    public function update($id, $kg, $variedad, $localidad, $eco, $fecha, $dni){
        $query = $this->db->query("DELETE FROM aportacion WHERE id = '$id'");
        $query = $this->db->query("INSERT INTO aportacion (id, id_proveedor, kilos , id_variedad, id_localidad, eco, fecha) VALUES ($id, '$dni', '$kg', '$variedad', '$localidad', $eco, '$fecha');");
        return $this->db->affected_rows();

    }

} 

