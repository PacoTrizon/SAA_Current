<html lang="en">
    <head>
        <title>SAA2</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet" >
        <link href="<?php echo base_url('css/jquery.growl.css')?>" rel="stylesheet" >
        <link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" >
        <link href="<?php echo base_url('css/style.css')?>" rel="stylesheet" >

        <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.growl.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.2.custom.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap-filestyle.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/autocomplete.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/tranferencias.js') ?>"></script>

    <header>
      <?php if($this->session->flashdata('_flash_message')) : ?>
          <div class="alert alert-success" style="text-align:right;margin:20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><center><?php echo $this->session->flashdata('_flash_message'); ?></center></strong>
          </div>
      <?php endif; ?>

      <?php if($this->session->flashdata('_flash_message_error')) : ?>
          <div class="alert alert-danger" style="text-align:right;margin:20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><center><?php echo $this->session->flashdata('_flash_message_error'); ?></center></strong>
          </div>
      <?php endif; ?>
      <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
        <nav class="navbar navbar-default" style="height: 196px;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="col-lg-12 col-lg-offset-4" >
                        <span> <a class="navbar-brand " href="#"> <img src="<?php echo base_url('img/sistema-de-admin-de-archivos.png')?>" class="img-responsive" style="height: 129px; width: 299px;"></a></span>
                        <a class="navbar-brand" href="#"> <img src="<?php echo base_url('img/logoCuliacan.png')?>" class="img-responsive" style="height: 108px;"></a>
                    </div>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                    <ul class="nav navbar-nav navbar-right">
                        <li><h4>Usuario: <span class="glyphicon glyphicon-user"></span><?php echo $this->session->userdata('usuario'); ?></h4></li>
                    </ul>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2" >
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-cog"></span> Menu principal <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Vacio</a></li>
                           </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  <span class="glyphicon glyphicon-wrench"></span> Administracion <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url('usuarios/cambio_password'); ?>">Cambio de contraseña</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('perfiles/index'); ?>">Perfiles de Usuarios</a>
                                </li>
                                <li >
                                    <a href="<?php echo base_url('usuarios/index'); ?>">Usuarios</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                          <a href="<?php echo base_url('home/cerrarSesion'); ?>" >
                             <span class="glyphicon glyphicon-off"></span> Salir</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3"style="margin-top: 23px;">
              <ul class="nav navbar-nav navbar-default">

                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >
                                <a href="<?php echo base_url('colonias/index'); ?>">Colonias</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('dependencias/index'); ?>">Dependencias</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('estados/index'); ?>">Estados</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('municipios/index'); ?>">Municipios</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('Paises/index'); ?>">Países</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('sindicaturas/index'); ?>">Sindicaturas</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('tipologias/index'); ?>">Tipologías</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('asentamientos/index'); ?>">Tipos de Asentamientos</a>
                            </li>
<!--                            <li><a href="<?php echo base_url('unidades_administrativas/index'); ?>">Unidades Admistrativas</a></li>  -->

                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Valoración documental <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >
                                <a href="<?php echo base_url('documentos/index'); ?>">Documentos</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('serieDocumentos/index'); ?>">Series Documentos</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('series/index'); ?>">Series</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Elaboración Expedientes <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo base_url('Tramite_Concentracion/index'); ?>">Trámite y Concentración</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Transferencias/tramite'); ?>">Transferencia Tramite</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Transferencias/recepcion'); ?>">Transferencia Recepción</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('Transferencias/revision'); ?>">Transferencia Revisión</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('Transferencias/concentracion'); ?>">Concentración</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Servicios <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >
                                <a href="<?php echo base_url('investigadores/index'); ?>">Investigadores</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('solicitantes/index'); ?>">Solicitantes</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('servicio_expediente/index'); ?>">Servicios de Expedientes</a>
                            </li>
                            <li >
                                <a href="<?php echo base_url('devolucion/agregar'); ?>">Devoluciones</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Concentración <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >
                                <a href="<?php echo base_url('investigadores/index'); ?>">Concentración</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
</head>
<body>
