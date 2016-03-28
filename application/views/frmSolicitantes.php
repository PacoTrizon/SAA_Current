<script type="text/javascript" src="/SAA/js/controllers/solicitantesCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="agregarSolicitanteCtrl">
    <div class="panel-heading"><h4>Solicitantes</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('solicitantes/index'); ?>">Solicitantes</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form class="form-horizontal" name="formSolicitantes" id="formSolicitantes" novalidate="" style="margin-top: 11px;">
        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.nombre)" style="margin-left: -40px;">
            <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="nombre" autofocus name="nombre" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="solicitante.nombre" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.nombre)"></span>
            </div>
            <div ng-show="formSolicitantes.$submitted || formSolicitantes.nombre.$touched">
                <p ng-show="formSolicitantes.nombre.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre del solicitante es requirido.</p>
            </div>
            <p ng-show="formSolicitantes.nombre.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formSolicitantes.nombre.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>

        </div>

        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.apellido_paterno)" style="margin-left: -40px;">
            <label for="apellido_paterno" class="col-sm-2 control-label">Apellido Paterno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="apellido_paterno" name="apellido_paterno" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="solicitante.apellido_paterno" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.apellido_paterno)"></span>
            </div>
            <div ng-show="formSolicitantes.$submitted || formSolicitantes.apellido_paterno.$touched">
                <p ng-show="formSolicitantes.apellido_paterno.$error.required" class="help-block col-lg-offset-2 errorRequerido">El apellido paterno del solicitante es requirido.</p>
            </div>
            <p ng-show="formSolicitantes.apellido_paterno.$error.minlength" class="help-block errorRequerido  col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formSolicitantes.apellido_paterno.$error.maxlength" class="help-block errorRequerido  col-sm-offset-2">El máximo es de 100</p>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.apellido_materno)" style="margin-left: -40px;">
            <label for="apellido_materno" class="col-sm-2 control-label">Apellido Materno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="apellido_materno" name="apellido_materno" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="solicitante.apellido_materno"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.apellido_materno)"></span>
            </div>
            <p ng-show="formSolicitantes.apellido_materno.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formSolicitantes.apellido_materno.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.correo)" style="    margin-left: -40px;">
            <label for="correo" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control col-lg-1" id="correo" name="correo" ng-model="solicitante.correo_electronico"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.correo)"></span>
            </div>
            <p ng-show="formSolicitantes.correo.$invalid && !formSolicitantes.correo.$pristine" class="help-block col-lg-offset-2 errorRequerido">La dirección de correo no es valida.</p>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.dependencia)" style="margin-left: -40px;">
            <label for="dependencia" class="col-sm-2 control-label">Dependencia:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" ng-change="" required id="dependencia" name="dependencia" ng-model="datos.id_pais">                  
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.dependencia)"></span>
                <div ng-show="formSolicitantes.$submitted || formSolicitantes.dependencia.$touched">
                    <p ng-show="formSolicitantes.dependencia.$error.required" class="help-block errorRequerido">La dependencia es requirido.</p>
                </div>
            </div>
        </div>
        <!--        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.dependencia)" style="margin-left: -40px;">
                    <label for="dependencia" class="col-sm-2 control-label">Dependencia:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="dependencia" name="dependencia" ng-model="solicitante.dependencia_id" ng-options="item.dependencia_id as item.nombre for item in dependencias" required>
                            <option value="">Seleccione una Dependencia</option>
                        </select>                   
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.dependencia)"></span>
                        <div ng-show="formSolicitantes.$submitted || formSolicitantes.dependencia.$touched">
                            <p ng-show="formSolicitantes.dependencia.$error.required" class="help-block errorRequerido">La dependencia es requirido.</p>
                        </div>
                    </div>
                </div>-->
        <div class="row" style="    margin-left: 53px;" >
            <div class="form-group col-sm-4 has-feedback" style="    margin-left: auto;" ng-class="cssInput(formSolicitantes.telefono)">
                <label for="telefono" class="col-sm-4 control-label">Télefono:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" id="telefono" name="telefono" ng-maxlength="10" ng-minlength="7"ng-pattern="/^[0-9]{1,10}$/" ng-model="solicitante.telefono" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.telefono)"></span>
                </div>
                <div ng-show="formSolicitantes.$submitted || formSolicitantes.telefono.$touched">
                    <p ng-show="formSolicitantes.telefono.$error.required" class="help-block errorRequerido">El télefono del solicitante es requirido.</p>
                </div>
                <p ng-show="formSolicitantes.telefono.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 7 </p>
                <p ng-show="formSolicitantes.telefono.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 10</p>
            </div>
            <div class="form-group col-sm-4  has-feedback" ng-class="cssInput(formSolicitantes.extension)">
                <label for="extension" class="col-sm-5 control-label">Extensión:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="extension" name="extension" ng-minlength="1" ng-maxlength="4" ng-pattern="/^[0-9]{1,4}$/" ng-model="solicitante.extension"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.extension)"></span>
                </div>
                <p ng-show="formSolicitantes.extension.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 4 y no se aceptan letras</p>
                <p ng-show="formSolicitantes.extension.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 4 y no se aceptan letras</p>
            </div>
            <div class="form-group col-sm-4  has-feedback" ng-class="cssInput(formSolicitantes.celular)">
                <label for="celular" class="col-sm-5 control-label">Celular:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="celular" name="celular" ng-minlength="10" ng-maxlength="10" ng-pattern="/^[0-9]{1,10}$/" ng-model="solicitante.celular"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.celular)"></span>
                </div>
                <p ng-show="formSolicitantes.celular.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 10 y no se aceptan letras</p>
                <p ng-show="formSolicitantes.celular.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 10 y no se aceptan letras</p>
            </div>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formSolicitantes.cargo)" style="    margin-left: -40px;">
            <label for="cargo" class="col-sm-2 control-label">Cargo:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="cargo" name="cargo" ng-maxlength="100" ng-minlength="3"  ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="solicitante.cargo" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formSolicitantes.cargo)"></span>
            </div>
            <div ng-show="formSolicitantes.$submitted || formSolicitantes.cargo.$touched">
                <p ng-show="formSolicitantes.cargo.$error.required" class="help-block col-lg-offset-2 errorRequerido">El cargo es requirido.</p>
            </div>
            <p ng-show="formSolicitantes.cargo.$error.minlength" class="help-block errorRequerido col-sm-offset-2">El mínimo es de 3</p>
            <p ng-show="formSolicitantes.cargo.$error.maxlength" class="help-block errorRequerido col-sm-offset-2">El máximo es de 100</p>
        </div>
        <!--        <div class="form-group">
                    <label for="estatusDependencia" class="col-sm-2 control-label">Estatus:</label>
                    <div class="col-sm-8">
                        <div class="btn-group">
                            <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                            <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                        </div>
                    </div>
                </div>   -->
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" title="Guargar" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('solicitantes/index'); ?>"><button type="button" title="Cancelar" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span> Imprimir</button></a>
                </span>
            </div>
        </div>

    </form>
</div>
