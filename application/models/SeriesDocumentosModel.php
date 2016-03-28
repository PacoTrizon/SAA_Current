<?php

class SeriesDocumentosModel extends CI_Model {

    private $table = "documento_dependencia";

    public function agregar($id_serie, $documentos) {
        $this->db->trans_begin();
        foreach ($documentos as $key => $id_documento) {
            $insertar = $this->documentoExistente($id_serie, $id_documento);
            if ($insertar == 1) {
                $data = array(
                    'serie' => $id_serie,
                    'documento' => $id_documento
                );
                $this->db->insert($this->table, $data);
            }
        }
        if ($this->db->trans_status() === 0) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    public function documentoExistente($serie, $id_documento) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('serie', $serie);
        $this->db->where('documento', $id_documento);
        $q = $this->db->get();
        if (count($q->result()) > 0)
            return 0;
        else
            return 1;
    }

    public function eliminarDocumento($id_serie, $documentos) {
        foreach ($documentos as $key => $id_documento) {
            $this->db->where('documento', $id_documento);
            $this->db->where('serie', $id_serie);
            $this->db->delete($this->table);
        }
    }

}
