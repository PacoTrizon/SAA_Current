<?php

class Devolucion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('DevolucionModel');
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

    }

    public function agregar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmDevolucionExpediente');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $data = json_decode($postdata);
        $datos_expedientes = $data->expedientes;
        $solicitante = $data->solicitante;
        $respuesta = $this->DevolucionModel->guardar($datos_expedientes, $solicitante);
        echo json_encode($respuesta);
    }

    public function busqueda_solicitantes_expedientes() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $nombre_solicitante = (isset($datos->nombre_solicitante)) ? $datos->nombre_solicitante : null;
        $nombre_solicitante = $this->DevolucionModel->busqueda_solicitante_expedientes($nombre_solicitante);
        echo json_encode(array('data' => $nombre_solicitante));
    }

    public function busqueda_expedientes_prestados() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $nombre_solicitante = (isset($datos->nombre_solicitante)) ? $datos->nombre_solicitante : null;
        $nombre_solicitante = $this->DevolucionModel->busqueda_expedientes_prestados($nombre_solicitante);
        echo json_encode(array('data' => $nombre_solicitante));
    }

    public function imprimir() {
        $id_devolucion = (isset($_GET['id_devolucion'])) ? $_GET['id_devolucion'] : null;
//        foreach ($expedientes as $key => $expediente) {
        log_message('info', var_export($id_devolucion, true));
//        }
        $devolucion_inf = $this->DevolucionModel->devolucion_id($id_devolucion);
        $tipo_solicitante = $this->DevolucionModel->tipo_solicitante($id_devolucion);
        $devolucion_enc = $this->DevolucionModel->informacion_solicitante($tipo_solicitante);
        $devolucion_det = $this->DevolucionModel->devolucion_expedientes_detalle($id_devolucion);
         log_message('info', 'tipo_solicitante');
        log_message('info', var_export($tipo_solicitante, true));
        log_message('info', 'inf');
        log_message('info', var_export($devolucion_inf, true));
        log_message('info', 'enc');
        log_message('info', var_export($devolucion_enc, true));
        log_message('info', 'det');
        log_message('info', var_export($devolucion_det, true));

        $data['tipo_solicitante'] = $tipo_solicitante[0]->tipo_solicitante;
        $data['inf'] = $devolucion_inf;
        $data['enc'] = $devolucion_enc;
        $data['det'] = $devolucion_det;

        $html = $this->load->view('pdf/pdf_devolucion', $data, true);

        $pdfFilePath = "devolucion_expedientes.pdf";

        $this->load->library('m_pdf');

        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }

}
