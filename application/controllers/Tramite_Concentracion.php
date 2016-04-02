<?php

class Tramite_concentracion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TramiteConcentracionModel');
        $this->load->helper('url');
        $this->load->model('SeriesModel');
        $this->load->model('DocumentosModel');
        $this->load->model('MunicipioModel');
        $this->load->model('TipologiasModel');
        $this->load->model('UsuarioModel');
        $this->load->library("pagination");
    }


    public function index() {
      $perPage = (isset($_GET['per_page'])) ? $_GET['per_page'] : null;
      $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 1;
      $Buscar = (isset($_GET['buscar'])) ? $_GET['buscar'] : null;

      $this->load->library('pagination');

      if (!empty($Buscar) || isset($estatus))
          $total_rows = count($this->TramiteConcentracionModel->filtros($estatus, $Buscar));
      else
          $total_rows = $this->TramiteConcentracionModel->record_count();
      $config['base_url'] = base_url('Tramite_Concentracion/index');
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
          $datos["resultado"] = $this->TramiteConcentracionModel->fetch_data($total_rows, $page, $estatus, $Buscar, $config['per_page']);
      } else {
          $page = 0;
          $datos["resultado"] = $this->TramiteConcentracionModel->fetch_data($config['per_page'], $page, $estatus, $Buscar, $config['per_page']);
      }
      if ($datos["resultado"] == false)
          $datos["resultado"] = 0;
      $datos["estatus"] = isset($estatus) ? $estatus : 1;
      $datos["buscar"] = isset($Buscar) ? $Buscar : "";
      $str_links = $this->pagination->create_links();
      $datos["links"] = explode('&nbsp;', $str_links);

      $this->load->view('Templates/header',$datos);
      $this->load->view('listTramiteConcentracion');
      $this->load->view('Templates/footer');
      }




    public function agregar() {
        $this->load->view('Templates/header');
        $this->load->view('frmTramiteConcentracion');
        $this->load->view('Templates/footer');
    }

    public function guardar() {
        $postdata = $this->input->post('obj');
        if ($this->input->post('obj')) {
          $tramite = (object) $this->input->post('obj');
            if (isset($tramite->id_sub_fondo) && !empty($tramite->id_sub_fondo) && isset($tramite->id_serie) && !empty($tramite->id_serie)
            &&  isset($tramite->pestana) && !empty($tramite->pestana)
            && isset($tramite->descripcion) && !empty($tramite->descripcion) && isset($tramite->fecha_apertura) && !empty($tramite->fecha_apertura)
            && isset($tramite->ubicacion_archivero) && !empty($tramite->ubicacion_archivero) && isset($tramite->ubicacion_gaveta) && !empty($tramite->ubicacion_gaveta)
            && isset($tramite->clasificacion_informacion) && !empty($tramite->clasificacion_informacion) && $tramite->clasificacion_informacion >= 0 && $tramite->clasificacion_informacion < 3
            ) {
            if (isset($tramite->observaciones) && !empty($tramite->observaciones)) {
              $tramite->observaciones = $tramite->observaciones;
            }else {
              $tramite->observaciones = null;
            }
            if (isset($tramite->fecha_cierre) && !empty($tramite->fecha_cierre)) {
              $tramite->fecha_cierre = $tramite->fecha_cierre;
            }else {
              $tramite->fecha_cierre = null;
            }

            if (isset($tramite->archivo_expediente) && !empty($tramite->archivo_expediente)) {
              $tramite->archivo_expediente = $tramite->archivo_expediente;
            }else {
              $tramite->archivo_expediente  = null;
            }
            if(isset($tramite->id_seccion) && !empty($tramite->id_seccion))
            {
              $tramite->id_seccion = $tramite->id_seccion;
            }else {
              $tramite->id_seccion= null;
            }
            if (isset($tramite->id_sub_serie) && !empty($tramite->id_sub_serie)) {
              $tramite->id_sub_serie = $tramite->id_sub_serie;
            }else {
              $tramite->id_sub_serie= null;
            }

            if (isset($tramite->id_sub_seccion) && !empty($tramite->id_sub_seccion)) {
              $tramite->id_sub_seccion=$tramite->id_sub_seccion;
            }else {
              $tramite->id_sub_seccion=null;
            }
            $tramite->estatus = 1;

              $result = $this->TramiteConcentracionModel->agregar($tramite);

              if ($result == 0) {
                $this->session->set_flashdata('_flash_message', 'Guardado');
                redirect('Tramite_Concentracion','refresh');
              }
              else {
                $this->session->set_flashdata('_flash_message_error', 'Error al guardar intente mas tarde');
                redirect('Tramite_Concentracion','refresh');
              }

            }else {
              $this->session->set_flashdata('_flash_message_error', 'Faltan Parametros');
              redirect('Tramite_Concentracion/agregar','refresh');
            }
        }else {
          $this->session->set_flashdata('_flash_message_error', 'Faltan Parametros');
          redirect(base_url('Tramite_Concentracion/agregar'),'refresh');
        }
    }
/*
    public function editar() {
        $busqueda = $_GET['id'];
        $query = "select*from tramite_concentracion where id_tramite='$busqueda'";
          $respuesta = $this->db->query($query)->row();
        $data['permisos'] = $this->getPermiso();
        $data['usuario'] = $this->session->usuario;
        $data['result'] = $respuesta;
        $query2 = "  select  documentos.descripcion from documento_dependencia inner join
        documentos on documentos.codigo = documento_dependencia.documento where documento_dependencia.serie
        =".$respuesta->id_tramite;
        $res = $this->db->query($query2)->result();
        $data['docs'] = $res;
        $this->load->view('templates/header', $data);
        $this->load->view('frmEditarTramiteConcentracion');
        $this->load->view('templates/footer');
    } */


      public function TransferenciaTramite()
      {
        if ($this->input->post('gaveta')) {
          # code...
        }else {
          $this->session->set_flashdata('_flash_message_error', 'Faltan Parametros');
          redirect(base_url('Tramite_Concentracion/agregar'),'refresh');
        }
      }

    public function editar() {
        if ($this->input->get('id')) {
          $data = array();
          $id = base64_decode($this->input->get('id'));
          $result = $this->TramiteConcentracionModel->buscarId($id);
          $data['result'] = $result;
          $data['docs'] = $this->TramiteConcentracionModel->getDocs();
          $this->load->view('Templates/header',$data);
          $this->load->view('frmEditarTramiteConcentracion');
          $this->load->view('Templates/footer');
        }
        else {
          $data['get'] = "nada";
        }

    }


    public function buscarPorId() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $this->db->where('id_tramite', $busqueda->id);
        $q = $this->db->get('tramite_concentracion');
        $data = $q->result_array();
        $respuesta = $this->TramiteConcentracionModel->buscarId($data[0]['id_tramite'], $data[0]['id_sub_serie'], $data[0]['id_seccion'], $data[0]['id_sub_seccion']);
        if (isset($respuesta[0]->id_sub_serie))
            $documentos = $this->SeriesModel->documentosSeriesTramite($respuesta[0]->id_sub_serie);
        else
            $documentos = $this->SeriesModel->documentosSeriesTramite($respuesta[0]->id_serie);
        if (count($documentos) == 0)
            $documentos = null;
        $cuidades = $this->MunicipioModel->getAll(1);
        $tipologias = $this->TipologiasModel->getAll();
        echo json_encode(array('data' => $respuesta[0], 'documentos' => $documentos, 'cuidades' => $cuidades, 'tipologias' => $tipologias));
    }

    public function guardarHistorico() {
        $postdata = file_get_contents('php://input');
        $datos = json_decode($postdata);
        $respuesta = $this->TramiteConcentracionModel->guardarHistorico($datos);
        echo json_encode(array('data' => $respuesta));
    }

    public function buscarHistorico() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $respuesta = $this->TramiteConcentracionModel->buscarHistorico($busqueda);
        echo json_encode(array('data' => $respuesta));
    }

     public function buscarPorDescripcion() {
        $postdata = file_get_contents('php://input');
        $busqueda = json_decode($postdata);
        $descripcion = (isset($busqueda->descripcion)) ? $busqueda->descripcion : null;
        $respuesta = $this->TramiteConcentracionModel->buscarDescripcion($descripcion);
        echo json_encode(array('data' => $respuesta));
    }

    public function subirPDF() {
        if (is_dir('uploads')) {
            $nombrePDF = (isset($_POST['nombrePDF'])) ? $_POST['nombrePDF'] : null;
            if ($nombrePDF !== null)
                unlink('uploads/' . $nombrePDF);
            $tmp_file = $_FILES['inputPDF']['tmp_name'];
            $fileName = $_FILES['inputPDF']['name'];
            $direccionNombre = 'uploads/' . $fileName;
            move_uploaded_file($tmp_file, $direccionNombre);
            return json_encode(array('data' => $respuesta));
        }
    }


    public function getSerieDocumento()
    {
        if ($this->input->post('id')) {
              $id = $this->input->post('id');
              $query ="call getSerieDocumento('$id')";
                $resultado = $this->db->query($query)->row();
                $this->db->close();
                if ($resultado != null) {
                    echo json_encode(($resultado));
                }else{
                    echo "No hay valores";
                }
           }else{
            echo "Falta ID";
           }
    }

}
