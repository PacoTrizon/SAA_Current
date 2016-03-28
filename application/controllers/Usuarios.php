<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UsuarioModel');
        $this->getSessionUser();
        $this->load->helper('url');
    }

    private $paginado = 5;

    public function login() {
        echo json_encode(array('mensaje' => true));
    }

    public function index() {

        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        $data['permisos'] = json_decode($usuario->permisos);
        if (property_exists($data['permisos'], 'usuarios.index')) {
            $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
            $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 1;
            $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

            $this->load->library('pagination');

            if (!empty($Buscar) || isset($estatus))
                $total_rows = count($this->UsuarioModel->filtros($estatus, $Buscar));
            else
                $total_rows = $this->UsuarioModel->record_count();

            $config['base_url'] = base_url('usuarios/index');
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
                $config['suffix'] = '&estatus=' . $estatus . '&buscar=' . $Buscar;
            $config['first_url'] = $config['base_url'] . '?estatus=' . $estatus . '&buscar=' . $Buscar;
            $config['second_url'] = $config['base_url'] . '?per_page=' . $config['per_page'] . 'estatus=' . $estatus . '&buscar=' . $Buscar;

            $this->pagination->initialize($config);
            if ($perPage != null) {
                $page = $config['per_page'] * ($perPage - 1);
                $datos["results"] = $this->UsuarioModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
            } else {
                $page = 0;
                $datos["results"] = $this->UsuarioModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
            }

            if ($datos["results"] == false)
                $datos["results"] = 0;
            $datos["estatus"] = isset($estatus) ? $estatus : 1;
            $datos["buscar"] = isset($Buscar) ? $Buscar : "";
            $str_links = $this->pagination->create_links();
            $datos["links"] = explode('&nbsp;', $str_links);
            $data['usuario'] = $this->session->usuario;
            $this->load->view('Templates/header', $data);
            $this->load->view('usuario', $datos);
            $this->load->view('Templates/footer');
        }else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function getSessionUser() {
        if ($this->session->logged_in == 0)
            redirect(base_url("home/index"));
        else
            return true;
    }

    public function listUser() {
        $usuario = $this->UsuarioModel->getAll();
        $pag = round(count($usuario) / $this->paginado, 0, PHP_ROUND_HALF_UP) + 1;
        echo json_encode(array('data' => $usuario, 'paginado' => $pag));
    }

    public function agregar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        //$data['permisos'] = json_decode($usuario[0]->permisos);
        if (property_exists($data['permisos'], 'usuarios.index')) {
            $postdata = file_get_contents('php://input');
            $usuario = json_decode($postdata);

            $respuesta = $this->UsuarioModel->agregarUsuario($usuario);
            if ($respuesta == 0) {
                $password = $usuario->nombre . strval($usuario->id_rol);
                $this->load->library("email");
                // configuracion para gmail
                $configGmail = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'deyvid1913@gmail.com',
                    'smtp_pass' => '11947004563',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                );

                //cargamos la configuración para enviar con gmail
                $this->email->initialize($configGmail);

                $this->email->from('deyvid1913@gmail.com');
                $this->email->to(strval($usuario->correo));
                //$this->email->to('deyvid1913@gmail.com');
                $this->email->subject('Contraseña');
                $this->email->message('<h2>Listo accede a<a href="http://localhost:8090/SAA/index.php/usuarios/index"></a></h2>'
                        . '<hr>'
                        . '<br> Con esta contraseña: ' . $password);
                $this->email->send();
            }
            echo json_encode(array('data' => $respuesta));
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function buscar() {
        $estutus = explode(":", $_POST['estatus']);
        echo var_export($estutus[1], true);
        echo $_POST['nombreBuscar'];
//        $postdata = file_get_contents('php://input');
//        $busqueda = json_decode($postdata);
//        echo var_export($busqueda, true);
//        die();
//        $this->load->model('UsuarioModel');
//        $respuesta = $this->UsuarioModel->buscarFiltros($busqueda);
//        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->UsuarioModel->buscarUsuarioId($busqueda->id);
        echo json_encode(array('data' => $respuesta[0]));
    }

    public function editar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        //$data['permisos'] = json_decode($usuario->permisos);
        if (property_exists($data['permisos'], 'usuarios.actualizar')) {
            $data['usuario'] = $this->session->usuario;
            $this->load->view('Templates/header', $data);
            $this->load->view('frmEditarUsuario');
            $this->load->view('Templates/footer');
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function actualizar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        //$usuario = $this->UsuarioModel->permisos_id($usuario[0]->id_perfil);
        $data['permisos'] = json_decode($usuario[0]->permisos);
        if (property_exists($data['permisos'], 'usuarios.actualizar')) {
            $postdata = file_get_contents('php://input');
            $busqueda = json_decode($postdata);
            $respuesta = $this->UsuarioModel->actualizar($busqueda);
            echo json_encode(array('data' => $respuesta));
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function existenDatos() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $estatus = (isset($datos->estatus)) ? $datos->estatus : 1;
        $descripcion = (isset($datos->descripcion)) ? $datos->descripcion : null;
        $respuesta = $this->UsuarioModel->reportePdf($estatus, $descripcion);
        echo json_encode(array('data' => count($respuesta)));
    }

    public function cambio_password() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        //$usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        //$data['permisos'] = json_decode($usuario->permisos);
        //if (property_exists($data['permisos'], 'usuarios.actualizar')) {
            $data['usuario'] = $this->session->usuario;
            $this->load->view('Templates/header');
            $this->load->view('frmCambioPassword');
            $this->load->view('Templates/footer');
        //} else {
          //  echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        //}
    }

    public function get_user() {
        $id_usuario = $this->session->id_usuario;
        $respuesta = $this->UsuarioModel->buscarUsuarioId($id_usuario);
        echo json_encode(array('data' => $respuesta->usuario, 'id' => $respuesta->id));
    }

    public function verificar_password() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $id_usuario = $this->session->id_usuario;
        $password = (isset($datos->password)) ? $datos->password : null;
        $respuesta = $this->UsuarioModel->verificar_password($id_usuario, $password);
        echo json_encode(array('data' => $respuesta));
    }

    public function imprimir() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        $data['permisos'] = json_decode($usuario->permisos);
        if (property_exists($data['permisos'], 'usuarios.imprimir')) {
            $descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : null;
            $estatus = (isset($_GET['estatus'])) ? $_GET['estatus'] : 1;
            $datos = $this->UsuarioModel->reportePdf($estatus, $descripcion);
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
                    $pdf->Cell(55, 8, "LISTADO DE USUARIOS", 0, 0, 'C');

                    $pdf->SetFont('Helvetica', 'B', 13);

                    $Y+=15;
                    $pdf->SetY($Y);
                    $pdf->GetX();
                    $pdf->SetFillColor(153, 153, 153);
                    $pdf->SetTextColor(255, 255, 255);
                    //$pdf->SetDrawColor(1, 1, 1);
                    $pdf->Cell(30, 8, "Usuario", 1, 1, 'C', true);

                    $pdf->SetXY($X + 15, $Y);
                    $pdf->SetFillColor(153, 153, 153);
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->Cell(75, 8, utf8_decode("Nombre Completo"), 1, 1, 'C', true);

                    $pdf->SetXY($X + 75, $Y);
                    $pdf->SetFillColor(153, 153, 153);
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->Cell(120, 8, utf8_decode("Dependencia"), 1, 1, 'C', true);

                    $pdf->SetXY($X + 195, $Y);
                    $pdf->SetFillColor(153, 153, 153);
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->Cell(50, 8, utf8_decode("Rol"), 1, 1, 'C', true);

                    $pdf->SetXY($X + 245, $Y);
                    $pdf->SetFillColor(153, 153, 153);
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->Cell(20, 8, utf8_decode("Estatus"), 1, 1, 'C', true);



                    $pdf->SetTextColor(0, 0, 0);

                    $Y+=8;
                }
                $pdf->SetFont('Times', '', 11);
//---------------------------------------------------------------------------------------
                $pdf->SetY($Y);
                $pdf->GetX();
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                if (strlen($value->usuario) > 50) {
                    $pdf->MultiCell(30, 4, ucwords(strtolower(utf8_decode($value->usuario))), 1, 'L');
                } else {
                    $pdf->Cell(30, 8, ucwords(strtolower(utf8_decode($value->usuario))), 1, 1, 'L');
                }

                $pdf->SetXY($X + 15, $Y);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                $nombreCompleto = $value->nombre . ' ' . $value->apellido_paterno . ' ' . $value->apellido_materno;
                if (strlen($nombreCompleto) >= 60) {
                    $pdf->MultiCell(60, 4, utf8_decode($nombreCompleto), 1, 'L');
                } else {
                    $pdf->Cell(60, 8, utf8_decode($nombreCompleto), 1, 1, 'L');
                }
                $pdf->SetXY($X + 75, $Y);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                if (strlen($value->nombre_dependencia) > 55) {
                    $pdf->MultiCell(120, 0, utf8_decode($value->nombre_dependencia), 1, 'L');
                } else
                    $pdf->Cell(120, 8, utf8_decode($value->nombre_dependencia), 1, 1, 'L');

                $pdf->SetXY($X + 195, $Y);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Cell(50, 8, utf8_decode($value->nombre_rol), 1, 1, 'L');

                $pdf->SetXY($X + 245, $Y);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(0, 0, 0);
                $estatus = "";
                if ($value->estatus == "1")
                    $estatus = "ACTIVO";
                else
                    $estatus = "INACTIVO";
                $pdf->Cell(20, 8, utf8_decode($estatus), 1, 1, 'L');

                $Y+=8;
                $contador++;
                if ($contador == 13)
                    $contador = 0;
            }
            $pdf->Output('I', 'Usuarios.pdf');
        }else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

}
