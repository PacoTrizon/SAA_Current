<?php

class Dependencias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DependenciasModel');
        $this->load->model('UsuarioModel');
        $this->load->helper('url');
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
            $total_rows = count($this->DependenciasModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->DependenciasModel->record_count();
        $config['base_url'] = base_url('dependencias/index');
        $config['page_query_string'] = TRUE;

        $config['total_rows'] = $total_rows; //this total count of rows returned from the query
        $config['per_page'] = 5; //data per page you want to display.
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
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
            $datos["resultado"] = $this->DependenciasModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->DependenciasModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
        }
        if ($datos["resultado"] == false)
            $datos["resultado"] = 0;
        $datos["estatus"] = isset($estatus) ? $estatus : 1;
        $datos["buscar"] = isset($Buscar) ? $Buscar : "";
        $str_links = $this->pagination->create_links();
        $datos["links"] = explode('&nbsp;', $str_links);
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('listDependencias', $datos);
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmDependencias');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);

//        if (isset($dato->dependencia_padre_id)) {
//            if (gettype($dato->dependencia_padre_id) == "string") {
//                $result = $this->DependenciasModel->buscarPorNombre($dato->dependencia_padre_id, true);
//                $dato->dependencia_padre_id = $result[0]->dependencia_id;
//            }
//        }
        $respuesta = $this->DependenciasModel->agregar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function editar() {
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarDependencia');
        $this->load->view('Templates/footer');
    }

    public function actualizar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        if (isset($dato->dependencia_padre_id)) {
            if (!intVal($dato->dependencia_padre_id && $dato->dependencia_padre_id != null)) {
                $result = $this->DependenciasModel->buscarPorNombre($dato->dependencia_padre_id, true);
                $dato->dependencia_padre_id = $result[0]->dependencia_id;
            }
        }
        $respuesta = $this->DependenciasModel->actualizar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function obtenerDependencias() {
        $respuesta = $this->DependenciasModel->getAll();
        echo json_encode(array('data' => $respuesta));
    }

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



    public function busquedaPadreInicial() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->DependenciasModel->buscarPorNombre($nombre);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->DependenciasModel->buscarId($busqueda->id);
        $dependencias = $this->DependenciasModel->getAll();
        echo json_encode(array('data' => $respuesta[0], 'dependencias' => $dependencias));
    }

    public function imprimir() {
        $estatus = (isset($_GET['estatus'])) ? $_GET['estatus'] : null;
        $descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : null;
        $datos = $this->DependenciasModel->dependenciasPadres($estatus, $descripcion);

        $pdf = new PDF();
        $contador = 0;
        $objNieto = new stdClass();
        $objHijo = new stdClass();
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
                $pdf->Cell(55, 8, "LISTADO DE DEPENDENCIAS", 0, 0, 'C');

                $pdf->SetFont('Helvetica', 'B', 13);

                $Y+=15;
                $pdf->SetY($Y);
                $pdf->GetX();
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetTextColor(255, 255, 255);
                //$pdf->SetDrawColor(1, 1, 1);
                $pdf->Cell(85, 8, "SUB-FONDO", 1, 1, 'C', true);

                $pdf->SetXY($X + 70, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(93, 8, utf8_decode("SECCION"), 1, 1, 'C', true);

                $pdf->SetXY($X + 165, $Y);
                $pdf->SetFillColor(153, 153, 153);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(90, 8, utf8_decode("SUB-SECCION"), 1, 1, 'C', true);

                $pdf->SetTextColor(0, 0, 0);

                $Y+=8;
            }
            $pdf->SetFont('Times', '', 11);
//---------------------------------------------------------------------------------------
//            $objNieto

            if (count($objNieto) == 0) {
                $pdf->Cell(85, 8, "FALTO", 1, 1, 'L');
            }
            $hijos = $this->DependenciasModel->dependenciasHijos($value->dependencia_id, $estatus, $descripcion);
            $pdf->SetY($Y);
            $pdf->GetX();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(0, 0, 0);
            if (strlen($value->nombre) > 44) {
                $pdf->MultiCell(85, 8, ucwords(strtolower(utf8_decode($value->nombre) . ' (' . $value->dependencia_id . ')')), 1, 'L');
            } else {
                $pdf->Cell(85, 8, ucwords(strtolower(utf8_decode($value->nombre) . ' (' . $value->dependencia_id . ')')), 1, 1, 'L');
            }

            foreach ($hijos as $keyHijo => $hijo) {
                $pdf->SetXY($X + 70, $Y);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                if (strlen($hijo->nombre) > 44) {
                    $pdf->MultiCell(95, 8, ucwords(strtolower(utf8_decode($hijo->nombre) . ' (' . $hijo->dependencia_id . ')')), 1, 'L');
                } else {
                    $pdf->Cell(95, 8, ucwords(strtolower(utf8_decode($hijo->nombre) . ' (' . $hijo->dependencia_id . ')')), 1, 1, 'L');
                }
                $nietos = $this->DependenciasModel->dependenciasHijos($hijo->dependencia_id, $estatus, $descripcion);
                foreach ($nietos as $keyNieto => $nieto) {
                    $pdf->SetXY($X + 165, $Y);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetDrawColor(0, 0, 0);
                    if (strlen($nieto->nombre) > 44) {
                        $pdf->MultiCell(100, 8, ucwords(strtolower(utf8_decode($nieto->nombre) . ' (' . $nieto->dependencia_id . ')')), 1, 'L');
                    } else {
                        $pdf->Cell(100, 8, ucwords(strtolower(utf8_decode($nieto->nombre) . ' (' . $nieto->dependencia_id . ')')), 1, 1, 'L');
                    }
                    if ($contador >= 12) {
                        if ((count($nietos) - 1) >= $keyNieto) {
                            $objNieto = new stdClass();
                            $objNieto->keyNieto = $keyNieto;
                            $objNieto->nietos = $nietos;
                        }
                        break;
                    }
                    if (strlen($nieto->nombre) > 44) {
                        if ((count($nietos) - 1) != $keyNieto) {
                            $contador+=2;
                            $Y+=16;
                        }
                    } else {
                        if ((count($nietos) - 1) != $keyNieto) {
                            $contador++;
                            $Y+=8;
                        }
                    }
                }
                if ($contador >= 12) {
                    if ((count($hijos) - 1) >= $keyHijo) {
                        $objHijo = new stdClass();
                        $objHijo->keyHijo = $keyHijo;
                        $objHijo->hijos = $hijos;
                    }
                    break;
                }
                if (strlen($hijo->nombre) > 44) {
                    if ((count($hijos) - 1) != $keyHijo) {
                        $contador+=2;
                        $Y+=16;
                    }
                } else {
                    if ((count($hijos) - 1) != $keyHijo) {
                        $contador++;
                        $Y+=8;
                    }
                }
            }
            if ($contador >= 12)
                $contador = 0;
            else {
                if (strlen($value->nombre) > 44) {
                    $Y+=16;
                    $contador++;
                } else {
                    $contador++;
                    $Y+=8;
                }
            }
        }
        $pdf->Output('I', 'Solicitantes.pdf');
    }

}
