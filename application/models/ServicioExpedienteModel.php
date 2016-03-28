<?php

class ServicioExpedienteModel extends CI_Model {

    private $table = "servicios";

    public function agregar($dato, $detalles) {
        $foo = (array) $dato;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->trans_begin();
        $this->db->insert($this->table, $dato);
        $servicio_id = $this->db->insert_id();
        foreach ($detalles as $key => $dato) {
            $servicio_detalle = new stdClass();
            $servicio_detalle->servicio_id = $servicio_id;
            $servicio_detalle->tramite_concentracion_id = $dato->id_tramite;
            $servicio_detalle->prestamo = $dato->prestamo;
            $servicio_detalle->consulta = $dato->consulta;
            $servicio_detalle->fotocopiado = $dato->fotocopiado;
            $servicio_detalle->disponibilidad = $dato->prestamo;
            $this->db->insert('servicios_detalles', $servicio_detalle);
            if (intval($dato->prestamo) == 1) {
                $array = array('disponibilidad' => 1);
                $this->db->where('id_tramite', $dato->id_tramite);
                $this->db->update('tramite_concentracion', $array);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            log_message('info', $this->db->_error_message());
            $this->db->trans_rollback();
            return array('inserto' => 0, 'id' => $servicio_id);
        } else {
            $this->db->trans_commit();
            return array('inserto' => 1, 'id' => $servicio_id);
        }
    }

//    public function guardar_devolucion($expedientes, $solicitante) {
//        $foo = (array) $solicitante;
//        $foo['fecha_creado'] = date('Y-m-d H:i:s');
//        $foo['usuario_creado'] = $this->session->id_usuario;
//        $foo = (object) $foo;
//        $dato = $foo;
//
//        $this->db->trans_begin();
//        //insertar datos en la tabla devoluciones
//        $this->db->insert('devoluciones', $dato);
//        $id_devolucion = $this->db->insert_id();
//        foreach ($expedientes as $key => $expediente) {
//            if (intval($expediente->devolucion) == 0) {
//                //insertar en la tabla devoluciones_detalles 
//                $devolucion_detalle = new stdClass();
//                $devolucion_detalle->id_devolucion = $id_devolucion;
//                $devolucion_detalle->id_tramite = $expediente->tramite_concentracion_id;
//                $devolucion_detalle->servicio_id = $expediente->servicio_id;
//                $this->db->insert('devoluciones_detalles', $devolucion_detalle);
//
//                //update a la tabla servicios detalles actualizar el estado de disponibilidad del expediente 
//                $array_serv_det = array('disponibilidad' => 0);
//                $this->db->where('servicio_id', $expediente->servicio_id);
//                $this->db->where('tramite_concentracion_id', $expediente->tramite_concentracion_id);
//                $this->db->update('servicios_detalles', $array_serv_det);
//
//                //update a la tabla de servicios, actualizar la fecha de entrega
//                $date = date('Y-m-d');
//                $array_serv_enc = array('fecha_entrega' => $date);
//                $this->db->where('servicio_id', $expediente->servicio_id);
//                $this->db->update('servicios', $array_serv_enc);
//
//                //update a la tabla de tramite_concentracion, actualizar el estado a disponible 
//                $array_tramite = array('disponibilidad' => 0);
//                $this->db->where('id_tramite', $expediente->tramite_concentracion_id);
//                $this->db->update('tramite_concentracion', $array_tramite);
//            }
//        }
//        if ($this->db->trans_status() === FALSE) {
//            log_message('info', $this->db->_error_message());
//            $this->db->trans_rollback();
//            return array('data' => 0);
//        } else {
//            $this->db->trans_commit();
//            return array('data' => 1, 'id_devolucion' => $id_devolucion);
//        }
//    }


    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('estatus', 1);
        $this->db->order_by("nombre", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getSolicitante($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cat_colonias as col_inv', 'col_inv.id_colonia = cat_investigadores.colonia');
        $this->db->join('cat_colonias as col_inst', 'col_inst.id_colonia = cat_investigadores.colonia_institucion', 'left');
        $this->db->where('id_investigador', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function buscarId($id, $tipo_solicitante) {
        $select = $this->table . '.*,';
//        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        $this->db->where($this->table . '.estatus', 1);
        if ($tipo_solicitante == 1) {
            $select = $this->table . '.*,soli.*,depen.nombre as nombre_dependencia';
            $this->db->join('solicitantes as soli', 'soli.solicitante_id = servicios.solicitante_id');
            $this->db->join('dependencias as depen', 'depen.dependencia_id = soli.dependencia_id');
        } else {
            $select = $this->table . '.*,investigadores.*';
            $this->db->join('cat_investigadores as investigadores', 'investigadores.id_investigador = servicios.investigador_id');
        }
        $this->db->select($select);
        $this->db->where($this->table . '.servicio_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_servicio_detalle($id, $prestamo = null) {
        $this->db->select('serv_det.*, tramite.clave, tramite.descripcion');
        $this->db->from('servicios_detalles as serv_det');
        $this->db->join('tramite_concentracion as tramite', 'tramite.id_tramite = serv_det.tramite_concentracion_id');
        if ($prestamo != null)
            $this->db->where('serv_det.disponibilidad', 1);
        $this->db->where('serv_det.servicio_id', $id);
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

//    public function busqueda_solicitante_expedientes($nombre) {
//        $this->db->select('serv.nombre_solicitante,soli.solicitante_id,inves.id_investigador');
//        $this->db->from('servicios as serv');
//        $this->db->join('solicitantes as soli', 'soli.solicitante_id=serv.solicitante_id', 'left');
//        $this->db->join('cat_investigadores as inves', 'inves.id_investigador=serv.investigador_id', 'left');
//        $this->db->join('servicios_detalles as serv_det', 'serv_det.servicio_id = serv.servicio_id');
//        $this->db->where("(serv.nombre_solicitante LIKE '%$nombre%')");
//        $this->db->where('serv_det.disponibilidad', 1);
//        $this->db->group_by("serv.nombre_solicitante");
//        $query = $this->db->get();
//        return $query->result();
//    }

//    public function busqueda_expedientes_prestados($nombre) {
//        $this->db->select('serv_det.servicio_id,serv_det.tramite_concentracion_id, tram.descripcion as nombre_expediente,tram.clave, date_format(serv.fecha_solicitud,"%d-%m-%Y") as fecha_formateada, IF(serv_det.prestamo = 1, 1, 0) as devolucion');
//        $this->db->from('servicios as serv');
//        $this->db->join('servicios_detalles as serv_det', 'serv_det.servicio_id = serv.servicio_id');
//        $this->db->join('tramite_concentracion as tram', 'tram.id_tramite=serv_det.tramite_concentracion_id');
//        $this->db->where("(serv.nombre_solicitante LIKE '%$nombre%')");
//        $this->db->where('serv_det.disponibilidad', 1);
//        $query = $this->db->get();
//        return $query->result();
//    }

    public function fetch_data($limit, $start, $estatus, $descripcion, $limitePaginado) {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        if (!empty($descripcion))
            $this->db->where("(nombre_solicitante LIKE '%$descripcion%')");
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".nombre_solicitante", "asc");
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
            $this->db->where("(nombre_solicitante LIKE '%$descripcion%')");
        $this->db->where('estatus', intval($estatus));
        $this->db->order_by($this->table . ".nombre_solicitante", "asc");
        $query = $this->db->get();
        return $query->result();
    }

}
