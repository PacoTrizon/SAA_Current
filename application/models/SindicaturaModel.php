<?php

class SindicaturaModel extends CI_Model {

    private $table = "cat_sindicaturas";

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

    public function verificarExistente($dato,$id=null) {
        $this->db->where('descripcion', $dato->descripcion);
        $this->db->where('id_municipio', $dato->id_municipio);
        if($id!=null)
             $this->db->where('id_municipio <>',$id);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function buscarId($id) {
        $this->db->select($this->table . '.*,cat_municipios.descripcion as nombre_municipio');
        $this->db->from($this->table);
        $this->db->join('cat_municipios', 'cat_municipios.id_municipio = ' . $this->table . '.id_municipio');
        $this->db->where('id_sindicatura', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar($dato) {

        if ($this->verificarExistente($dato,$dato->id_municipio) === true) {
            $foo = (array) $dato;
            $foo['fecha_modificado'] = date('Y-m-d H:i:s');
            $foo['usuario_modificado'] = $this->session->id_usuario;
            $foo = (object) $foo;
            $dato = $foo;

            $this->db->where('id_sindicatura', $dato->id_sindicatura);
            $this->db->update($this->table, $dato);

            return ($this->db->affected_rows()) ? true : false;
        } else {
            return 2;
        }
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*,cat_municipios.descripcion as nombre_municipio');
        $this->db->from($this->table);
        $this->db->join('cat_municipios', 'cat_municipios.id_municipio = ' . $this->table . '.id_municipio');
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
        $this->db->select($this->table . '.*,cat_municipios.descripcion as nombre_municipio');
        $this->db->from($this->table);
        $this->db->join('cat_municipios', 'cat_municipios.id_municipio = ' . $this->table . '.id_municipio');
        if (!empty($descripcion))
            $this->db->like($this->table . '.descripcion', $descripcion);
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
