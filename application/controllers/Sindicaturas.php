<?php

class Sindicaturas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->getSessionUser();
        $this->load->model('SindicaturaModel');
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
            $total_rows = count($this->SindicaturaModel->filtros($estatus, $Buscar));
        else
            $total_rows = $this->SindicaturaModel->record_count();

        $config['base_url'] = base_url('sindicaturas/index');
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
            $datos["resultado"] = $this->SindicaturaModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
        } else {
            $page = 0;
            $datos["resultado"] = $this->SindicaturaModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
        }
        if ($datos["resultado"] == false)
            $datos["resultado"] = 0;
        $datos["estatus"] = isset($estatus) ? $estatus : 1;
        $datos["buscar"] = isset($Buscar) ? $Buscar : "";
        $str_links = $this->pagination->create_links();
        $datos["links"] = explode('&nbsp;', $str_links);
        $data['usuario'] = $this->session->usuario;
        //$data['permisos'] = $this->getPermiso();
        $this->load->view('Templates/header', $data);
        $this->load->view('listSindicaturas', $datos);
        $this->load->view('Templates/footer');
    }

    public function agregar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmSindicatura');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = file_get_contents('php://input');
        $dato = json_decode($postdata);
        $respuesta = $this->SindicaturaModel->agregar($dato);
        echo json_encode(array('data' => $respuesta));
    }

    public function editar() {
        //$data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $this->load->view('Templates/header', $data);
        $this->load->view('frmEditarSindicatura');
        $this->load->view('Templates/footer');
    }

    public function actualizar() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->SindicaturaModel->actualizar($busqueda);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscar() {
        $respuesta = $this->SindicaturaModel->getAll();
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->SindicaturaModel->buscarId($busqueda->id);
        echo json_encode(array('data' => $respuesta[0]));
    }

}
