<script type="text/javascript" src="/SAA/js/controllers/servicioExpedientesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="agregarServicioExpedienteCtrl">
    <div class="panel-heading">
        <div class="row">
            <div class="form-group col-sm-6">
                <h4>Servicios de Expedientes</h4>
            </div>
        </div>
    </div>   
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('servicio_expediente/index'); ?>">Servicios de Expedientes</a></li>
        <li class="active">Agregar</li>        
    </ol>   
    <form class="form-horizontal" name="frmServicio" id="frmServicio" novalidate style="margin-top: 11px;">
        <div class="row" style="margin-left: 78px;">                    
            <div class="form-group col-sm-3" >
                <label for="clave" class="col-sm-6 control-label">Tipo solicitante:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="solicitante" name="solicitante">
                        <option value="1" >Solicitante</option> 
                        <option value="0">Investigador</option>
                    </select>
                </div>                     
            </div>   
            <div class="form-group col-sm-3 has-feedback" ng-class="cssInput(frmServicio.busqueda)">
                <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Buscar..." id="busqueda" name="busqueda" ng-change="busqueda(frmServicio.busqueda)" autofocus ng-minlength="3" ng-model="dato.nombre_busqueda" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.busqueda)"></span>
                </div> 
            </div>           
        </div> 
        <!--        <div ng-show="mostrarCampos">-->
        <div ng-show="true">
            <div class="form-group"> 
                <label for="nombre" class="col-sm-2 control-label">* Nombre:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" ng-disabled="true" id="nombre" name="nombre" ng-model="dato.nombre"/>  
                </div>           
            </div>
            <div class="form-group" ng-show="tipo_investigador"> 
                <label for="domicilio" class="col-sm-2 control-label">Domicilio:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" ng-disabled="true" id="domicilio" name="domicilio" ng-model="dato.domicilio"/>                
                </div>           
            </div>
            <div class="form-group" ng-show="tipo_investigador"> 
                <label for="telefono_investigador" class="col-sm-2 control-label">Teléfono:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" ng-disabled="true" id="telefono_investigador" name="telefono_investigador" ng-model="dato.telefono_investigador"/>                
                </div>           
            </div>
            <div class="form-group"> 
                <label for="referencia" class="col-sm-2 control-label" id="label_referencia">Unidad Administrativa:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" ng-disabled="true" id="referencia" name="referencia" ng-model="dato.referencia"/>
                </div>
            </div> 
            <div class="form-group"> 
                <label for="pestana" class="col-sm-2 control-label">Cargo:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" ng-disabled="true" id="cargo" name="cargo" ng-model="dato.cargo"/>
                </div>          
            </div> 
            <div class="form-group" ng-show="!tipo_investigador"> 
                <label for="correo" class="col-sm-2 control-label">Correo:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" ng-disabled="true" id="correo" name="correo" ng-model="dato.correo"/>
                </div>
            </div> 
            <div class="form-group"> 
                <label for="telefono" class="col-sm-2 control-label" id="label_telefono">Teléfono:</label>
                <div class="col-sm-3">
                    <input type="tel" class="form-control col-lg-1" ng-disabled="true" id="telefono" name="telefono" ng-model="dato.telefono"/>                
                </div>           
            </div> 
            <div class="form-group" ng-show="!tipo_investigador"> 
                <label for="celular" class="col-sm-2 control-label">Celular:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" ng-disabled="true" id="celular" name="celular" ng-model="dato.celular" />               
                </div>
            </div>  
            <h4><strong>Expedientes</strong></h4>
            <hr size="10px"/>
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.busqueda_expediente)">
                <label for="clave" class="col-sm-3 control-label">Expediente:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Buscar..." id="busqueda_expediente" name="busqueda_expediente" ng-change="busqueda_expedientes(frmServicio.busqueda_expediente)" ng-minlength="3" ng-model="dato.busqueda_expediente"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.busqueda_expediente)"></span>
                </div> 
            </div>  
            <div class="scrollExpedientes">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Disponibilidad</th>
                            <th align="left">Préstamo</th>
                            <th>Fotocopiado</th>
                            <th>Consulta</th>
                            <th>Información</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="expediente in expedientes">
                            <th>{{$index + 1}}</th>
                            <td>{{expediente.clave}}</td>
                            <td>{{expediente.descripcion}}</td>
                            <td>Disponible</td>
                            <td><input class="size_checkBox" type="checkbox" ng-click="agregar_servicio($index, 'prestamo')"></td>
                            <td><input class="size_checkBox" type="checkbox" ng-click="agregar_servicio($index, 'fotocopiado')"></td>
                            <td><input class="size_checkBox" type="checkbox" ng-click="agregar_servicio($index, 'consulta')"></td>
                            <td><button ng-click="informacion($index)" type="button" title="Información" class="btn btn-primary glyphicon glyphicon-list-alt"></button></td> 
                            <td><button ng-click="remover($index)" type="button" title="Quitar Expediente" class="btn btn-danger glyphicon glyphicon-remove"></button></td>                           
                        </tr>
                    </tbody>
                </table>
            </div>       
            <h4><strong>Detalle de Servicio</strong></h4>
            <hr size="10px"/>             
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.fecha_solicitud)">
                <label for="fecha_solicitud" class="col-sm-2 control-label">* Fecha de Solicitud:</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control col-lg-1" id="fecha_solicitud" name="fecha_solicitud" ng-model="solicitante.fecha_solicitud" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.fecha_solicitud)"></span>
                    <div ng-show="frmServicio.$submitted || frmServicio.fecha_solicitud.$touched">
                        <p ng-show="frmServicio.fecha_solicitud.$error.required" class="help-block errorRequerido">La fecha de solicitud es requerida.</p>                        
                    </div>
                </div>               
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.numero_fojas)">
                <label for="numero_fojas" class="col-sm-2 control-label">* Número de Fojas:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" id="numero_fojas" name="numero_fojas" ng-model="solicitante.numero_fojas" ng-pattern="/^[0-9]{1,9}$/" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.numero_fojas)"></span>
                    <div ng-show="frmServicio.$submitted || frmServicio.numero_fojas.$touched">
                        <p ng-show="frmServicio.numero_fojas.$error.required" class="help-block errorRequerido">El número de fojas es requerido.</p>                        
                    </div>
                </div>               
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.numero_planos)">
                <label for="numero_planos" class="col-sm-2 control-label">* Número de Planos:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" id="numero_planos" name="numero_planos" ng-model="solicitante.numero_planos" ng-pattern="/^[0-9]{1,9}$/" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.numero_planos)"></span>
                    <div ng-show="frmServicio.$submitted || frmServicio.numero_planos.$touched">
                        <p ng-show="frmServicio.numero_planos.$error.required" class="help-block errorRequerido">El número de planos es requerido.</p>                        
                    </div>
                </div>               
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.motivo)">
                <label for="motivo" class="col-sm-2 control-label">* Motivos:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" id="motivo" name="motivo" ng-model="solicitante.motivo" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.motivo)"></span>
                    <div ng-show="frmServicio.$submitted || frmServicio.motivo.$touched">
                        <p ng-show="frmServicio.motivo.$error.required" class="help-block errorRequerido">El motivo es requerido.</p>                        
                    </div>
                </div>               
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmServicio.observaciones)">
                <label for="observaciones" class="col-sm-2 control-label">* Observaciones:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control col-lg-1" id="observaciones" name="observaciones" ng-model="solicitante.observaciones" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmServicio.observaciones)"></span>
                    <div ng-show="frmServicio.$submitted || frmServicio.observaciones.$touched">
                        <p ng-show="frmServicio.observaciones.$error.required" class="help-block errorRequerido">Las observaciones es requerido.</p>                        
                    </div>
                </div>               
            </div>
            <div class="col-sm-offset-10">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" ng-click="guardar(frmServicio)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                    <span>
                        <a href="<?php echo base_url('servicio_expediente/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                    </span>
                </div> 
            </div>
        </div>
    </form>   
    <modal title="INFORMACIÓN" visible="showModal">
        <form class="form-horizontal" ng-show="!tipo_investigador" name="frmTramite" id="frmTramite" novalidate="" style="margin-top: 11px;">
            <div class="row col-sm-offset-1">
                <div class="form-group col-sm-6">
                    <label class="col-sm-4 control-label">Fondo:</label>
                    <label class="control-label"><strong>Ayuntamiento de Culiacán</strong></label>
                </div>  
            </div>   
            <div class="row col-sm-offset-1">
                <div class="form-group col-sm-6">
                    <label for="sub_fondo" class="col-sm-4 control-label">Sub-fondo:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control col-sm-1" ng-disabled="true" id="sub_fondo" name="sub_fondo"  ng-model="informacion_expediente.nombre_sub_fondo"/>                       
                    </div>                    
                </div>   
                <div class="form-group col-sm-6">
                    <label for="serie" class="col-sm-2 control-label">Serie:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control col-sm-1" ng-disabled="true" id="serie" name="serie" ng-model="informacion_expediente.nombre_serie" />                        
                    </div>
                </div> 
            </div> 
            <div class="row col-sm-offset-1">
                <div class="form-group col-sm-6"> 
                    <label for="seccion" class="col-sm-4 control-label">Sección:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control col-sm-1" ng-disabled="true" id="seccion" name="seccion" autofocus ng-maxlength="9" ng-model="informacion_expediente.nombre_seccion"/>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.seccion)"></span> <!---->
                    </div> 
                    <div ng-show="frmTramite.$submitted || frmTramite.seccion.$touched">
                        <p ng-show="frmTramite.seccion.$error.required" class="help-block errorRequerido">La sección es requirida.</p>
                    </div>

                </div>   
                <div class="col-sm-1">

                </div>
                <div class="form-group col-sm-6 has-feedback" ng-class="cssInput(frmTramite.sub_serie)"> <!-- -->
                    <label for="sub_serie" class="col-sm-2 control-label">Sub-Serie:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control col-sm-1" ng-maxlength="20" ng-disabled="true" id="sub_serie" name="sub_serie" ng-model="informacion_expediente.nombre_sub_serie"/>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.sub_serie)"></span>
                    </div> 
                    <div ng-show="frmTramite.$submitted || frmTramite.sub_serie.$touched">
                        <p ng-show="frmTramite.sub_serie.$error.required" class="help-block col-lg-offset-2 errorRequerido">La sub serie es requirida.</p>
                    </div>
                </div> 
            </div> 
            <div class="row col-sm-offset-1">
                <div class="form-group col-sm-6 has-feedback" ng-class="cssInput(frmTramite.sub_seccion)">
                    <label for="sub_seccion" class="col-sm-4 control-label">Subsección:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control col-sm-1" ng-disabled="true" id="sub_seccion" name="sub_seccion" ng-maxlength="9" ng-model="informacion_expediente.nombre_sub_seccion"/>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.sub_seccion)"></span> <!---->
                    </div> 
                    <div ng-show="frmTramite.$submitted || frmTramite.sub_seccion.$touched">
                        <p ng-show="frmTramite.sub_seccion.$error.required" class="help-block col-lg-offset-2 errorRequerido">La sub seccion es requirida.</p>
                    </div>
                </div>   
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(frmTramite.pestana)"> 
                <label for="pestana" class="col-sm-2 control-label">Pestaña:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-lg-1" id="pestana" ng-disabled="true" name="pestana" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"  ng-model="informacion_expediente.pestana" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.pestana)"></span>
                </div>
                <div ng-show="frmTramite.$submitted || frmTramite.pestana.$touched">
                    <p ng-show="frmTramite.pestana.$error.required" class="help-block col-lg-offset-2 errorRequerido">La pestaña es requirida.</p>
                </div>
                <p ng-show="frmTramite.pestana.$error.minlength" class="help-block col-lg-offset-2 errorRequerido">El mínimo es de 3</p>
                <p ng-show="frmTramite.pestana.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 100</p>
            </div> 

            <div class="form-group has-feedback" ng-class="cssInput(frmTramite.descripcion)">
                <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion" name="descripcion" ng-disabled="true" ng-model="informacion_expediente.descripcion" required rows="3" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"></textarea>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.descripcion)"></span>
                </div>
                <div ng-show="frmTramite.$submitted || frmTramite.descripcion.$touched">
                    <p ng-show="frmTramite.descripcion.$error.required" class="help-block col-lg-offset-2 errorRequerido">La descripción es requirida.</p>
                </div>
                <p ng-show="frmTramite.descripcion.$error.minlength" class="help-block col-lg-offset-2 errorRequerido">El mínimo es de 3</p>
                <p ng-show="frmTramite.descripcion.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 100</p>
            </div>
            <div class="form-group">
                <label for="observaciones" class="col-sm-2 control-label">Observaciones:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="observaciones" ng-disabled="true" ng-model="tramite.observaciones" rows="3"></textarea>
                </div>
            </div> 
            <div class="row col-sm-offset-1">
                <div class="form-group col-sm-6 has-feedback" ng-class="cssInput(frmTramite.fecha_apertura)">
                    <label for="fecha_apertura" class="col-sm-4 control-label">Fecha Apertura:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control col-lg-1" ng-disabled="true" id="fecha_apertura" name="fecha_apertura" ng-maxlength="50" ng-model="informacion_expediente.fecha_apertura"/>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTramite.fecha_apertura)"></span>
                    </div> 
                    <div ng-show="frmTramite.$submitted || frmTramite.fecha_apertura.$touched">
                        <p ng-show="frmTramite.fecha_apertura.$error.required" class="help-block col-lg-offset-2 errorRequerido">La fecha de apertura es requirida.</p>
                    </div>
                </div> 
                <div class="form-group col-sm-6  has-feedback">
                    <label for="fecha_cierre" class="col-sm-2 control-label">Fecha Cierre:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control col-lg-1" id="fecha_cierre" name="fecha_cierre" ng-disabled="true" ng-model="informacion_expediente.fecha_cierre"/>
                    </div>               
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="titulo" class="col-sm-6 control-label">Clasificación de la información:</label>
                    <div class="col-sm-6">
                        <div class="btn-group">
                            <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" ng-disabled="true" class="btn btn-success">RESERVADA</button>
                        </div>
                    </div>           
                </div> 
                <div class="form-group col-sm-6">
                    <label for="extension" class="col-sm-2 control-label">Ubicación:</label>
                    <div class="col-sm-10 has-feedback">
                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="archivero" ng-disabled="true" id="archivero" name="archivero" ng-model="informacion_expediente.ubicacion_archivero"/>                          
                        </div>
                        <div class="col-sm-5 has-feedback">
                            <input type="text" class="form-control" id="gaveta" placeholder="Gaveta" ng-disabled="true" name="gaveta" ng-model="informacion_expediente.ubicacion_gaveta"/>                            
                        </div>
                    </div>
                </div>
            </div>             
        </form>
        <div class="scrollDocumentos" ng-show="tipo_investigador">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre Documento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="documento in documentos| filter:descripcion">
                        <th>{{$index+1}}</th>
                        <td>{{documento.descripcion}}</td>
                        <!--<td><button ng-click="buscarHistorico(documento)" type="button" title="Describir Documento" class="btn btn-primary glyphicon glyphicon-list-alt"></button></td>--> 
                    </tr>
                </tbody>
            </table>
        </div>    
         <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button>
            </div>
    </modal>
</div>