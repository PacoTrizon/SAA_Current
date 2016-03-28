<?php

class PaisesModel extends CI_Model {

    private $table = "cat_paises";

    public function agregarPais($pais) {
        $foo = (array) $pais;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $pais = $foo;
        if ($this->verificarPaisExistente($pais) === true) {
            try {
                $this->db->insert($this->table, $pais);
                return ($this->db->affected_rows()) ? 1 : 0;
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            return 2;
        }
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function verificarPaisExistente($pais,$id) {
        $this->db->where('descripcion', $pais->descripcion);
        if($id!=null)
             $this->db->where('id_pais <>', $id);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function buscarPaisId($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pais', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar($pais) {
        if ($this->verificarPaisExistente($pais,$pais->id_pais) === true) {
            $foo = (array) $pais;
            $foo['fecha_modificado'] = date('Y-m-d H:i:s');
            $foo['usuario_modificado'] = $this->session->id_usuario;
            $foo = (object) $foo;
            $pais = $foo;

            $this->db->where('id_pais', $pais->id_pais);
            $this->db->update($this->table, $pais);

            return ($this->db->affected_rows()) ? true : false;
        } else {
             return 2;
        }
    }

    public function fetch_data($limit, $start, $estatus, $nombrePais, $limitePaginado) {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($nombrePais))
            $this->db->like('descripcion', $nombrePais);
        $this->db->where('estatus', intval($estatus));
//        if (!empty($estatus)) {
//            $estatus = explode(':', $estatus);
//            $estatus = $estatus[1];
//            $this->db->like('estatus', intval($estatus));
//        } else
//            $this->db->where('estatus', 1);
        $this->db->order_by($this->table . ".descripcion", "asc");
        $this->db->limit($limit, $start);
        $this->db->limit($limitePaginado);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function record_count() {
        return $this->db->count_all($this->table);
    }

    public function filtros($estatus, $descripcion) {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->like($this->table . '.descripcion', $descripcion);
        $this->db->where('estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
