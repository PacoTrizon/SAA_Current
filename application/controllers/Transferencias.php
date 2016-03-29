<?php

class Transferencias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('TransferenciaModel');
    }
    //estados tramite = 1, Recepcion = 2, revision 3,concentracion 4
    public function tramite()
    {
      $data = array();
      $data['nombre'] = "Trámite";
      $data['tipo'] = 1;
      $this->load->view('Templates/header');
      $this->load->view('listTransferenciaTramite',$data);
      $this->load->view('Templates/footer');
    }

    public function recepcion()
    {
      $data = array();
      $data['nombre'] = "Recepcion";
      $data['std'] = base64_encode(2*7);
      $data['std2'] = 3;
      $this->load->view('Templates/header');
      $this->load->view('listTransferenciaTramiteDep',$data);
      $this->load->view('Templates/footer');
    }

    public function revision()
    {
      $data = array();
      $data['nombre'] = "Revision";
      $data['std'] = base64_encode(3*7);
      $data['std2'] = 4;
      $this->load->view('Templates/header');
      $this->load->view('listTransferenciaTramiteDep',$data);
      $this->load->view('Templates/footer');
    }

    public function concentracion()
    {
      $data = array();
      $data['nombre'] = "Concentración";
      $data['std'] = base64_encode(4*7);
      $data['std2'] = 0;
      $this->load->view('Templates/header');
      $this->load->view('listTransferenciaTramiteDep',$data);
      $this->load->view('Templates/footer');
    }


    public function transferirRec()
    {
      if ($this->input->post('transf')) {
        $t = $this->input->post('transf');
        $tramites =$this->TransferenciaModel->transferirRec($t,2);
        $result = "Cambio Exitoso";
      }else {
        $result = "error";
      }
      echo $result;
    }


    public function transferirRev()
    {
      if ($this->input->post('transf')) {
        $t = $this->input->post('transf');
        $std = $this->input->post('est');
        $tramites =$this->TransferenciaModel->transferirRec($t,$std);
        $result = "Cambio Exitoso";
      }else {
        $result = "error";
      }
      echo $result;


    }



    public function obtenerTramites()
    {
      if (isset($_POST['gaveta']) && !empty($_POST['gaveta']) ) {
          $tramites = $this->TransferenciaModel->tramitesGaveta($this->input->post('gaveta'),1);
          $result = $this->tablaTramites($tramites);
          echo $result;
      }else {
        echo "Faltan Parametros";
      }
    }

    public function obtenerTramitesDep()
    {
      if (isset($_POST['dep']) && !empty($_POST['dep']) && isset($_POST['std']) && !empty($_POST['std'])) {
          $std = (base64_decode($this->input->post('std')))/7;
          $tramites = $this->TransferenciaModel->tramitesDependencia($this->input->post('dep'),$std);
          $result = $this->tablaTramites($tramites);
          echo $result;
      }else {
        echo "Faltan Parametros";
      }
    }





    private function tablaTramites($resultado)
    {
      $html = "";
      if ($resultado != null || !empty($resultado)) {
        foreach ($resultado as $key) {
          if ($key->disponibilidad == 0) {
            $key->disponibilidad="Disponible";
          }
          if ($key->estatus == 1) {
            $key->estatus = "Trámite";
          }elseif ($key->estatus == 2) {
            $key->estatus = "Recepción";
          }elseif ($key->estatus == 3) {
            $key->estatus = "Concentración";
          }


          $html .= '<tr>
                    <td>'.$key->clave.'</td>
                    <td>'.$key->descripcion.'</td>
                    <td>'.$key->disponibilidad.'</td>
                    <td>'.$key->estatus.'</td>
                    <td style="text-align:center;"><input type="checkbox" name="transf" id="transf" value="'.$key->id_tramite.'"></td>
                  </tr>';
        }
      }else{
        $html = '<tr >
                  <td colspan="5" style="text-align:center">No se encontrarón tramites</td>
                </tr>';
      }
      return $html;
    }

}
