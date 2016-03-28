<?php

class Servicio_expediente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('SolicitantesModel');
        $this->load->model('InvestigadoresModel');
        $this->load->model('ServicioExpedienteModel');
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
        $estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : 1;
        $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
        $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

        $this->load->library('pagination');

        if (!empty($Buscar) || isset($estatus))
            $total_rows = count($this->ServicioExpedienteModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->ServicioExpedienteModel->record_count();
        $config['base_url'] = base_url('servicio_expediente/index');
        $config['page_query_string'] = TRUE;

        $config['total_rows'] = $total_rows; //this total count of rows returned from the query
        $config['per_page'] = 5; //data per page you want to display.
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'Primera';
        $config['last_link'] = 'Última';
        $config['cur_tag_open'] = '&nbsp;<a class="current">';

        $config['cur_tag_close'] = '</a>';

        $config['next_link'] = 'Siguiente';

        $config['prev_link'] = 'Anterior';

        if (count($_GET) > 0)
            $config['suffix'] = '&estatus=' . $estatus . '&buscar=' . $Buscar;
        $config['first_url'] = $config['base_url'] . '?estatus=' . $estatus . '&buscar=' . $Buscar;
        $config['second_url'] = $config['base_url'] . '?per_page=' . $config['per_page'] . 'estatus=' . $estatus . '&buscar=' . $Buscar;

        $this->pagination->initialize($config);

        if ($perPage != null) {
            $page = $config['per_page'] * ($perPage - 1);
            $datos["resultado"] = $this->ServicioExpedienteModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->ServicioExpedienteModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
        }
        if ($datos["resultado"] == false)
            $datos["resultado"] = 0;
        $datos["estatus"] = isset($estatus) ? $estatus : 1;
        $datos["buscar"] = isset($Buscar) ? $Buscar : "";
        $str_links = $this->pagination->create_links();

        $datos["links"] = explode('&nbsp;', $str_links);
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('listServicioExpedientes', $datos);
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmServicioExpediente');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $data = json_decode($postdata);
        $datos_expedientes = $data->expedientes;
        $respuesta = $this->ServicioExpedienteModel->agregar($data->datos, $datos_expedientes);
        echo json_encode($respuesta);
    }

//    public function guardar_devolucion() {
//        $postdata = file_get_contents('php://input');
//        $data = json_decode($postdata);
//        $datos_expedientes = $data->expedientes;
//        $solicitante = $data->solicitante;
//        $respuesta = $this->ServicioExpedienteModel->guardar_devolucion($datos_expedientes,$solicitante);
//        echo json_encode($respuesta);
//    }

    public function editar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarTramiteConcentracion');
        $this->load->view('Templates/footer');
    }

    public function devolucion() {

    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->TramiteConcentracionModel->buscarId($busqueda->id);
        $documentos = $this->SeriesModel->documentosSeriesTramite($respuesta[0]->id_sub_serie);
        $cuidades = $this->MunicipioModel->getAll(1);
        $tipologias = $this->TipologiasModel->getAll();
        echo json_encode(array('data' => $respuesta[0], 'documentos' => $documentos, 'cuidades' => $cuidades, 'tipologias' => $tipologias));
    }

    public function buscarPorIdDevolucion() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $respuesta = $this->ServicioExpedienteModel->buscarId($datos->id, $datos->tipo_solicitante);
        $expedientes = $this->ServicioExpedienteModel->get_servicio_detalle($datos->id, true);
        log_message('info', 'devolucion');
        log_message('info', var_export($respuesta, true));
        echo json_encode(array('data' => $respuesta[0], 'expedientes' => $expedientes));
    }

    public function busquedaSolicitantes() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $tipo_solicitante = (isset($datos->tipo_solicitante)) ? $datos->tipo_solicitante : null;
        $descripcion = (isset($datos->descripcion)) ? $datos->descripcion : null;
        if ($tipo_solicitante == 1)
            $respuesta = $this->SolicitantesModel->reportePdf(1, $descripcion);
        else
            $respuesta = $this->InvestigadoresModel->busqueda($descripcion);
        echo json_encode(array('data' => $respuesta));
    }

//    public function busqueda_solicitantes_expedientes() {
//        $postdata = file_get_contents('php://input');
//        $datos = json_decode($postdata);
//        $nombre_solicitante = (isset($datos->nombre_solicitante)) ? $datos->nombre_solicitante : null;
//        $nombre_solicitante = $this->ServicioExpedienteModel->busqueda_solicitante_expedientes($nombre_solicitante);
//        echo json_encode(array('data' => $nombre_solicitante));
//    }
//    public function busqueda_expedientes_prestados() {
//        $postdata = file_get_contents('php://input');
//        $datos = json_decode($postdata);
//        $nombre_solicitante = (isset($datos->nombre_solicitante)) ? $datos->nombre_solicitante : null;
//        $nombre_solicitante = $this->ServicioExpedienteModel->busqueda_expedientes_prestados($nombre_solicitante);
//        echo json_encode(array('data' => $nombre_solicitante));
//    }

    public function imprimir() {
        $servicio_id = (isset($_GET['servicio_id'])) ? $_GET['servicio_id'] : null;
        $tipo_solicitante = (isset($_GET['tipo_solictante'])) ? $_GET['tipo_solictante'] : null;
        $servicio_enc = $this->ServicioExpedienteModel->buscarId($servicio_id, $tipo_solicitante);
        $servicio_det = $this->ServicioExpedienteModel->get_servicio_detalle($servicio_id);

        $data['tipo_solicitante'] = $tipo_solicitante;
        $data['servicio_enc'] = $servicio_enc;
        $data['servicio_det'] = $servicio_det;
        log_message('info', var_export($servicio_enc, true));
        log_message('info', var_export($servicio_det, true));


        $html = $this->load->view('pdf/pdf_servicio', $data, true);

        $pdfFilePath = "Prestamo de Expedientes.pdf";

        $this->load->library('m_pdf');

        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }

//    public function imprimir_devolucion() {
//        $id_devolucion = (isset($_GET['id_devolucion'])) ? $_GET['id_devolucion'] : null;
////        foreach ($expedientes as $key => $expediente) {
//             log_message('info', var_export($id_devolucion, true));
////        }
//        $devolucion_enc = $this->ServicioExpedienteModel->buscarId($servicio_id, $tipo_solictante);
////        $servicio_det = $this->ServicioExpedienteModel->get_servicio_detalle($servicio_id);
////        $total_expdientes = 0;
////        $data['servicio_enc'] = $servicio_enc;
////        $data['servicio_det'] = $servicio_det;
////        log_message('info', var_export($servicio_det, true));
//        $data;
//
//        $html = $this->load->view('pdf/devolucion', $data, true);
//
//        $pdfFilePath = "devolucion_expedientes.pdf";
//
//        $this->load->library('m_pdf');
//
//        $pdf = $this->m_pdf->load();
//        $pdf->WriteHTML($html);
//        $pdf->Output($pdfFilePath, "I");
//    }
}
