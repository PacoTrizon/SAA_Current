<?php

class DevolucionModel extends CI_Model {

    public function guardar($expedientes, $solicitante) {
        $foo = (array) $solicitante;
        $foo['fecha_creado'] = date('Y-m-d H:i:s');
        $foo['usuario_creado'] = $this->session->id_usuario;
        $foo = (object) $foo;
        $dato = $foo;

        $this->db->trans_begin();
        //insertar datos en la tabla devoluciones
        $this->db->insert('devoluciones', $dato);
        $id_devolucion = $this->db->insert_id();
        foreach ($expedientes as $key => $expediente) {
            if (intval($expediente->devolucion) == 0) {
                //insertar en la tabla devoluciones_detalles 
                $devolucion_detalle = new stdClass();
                $devolucion_detalle->id_devolucion = $id_devolucion;
                $devolucion_detalle->id_tramite = $expediente->tramite_concentracion_id;
                $devolucion_detalle->servicio_id = $expediente->servicio_id;
                $this->db->insert('devoluciones_detalles', $devolucion_detalle);

                //update a la tabla servicios detalles actualizar el estado de disponibilidad del expediente 
                $array_serv_det = array('disponibilidad' => 0);
                $this->db->where('servicio_id', $expediente->servicio_id);
                $this->db->where('tramite_concentracion_id', $expediente->tramite_concentracion_id);
                $this->db->update('servicios_detalles', $array_serv_det);

                //update a la tabla de servicios, actualizar la fecha de entrega
                $date = date('Y-m-d');
                $array_serv_enc = array('fecha_entrega' => $date);
                $this->db->where('servicio_id', $expediente->servicio_id);
                $this->db->update('servicios', $array_serv_enc);

                //update a la tabla de tramite_concentracion, actualizar el estado a disponible 
                $array_tramite = array('disponibilidad' => 0);
                $this->db->where('id_tramite', $expediente->tramite_concentracion_id);
                $this->db->update('tramite_concentracion', $array_tramite);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            log_message('info', $this->db->_error_message());
            $this->db->trans_rollback();
            return array('data' => 0);
        } else {
            $this->db->trans_commit();
            return array('data' => 1, 'id_devolucion' => $id_devolucion);
        }
    }

    public function busqueda_solicitante_expedientes($nombre) {
        $this->db->select('serv.nombre_solicitante,soli.solicitante_id,inves.id_investigador');
        $this->db->from('servicios as serv');
        $this->db->join('solicitantes as soli', 'soli.solicitante_id=serv.solicitante_id', 'left');
        $this->db->join('cat_investigadores as inves', 'inves.id_investigador=serv.investigador_id', 'left');
        $this->db->join('servicios_detalles as serv_det', 'serv_det.servicio_id = serv.servicio_id');
        $this->db->where("(serv.nombre_solicitante LIKE '%$nombre%')");
        $this->db->where('serv_det.disponibilidad', 1);
        $this->db->group_by("serv.nombre_solicitante");
        $query = $this->db->get();
        return $query->result();
    }

    public function tipo_solicitante($id_devolucion) {
        $this->db->select('if(dev.solicitante_id <=> null,0,1) as tipo_solicitante,if(dev.solicitante_id <=> null,inves.id_investigador,soli.solicitante_id) as id_solicitante');
        $this->db->from('devoluciones as dev');
        $this->db->join('solicitantes as soli', 'soli.solicitante_id=dev.solicitante_id', 'left');
        $this->db->join('cat_investigadores as inves', 'inves.id_investigador=dev.id_investigador', 'left');
        $this->db->where('dev.id_devolucion', $id_devolucion);
        $query = $this->db->get();
        return $query->result();
    }

    public function informacion_solicitante($datos) {
        $id_solicitante = $datos[0]->id_solicitante;
        $select = '';

        if (intval($datos[0]->tipo_solicitante) == 1) {
            $select="solicitantes.nombre,solicitantes.cargo,depen.nombre as nombre_dependencia";
            $this->db->from('solicitantes');
            $this->db->join('dependencias as depen', 'depen.dependencia_id = solicitantes.dependencia_id');
            $this->db->where('solicitante_id', $id_solicitante);
        } else {
             $select="*";
            $this->db->from('cat_investigadores');
            $this->db->where('id_investigador', $id_solicitante);
        }
        $this->db->select($select);
        $query = $this->db->get();
        $query = $query->result();
        return $query[0];
    }

    public function devolucion_expedientes_detalle($id_devolucion) {
        $this->db->select('tram.clave, tram.descripcion,serv.motivo, date_format(serv.fecha_solicitud, "%d-%m-%Y") as fecha_solicitud');
        $this->db->from('devoluciones as dev');
        $this->db->join('devoluciones_detalles as dev_det', 'dev_det.id_devolucion=dev.id_devolucion');
        $this->db->join('servicios as serv', 'serv.servicio_id=dev_det.servicio_id');
        $this->db->join('tramite_concentracion as tram', 'tram.id_tramite=dev_det.id_tramite');
        $this->db->where('dev.id_devolucion', $id_devolucion);
        $query = $this->db->get();
        return $query->result();
    }

    public function devolucion_id($id_devolucion) {
        $this->db->select('*');
        $this->db->from('devoluciones');
        $this->db->where('id_devolucion', $id_devolucion);
        $query = $this->db->get();
        $query = $query->result();
        return $query[0];
    }

    public function busqueda_expedientes_prestados($nombre) {
        $this->db->select('serv_det.servicio_id,serv_det.tramite_concentracion_id, tram.descripcion as nombre_expediente,tram.clave, date_format(serv.fecha_solicitud,"%d-%m-%Y") as fecha_formateada, IF(serv_det.prestamo = 1, 1, 0) as devolucion');
        $this->db->from('servicios as serv');
        $this->db->join('servicios_detalles as serv_det', 'serv_det.servicio_id = serv.servicio_id');
        $this->db->join('tramite_concentracion as tram', 'tram.id_tramite=serv_det.tramite_concentracion_id');
        $this->db->where("(serv.nombre_solicitante LIKE '%$nombre%')");
        $this->db->where('serv_det.disponibilidad', 1);
        $query = $this->db->get();
        return $query->result();
    }

}
