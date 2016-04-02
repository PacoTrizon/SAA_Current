<?php

class TransferenciaModel extends CI_Model {

  public function tramitesGaveta($gaveta,$tipo)
  {
      $query = "select * FROM archivo_municipal.tramite_concentracion where estatus = '$tipo' and ubicacion_gaveta like '$gaveta'";
      $result = $this->db->query($query)->result();
      $this->db->close();
      return $result;
  }

  public function tramitesDependencia($dependencia,$tipo)
  {
      $query = "select * FROM archivo_municipal.tramite_concentracion where estatus = '$tipo' and id_sub_fondo = '$dependencia'";
      $result = $this->db->query($query)->result();
      $this->db->close();
      return $result;
  }

  public function transferirRec($obj,$est)
  {
      $obj = (object) $obj;
      $result = null;
      if ($obj != null) {
        foreach ($obj as $key) {
          $query = "update tramite_concentracion set estatus = $est where id_tramite = $key";
          $result = $this->db->query($query);
          $this->db->close();
        }
      }
      return $result;
  }

}
