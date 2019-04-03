
<?php 
class modelAportaciones extends CI_Model{

    public function get_all(){
        // $query = $this->db->query("SELECT *,aportacion.id as id, aceite.id as id_aceite, proveedores.id as id_proveedor FROM `aportacion` left join proveedores on aportacion.id_proveedor = proveedores.dni inner join variedad on aportacion.id_variedad = variedad.id inner join localidad on aportacion.id_localidad = localidad.id inner join aceite on aportacion.id = aceite.id_aportacion;"); 
        
        $query = $this->db->query(" SELECT *, aceite.id as id_aceite FROM `aportacion` 
left join proveedores on aportacion.id_proveedor = proveedores.dni 
inner join variedad on aportacion.id_variedad = variedad.id 
inner join localidad on aportacion.id_localidad = localidad.id 
inner join aceite on aportacion.id = aceite.id_aportacion ");


$data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function get_last_id(){
        $query = $this->db->query("SELECT id from aportacion order by id desc limit 1");
        return $query;
    }

    public function get_last_kg(){
        $query = $this->db->query("SELECT kilos from aportacion order by id desc limit 1");
        return $query;
    }

    function get_next_id ($table){
        $query = $this->db->query("SHOW TABLE STATUS LIKE '$table';");
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

    public function get_capacidad_bidones(){
        $query = $this->db->query("SELECT ( SUM(litros_max) - SUM(litros_almacenados) ) as capacidad from bidon");
        return $query->result_array()[0]['capacidad'];
    }

    public function insert($dni, $kg, $variedad, $localidad, $eco , $fecha, $id_aportacion, $id_aceite){
        $valid = 1;
        // COMIENZA LA TRANSACCION:
        $this->db->trans_start();
        // Primero insertamos la aportación.
        $query = $this->db->query("INSERT INTO aportacion (id, id_proveedor, kilos , id_variedad, id_localidad, eco, fecha) VALUES (null, '$dni', '$kg', '$variedad', '$localidad', $eco, '$fecha');"); 
        
        // Segundo se produce el aceite.
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

        // Tercero se almacena.
        $query = $this->db->query("SELECT * from bidon");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
        }

        for ($i = 0; $i < count($data) ; $i++){
            $bidon = $data[$i];
            $id_bidon = $bidon['id'];
            var_dump($id_bidon);
            // 5000
            $capacidad = $bidon['litros_max'] - $bidon['litros_almacenados'];
                if ($capacidad > $litros){
                    $query = $this->db->query("INSERT INTO bidon_almacena_aceite (id_bidon, id_aceite, litros_almacenados) VALUES ('$id_bidon','$id_aceite', $litros);");
                    $litros_almacenados = $bidon['litros_almacenados'] + $litros;
                    $query = $this->db->query("UPDATE bidon SET litros_almacenados = '$litros_almacenados' WHERE id = '$id_bidon';");
                    $litros -= $litros;
                    break;
                } else {
                    $litros = $litros - $capacidad;
                    $litros_almacenar = $capacidad;
                    $query = $this->db->query("INSERT INTO bidon_almacena_aceite (id_bidon, id_aceite, litros_almacenados) VALUES ('$id_bidon', '$id_aceite', $litros_almacenar);");
                    $litros_almacenados = $bidon['litros_almacenados'] + $litros_almacenar;
                    $query = $this->db->query("UPDATE bidon SET litros_almacenados = '$litros_almacenados' WHERE id = '$id_bidon';"); 

                    if ($litros == 0){
                        break;
                    }
                }
            }
        // TRANSACCION COMPLETADA:
        $this->db->trans_complete();
        if (($this->db->trans_status() === FALSE)  ||  $litros != 0){
            $valid = 0;
            if ($litros != 0) {
                $valid = 2;
            }
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $valid;
    }

    public function almacenar_aceite($litros,$id_aceite){
        $valid = 1;
        $this->db->trans_start();
        $query = $this->db->query("SELECT * from bidon");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
        }

        for ($i = 0; $i < count($data) ; $i++){
            $bidon = $data[$i];
            $id_bidon = $bidon['id'];
            var_dump($id_bidon);
            // 5000
            $capacidad = $bidon['litros_max'] - $bidon['litros_almacenados'];
                if ($capacidad > $litros){
                    $litros_almacenar = $litros;
                    $query = $this->db->query("INSERT INTO bidon_almacena_aceite (id_bidon, id_aceite, litros_almacenados) VALUES ('$id_bidon','$id_aceite', $litros_almacenar);");
                    $litros_almacenados = $bidon['litros_almacenados'] + $litros;
                    $query = $this->db->query("UPDATE bidon SET litros_almacenados = '$litros_almacenados' WHERE id = '$id_bidon';"); 
                    break;
                } else {
                    $litros = $litros - $capacidad;
                    $litros_almacenar = $capacidad;
                    $query = $this->db->query("INSERT INTO bidon_almacena_aceite (id_bidon, id_aceite, litros_almacenados) VALUES ('$id_bidon', '$id_aceite', $litros_almacenar);");
                    $litros_almacenados = $bidon['litros_almacenados'] + $litros_almacenar;
                    $query = $this->db->query("UPDATE bidon SET litros_almacenados = '$litros_almacenados' WHERE id = '$id_bidon';"); 

                    if ($litros == 0){
                        break;
                    }
                }
        }
        $this->db->trans_complete();
    
        if (($this->db->trans_status() === FALSE)  || ($i == count($data) && $litros != 0)){
            $this->db->trans_rollback();
            $valid = 0;
            if ($i == count($data) && $litros != 0) {
                $valid = 2;
            }
        } else {
            $this->db->trans_commit();
        }

        return $valid;
    }

    public function delete($id){
        $query = $this->db->query("DELETE FROM aportacion WHERE id = '$id'"); 
        $query = $this->db->query("DELETE FROM aceite WHERE id_aportacion = '$id'"); 
        return $this->db->affected_rows();
    }

    public function delete_aceite_en_bidon($id_aceite){
        $query = $this->db->query("DELETE FROM bidon_almacena_aceite WHERE id_aceite = $id_aceite");
        return $this->db->affected_rows();

    }

    public function update($id_aportacion, $kg, $variedad, $localidad, $eco, $fecha, $dni){
        $valid = 1;
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM aportacion WHERE id = $id_aportacion;");
        $query = $this->db->query("INSERT INTO aportacion (id, id_proveedor, kilos , id_variedad, id_localidad, eco, fecha) VALUES ($id_aportacion, '$dni', '$kg', '$variedad', '$localidad', $eco, '$fecha');");
        $query1 = $this->db->query("SELECT id from aceite where id_aportacion = '$id_aportacion';");
        $data = array();
            if ($query1->num_rows() > 0){
                foreach ($query1->result_array() as $row){
                    $data[] = $row;
                }
            }
        $id_aceite = $data[0]['id'];
        $litros = $kg/5;
        $acidez = 1;
        $query = $this->db->query("DELETE FROM aceite WHERE id_aportacion = $id_aportacion");
        $query = $this->db->query("INSERT INTO aceite (id, id_aportacion, litros, acidez) VALUES ($id_aceite, '$id_aportacion', '$litros', '$acidez');");

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $valid = 0;
        }
        return $valid;
    }

    /*
    $query = $this->db->query("SELECT id_bidon from bidon_almacena_aceite where id_aceite = $id_aceite;");
    $id_bidon = $query->result_array()[0]['id'];
    $query = $this->db->query("DELETE FROM bidon_almacena_aceite WHERE id_aceite = $id_aceite");
    $query = $this->db->query("UPDATE bidon SET litros_almacenados = '$litros_almacenados' WHERE id = '$id_bidon';"); 
    */

} 

