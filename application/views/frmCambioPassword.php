<script type="text/javascript" src="/SAA/js/controllers/usuarioCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="usuarioCambioPasswordCtrl">
    <div class="panel-heading"><h4>Cambio de Contraseña</h4></div>
    <form class="form-horizontal" name="frmCambioPassword" novalidate="" style="margin-top: 11px;">
        <div class="form-group">
            <label for="dependencia_padre_id" class="col-sm-2 control-label">Usuario:</label>
            <div class="col-sm-6">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="dependencia_padre_id" ng-model="usuario.usuario" />               
            </div>
        </div>   
        <div class="form-group has-feedback" ng-class="cssInput(frmCambioPassword.password_actual)">
            <label for="password_actual" class="col-sm-2 control-label">Contraseña Actual:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control col-lg-1" id="password_actual" name="password_actual" ng-maxlength="100" ng-minlength="5" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="usuario.password_actual" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmCambioPassword.password_actual)"></span>
            </div>
            <div ng-show="frmCambioPassword.$submitted || frmCambioPassword.password_actual.$touched">
                <p ng-show="frmCambioPassword.password_actual.$error.required" class="help-block col-lg-offset-2 errorRequerido">La contreseña actual es requerida.</p>
            </div>           
        </div>  
        <div class="form-group has-feedback" ng-class="cssInput(frmCambioPassword.password_nueva)">
            <label for="password_nueva" class="col-sm-2 control-label">Nueva Contraseña:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control col-lg-1" id="password_nueva" name="password_nueva" ng-maxlength="100" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="usuario.password_nueva" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmCambioPassword.password_nueva)"></span>
            </div>
            <div ng-show="frmCambioPassword.$submitted || frmCambioPassword.password_nueva.$touched">
                <p ng-show="frmCambioPassword.password_nueva.$error.required" class="help-block col-lg-offset-2 errorRequerido">La nueva contraseña es requerida.</p>
            </div>         
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(frmCambioPassword.confirmacion_password)">
            <label for="confirmacion_password" class="col-sm-2 control-label">Confirmar Contraseña:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control col-lg-1" id="confirmacion_password" name="confirmacion_password" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="usuario.confirmacion_password" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmCambioPassword.resposable)"></span>
            </div>
            <div ng-show="frmCambioPassword.$submitted || frmCambioPassword.confirmacion_password.$touched">
                <p ng-show="frmCambioPassword.confirmacion_password.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre del responsable es requirido.</p>
            </div>           
        </div> 
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-click="guardar(frmCambioPassword)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('dependencias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>         
    </form>         
</div>





