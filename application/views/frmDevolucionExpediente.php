<script type="text/javascript" src="/SAA/js/controllers/servicioExpedientesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="devolucionExpedienteCtrl">
    <div class="panel-heading">
        <div class="row">
            <div class="form-group col-sm-6">
                <h4>Servicios de Devoluciones</h4>
            </div>
        </div>
    </div>  
    <form class="form-horizontal" name="frmDevoluciones" id="frmDevoluciones" novalidate style="margin-top: 11px;">
        <!--        <div ng-show="true">
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
                            <input type="text" class="form-control" ng-disabled="true" id="referencia" name="referencia" ng-model="dato.nombre_dependencia"/>
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
                            <input type="text" class="form-control" ng-disabled="true" id="correo" name="correo" ng-model="dato.correo_electronico"/>
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
                    </div>  -->
        <div class="form-group has-feedback" ng-class="cssInput(frmDevoluciones.busqueda_solicitante)">
            <label for="busqueda_solicitante" class="col-sm-3 control-label">Solicitante:</label>
            <div class="col-sm-6">
                <input type="text" autofocus class="form-control" placeholder="Buscar..." id="busqueda_solicitante" name="busqueda_solicitante" ng-change="busqueda_solicitantes(frmDevoluciones.busqueda_solicitante)" ng-minlength="3" ng-model="dato.busqueda_expediente"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmDevoluciones.busqueda_solicitante)"></span>
            </div> 
            <label>Seleccionar Todos<input type="checkbox" class="size_checkBox" ng-model="check_global" ng-click="check_all()"></label>
        </div> 
        <div class="scrollExpedientesDevoluciones">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código Servicio</th>
                        <th>Clave</th>
                        <th>Expediente</th>
                        <th>Fecha Solicitud</th>
                        <th>Devolver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="expediente in expedientes">
                        <td>{{expediente.servicio_id}}</td>
                        <td>{{expediente.clave}}</td>
                        <td>{{expediente.nombre_expediente}}</td>
                        <td>{{expediente.fecha_formateada}}</td>
                        <td><input class="size_checkBox" type="checkbox" ng-click="check_devolucion($index)" ng-model="check_global"></td>                                                    
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(frmDevoluciones.observaciones)">
            <label for="busqueda_solicitante" class="col-sm-1 control-label">Observaciones:</label>
            <div class="col-sm-6">
                <textarea class="form-control" id="observaciones" name="observaciones" ng-minlength="3" ng-model="solicitante.observaciones"> </textarea>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmDevoluciones.observaciones)"></span>
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
</div>