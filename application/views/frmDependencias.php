<script type="text/javascript" src="/SAA/js/controllers/dependenciasCtrl.js"></script>
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
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="agregarDependenciaCtrl">
    <div class="panel-heading"><h4>Datos Dependencia</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dependencias/index'); ?>">Dependencias</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form class="form-horizontal" name="formDependencia" novalidate="" style="margin-top: 11px;">
        <div class="form-group">
            <label for="dependencia_padre_id" class="col-sm-2 control-label">Dependencia Padre:</label>
             <div class="col-sm-6">
                <input type="text" class="form-control col-lg-1" id="dependencia_padre_id" ng-model="padre.nombre" />
            </div>


<!--            <div class="col-sm-6 input-group">
                <input type="text" class="form-control col-lg-1" id="dependencia_padre_id" readonly ng-model="padre.nombre" />
                <span class="input-group-btn">
                    <button class="btn btn-danger" ng-show="quitarPadre" type="button" ng-click="removerDepenciaPadre()"><span class="glyphicon glyphicon-remove"></span> Quitar</button>
                    <button class="btn btn-primary" type="button" ng-click="openModal()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                </span>
            </div>           -->
        </div>
        <div class="row col-sm-offset-1">
            <div class="form-group col-sm-6 has-feedback" ng-class="cssInput(formDependencia.clave)">
                <label for="clave" class="col-sm-2 control-label">Clave:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-sm-1" id="clave" name="clave" autofocus ng-maxlength="15" ng-model="dependencia.clave" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.clave)"></span>
                </div>
                <div ng-show="formDependencia.$submitted || formDependencia.clave.$touched">
                    <p ng-show="formDependencia.clave.$error.required" class="help-block col-lg-offset-2 errorRequerido">La clave es requirida.</p>
                </div>
                <p ng-show="formDependencia.clave.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 15</p>

            </div>
            <!--            <div class="form-group col-sm-4  has-feedback" ng-show="mostrarCodigo" ng-class="cssInput(formDependencia.codigo)">
                            <label for="codigo" class="col-sm-2 control-label">Código:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control col-sm-1" ng-maxlength="20" id="codigo" name="codigo" ng-model="dependencia.codigo"/>
                                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.codigo)"></span>
                            </div>
                            <div ng-show="formDependencia.$submitted || formDependencia.codigo.$touched">
                                <p ng-show="formDependencia.codigo.$error.required" class="help-block col-lg-offset-2 errorRequerido">El código es requirido.</p>
                            </div>
                        </div> -->
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formDependencia.nombre)">
            <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="nombre" name="nombre" ng-maxlength="100" ng-minlength="5" ng-pattern="/^[a-zA-Z\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="dependencia.nombre" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.nombre)"></span>
            </div>
            <div ng-show="formDependencia.$submitted || formDependencia.nombre.$touched">
                <p ng-show="formDependencia.nombre.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre de la unidad es requirido.</p>
            </div>
            <p ng-show="formDependencia.nombre.$error.minlength" class="help-block col-lg-offset-2 errorRequerido">El mínimo es de 5</p>
            <p ng-show="formDependencia.nombre.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 100</p>
        </div>

<!--        <div class="form-group">
            <label for="estatusDependencia" class="col-sm-2 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> -->
        <h4><strong>Datos Reponsable</strong></h4>
        <hr size="10px"/>
        <div class="form-group has-feedback" ng-class="cssInput(formDependencia.resposable)">
            <label for="resposable" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="resposable" name="resposable" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="nombre_responsable" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.resposable)"></span>
            </div>
            <div ng-show="formDependencia.$submitted || formDependencia.resposable.$touched">
                <p ng-show="formDependencia.resposable.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre del responsable es requirido.</p>
            </div>
            <p ng-show="formDependencia.resposable.$error.minlength" class="help-block col-lg-offset-2 errorRequerido">El mínimo es de 3</p>
            <p ng-show="formDependencia.resposable.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 50</p>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formDependencia.apellido_paterno)">
            <label for="apellido_paterno" class="col-sm-2 control-label">Apellido Paterno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="apellido_paterno" name="apellido_paterno" ng-minlength="3" ng-maxlength="50" ng-pattern="/^[a-zA-Z ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="apellido_paterno" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.apellido_paterno)"></span>
            </div>
            <div ng-show="formDependencia.$submitted || formDependencia.apellido_paterno.$touched">
                <p ng-show="formDependencia.apellido_paterno.$error.required" class="help-block col-lg-offset-2 errorRequerido">El nombre del responsable es requirido.</p>
            </div>
            <p ng-show="formDependencia.apellido_paterno.$error.minlength" class="help-block col-lg-offset-2 errorRequerido">El mínimo es de 3</p>
            <p ng-show="formDependencia.apellido_paterno.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 50</p>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formDependencia.apellido_materno)">
            <label for="apellido_materno" class="col-sm-2 control-label">Apellido Materno:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" name="apellido_materno" id="apellido_materno" ng-maxlength="50" ng-pattern="/^[a-zA-Z ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="apellido_materno"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.apellido_materno)"></span>
            </div>
               <p ng-show="formDependencia.apellido_materno.$error.maxlength" class="help-block col-lg-offset-2 errorRequerido">El máximo es de 50</p>
        </div>
        <div class="row col-sm-offset-1" >
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formDependencia.titulo)">
                <label for="titulo" class="col-sm-3 control-label">Título:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-lg-1" id="titulo" name="titulo" ng-maxlength="50" ng-model="dependencia.titulo"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.titulo)"></span>
                </div>
            </div>
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formDependencia.telefono)">
                <label for="telefono" class="col-sm-4 control-label">Télefono:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" ng-maxlength="7" ng-minlength="7" id="telefono" ng-pattern="/^[0-9]{1,7}$/" name="telefono" ng-model="dependencia.telefono" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.telefono)"></span>
                </div>
                <div ng-show="formDependencia.$submitted || formDependencia.telefono.$touched">
                    <p ng-show="formDependencia.telefono.$error.required" class="help-block col-lg-offset-2 errorRequerido">El télefono es requirido.</p>
                </div>
                <p ng-show="formDependencia.telefono.$error.minlength" class="help-block errorRequerido">El mínimo es de 7</p>
                <p ng-show="formDependencia.telefono.$error.maxlength" class="help-block errorRequerido">El máximo es de 7</p>
            </div>
            <div class="form-group col-sm-4  has-feedback" ng-class="cssInput(formDependencia.extension)">
                <label for="extension" class="col-sm-4 control-label">Extensión:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" id="extension" name="extension" ng-minlength="1" ng-maxlength="4" ng-minlength="1" ng-pattern="/^[0-9]{1,4}$/" ng-model="dependencia.extension"/>
                     <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.extension)"></span>
                </div>
                <p ng-show="formDependencia.extension.$invalid" class="help-block col-lg-offset-2 errorRequerido">El número es maximo de 4 y no acepta letras.</p>
            </div>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formDependencia.correo_electronico)">
            <label for="correo" class="col-sm-2 control-label">Correo Electrónico:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control col-lg-1" id="correo_electronico" name="correo_electronico" ng-model="dependencia.correo_electronico" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formDependencia.correo_electronico)"></span>
            </div>
            <div ng-show="formDependencia.$submitted || formDependencia.correo_electronico.$touched">
                <p ng-show="formDependencia.correo_electronico.$error.required" class="help-block col-lg-offset-2 errorRequerido">El correo electrónico es requirido.</p>
            </div>
            <p ng-show="formDependencia.correo_electronico.$invalid && !formDependencia.correo_electronico.$pristine" class="help-block col-lg-offset-2 errorRequerido">La dirección de correo no es valida.</p>
        </div>
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('Dependencias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>
</div>
