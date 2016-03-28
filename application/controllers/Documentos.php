<?php

class Documentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('DocumentosModel');
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
        $this->load->view('frmDocumento');
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->DocumentosModel->agregar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscar() {
        $respuesta = $this->DocumentosModel->getAll();
        echo json_encode(array('data' => $respuesta));
    }

    public function busqueda_descripcion() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->DocumentosModel->get_documentos_descripcion($dato->descripcion);
        echo json_encode(array('data' => $respuesta));
    }

}
