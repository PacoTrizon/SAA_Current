<?php

class MunicipioModel extends CI_Model {

    private $table = "cat_municipios";

    public function agregar($dato) {
        $foo = (array) $dato;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;
        if ($this->verificarExistente($dato) === true) {
            try {
                $this->db->insert($this->table, $dato);
                return ($this->db->affected_rows()) ? 1 : 0;
            } catch (Exception $ex) {
                return $ex;
            }
        } else {
            return 2;
        }
    }

    public function verificarExistente($dato) {
        $this->db->where('descripcion', $dato->descripcion);
        $this->db->where('id_estado', $dato->id_estado);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function buscarId($id) {
        $this->db->select($this->table . '.*,cat_estados.descripcion as nombre_estado');
        $this->db->from($this->table);
        $this->db->join('cat_estados', 'cat_estados.id_estado = ' . $this->table . '.id_estado');
        $this->db->where('id_municipio', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAll($estado = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($estado != null)
            $this->db->where('id_estado', $estado);
        $this->db->where('estatus', 1);
        $this->db->order_by("descripcion", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar($dato) {

        $foo = (array) $dato;
        $foo['fecha_modificado'] = date('Y-m-d H:i:s');
        $foo['usuario_modificado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;
//        if ($this->verificarExistente($dato) === true) {
            $this->db->where('id_municipio', $dato->id_municipio);
            $this->db->update($this->table, $dato);
//        } else
//            return FALSE;


        return ($this->db->affected_rows()) ? true : false;
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*,cat_estados.descripcion as nombre_estado');
        $this->db->from($this->table);
        $this->db->join('cat_estados', 'cat_estados.id_estado = ' . $this->table . '.id_estado');
        if (!empty($descripcion))
            $this->db->like($this->table . '.descripcion', $descripcion);
        $this->db->where($this->table . '.estatus', intval($estatus));
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
        $this->db->select($this->table . '.*,cat_estados.descripcion as nombre_estado');
        $this->db->from($this->table);
        $this->db->join('cat_estados', 'cat_estados.id_estado = ' . $this->table . '.id_estado');
        if (!empty($descripcion))
            $this->db->like($this->table . '.descripcion', $descripcion);
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
