<?php

class Perfiles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('PerfilesModel');
        $this->load->model('UsuarioModel');
        $this->load->helper('url');
    }

    public function getSessionUser() {
        if ($this->session->logged_in == 0)
            redirect(base_url("home/index"));
        else
            return true;
    }

    public function index() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        //$usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        //$data['permisos'] = json_decode($usuario->permisos);
        //if (property_exists($data['permisos'], 'perfiles.index')) {
            $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
            $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 1;
            $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

            $this->load->library('pagination');

            if (!empty($Buscar) || isset($estatus))
                $total_rows = count($this->PerfilesModel->filtros($estatus, $Buscar));
            else
                $total_rows = $this->PerfilesModel->record_count();

            $config['base_url'] = base_url('perfiles/index');
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
                $datos["resultado"] = $this->PerfilesModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
            } else {
                $page = 0;
                $datos["resultado"] = $this->PerfilesModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
            }
            if ($datos["resultado"] == false)
                $datos["resultado"] = 0;
            $datos["estatus"] = isset($estatus) ? $estatus : 1;
            $datos["buscar"] = isset($Buscar) ? $Buscar : "";
            $str_links = $this->pagination->create_links();
            $datos["links"] = explode('&nbsp;', $str_links);
            $data['usuario'] = $this->session->usuario;
            $this->load->view('templates/header', $data);
            $this->load->view('listPerfiles', $datos);
            $this->load->view('templates/footer');
        //}else {
          //  echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        //}
    }

    public function agregar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        //$usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        $data['permisos'] = json_decode($usuario->permisos);
        if (property_exists($data['permisos'], 'perfiles.guardar')) {
            $data['usuario'] = $this->session->usuario;
            $this->load->view('templates/header', $data);
            $this->load->view('frmPerfil');
            $this->load->view('templates/footer');
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function guardar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario[0]->id_perfil);
        $data['permisos'] = json_decode($usuario[0]->permisos);
        if (property_exists($data['permisos'], 'perfiles.guardar')) {
            $postdata = file_get_contents('php://input');
            $dato = json_decode($postdata);
            $permisos = $dato->permisos;
            $perm = new stdClass();
            foreach ($permisos as $key => $permiso) {
                $nombre = strval($permiso);
                $perm->$nombre = 1;
            }
            $dato->permisos = json_encode($perm);
            $respuesta = $this->PerfilesModel->guardar($dato);
            echo json_encode(array('data' => $respuesta));
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function editar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario->id_perfil);
        $data['permisos'] = json_decode($usuario->permisos);
        if (property_exists($data['permisos'], 'perfiles.actualizar')) {
            $data['usuario'] = $this->session->usuario;
            $this->load->view('templates/header', $data);
            $this->load->view('frmEditarPerfil');
            $this->load->view('templates/footer');
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function actualizar() {
        $usuario = $this->UsuarioModel->buscarUsuarioId($this->session->id_usuario);
        $usuario = $this->UsuarioModel->permisos_id($usuario[0]->id_perfil);
        $data['permisos'] = json_decode($usuario[0]->permisos);
        if (property_exists($data['permisos'], 'perfiles.actualizar')) {
            $postdata = file_get_contents('php://input');
            $busqueda = json_decode($postdata);
            $respuesta = $this->ColoniasModel->actualizar($busqueda);
            echo json_encode(array('data' => $respuesta));
        } else {
            echo json_encode(array('mensaje' => $this->config->item('mensaje_permisos')));
        }
    }

    public function buscar() {
        $respuesta = $this->PerfilesModel->getAll();
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->PerfilesModel->get_perfil($dato->id);
        $permisos = $this->PerfilesModel->permisos();
        echo json_encode(array('data' => $respuesta[0], 'permisos' => $permisos));
    }

    public function buscar_permisos() {
        $permisos = $this->PerfilesModel->permisos();
        echo json_encode(array('data' => $permisos));
    }

}
