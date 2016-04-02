<script type="text/javascript" src="/SAA/js/controllers/seriesDocumentosCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="seriesDocumentosCtrl">
    <div class="panel-heading"><h4>Serie Documentos</h4></div>
    <form class="form-horizontal css-form" name="formSerie" novalidate style="margin-top: 11px;">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Serie:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control col-lg-1" id="seriesDescripcion" onChange="autocompletDS()" name="seriesDescripcion"/>
            </div>

        </div>
        <div class="form-inline">
            <div class="form-group col-sm-6">
                <div class="panel panel-default form-inline">
                    <div class="panel-heading">            
                        <strong>Documentos Existentes</strong>                                             
                        <input type="text" class="form-control col-sm-offset-5" placeholder="Buscar" ng-model="buscadorDocumentoExistente">                                        
                        <span></span>
                    </div>
                    <div class="panel-body scrollDocumentos">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="documentos in listDocumentos| filter:buscadorDocumentoExistente">
                                    <td>{{documentos.descripcion}}</td>
                                    <td><button ng-click="agregarDocumentos(documentos,$index)" ng-disabled="serieSeleccionada" type="button" class="btn btn-primary glyphicon glyphicon-plus"></button></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group  col-sm-6" style="margin-left: 2px;">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Documentos Seleccionados</strong></div>
                    <div class="panel-body scrollDocumentos">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="documentosSeleccion in documentosSeleccionados">
                                    <td>{{documentosSeleccion.descripcion}}</td>
                                    <td><button ng-click="removerDocumentos($index)" type="button" class="btn btn-danger glyphicon glyphicon-remove"></button></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>           
        </div>

        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-click="guardar()" ng-disabled="serieSeleccionada"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('colonias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>       
    </form>
    <modal title="BUSQUEDA SERIE" visible="showModal">
        <form role="form">
            <div class="form-group">
                <div class="input-group col-sm-8 col-sm-offset-2">
                    <input type="text" class="form-control" id="buscadorSerie" name="buscadorSerie" autofocus ng-model="buscardorSerie.descripcion"/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" ng-click="buscarSerie()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                    </span>
                </div>    
            </div> 
            <div class="form-group">
                <div class="panel panel-default">                    
                    <div class="panel-body scrollDocumentos">
                        <table class="table table-striped" ng-show="tablaSerieBuscados">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="series in listSeriesBuscados">
                                    <td>{{series.descripcion}}</td>
                                    <td><button ng-click="asignarSerie($index)" type="button" class="btn btn-primary glyphicon glyphicon-arrow-right"></button></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </form>       
    </modal>
</div>




