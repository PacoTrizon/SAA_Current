<?php

class ColoniasModel extends CI_Model {

    private $table = "cat_colonias";

    public function guardar($dato) {
        $dato->fecha_creado= date('Y-m-d H:i:s');
        $dato->usuario_creado= $this->session->id_usuario;

        if ($this->verificarExistente($dato) === true) {
            //$query="insert into ".$table. " (id_asentamiento,codigo_postal,id_sindicatura, descripcion,fecha_creado, usuario_creado) values ('$dato->asentamiento','$dato->codigo_postal','$dato->sindicatura','$dato->descripcion','$dato->fecha_creado','$dato->usuario_creado') select 1";
            //$result=$this->db->query($query)->row();
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
        $this->db->order_by("descripcion", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function verificarExistente($dato, $id = null) {
        $this->db->where('descripcion', $dato->descripcion);
        $this->db->where('id_sindicatura', $dato->id_sindicatura);
        $this->db->where('id_asentamiento', $dato->id_asentamiento);
        if ($id != null)
            $this->db->where('id_colonia <>', $id);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function buscarId($id) {
        $this->db->select($this->table . '.*,sindicaturas.descripcion as nombre_sindicatura,asentamiento.descripcion as nombre_asentamiento');
        $this->db->from($this->table);
        $this->db->join('cat_sindicaturas as sindicaturas', 'sindicaturas.id_sindicatura = cat_colonias.id_sindicatura');
        $this->db->join('cat_asentamientos as asentamiento', 'asentamiento.id_asentamiento = cat_colonias.id_asentamiento');
        $this->db->where($this->table . '.id_colonia', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarCodigoPostal($codigo_postal) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $this->db->where("(descripcion LIKE '%$codigo_postal%' OR codigo_postal LIKE '%$codigo_postal%')");
        $query = $this->db->get();
        return $query->result();
    }

//    public function buscarDes($codigo_postal) {
//        $this->db->select('descripcion');
//        $this->db->from($this->table);
//        $this->db->where('estatus', 1);
//        $this->db->like('descripcion', $codigo_postal);
//        $query = $this->db->get();
//        return $query->result();
//    }

    public function autocompletarCampos($id_colonia) {
        $this->db->select(
                'sindicaturas.descripcion as nombre_sindicatuta,'
                . 'sindicaturas.id_sindicatura as id_sindicatura,'
                . 'municipios.descripcion as nombre_municipio,'
                . 'municipios.id_municipio as id_municipio,'
                . 'estados.descripcion as nombre_estado,'
                . 'estados.id_estado as id_estado,'
                . 'paises.descripcion as nombre_pais,'
                . 'paises.id_pais as id_pais');
        $this->db->from('cat_colonias as colonias');
        $this->db->join('cat_sindicaturas as sindicaturas', 'sindicaturas.id_sindicatura = colonias.id_sindicatura');
        $this->db->join('cat_municipios as municipios', 'sindicaturas.id_municipio = municipios.id_municipio');
        $this->db->join('cat_estados as estados', 'estados.id_estado = municipios.id_estado');
        $this->db->join('cat_paises as paises', 'paises.id_pais = estados.id_pais');
        $this->db->where('colonias.estatus', 1);
        $this->db->where('colonias.id_colonia', $id_colonia);
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar($dato) {
        if ($this->verificarExistente($dato,$dato->id_colonia) === true) {
            $foo = (array) $dato;
            $foo['fecha_modificado'] = date('Y-m-d H:i:s');
            $foo['usuario_modificado'] = $this->session->id_usuario;
            $foo = (object) $foo;
            $dato = $foo;

            $this->db->where('id_colonia', $dato->id_colonia);
            $this->db->update($this->table, $dato);

            return ($this->db->affected_rows()) ? true : false;
        } else {
            return 2;
        }
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*,cat_sindicaturas.descripcion as nombre_sindicatura,cat_asentamientos.descripcion as nombre_asentamiento');
        $this->db->from($this->table);
        $this->db->join('cat_sindicaturas', 'cat_sindicaturas.id_sindicatura = ' . $this->table . '.id_sindicatura');
        $this->db->join('cat_asentamientos', 'cat_asentamientos.id_asentamiento = ' . $this->table . '.id_asentamiento');
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
        $this->db->select($this->table . '.*,cat_sindicaturas.descripcion as nombre_sindicatura,cat_asentamientos.descripcion as nombre_asentamiento');
        $this->db->from($this->table);
        $this->db->join('cat_sindicaturas', 'cat_sindicaturas.id_sindicatura = ' . $this->table . '.id_sindicatura');
        $this->db->join('cat_asentamientos', 'cat_asentamientos.id_asentamiento = ' . $this->table . '.id_asentamiento');
        if (!empty($descripcion))
            $this->db->like($this->table . '.descripcion', $descripcion);
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
