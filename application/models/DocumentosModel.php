<?php

class DocumentosModel extends CI_Model {

    private $table = "documentos";

    public function agregar($dato) {
        $foo = (array) $dato;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
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
        $this->db->like('descripcion', $dato->descripcion);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $this->db->order_by("descripcion", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getId($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_documentos_descripcion($descripcion) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $this->db->like('descripcion',$descripcion);
        $this->db->order_by("descripcion", "asc");
        $query = $this->db->get();
        return $query->result();
    }

}
