<?php

class Investigadores extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('InvestigadoresModel');
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
            $total_rows = count($this->InvestigadoresModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->InvestigadoresModel->record_count();
        $config['base_url'] = base_url('investigadores/index');
        $config['page_query_string'] = TRUE;

        $config['total_rows'] = $total_rows; //this total count of rows returned from the query
        $config['per_page'] = 5; //data per page you want to display.
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_rows;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';

        $config['cur_tag_close'] = '</a>';

        $config['next_link'] = 'Siguiente';

        $config['prev_link'] = 'Anterior';

         if (count($_GET) > 0)
            $config['suffix'] =  '&estatus=' . $estatus . '&buscar=' . $Buscar;
        $config['first_url'] = $config['base_url'] . '?estatus=' . $estatus . '&buscar=' . $Buscar;
        $config['second_url'] = $config['base_url'] . '?per_page='.$config['per_page'].'estatus=' . $estatus . '&buscar=' . $Buscar;

        $this->pagination->initialize($config);
        if ($perPage != null) {
            $page = $config['per_page'] * ($perPage - 1);
            $datos["resultado"] = $this->InvestigadoresModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->InvestigadoresModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
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
        $this->load->view('listInvestigadores', $datos);
        $this->load->view('Templates/footer');
    }

    public function obtenerInvestigadores() {
        $respuesta = $this->InvestigadoresModel->getAll();
        echo json_encode($respuesta);
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->InvestigadoresModel->agregar($busqueda);
        echo json_encode($respuesta);
    }

    public function agregar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmInvestigadores');
        $this->load->view('Templates/footer');
    }

    public function editar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarInvestigador');
        $this->load->view('Templates/footer');
    }

    public function actualizar() {
        $this->getSessionUser();
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $respuesta = $this->InvestigadoresModel->actualizar($datos);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->InvestigadoresModel->buscarId($busqueda->id);
        echo json_encode(array('data' => $respuesta[0]));
    }

    public function subirImagen() {
        if (is_dir('uploads')) {
            $nombreImagenBorrar = (isset($_POST['nombreImagenBorrar'])) ? $_POST['nombreImagenBorrar'] : null;
            $id_investigador = $_POST['id_investigador'];
            if ($nombreImagenBorrar !== null)
                unlink('uploads/' . $nombreImagenBorrar);
            $tmp_file = $_FILES['fileInput']['tmp_name'];
            $fileName = $_FILES['fileInput']['name'];

            $direccionNombreImagen = 'uploads/' . $fileName;
            move_uploaded_file($tmp_file, $direccionNombreImagen);
//            $bin_string = file_get_contents($direccionNombreImagen);
//            $hex_string = base64_encode($bin_string);
            //$respuesta = $this->InvestigadoresModel->insertarImagen($id_investigador, $hex_string);
            return json_encode(array('data' => $respuesta));
        }
    }

    public function imprimir() {
        $estatus = (isset($_GET['estatus'])) ? $_GET['estatus'] : null;
        $descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : null;
        $investigadores = $this->InvestigadoresModel->filtros($estatus, $descripcion);

        $pdf = new PDF();
        $contador = 0;
        foreach ($investigadores as $key => $value) {

            if ($contador === 0) {
                $pdf->AliasNbPages();
                $pdf->AddPage('L');
                $pdf->SetFont('Times', '', 12);
                $Y = 40;
                $X = $pdf->GetX();
                $pdf->SetFont('Helvetica', 'B', 16);
                $pdf->SetY($Y + 2);
                $pdf->SetX(115);
                $pdf->Cell(55, 8, "REPORTE DE INVESTIGADORES", 0, 0, 'C');

                $Y+=15;
                $pdf->SetFont('Helvetica', 'B', 13);
                $pdf->SetY($Y);
                $pdf->GetX();
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetTextColor(255, 255, 255);
                //$pdf->SetDrawColor(1, 1, 1);
                $pdf->Cell(60, 8, utf8_decode("NÚMERO INVESTIGADOR"), 1, 1, 'C', true);

                $pdf->SetXY($X + 45, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(60, 8, utf8_decode("INVESTIGADOR"), 1, 1, 'C', true);

                $pdf->SetXY($X + 105, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(30, 8, utf8_decode("TÉLEFONO"), 1, 1, 'C', true);

                $pdf->SetXY($X + 135, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(80, 8, utf8_decode("INSTITUCIÓN PERTENECIENTE"), 1, 1, 'C', true);

                $pdf->SetTextColor(0, 0, 0);

                $Y+=8;
            }
            $pdf->SetFont('Times', '', 13);

            $pdf->SetY($Y);
            $pdf->GetX();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(60, 8, $value->numero_investigador, 1, 1, 'L');

            $pdf->SetXY($X + 45, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(60, 8, utf8_decode($value->nombre . ' ' . $value->apellido_paterno . ' ' . $value->apellido_materno), 1, 1, 'L');

            $pdf->SetXY($X + 105, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(30, 8, $value->telefono, 1, 1, 'L');

            $pdf->SetXY($X + 135, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(80, 8, utf8_decode($value->nombre_institucion), 1, 1, 'L');

            $Y+=8;
            $contador++;
            if ($contador == 13)
                $contador = 0;
        }
        $pdf->Output('I', 'Investigadores.pdf');
    }

}
