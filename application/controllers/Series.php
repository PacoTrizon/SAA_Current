<?php

class Series extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SeriesModel');
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
        $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
        $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 1;
        $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

        $this->load->library('pagination');

        if (!empty($Buscar) || isset($estatus))
            $total_rows = count($this->SeriesModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->SeriesModel->record_count();
        $config['base_url'] = base_url('series/index');
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
            $datos["resultado"] = $this->SeriesModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->SeriesModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
        }
        if ($datos["resultado"] == false)
            $datos["resultado"] = 0;
        $datos["estatus"] = isset($estatus) ? $estatus : 1;
        $datos["buscar"] = isset($Buscar) ? $Buscar : "";
        $str_links = $this->pagination->create_links();
        $datos["links"] = explode('&nbsp;', $str_links);
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('listSeries', $datos);
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmSeries');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->SeriesModel->agregar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function editar() {
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarSerie');
        $this->load->view('Templates/footer');
    }

    public function actualizar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->SeriesModel->actualizar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->SeriesModel->buscarId($busqueda->id);
        echo json_encode(array('data' => $respuesta[0]));
    }

    public function buscarDescripcion() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->SeriesModel->buscarSerieDescripcion($busqueda->descripcion);
        $documentos = $this->SeriesModel->documentosSeries($respuesta);
        echo json_encode(array('data' => $respuesta, 'documentos' => $documentos[0]));
    }

    /**************

    public function busquedaPadre() {
        $nombre = $_GET['term'];
        $respuesta = $this->DependenciasModel->dependenciasPadres($nombre);
        echo json_encode($respuesta);
    }

    public function busquedaHijos() {
        $id = $this->input->get('dependencia');
        $respuesta = $this->DependenciasModel->dependenciasHijos($id);
        echo json_encode($respuesta);
    }

    ************/

    public function buscarSeriePadres() {
            $nombre = $_GET['term'];
            $respuesta = $this->SeriesModel->seriesPadres($nombre);
            echo json_encode($respuesta);
    }

    public function buscarSeries() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $descripcion = (isset($busqueda->descripcion)) ? $busqueda->descripcion : null;
        $estatus = (isset($busqueda->estatus)) ? $busqueda->estatus : null;
        $respuesta = $this->SeriesModel->seriesExistentes($descripcion, $estatus);
        echo json_encode(array('data' => count($respuesta)));
    }

    public function buscarHijosSerie() {
      $nombre = $_GET['serie'];
      $respuesta = $this->SeriesModel->seriesHijos($nombre);
      echo json_encode($respuesta);
    }

    public function imprimir() {
        $estatus = (isset($_GET['estatus'])) ? $_GET['estatus'] : null;
        $descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : null;
        $datos = $this->SeriesModel->seriePadresPDF($estatus, $descripcion);

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
                $pdf->Cell(55, 8, "LISTADO DE SERIES", 0, 0, 'C');

                $pdf->SetFont('Helvetica', 'B', 13);

                $Y+=10;
                $pdf->SetY($Y);
                $pdf->GetX();
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetTextColor(255, 255, 255);
                //$pdf->SetDrawColor(1, 1, 1);
                $pdf->MultiCell(25, 24, "CODIGO", 1, 1, 'C', true);

                $altoCelda = 16;

                $pdf->SetXY($X + 5, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->MultiCell(50, $altoCelda, utf8_decode("SERIE"), 1, 1, true);

                $pdf->SetXY($X + 55, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->MultiCell(50, $altoCelda, utf8_decode("SUB-SERIE"), 1, 1, 'C', true);

                $pdf->SetXY($X + 105, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->MultiCell(55, $altoCelda, utf8_decode("VALOR DOCUMENTAL"), 1, 1, 'C', true);

                $pdf->SetXY($X + 160, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->MultiCell(50, $altoCelda, utf8_decode("VIGENCIA TRAMITE"), 1, 1, 'C', true);

                $pdf->SetXY($X + 210, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->MultiCell(60, $altoCelda - 8, utf8_decode("VIGENCIA CONCENTRACIÓN"), 1, 1, 'R', true);

                $pdf->SetTextColor(0, 0, 0);

                $Y+=16;
            }
            $pdf->SetFont('Times', '', 11);
//---------------------------------------------------------------------------------------
            $pdf->SetY($Y);
            $pdf->GetX();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(20, 8, $value->id_serie, 1, 1, 'C', true);

            $pdf->SetXY($X + 5, $Y);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(50, 8, utf8_decode($value->descripcion), 1, 1, 'L', true);

            $pdf->SetXY($X + 55, $Y);
            $pdf->Cell(50, 8, "", 1, 1, 'L');

            $pdf->SetXY($X + 105, $Y);
            $valor_documental = $this->nombreValorDocumental($value->valor_documental);
            $pdf->Cell(55, 8, utf8_decode($valor_documental), 1, 1, 'C');

            $pdf->SetXY($X + 160, $Y);
            $pdf->Cell(50, 8, $value->vigencia_tramite, 1, 1, 'C');
            $pdf->SetXY($X + 210, $Y);
            $pdf->Cell(60, 8, $value->vigencia_concentracion, 1, 1, 'C');

            $hijos = $this->SeriesModel->serieHijosPDF($value->id_serie, $estatus, $descripcion);

            foreach ($hijos as $keyHijo => $hijo) {
                $saltoLineaY = 8;

                $pdf->SetY($Y + $saltoLineaY);
                $pdf->GetX();
                $pdf->Cell(20, 8, $hijo->codigo, 1, 1, 'C');

                $pdf->SetXY($X + 5, $Y + $saltoLineaY);
                $pdf->Cell(50, 8, "", 1, 1, 'L');

                $pdf->SetXY($X + 55, $Y + +$saltoLineaY);
                if (strlen($hijo->descripcion) > 50) {
                    $pdf->Cell(50, 8, ucwords(strtolower(utf8_decode($hijo->descripcion))), 1, 1, 'L');
                } else {
                    $pdf->Cell(50, 8, ucwords(strtolower(utf8_decode($hijo->descripcion))), 1, 1, 'L');
                }

                $valor_documental = $this->nombreValorDocumental($hijo->valor_documental);
                $pdf->SetXY($X + 105, $Y + +$saltoLineaY);
                $pdf->Cell(55, 8, utf8_decode($valor_documental), 1, 1, 'C');

                $pdf->SetXY($X + 160, $Y + $saltoLineaY);
                $pdf->Cell(50, 8, $hijo->vigencia_tramite, 1, 1, 'C');
                $pdf->SetXY($X + 210, $Y + $saltoLineaY);
                $pdf->Cell(60, 8, $hijo->vigencia_concentracion, 1, 1, 'C');


                $contador++;
                if ((count($hijos) - 1) != $keyHijo) {
                    $Y+=8;
                } else
                    break;
            }
            if ($contador >= 11)
                $contador = 0;
            else {
                $Y+=16;
            }
        }
        $pdf->Output('I', 'Series.pdf');
    }

    public function nombreValorDocumental($valorDocumental) {
        $nombre = "";
        switch ($valorDocumental) {
            case "0":
                $nombre = "ADMINISTRATIVO";
                break;
            case "1":
                $nombre = "LEGAL";
                break;
            case "2":
                $nombre = "CONTABLE";
                break;
            case "3":
                $nombre = "TÉCNICO";
                break;
        }
        return $nombre;
    }

}
