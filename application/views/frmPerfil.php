<script type="text/javascript" src="/SAA/js/controllers/perfilesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="perfilAgregarCtrl">
    <div class="panel-heading"><h4>Perfiles</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('perfiles/index'); ?>">Perfiles</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form role="form" class="form-horizontal" name="frmPerfil" id="frmPerfil" novalidate="">
        <div class="form-inline">
            <div class="form-group has-feedback col-sm-4"  ng-class="cssInput(frmPerfil.nombre)">
                <label for="descripcion" class="control-label col-lg-3">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" autofocus id="nombre" name="nombre" ng-maxlength="100" ng-minlength="3" ng-model="perfil.descripcion" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmPerfil.nombre)"></span>
                    <div ng-show="frmPerfil.$submitted || frmPerfil.nombre.$touched">
                        <p ng-show="frmPerfil.nombre.$error.required" class="help-block errorRequerido">El nombre del perfil es requirido.</p>                        
                    </div>
                    <p ng-show="frmPerfil.nombre.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                    <p ng-show="frmPerfil.nombre.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
                </div>           
            </div>
            <div class="form-group  col-sm-8" style="margin-left: 2px;">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Permisos</strong></div>
                    <div class="panel-body scrollDocumentos">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Menu</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#encabezados"></button></th>
                                </tr>
                            </thead>
                            <tbody id="encabezados" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.tipo == 'encabezado'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.tipo == 'encabezado'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Usuarios</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#usuarios"></button></th>
                                </tr>
                            </thead>
                            <tbody id="usuarios" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'usuarios'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'usuarios'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Perfiles</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#perfiles"></button></th>
                                </tr>
                            </thead>
                            <tbody id="perfiles" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'perfiles'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'perfiles'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Colonias</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#colonia"></button></th>
                                </tr>
                            </thead>
                            <tbody id="colonia" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'colonia'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'colonia'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Dependencias</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#dependencia"></button></th>
                                </tr>
                            </thead>
                            <tbody id="dependencia" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'dependencia'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'dependencia'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Estados</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#estado"></button></th>
                                </tr>
                            </thead>
                            <tbody id="estado" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'estado'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'estado'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Municipios</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#municipio"></button></th>
                                </tr>
                            </thead>
                            <tbody id="municipio" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'municipio'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'municipio'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Países</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#pais"></button></th>
                                </tr>
                            </thead>
                            <tbody id="pais" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'pais'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'pais'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Sindicaturas</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#sindicatura"></button></th>
                                </tr>
                            </thead>
                            <tbody id="sindicatura" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'sindicatura'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'sindicatura'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Tipologías</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#tipologia"></button></th>
                                </tr>
                            </thead>
                            <tbody id="tipologia" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'tipologia'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'tipologia'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Tipos de Asentamientos</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#tipo_asentamiento"></button></th>
                                </tr>
                            </thead>
                            <tbody id="tipo_asentamiento" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'tipo_asentamiento'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'tipo_asentamiento'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Documentos</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#documentos"></button></th>
                                </tr>
                            </thead>
                            <tbody id="documentos" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'documentos'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'documentos'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Series Documentos</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#series_documentos"></button></th>
                                </tr>
                            </thead>
                            <tbody id="series_documentos" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'series_documentos'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'series_documentos'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Series</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#serie"></button></th>
                                </tr>
                            </thead>
                            <tbody id="serie" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'serie'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'serie'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Trámite y Concentración</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#tramite_concentracion"></button></th>
                                </tr>
                            </thead>
                            <tbody id="tramite_concentracion" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'tramite_concentracion'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'tramite_concentracion'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Investigadores</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#investigador"></button></th>
                                </tr>
                            </thead>
                            <tbody id="investigador" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'investigador'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'investigador'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Solicitantes</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#solicitante"></button></th>
                                </tr>
                            </thead>
                            <tbody id="solicitante" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'solicitante'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'solicitante'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Servicio de Expedientes</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#servicio_expediente"></button></th>
                                </tr>
                            </thead>
                            <tbody id="servicio_expediente" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'servicio_expediente'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'servicio_expediente'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th class="ancho_listado_descripcion">Servicio de Devolución</th>
                                    <th class="ancho_listado_checkbox"><button class="btn btn-primary glyphicon glyphicon-plus" data-toggle="collapse" data-target="#servicio_devolucion"></button></th>
                                </tr>
                            </thead>
                            <tbody id="servicio_devolucion" class="collapse">
                                <tr ng-repeat="permiso in list_permisos">
                                    <td ng-if="permiso.grupo == 'servicio_devolucion'" class="ancho_listado_descripcion">{{permiso.descripcion}}</td>
                                    <td ng-if="permiso.grupo == 'servicio_devolucion'" class="ancho_listado_checkbox"><input type="checkbox" ng-click="agregar_permiso(permiso, $index)" class="size_checkBox"></td> 
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>   
        </div>       

        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmPerfil)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('perfiles/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>       
</div>