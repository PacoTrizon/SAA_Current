<?php

class Solicitantes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('SolicitantesModel');
        $this->load->model('DependenciasModel');
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
        $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
        $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 1;
        $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

        $this->load->library('pagination');

        if (!empty($Buscar) || isset($estatus))
            $total_rows = count($this->SolicitantesModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->SolicitantesModel->record_count();
        $config['base_url'] = base_url('solicitantes/index');
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
            $datos["resultado"] = $this->SolicitantesModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->SolicitantesModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
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
        $this->load->view('listSolicitantes', $datos);
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmSolicitantes');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $respuesta = $this->SolicitantesModel->agregar($datos);
        echo json_encode(array('data' => $respuesta));
    }

    public function editar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarSolicitante');
        $this->load->view('Templates/footer');
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $dependencias = $this->DependenciasModel->getAll();
        $respuesta = $this->SolicitantesModel->buscarId($busqueda->id);
        echo json_encode(array('data' => $respuesta[0], 'dependencias' => $dependencias));
    }

    public function actualizar() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $respuesta = $this->SolicitantesModel->actualizar($datos);
        echo json_encode(array('data' => $respuesta));
    }

    public function existenDatos() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $estatus = (isset($datos->estatus)) ? $datos->estatus : 1;
        $descripcion = (isset($datos->descripcion)) ? $datos->descripcion : null;
        $respuesta = $this->SolicitantesModel->reportePdf($estatus, $descripcion);
        echo json_encode(array('data' => count($respuesta),'datos'=>$respuesta));
    }

    public function imprimir() {
        $estatus = (isset($_GET['estatus'])) ? $_GET['estatus'] : null;
        $descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : null;
        $datos = $this->SolicitantesModel->reportePdf($estatus, $descripcion);

        $pdf = new PDF();
        $contador = 0;
        foreach ($datos as $key => $value) {

            if ($contador === 0) {
                $pdf->AliasNbPages();
                $pdf->AddPage('L');
                $pdf->SetFont('Times', '', 12);
                $Y = 40;
                $X = $pdf->GetX();
                $pdf->SetFont('Helvetica', 'B', 16);
                $pdf->SetY($Y);
                $pdf->SetX(115);
                $pdf->Cell(55, 8, "REPORTE DE SOLICITANTES", 0, 0, 'C');

                $pdf->SetFont('Helvetica', 'B', 13);

                $Y+=15;
                $pdf->SetY($Y);
                $pdf->GetX();
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetTextColor(255, 255, 255);
                //$pdf->SetDrawColor(1, 1, 1);
                $pdf->Cell(60, 8, "Solicitante", 1, 1, 'C', true);

                $pdf->SetXY($X + 45, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(105, 8, utf8_decode("Dependencia"), 1, 1, 'C', true);

                $pdf->SetXY($X + 150, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(90, 8, utf8_decode("Cargo"), 1, 1, 'C', true);

                $pdf->SetXY($X + 240, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(20, 8, utf8_decode("Télefono"), 1, 1, 'C', true);

                $pdf->SetTextColor(0, 0, 0);

                $Y+=8;
            }
            $pdf->SetFont('Times', '', 11);
//---------------------------------------------------------------------------------------
            $pdf->SetY($Y);
            $pdf->GetX();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            if (strlen($value->nombre) > 50) {
                $pdf->MultiCell(60, 4, ucwords(strtolower(utf8_decode($value->nombre))), 1, 'L');
            } else {
                $pdf->Cell(60, 8, ucwords(strtolower(utf8_decode($value->nombre))), 1, 1, 'L');
            }

            $pdf->SetXY($X + 45, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            if (strlen($value->nombre_dependencia) >= 60) {
                $pdf->MultiCell(105, 4, utf8_decode($value->nombre_dependencia), 1, 'L');
            } else {
                $pdf->Cell(105, 8, utf8_decode($value->nombre_dependencia), 1, 1, 'L');
            }
            $pdf->SetXY($X + 150, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            if (strlen($value->cargo) > 55) {
                $pdf->MultiCell(90, 0, utf8_decode($value->cargo), 1, 'L');
            } else
                $pdf->Cell(90, 8, utf8_decode($value->cargo), 1, 1, 'L');

            $pdf->SetXY($X + 240, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(20, 8, utf8_decode($value->telefono), 1, 1, 'L');
            $Y+=8;
            $contador++;
            if ($contador == 13)
                $contador = 0;
        }
        $pdf->Output('I', 'Solicitantes.pdf');
    }

}
