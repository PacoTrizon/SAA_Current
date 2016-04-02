<?php

class InvestigadoresModel extends CI_Model {

    private $table = "cat_investigadores";

    public function agregar($dato) {
        $foo = (array) $dato;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['numero_investigador'] = date('YmdHis');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        if (isset($dato->nombre_imagen)) {
            if ($this->verificarExistenteImagen($dato->nombre_imagen) === true) {
                return $this->add($dato);
            } else {
                return array('inserto' => 3);
            }
        } else {
            return $this->add($dato);
        }
    }

    public function add($dato) {
        if ($this->verificarExistente($dato) === true) {
            try {
                $this->db->insert($this->table, $dato);
                $insert_id = $this->db->insert_id();

                return ($this->db->affected_rows()) ? array('inserto' => 1, 'id' => $insert_id) : array('inserto' => 0);
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            return array('inserto' => 2);
        }
    }

    public function verificarExistente($dato) {
        $this->db->where('nombre', $dato->nombre);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function verificarExistenteImagen($nombre, $id = null) {
        $this->db->where('nombre_imagen', $nombre);
        if ($id != null)
            $this->db->where('id_investigador <>', $id);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function actualizarInvestigador($dato) {
        $foo = (array) $dato;
        $foo['fecha_modificado'] = date('Y-m-d H:i:s');
        $foo['usuario_modificado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->where('id_investigador', $dato->id_investigador);
        $this->db->update($this->table, $dato);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function actualizar($dato) {
        if (isset($dato->nombre_imagen)) {
            if ($this->verificarExistenteImagen($dato->nombre_imagen, $dato->id_investigador) === true) {
                return $this->actualizarInvestigador($dato);
            } else {
                return 3;
            }
        } else {
            return $this->add($dato);
        }
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $this->db->order_by("nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarId($id) {
        $this->db->select($this->table . '.*,col_inv.descripcion as colonia_investigador, col_inst.descripcion as colonia_institucion');
        $this->db->from($this->table);
        $this->db->join('cat_colonias as col_inv', 'col_inv.id_colonia = cat_investigadores.colonia');
        $this->db->join('cat_colonias as col_inst', 'col_inst.id_colonia = cat_investigadores.colonia_institucion', 'left');
        $this->db->where('id_investigador', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function busqueda($descripcion) {
        $this->db->select($this->table . '.*,col_inv.descripcion as colonia_investigador');
        $this->db->from($this->table);
        $this->db->join('cat_colonias as col_inv', 'col_inv.id_colonia = cat_investigadores.colonia');
        $this->db->where("(cat_investigadores.nombre LIKE '%$descripcion%' OR cat_investigadores.apellido_paterno LIKE '%$descripcion%' OR cat_investigadores.apellido_materno LIKE '%$descripcion%')");
        $this->db->where($this->table . '.estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertarImagen($id_investigador) {
        $this->db->where('id_investigador', $id_investigador);
//        $this->db->update($this->table, array('imagen' => $imagenBase64));
        return ($this->db->affected_rows()) ? true : false;
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->where("(nombre LIKE '%$descripcion%' OR nombre_institucion LIKE '%$descripcion%')");
//            $this->db->or_like(array('nombre' => $descripcion, 'nombre_institucion' => $descripcion));
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".nombre", "asc");
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
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->where("(nombre LIKE '%$descripcion%' OR nombre_institucion LIKE '%$descripcion%')");
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

}
