<script type="text/javascript" src="/SAA/js/controllers/solicitantesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="solictantesEditCtrl">
    <div class="panel-heading"><h4>Solicitantes</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('solicitantes/index'); ?>">Solicitantes</a></li>
        <li class="active">Editar</li>
    </ol>
    <form class="form-horizontal" name="formEditSolicitante" id="formEditSolicitante" novalidate="" style="margin-top: 11px;">
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.nombre)" style="margin-left: -40px;">
            <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="nombre" autofocus name="nombre" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="solicitante.nombre" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.nombre)"></span>
            </div>
            <div ng-show="formEditSolicitante.$submitted || formEditSolicitante.nombre.$touched">
                <p ng-show="formEditSolicitante.nombre.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre del solicitante es requirido.</p>
            </div>
            <p ng-show="formEditSolicitante.nombre.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formEditSolicitante.nombre.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.apellido_paterno)" style="margin-left: -40px;">
            <label for="apellido_paterno" class="col-sm-2 control-label">Apellido Paterno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="apellido_paterno" name="apellido_paterno" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="solicitante.apellido_paterno" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.apellido_paterno)"></span>                
            </div>          
            <div ng-show="formEditSolicitante.$submitted || formEditSolicitante.apellido_paterno.$touched">
                <p ng-show="formEditSolicitante.nombre.$error.required" class="help-block col-lg-offset-2 errorRequerido">El apellido paterno del solicitante es requirido.</p>
            </div>
            <p ng-show="formEditSolicitante.apellido_paterno.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formEditSolicitante.apellido_paterno.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.apellido_materno)" style="margin-left: -40px;">
            <label for="apellido_materno" class="col-sm-2 control-label">Apellido Materno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="apellido_materno" name="apellido_materno" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="solicitante.apellido_materno"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.apellido_materno)"></span>               
            </div>            
            <p ng-show="formEditSolicitante.apellido_materno.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formEditSolicitante.apellido_materno.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.correo)" style="    margin-left: -40px;">
            <label for="correo" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control col-lg-1" id="correo" name="correo" ng-model="solicitante.correo_electronico"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.correo)"></span>
            </div>
            <p ng-show="formEditSolicitante.correo.$invalid && !formEditSolicitante.correo.$pristine" class="help-block col-lg-offset-2 errorRequerido">La dirección de correo no es valida.</p>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.dependencia)" style="margin-left: -40px;">
            <label for="dependencia" class="col-sm-2 control-label">Dependencia:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" ng-change="" required id="dependencia" name="dependencia" ng-model="datos.nombre_dependencia">                         
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.dependencia)"></span>
                <div ng-show="formEditSolicitante.$submitted || formEditSolicitante.dependencia.$touched">
                    <p ng-show="formEditSolicitante.dependencia.$error.required" class="help-block errorRequerido">La dependencia es requirido.</p>
                </div>
            </div>
        </div>
        <div class="row" style="    margin-left: 53px;" >
            <div class="form-group col-sm-4 has-feedback" style="    margin-left: auto;" ng-class="cssInput(formEditSolicitante.telefono)">
                <label for="telefono" class="col-sm-4 control-label">Télefono:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" id="telefono" name="telefono" ng-maxlength="7" ng-minlength="7" ng-pattern="/^[0-9]{1,7}$/" ng-model="solicitante.telefono" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.telefono)"></span>
                </div>
                <div ng-show="formEditSolicitante.$submitted || formEditSolicitante.telefono.$touched">
                    <p ng-show="formEditSolicitante.telefono.$error.required" class="help-block errorRequerido">El télefono del solicitante es requirido.</p>
                </div>
                <p ng-show="formEditSolicitante.telefono.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 7 </p>
                <p ng-show="formEditSolicitante.telefono.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 7</p>
            </div>
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formEditSolicitante.extension)">
                <label for="extension" class="col-sm-5 control-label">Extensión:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="extension" name="extension" ng-minlength="1" ng-maxlength="4" ng-pattern="/^[0-9]{1,4}$/" ng-model="solicitante.extension"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.extension)"></span>
                </div>
                <p ng-show="formEditSolicitante.extension.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 4 y no se aceptan letras</p>
                <p ng-show="formEditSolicitante.extension.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 4 y no se aceptan letras</p>
            </div>
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formEditSolicitante.celular)">
                <label for="celular" class="col-sm-5 control-label">Celular:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="celular" name="celular" ng-minlength="10" ng-maxlength="10" ng-pattern="/^[0-9]{1,10}$/" ng-model="solicitante.celular"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.celular)"></span>
                </div>
                <p ng-show="formEditSolicitante.celular.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 10 y no se aceptan letras</p>
                <p ng-show="formEditSolicitante.celular.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 10 y no se aceptan letras</p>
            </div>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formEditSolicitante.cargo)" style="    margin-left: -40px;">
            <label for="cargo" class="col-sm-2 control-label">Cargo:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="cargo" name="cargo" ng-maxlength="100" ng-minlength="3"  ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="solicitante.cargo" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditSolicitante.cargo)"></span>
            </div>
            <div ng-show="formEditSolicitante.$submitted || formEditSolicitante.cargo.$touched">
                <p ng-show="formEditSolicitante.cargo.$error.required" class="help-block col-lg-offset-2 errorRequerido">El cargo es requirido.</p>
            </div>
            <p ng-show="formEditSolicitante.cargo.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formEditSolicitante.cargo.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>
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
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" title="Guardar" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('investigadores/index'); ?>"><button type="button" title="Cancelar" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span> Imprimir</button></a>
                </span>
            </div>
        </div>

    </form>
</div>
