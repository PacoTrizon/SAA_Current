<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
          $this->load->model('UsuarioModel');
          $this->load->helper('url');
           }

      public function index() {
        $this->load->view('login');
      }

    public function login() {
        $correo = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model('UsuarioModel');
        $usuario = $this->UsuarioModel->getUser($correo, $password);
        if ($usuario != null) {
            $newdata = array(
                'id_usuario' => $usuario->usuario_id,
                'correo' => $usuario->email,
                'usuario' => $usuario->nombre,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            $this->session->set_flashdata('_flash_message', 'Bienvenido '.$usuario->nombre);
            redirect(base_url("Tramite_Concentracion"));
        } else{
            $this->session->set_flashdata('_flash_message_error', 'Usuario o Contraseña Incorrectos');
            redirect(base_url(),'refresh');
          }

    }

    public function getSessionUser() {
        if ($this->session->logged_in == 0)
            redirect(base_url("home/index"));
        else
            return true;
    }

    public function homePage() {
        $this->getSessionUser();

//        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
//        $usuario = $this->UsuarioModel->permisos_id($usuario[0]->id_perfil);
//        $data['permisos'] = json_decode($usuario[0]->permisos);
//        $data['usuario'] = $this->session->usuario;
//        log_message('info', var_export($data, true));
//        $this->load->view('templates/header', $data);
//        $this->load->view('principal');
//        $this->load->view('templates/footer');
    }

    public function cerrarSesion() {
        session_destroy();
        redirect(base_url("home/index"));
    }


}
