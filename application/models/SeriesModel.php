<?php

class SeriesModel extends CI_Model {

    private $table = "serie";

    public function agregar($dato) {
        $foo = (array) $dato;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;
        if (isset($dato->id_padre)) {
            $contadorHijo = count($this->seriesHijos($dato->id_padre)) + 1;
            $dato->codigo = $dato->id_padre . '.' . $contadorHijo;
        }
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

    public function seriesHijos($id_serie) {
      $query = "select*from serie where id_padre='$id_serie'";
      $result = $this->db->query($query)->result();
      $this->db->close();
      if ($result!=null) {
        foreach ($result as $key) {
          $datos[] = array('id' => $key->id_serie,'label' => $key->descripcion);
        }
        }else{
          $datos = array('id' => 'vacio');
      }
      return $datos;
    }

    public function verificarExistente($dato) {
        $this->db->like('descripcion', $dato->descripcion);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0)
            return false;
        else
            return true;
    }

    public function actualizar($dato) {

        $foo = (array) $dato;
        $foo['fecha_modificado'] = date('Y-m-d H:i:s');
        $foo['usuario_modificado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->where('id_serie', $dato->id_serie);
        $this->db->update($this->table, $dato);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function buscarId($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_serie', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarSerieDescripcion($descripcion, $id_padre = false) {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($id_padre == true)
            $this->db->where('descripcion', $descripcion);
        else
            $this->db->like('descripcion', $descripcion);
        $query = $this->db->get();
        return $query->result();
    }

    public function documentosSeries($series) {
        $documentos = array();
        foreach ($series as $key => $serie) {
            $sql = "select doc.id,doc.descripcion, doc_dep.serie
                    from documento_dependencia as doc_dep
                    inner join documentos as doc on doc.id=doc_dep.documento
                    where doc_dep.serie=? order by doc.descripcion";
            $query = $this->db->query($sql, array($serie->id_serie));
            $resultados = $query->result();
            array_push($documentos, $resultados);
        }
        return $documentos;
    }

    public function documentosSeriesTramite($id_serie) {
        $sql = "select doc.id,doc.descripcion, doc_dep.serie
                    from documento_dependencia as doc_dep
                    inner join documentos as doc on doc.id=doc_dep.documento
                    where doc_dep.serie=? order by doc.descripcion";
        $query = $this->db->query($sql, array($id_serie));
        return $resultados = $query->result();
    }

    public function seriesPadres($nombre) {
          $query = "select*from serie where descripcion like '%".$nombre."%'";
          $result = $this->db->query($query)->result();
          $this->db->close();
          foreach ($result as $key) {
            $datos[] = array('id' => $key->id_serie,'label' => $key->descripcion );
          }
          return $datos;
        }

    public function seriesExistentes($nombre = null, $estatus = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($nombre !== null)
            $this->db->like('descripcion', $nombre);
        if ($estatus != null)
            $this->db->where('estatus', $estatus);
        else
            $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select('*');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->or_like(array('descripcion' => $descripcion, 'valor_documental' => $descripcion));
        $this->db->where('estatus', intval($estatus));
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
            $this->db->or_like(array('descripcion' => $descripcion, 'valor_documental' => $descripcion));
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".descripcion", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function seriePadresPDF($estatus, $descripcion) {
        $this->db->select('id_serie,descripcion,valor_documental,vigencia_tramite,vigencia_concentracion');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->or_like(array('descripcion' => $descripcion));
        if ($estatus != null) {
            $this->db->where($this->table . '.estatus', intval($estatus));
        } else
            $this->db->where($this->table . '.estatus', 1);
        $this->db->where($this->table . '.id_padre is null');
        $this->db->order_by($this->table . ".id_serie", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function serieHijosPDF($id_padre, $estatus = null, $descripcion = "") {
        $this->db->select('id_serie,codigo,descripcion,valor_documental,vigencia_tramite,vigencia_concentracion');
        $this->db->from($this->table);
//        if (!empty($descripcion))
//            $this->db->or_like(array('descripcion' => $descripcion));
        if ($estatus != null) {
            $this->db->where($this->table . '.estatus', intval($estatus));
        } else
            $this->db->where($this->table . '.estatus', 1);
        $this->db->where($this->table . '.id_padre', $id_padre);
        $this->db->order_by($this->table . ".codigo", "asc");
        $query = $this->db->get();
        return $query->result();
    }

}
