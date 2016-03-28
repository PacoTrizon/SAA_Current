<script type="text/javascript" src="/SAA/js/controllers/coloniasCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="coloniaEditCtrl">
    <div class="panel-heading"><h4>Colonias</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('colonias/index'); ?>">Colonias</a></li>
        <li class="active">Editar</li>
    </ol>
    <form role="form" class="form-horizontal" name="frmColonia" id="frmColonia" novalidate="">
        <div class="form-group has-feedback"  ng-class="cssInput(frmColonia.descripcion)">
            <label for="descripcion" class="control-label col-lg-1">Descripción:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control col-lg-1" autofocus id="descripcion" name="descripcion" name="descripcion" ng-maxlength="200" ng-minlength="2" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"  ng-model="colonia.descripcion" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.descripcion)"></span>
            </div>
            <div ng-show="frmColonia.$submitted || frmColonia.descripcion.$touched">
                <p ng-show="frmColonia.descripcion.$error.required" class="help-block errorRequerido">El nombre del la colonia es requirido.</p>                        
            </div>
            <p ng-show="frmColonia.descripcion.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
            <p ng-show="frmColonia.descripcion.$error.maxlength" class="help-block errorRequerido">El máximo es de 200</p>
        </div>   
        <div class="form-group has-feedback"  ng-class="cssInput(frmColonia.sindicatura)">
            <label for="sindicatura" class="control-label col-lg-1">Sindicatura:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="sindicatura" name="sindicatura" ng-model="datos.id_sindicatura">
<!--                <select class="form-control" ng-model="colonia.id_sindicatura" ng-options="item.id_sindicatura as item.descripcion for item in sindicaturas" required id="sindicatura" name="sindicatura">
                    <option value="">Seleccione una sindicatura</option>
                </select>-->
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.sindicatura)"></span>
                <div ng-show="frmColonia.$submitted || frmColonia.sindicatura.$touched">
                    <p ng-show="frmColonia.sindicatura.$error.required" class="help-block errorRequerido">La sindicatura es requirida.</p>   
                </div>
            </div>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(frmColonia.asentamiento)">
            <label for="asentamiento" class="control-label col-lg-1">Tipo de Asentamiento:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="asentamiento" name="asentamiento" ng-model="datos.id_asentamiento">
<!--                <select class="form-control" ng-model="colonia.id_asentamiento" ng-options="item.id_asentamiento as item.descripcion for item in asentamientos" required id="asentamiento" name="asentamiento">
                    <option value="">Seleccione un asentamiento</option>
                </select>-->
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.asentamiento)"></span>
            </div>
            <div ng-show="frmColonia.$submitted || frmColonia.asentamiento.$touched">
                <p ng-show="frmColonia.asentamiento.$error.required" class="help-block errorRequerido">El asentamiento es requirido.</p>   
            </div>
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(frmColonia.codigo_postal)">
            <label for="codigo_postal" class="col-sm-1 control-label">Código Postal:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="codigo_postal" name="codigo_postal" ng-model="colonia.codigo_postal" ng-maxlength="5" ng-minlength="5" ng-pattern="/^[0-9]{1,5}$/">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.codigo_postal)"></span>
            </div>
            <div ng-show="frmColonia.$submitted || frmColonia.codigo_postal.$touched">
                <p ng-show="frmColonia.codigo_postal.$error.required" class="help-block errorRequerido">El código postal es requerido.</p>   
            </div>
            <p ng-show="frmColonia.codigo_postal.$error.minlength" class="help-block errorRequerido">El mínimo es de 5 y no se aceptan letras</p>
            <p ng-show="frmColonia.codigo_postal.$error.maxlength" class="help-block errorRequerido">El máximo es de 5 y no se aceptan letras</p>
        </div>  
        <div class="form-group ">
            <label for="estatus" class="col-sm-1 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div>   

        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmColonia)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('colonias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>       
</div>