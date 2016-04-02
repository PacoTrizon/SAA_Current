<?php

class TramiteConcentracionModel extends CI_Model {

    private $table = "tramite_concentracion";

    public function insertTramite($tramite)
    {

    }
    public function agregar($dato) {
        $dato->fecha_creado = date('Y-m-d H:i:s');
        $dato->usuario_creado = $this->session->id_usuario;
        if (isset($dato->archivo_expediente) && $dato->archivo_expediente != "") {
            if ($this->verificarExistentePdf($dato->archivo_expediente) === true) {
                return $this->add($dato);
            } else {
                return 3;
            }
        } else {
            return $this->add($dato);
        }
    }

    public function add($dato) {
        if ($this->verificarExistente($dato) === true) {
            $this->db->trans_begin();
            try {
                $this->db->insert($this->table, $dato);
                $insert_id = $this->db->insert_id();
                $year = date("Y");
                $this->db->where('id_tramite', $insert_id);
//                $clave = $dato->id_sub_fondo . "" . $dato->id_seccion . "" . $dato->id_sub_seccion . "" . $dato->id_serie . "" . $dato->id_sub_serie . "" . $insert_id . "" . $year;
                $clave = $dato->id_sub_fondo . "" . $dato->id_serie;
                if (isset($dato->id_sub_serie))
                    $clave = $clave . "" . $dato->id_sub_serie;
                if (isset($dato->id_seccion))
                    $clave = $clave . "" . $dato->id_seccion;
                if (isset($dato->id_sub_seccion))
                    $clave = $clave . "" . $dato->id_sub_seccion;
                $clave = $clave . "" . $insert_id . "" . $year;
                $this->db->update($this->table, array('clave' => $clave));




                $this->db->trans_commit();
                return ($this->db->affected_rows()) ? 1 : 0;
            } catch (Exception $ex) {
                $this->db->trans_rollback();
                echo $ex;
            }
        } else {
            return 2;
        }
    }

    public function guardarHistorico($dato) {
        $this->db->trans_begin();
        if ($this->verificarHistorico($dato) === true) {
            try {
                $foo = (array) $dato;
                $foo['fecha_creado'] = date('Y-m-d H:i:s');
                $foo['usuario_creado'] = $this->session->id_usuario;
                $foo = (object) $foo;
                $dato = $foo;
                $this->db->insert('historico', $dato);
                $this->db->trans_commit();
                return ($this->db->affected_rows()) ? 1 : 0;
            } catch (Exception $ex) {
                $this->db->trans_rollback();
                echo $ex;
            }
        } else {
            try {
                $foo = (array) $dato;
                $foo['fecha_modificado'] = date('Y-m-d H:i:s');
                $foo['usuario_modificado'] = $this->session->id_usuario;
                $foo = (object) $foo;
                $dato = $foo;

                $this->db->where('id_tramite', $dato->id_tramite);
                $this->db->where('id_documento', $dato->id_documento);
                $this->db->update('historico', $dato);
                $this->db->trans_commit();
                return ($this->db->affected_rows()) ? 1 : 0;
            } catch (Exception $ex) {
                $this->db->trans_rollback();
                echo $ex;
            }
        }
    }

    public function verificarHistorico($dato) {
        $this->db->where('id_tramite', $dato->id_tramite);
        $this->db->where('id_documento', $dato->id_documento);
        $q = $this->db->get('historico');
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function verificarExistente($dato) {
        $this->db->where('descripcion', $dato->descripcion);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function verificarExistentePdf($nombre) {
        $this->db->where('archivo_expediente', $nombre);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

  /*  public function buscarId($id, $sub_serie = null, $seccion = null, $sub_seccion = null) {
        $select = 'tramite_concentracion.*,depenSubFondo.nombre as nombre_sub_fondo,seriePadre.descripcion as nombre_serie';
        // $this->db->select('tramite_concentracion.*,depenSubFondo.nombre as nombre_sub_fondo,depenSeccion.nombre as nombre_seccion, depenSubSeccion.nombre as nombre_sub_seccion, seriePadre.descripcion as nombre_serie, serieHijo.descripcion as nombre_sub_serie ');
        $this->db->from($this->table);
        $this->db->join('dependencias as depenSubFondo', 'depenSubFondo.dependencia_id = ' . $this->table . '.id_sub_fondo');
        if ($seccion != null) {
            $select = $select . ',depenSeccion.nombre as nombre_seccion';
            $this->db->join('dependencias as depenSeccion', 'depenSeccion.dependencia_id = ' . $this->table . '.id_seccion');
        }
        if ($seccion != null) {
            $select = $select . ',depenSubSeccion.nombre as nombre_sub_seccion';
            $this->db->join('dependencias as depenSubSeccion', 'depenSubSeccion.dependencia_id = ' . $this->table . '.id_sub_seccion');
        }
        $this->db->join('serie as seriePadre', 'seriePadre.id_serie = ' . $this->table . '.id_serie');
        if ($sub_serie != null) {
            $select = $select . ', serieHijo.descripcion as nombre_sub_serie';
            $this->db->join('serie as serieHijo', 'serieHijo.id_serie = ' . $this->table . '.id_sub_serie');
        }
        $this->db->select($select);
        $this->db->where('id_tramite', $id);
        $query = $this->db->get();
        return $query->row();
    }*/
    public function buscarId($id)
    {
      $query ="call getTramites('$id');";
      $result = $this->db->query($query)->row();
      $this->db->close();
      return $result;
    }
    public function buscarHistorico($datos) {
        $this->db->select('*');
        $this->db->from('historico');
        $this->db->where('id_tramite', $datos->id_tramite);
        $this->db->where('id_documento', $datos->id_documento);
        $this->db->where('renglon', $datos->renglon);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDocs(){
      $query = "select*from documentos";
      $result = $this->db->query($query)->result();
      $this->db->close();
      return $result;
    }

    public function buscarDescripcion($descripcion) {
        $this->db->select('id_tramite, clave, descripcion');
        $this->db->from($this->table);
        $this->db->like('descripcion', $descripcion);
        $this->db->where('disponibilidad', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select('id_tramite,clave,descripcion,disponibilidad,estatus');
        $this->db->from($this->table);
        $this->db->or_like(array('descripcion' => $descripcion));
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".descripcion", "desc");
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

    public function fetch($limit,$start)
    {
      $query = "select* from tramite_concentracion order by fecha_creado DESC limit $start,$limit ";
      $result = $this->db->query($query)->result();
      $datos = FALSE;
      if (count($result) > 0) {
        foreach ($result as $row) {
               $data[] = $row;
           }
           $datos = $data;
      }
      $this->db->close();
      return $datos;
    }

    public function count()
    {
        $cont = 0;
        $query = "select count(id_tramite) as cont from tramite_concentracion;";
        $result = $this->db->query($query)->row();
        $cont = $result->cont;
        $this->db->close();
        return $cont;
    }

    public function filtros($estatus, $descripcion) {
        $this->db->select('id_tramite,clave,descripcion,disponibilidad,estatus');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->or_like(array('descripcion' => $descripcion));
        $this->db->where('estatus', intval($estatus));
        $query = $this->db->get();
        return $query->result();
    }

}
