<?php

class SolicitantesModel extends CI_Model {

    private $table = "solicitantes";

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

    public function verificarExistente($dato) {
        $this->db->where('nombre', $dato->nombre);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function actualizar($dato) {

        $foo = (array) $dato;
        $foo['fecha_modificacion'] = date('Y-m-d H:i:s');
        $foo['usuario_id'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->where('solicitante_id', $dato->solicitante_id);
        $this->db->update($this->table, $dato);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function getAll() {
        $this->db->select('solicitantes.solicitante_id, solicitantes.nombre, solicitantes.cargo, solicitantes.telefono, solicitantes.estatus, depen.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias as depen', 'depen.dependencia_id = ' . $this->table . '.dependencia_id');
        $this->db->where($this->table . '.estatus', 1);
        $this->db->order_by($this->table . ".nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarId($id) {
        $this->db->select($this->table . '.*,depen.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias as depen', 'depen.dependencia_id = ' . $this->table . '.dependencia_id');
        $this->db->where($this->table . '.solicitante_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select('solicitantes.solicitante_id, solicitantes.nombre, solicitantes.cargo, solicitantes.telefono, solicitantes.estatus, depen.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias as depen', 'depen.dependencia_id = ' . $this->table . '.dependencia_id');
        if (!empty($descripcion))
            $this->db->where("(solicitantes.nombre LIKE '%$descripcion%' OR depen.nombre LIKE '%$descripcion%')");
//            $this->db->or_like(array('solicitantes.nombre' => $descripcion, 'depen.nombre' => $descripcion));
        $this->db->where($this->table . '.estatus', intval($estatus));
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
        $this->db->select('solicitantes.*, depen.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias as depen', 'depen.dependencia_id = ' . $this->table . '.dependencia_id');
        if (!empty($descripcion))
             $this->db->where("(solicitantes.nombre LIKE '%$descripcion%' OR depen.nombre LIKE '%$descripcion%')");
//            $this->db->or_like(array('solicitantes.nombre' => $descripcion, 'depen.nombre' => $descripcion));
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

    public function reportePdf($estatus, $descripcion) {
        $this->db->select('solicitantes.*, depen.nombre as nombre_dependencia');
        $this->db->from($this->table);
        $this->db->join('dependencias as depen', 'depen.dependencia_id = ' . $this->table . '.dependencia_id');
        if ($descripcion != null)
             $this->db->where("(solicitantes.nombre LIKE '%$descripcion%' OR depen.nombre LIKE '%$descripcion%')");
//            $this->db->or_like(array('solicitantes.nombre' => $descripcion, 'depen.nombre' => $descripcion));
        $this->db->where($this->table . '.estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
