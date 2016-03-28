<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Trámite y Concentración</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Tramite_Concentracion'); ?>">Trámite y Concentración</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form class="form-horizontal" action="<?php echo base_url('Tramite_Concentracion/guardar')?>" method="post" style="margin-top: 11px;">
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label class="col-sm-2 control-label">Fondo:</label>
                <label class="control-label"><strong>Ayuntamiento de Culiacán</strong></label>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label class="col-sm-2 control-label">Sub-fondo:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"  id="subfondo" autofocus required/>
                    <input type="hidden" name="obj[id_sub_fondo]" id="hsf">
                </div>

            </div>
            <div class="form-group col-sm-6 ">
                <label for="serie" class="col-sm-2 control-label">Serie:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-sm-1" maxlength="20" id="serie" autofocus required/>
                    <input type="hidden" name="obj[id_serie]" id="hsr">
                </div>

            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6" >
                <label for="seccion" class="col-sm-2 control-label">Sección:</label>
                <div class="col-sm-9">
                    <input type="text" required="true" class="form-control col-sm-1" id="seccion" autofocus  />
                    <input type="hidden" name="obj[id_seccion]" id="hsc">
                </div>


            </div>

            <div class="form-group col-sm-6"> <!-- -->
                <label for="sub_serie" class="col-sm-2 control-label">Sub-Serie:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-sm-1" id="sub_serie" maxlength="20" required />
                    <input type="hidden"  name="obj[id_sub_serie]" id="hssr">
                </div>
            </div>
        </div>



        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label for="sub_seccion" class="col-sm-2 control-label">Subsección:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-sm-1" id="sub_seccion"  maxlength="9" required/>
                    <input type="hidden"  name="obj[id_sub_seccion]" id="hsss">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="pestana" class="col-sm-2 control-label">Pestaña:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-lg-1"  name="obj[pestana]" id="pestana" maxlength="100" required minlength="3" required/>
            </div>
        </div>


        <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="obj[descripcion]" id="descripcion" required rows="3" maxlength="100" required minlength="3" ></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="observaciones" class="col-sm-2 control-label">Observaciones:</label>
            <div class="col-sm-10 ">
                <textarea class="form-control" id="observacion" name="obj[observaciones]" rows="3"></textarea>
            </div>
        </div>

        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback">
                <label for="fecha_apertura" class="col-sm-2 control-label">Fecha Apertura:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-lg-1" required id="fecha_apertura" name="obj[fecha_apertura]" required maxlength="50" />
                    <span class="glyphicon form-control-feedback" ></span>
                </div>

            </div>
            <div class="form-group col-sm-6  has-feedback">
                <label for="fecha_cierre" class="col-sm-2 control-label">Fecha Cierre:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-lg-1" name="obj[fecha_cierre]" id="fecha_cierre"/>
                </div>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label for="titulo" class="col-sm-2 control-label">Clasificación de la información:</label>
                <div class="col-sm-10">
                    <div class="btn-group">
                        <button type="button" id="RESERVADA"  class="btn btn-success" onclick="ClasificarInfo(0)">RESERVADA</button>
                        <button type="button" id="PUBLICO"  class="btn btn-default" onclick="ClasificarInfo(1)">PÚBLICO</button>
                        <button type="button" id="CONFIDENCIAL" class="btn btn-default " onclick="ClasificarInfo(2)">CONFIDENCIAL</button>
                        <input type="hidden"  name="obj[clasificacion_informacion]" id="clasificacionInfo" value="0" required>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="extension" class="col-sm-2 control-label">Ubicación:</label>
                <div class="col-sm-10 has-feedback" >
                    <div class="col-sm-8">
                        <input type="text" class="form-control col-lg-1" placeholder="archivero" name="obj[ubicacion_archivero]" minlength="1" required maxlength="45" minlength="1" required/>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>

                    <div class="col-sm-4 has-feedback" >
                        <input type="text" class="form-control col-lg-1" id="gaveta" placeholder="Gaveta" name="obj[ubicacion_gaveta]" minlength="1" required maxlength="45" minlength="1"required/>
                        <span class="glyphicon form-control-feedback" ></span>

                    </div>
                </div>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label for="titulo" class="col-sm-2 control-label">Disponibilidad:</label>
                <div class="col-sm-5">
                    <h4><span class="label label-success">Disponible</span></h4>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <input type="file" id="inputPDf" name="obj[archivo_expediente]" class="btn btn-primary" accept="application/pdf">
            </div>
        </div>
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('Tramite_Concentracion/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>

    </form>
</div>
