<?php

class DependenciasModel extends CI_Model {

    private $table = "dependencias";

    public function agregar($dato) {
//        if ($dato->dependencia_padre_id != null) {
//            $this->db->where('codigo', $dato->codigo);
//            $this->db->where('codigo_hijo <>', null);
//            $this->db->from($this->table);
//            $contadorHijo = $this->db->count_all_results();
//        }
        $foo = (array) $dato;
//        $foo['codigo_hijo'] = $contadorHijo;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_id_creado'] = $this->session->id_usuario;
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

    public function buscarPorNombre($nombre, $id_padre = false) {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($id_padre == true)
            $this->db->where('nombre', $nombre);
        else
            $this->db->like('nombre', $nombre);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarId($id) {
        $sql = "select *, obtener_nombre_padre(dependencias.dependencia_padre_id) as nombre_padre
                from dependencias
                where dependencia_id=?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
    }

    public function getAll() {
        $this->db->select('nombre,dependencia_id');
        $this->db->from($this->table);
        $this->db->order_by("nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar($dato) {

        $foo = (array) $dato;
        $foo['fehca_modificacion'] = date('Y-m-d H:i:s');
        $foo['usuario_id_modificado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->where('dependencia_id', $dato->dependencia_id);
        $this->db->update($this->table, $dato);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        if (!empty($descripcion)) {
            if (intval($descripcion) != 0)
                $this->db->like($this->table . '.clave', $descripcion);
            else
                $this->db->like($this->table . '.nombre', $descripcion);
        }
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
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($descripcion)) {
            if (intval($descripcion) != 0)
                $this->db->like('clave', $descripcion);
            else
                $this->db->like('nombre', $descripcion);
        }
//        if (!empty($estatus)) {
//            $estatus = explode(':', $estatus);
//            $estatus = $estatus[1];
        $this->db->where('estatus', intval($estatus));
//        } else
//            $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function dependenciasPadres($nombre) {
        $result = null;
        $query = "select*from dependencias where dependencia_padre_id = 0 and nombre like '%$nombre%'";
        $result = $this->db->query($query)->result();
        $this->db->close();
        foreach ($result as $key) {
          $datos[] = array('id' => $key->dependencia_id,'label' => $key->nombre );
        }
        return $datos;
    }

    public function dependenciasHijos($id_dependencia) {
      $result = null;
      $query = "select*from dependencias where dependencia_padre_id = '$id_dependencia'";
      $result = $this->db->query($query)->result();
      $this->db->close();
      if ($result != null) {
        foreach ($result as $key) {
          $datos[] = array('id' => $key->dependencia_id,'label' => $key->nombre );
        }
      }else {
          $datos = array('id' => 'vacio');
      }

      return $datos;
    }




}
