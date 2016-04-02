<script type="text/javascript" src="/SAA/js/controllers/paisesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="paisAgregarCtrl">
    <div class="panel-heading"><h4>Países</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('paises/index'); ?>">Países</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form role="form" name="frmPais" id="frmPais" novalidate="" class="form-horizontal">
        <div class="form-group has-feedback"  ng-class="cssInput(frmPais.descripcion)">
            <label for="descripcion" class="control-label col-lg-1">Descripcion:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control col-lg-1" id="descripcion" name="descripcion" ng-model="pais.descripcion"  ng-maxlength="100" ng-minlength="2" ng-pattern="/^[a-zA-Z\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmPais.descripcion)"></span>
            </div>
            <div ng-show="frmPais.$submitted || frmPais.descripcion.$touched">
                <p ng-show="frmPais.descripcion.$error.required" class="help-block errorRequerido">El nombre del país es requerido.</p>
            </div>
            <p ng-show="frmPais.descripcion.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
            <p ng-show="frmPais.descripcion.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
        </div>

<!--        <div class="form-group ">
            <label for="estatus" class="col-sm-1 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> -->
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmPais)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('Paises/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>

    </form>
</div>
