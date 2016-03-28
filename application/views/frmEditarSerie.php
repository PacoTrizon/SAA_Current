<script type="text/javascript" src="/SAA/js/controllers/seriesCtrl.js"></script>
<style>
    hr {
        -moz-border-bottom-colors: none;
        -moz-border-image: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #EEEEEE -moz-use-text-color #FFFFFF;
        border-style: dotted;
        border-width: 1px 0;
        margin: 18px 0;
    }
</style>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="editarSerieCtrl">
    <div class="panel-heading"><h4>Series</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('series/index'); ?>">Series</a></li>
        <li class="active">Editar</li>
    </ol>
    <form class="form-horizontal css-form" name="formSerie" novalidate style="margin-top: 11px;">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Padre:</label>
            <div class="col-sm-9 input-group">
                <input style="    margin-left: 15px;" type="text" class="form-control col-lg-1" ng-disabled="true" id="padreSerie" name="padreSerie" ng-model="seriePadre.nombre"/>
                <span class="input-group-btn">
                    <button class="btn btn-primary" ng-click="openModal()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                </span>
            </div>           

        </div>
        <div class="form-group has-feedback" ng-show="codigo">
            <label for="codigo" class="col-sm-2 control-label">Código:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="codigo" name="codigo" ng-minlegth="1" ng-model="serie.codigo"/>
            </div>
        </div>

        <div class="form-group has-feedback" ng-class="cssInput(formSerie.descripcionSerie)">
            <label for="nombre" class="col-sm-2 control-label">Descripción:</label>
            <div class="col-sm-10">
                <input type="text" autofocus class="form-control col-lg-1" id="descripcionSerie" name="descripcionSerie" ng-model="serie.descripcion" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSerie.descripcionSerie)"></span>
            </div>
            <div ng-show="formSerie.$submitted || formSerie.descripcionSerie.$touched">
                <p ng-show="formSerie.descripcionSerie.$error.required" class="help-block col-lg-offset-2 errorRequerido">La descripción es requirida.</p>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Sustento legal:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="sustento_legal" ng-model="serie.sustento_legal" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="estatusDependencia" class="col-sm-2 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> 
        <!--        <div class="form-group has-feedback" ng-class="cssInput(formSerie.estatusSeries)">
                    <label for="estatus" class="col-sm-2 control-label">Estatus:</label>
                    <div class="col-sm-3">
                        <select class="form-control" ng-model="serie.estatus" ng-options="item.id as item.titulo for item in estatus" id="estatusSeries" name="estatusSeries" required>
                            <option value="">Seleccione un estatus</option>
                        </select>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSerie.estatusSeries)"></span>
                    </div>
                    <div ng-show="formSerie.$submitted || formSerie.estatusSeries.$touched">
                        <p ng-show="formSerie.estatusSeries.$error.required" class="help-block errorRequerido ">El estatus es requirido.</p>
                    </div>
                </div> -->
        <h4><strong>Valoración Documental</strong></h4>
        <hr size="10px"/>
        <div class="form-group">
            <label for="estatus" class="col-sm-2 control-label">Valor Documental:</label>
            <div class="col-sm-3">
                <div class="btn-group"role="group" aria-label="..." required>
                    <button type="button" id="administrativo" value="0" class="btn btn-default">Administrativo</button>
                    <button type="button" id="legal" value="1" class="btn btn-default">Legal</button>
                    <button type="button" id="contable" value="2" class="btn btn-default">Contable</button>
                    <button type="button" id="tecnico" value="3" class="btn btn-default">Técnico</button>
                </div>
            </div>
            <p ng-show="mostrarErrorValorDocumental" class="help-block errorRequerido ">El valor documental es requirido.</p>
        </div>

        <div class="form-inline">
            <div class="form-group col-sm-6">
                <label for="exampleInputName2" class="col-sm-3 col-sm-offset-1 control-label">Vigencia Tramite:</label>
                <div class="col-sm-3">
                    <input type="date" name="vigencia_tramite" id="vigencia_tramite" name="vigencia_tramite" class="form-control" min="2000-01-02" required ng-model="vigencia_tramite" value="{{date}}">
                </div>
                <div ng-show="formSerie.$submitted || formSerie.vigencia_tramite.$touched">
                    <p ng-show="formSerie.vigencia_tramite.$error.required" class="help-block col-lg-offset-8 errorRequerido ">La vigencia de tramite es requirida.</p>
                </div>

            </div>
            <div class="form-group  col-sm-6">
                <label for="exampleInputEmail2" class="col-sm-4 control-label">Vigencia Concentración:</label>
                <div class="col-sm-3">
                    <input type="date" name="vigencia_concentracion" id="vigencia_concentracion" name="vigencia_concentracion" class="form-control" min="2000-01-02" required ng-model="vigencia_concentracion" value="{{date2}}">
                </div>
                <div ng-show="formSerie.$submitted || formSerie.vigencia_concentracion.$touched">
                    <p ng-show="formSerie.vigencia_concentracion.$error.required" class="help-block col-lg-offset-8 errorRequerido">La vigencia de concentración es requirida.</p>
                </div>

            </div>           
        </div>
        <div class="form-group">
            <div class="col-sm-1 col-sm-offset-10">
                <button type="submit" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
            </div> 
        </div>
    </form> 
    <modal title="BUSQUEDA SERIE PADRE" visible="showModal">
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


