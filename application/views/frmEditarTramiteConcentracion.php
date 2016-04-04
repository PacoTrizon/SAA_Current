<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading">
        <div class="row">
            <div class="form-group col-sm-6">
                <h4>Trámite y Concentración</h4>
            </div>
    </div>
    </div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Tramite_Concentracion/index'); ?>">Trámite y Concentración </a></li>
        <li class="active">Editar</li>
    </ol>
    <form class="form-horizontal" name="frmTramite" id="frmTramite" novalidate="" style="margin-top: 11px;">
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label class="col-sm-2 control-label">Fondo:</label>
                <label class="control-label"><strong>Ayuntamiento de Culiacán </strong></label>
            </div>
            <div class="form-group col-sm-6">
                <label for="clave" class="col-sm-2 control-label">Clave:</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control col-sm-1" id="clave" name="clave" value="<?php echo $result->clave?>"/>
                </div>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback">
                <label for="sub_fondo" class="col-sm-2 control-label">Sub-fondo:</label>
                <div class="col-sm-9">
                    <input type="text" disabled="true" class="form-control col-sm-1" id="sub_fondo" name="sub_fondo" value="<?php echo $result->subfondo?>"required/>
                    <span class="glyphicon form-control-feedback" ></span>
                </div>

            </div>
            <div class="form-group col-sm-6 has-feedback" >
                <label for="serie" class="col-sm-2 control-label">Serie:</label>
                <div class="col-sm-10">
                    <input type="text" disabled="true" class="form-control col-sm-1"maxlength="20" id="serie" name="serie" value="<?php echo $result->serie?>" required/>
                    <p id="project-description"></p>
                    <span class="glyphicon form-control-feedback" ></span>
                </div>
                </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback">
                <label for="seccion" class="col-sm-2 control-label">Sección:</label>
                <div class="col-sm-9">
                    <input type="text" disabled="true" class="form-control col-sm-1" id="seccion" name="seccion" value="<?php echo $result->seccion?>" maxlength="9" />
                    <span class="glyphicon form-control-feedback" ></span> <!---->
                </div>

            </div>
            <div class="col-sm-1">

            </div>
            <div class="form-group col-sm-6 has-feedback"> <!-- -->
                <label for="sub_serie" class="col-sm-2 control-label">Sub-Serie:</label>
                <div class="col-sm-10">
                    <input type="text" disabled="true" class="form-control col-sm-1" value="<?php echo $result->subserie?>" id="sub_serie" name="sub_serie" />
                    <span class="glyphicon form-control-feedback"></span>
                </div>

            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback">
                <label for="sub_seccion" class="col-sm-2 control-label">Subsección:</label>
                <div class="col-sm-9">
                    <input type="text" disabled="true" class="form-control col-sm-1" id="sub_seccion" name="sub_seccion" value="<?php echo $result->subseccion?>" />
                    <span class="glyphicon form-control-feedback"></span> <!---->
                </div>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="pestana" class="col-sm-2 control-label">Pestaña:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="pestana" name="pestana" value="<?php echo $result->pestana?>" required/>
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>

        <div class="form-group has-feedback">
            <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
            <div class="col-sm-10">
                <textarea class="form-control" disabled="true" id="descripcion" name="descripcion" required rows="3" maxlength="100" minlength="3" ><?php echo $result->descripcion?></textarea>
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group">
            <label for="observaciones" class="col-sm-2 control-label">Observaciones:</label>
            <div class="col-sm-10">
                <textarea class="form-control" disabled="true" id="observaciones" rows="3"><?php echo $result->observaciones?></textarea>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback">
                <label for="fecha_apertura" class="col-sm-2 control-label">Fecha Apertura:</label>
                <div class="col-sm-10">
                    <input type="text" disabled="true" class="form-control col-lg-1" required name="fecha_apertura" value="<?php echo $result->fecha_apertura?>"/>
                    <span class="glyphicon form-control-feedback" ></span>
                </div>
            </div>
            <div class="form-group col-sm-6  has-feedback">
                <label for="fecha_cierre" class="col-sm-2 control-label">Fecha Cierre:</label>
                <div class="col-sm-10">
                    <input type="text" disabled="true" class="form-control col-lg-1" value="<?php echo $result->fecha_cierre?>"name="fecha_cierre" />
                </div>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label for="titulo" class="col-sm-2 control-label">Clasificación de la información: </label>
                <div class="col-sm-8">
                    <div class="btn-group">
                        <?php switch ($result->clasificacion_informacion) {
                          case 0:?>
                          <button type="button" id="RESERVADA"  class="btn btn-success" onclick="ClasificarInfo(0)">RESERVADA</button>
                          <button type="button" id="PUBLICO"  class="btn btn-default" onclick="ClasificarInfo(1)">PÚBLICO</button>
                          <button type="button" id="CONFIDENCIAL" class="btn btn-default " onclick="ClasificarInfo(2)">CONFIDENCIAL</button>
                          <input type="hidden"  name="obj[clasificacion_informacion]" id="clasificacionInfo" value="0" required>
                     <?php break;
                          case 1:?>
                          <button type="button" id="RESERVADA"  class="btn btn-default" onclick="ClasificarInfo(0)">RESERVADA</button>
                          <button type="button" id="PUBLICO"  class="btn btn-success" onclick="ClasificarInfo(1)">PÚBLICO</button>
                          <button type="button" id="CONFIDENCIAL" class="btn btn-default " onclick="ClasificarInfo(2)">CONFIDENCIAL</button>
                          <input type="hidden"  name="obj[clasificacion_informacion]" id="clasificacionInfo" value="1" required>
                      <?php break;
                          case 2:?>
                          <button type="button" id="RESERVADA"  class="btn btn-default" onclick="ClasificarInfo(0)">RESERVADA</button>
                          <button type="button" id="PUBLICO"  class="btn btn-default" onclick="ClasificarInfo(1)">PÚBLICO</button>
                          <button type="button" id="CONFIDENCIAL" class="btn btn-success " onclick="ClasificarInfo(2)">CONFIDENCIAL</button>
                          <input type="hidden"  name="obj[clasificacion_informacion]" id="clasificacionInfo" value="2" required>
                      <?php break;
                          default:?>
                          <button type="button" id="RESERVADA"  class="btn btn-default" onclick="ClasificarInfo(0)">RESERVADA</button>
                          <button type="button" id="PUBLICO"  class="btn btn-default" onclick="ClasificarInfo(1)">PÚBLICO</button>
                          <button type="button" id="CONFIDENCIAL" class="btn btn-default " onclick="ClasificarInfo(2)">CONFIDENCIAL</button>
                          <input type="hidden"  name="obj[clasificacion_informacion]" id="clasificacionInfo" required>
                      <?php break;
                        } ?>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6">
                <label for="extension" class="col-sm-2 control-label">Ubicación:</label>
                <div class="col-sm-10 has-feedback">
                    <div class="col-sm-8">
                        <input type="text" disabled="true" class="form-control col-lg-1"  name="archivero" value="<?php echo $result->ubicacion_archivero?>" required/>
                        <span class="glyphicon form-control-feedback" ></span>
                    </div>

                    <div class="col-sm-4 has-feedback" >
                        <input type="text" disabled="true" class="form-control col-lg-1" id="gaveta" name="gaveta" value="<?php echo $result->ubicacion_gaveta?>"  required/>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6">
                <label for="titulo" class="col-sm-2 control-label">Disponibilidad:</label>
                <div class="col-sm-5">
                    <h4><span class="label label-success">Disponible</span></h4>
<!--                    <h4> <span class="label label-danger">Disponible sin archivo digital</span></h4>-->
                </div>
            </div>
            <!--            <div class="form-group col-sm-6">
                            <input type="file" id="inputPDf" name="inputPDF" class="btn btn-primary" accept="application/pdf">
                        </div>-->
        </div>
        <h4><strong>Documentos</strong></h4>
        <hr size="10px"/>
        <div class="form-group has-feedback">
            <label for="busqueda_documento" class="col-sm-3 control-label">Agregar Documento:</label>
            <div class="col-sm-6">
              <select class="form-control" id="documentosS" onchange="adddocs(this)">
                <option value="">Documentos</option>
                <?php foreach ($docs as $key): ?>
                  <option value="<?php echo $key->codigo ?>"><?php echo $key->descripcion ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div class="scrollDocumentos">
            <table class="table table-striped">
                <thead >
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbodyDoc">
                      <?php if ($result->archivo_expediente != null && !empty($result->archivo_expediente)): ?>
                      <tr>
                        <td><?php echo $result->archivo_expediente?></td>
                        <td><button data-toggle="modal" data-target="#MyModal"type="button" title="Describir Documento" class="btn btn-primary glyphicon glyphicon-list-alt"></button>
                            <span><button ng-click="remover_documento($index)" type="button" title="Eliminar Documento" class="btn btn-danger glyphicon glyphicon-remove"></button></span>
                        </td>
                      </tr>
                      <?php endif; ?>

                </tbody>
            </table>
        </div>
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('Tramite_Concentracion/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>

    <div class="modal fade" id="MyModal" role="dialog" arial-labelledby="MyModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h1 style="text-align:center;">Documento</h1>
          </div>
          <div class="modal-body"  style="margin:20px">

        <form class="form-horizontal" name="frmHistorico" id="frmHistorico" novalidate>
            <div class="form-group">
                <label for="id_tipologia" class="col-sm-2 control-label">Tipología:</label>
                <div class="col-sm-10">
                    <select class="form-control" ng-model="historico.id_tipologia" ng-options="item.id_tipologia as item.descripcion for item in tipologias" id="id_tipologia" name="id_tipologia">
                        <option value="">Tipología</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="id_municipio" class="col-sm-2 control-label">Cuidades:</label>
                <div class="col-sm-10">
                    <select class="form-control" ng-model="historico.id_municipio" ng-options="item.id_municipio as item.descripcion for item in cuidades" id="id_municipio" name="id_municipio">
                        <option value="">Ciudad</option>
                    </select>
                </div>
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmHistorico.descripcion_historico)">
                <label for="descripcion_historico" class="col-sm-2 control-label">Descripción:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion_historico" name="descripcion_historico" ng-model="historico.descripcion" rows="3" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"></textarea>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmHistorico.descripcion_historico)"></span>
                </div>
              </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmHistorico.observacion_historico)">
                <label for="observacion_historico" class="col-sm-2 control-label">Observación:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="observacion_historico" name="observacion_historico" ng-model="historico.observaciones" rows="3" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"></textarea>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmHistorico.observacion_historico)"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="pestana" class="col-sm-4 control-label">Estado Físico:</label>
                    <div class="col-sm-8">
                        <select class="form-control" ng-model="historico.estado_fisico" ng-options="item.id as item.titulo for item in estado_fisico" id="estado_fisico" name="estado_fisico">
                            <option value="">Estado físico</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="pestana" class="col-sm-4 control-label">Medidas de papel:</label>
                    <div class="col-sm-8">
                        <select class="form-control" ng-model="historico.medida_papel" ng-options="item.id as item.titulo for item in medidas_papel" id="medidas_papel" name="medidas_papel">
                            <option value="">Medida</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="pestana" class="col-sm-4 control-label">Formato:</label>
                    <div class="col-sm-8">
                        <select class="form-control" ng-model="historico.formato" ng-options="item.id as item.titulo for item in formato" id="formato" name="formato">
                            <option value="">Formato</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="pestana" class="col-sm-4 control-label">Idioma:</label>
                    <div class="col-sm-8">
                        <select class="form-control" ng-model="historico.idioma" ng-options="item.id as item.titulo for item in idioma" id="idioma" name="idioma">
                            <option value="">Idioma</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="file" id="inputPDf" name="inputPDF" class="btn btn-primary" accept="application/pdf">
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardarHistorico(frmHistorico)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button>
            </div>

        </form>
      </div>

        </div>
    </div>

</div>
