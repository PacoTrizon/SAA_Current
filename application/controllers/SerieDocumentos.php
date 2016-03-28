<?php

class SerieDocumentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('SeriesDocumentosModel');
        $this->load->model('UsuarioModel');
        $this->load->helper('url');
    }

    public function getSessionUser() {
        if ($this->session->logged_in == 0)
            redirect(base_url("home/index"));
        else
            return true;
    }

      private function getPermiso()
    {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        return json_decode($usuario->permisos);
    }


    public function index() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmSerieDocumentos');
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $serieDocumetos = array();
        foreach ($dato->documentos as $key => $documentos) {
            array_push($serieDocumetos, $documentos->id);
        }
        $this->SeriesDocumentosModel->eliminarDocumento($dato->id_serie, $dato->documentosEliminados);
        $respuesta = $this->SeriesDocumentosModel->agregar($dato->id_serie, $serieDocumetos);
        echo json_encode(array('data' => $respuesta));
    }

}
