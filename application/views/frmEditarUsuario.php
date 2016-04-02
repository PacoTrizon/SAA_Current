<script type="text/javascript" src="/SAA/js/controllers/usuarioCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="usuarioEditCtrl">
    <div class="panel-heading"><h4>Usuario</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('usuarios/index'); ?>">Usuarios</a></li>
        <li class="active">Editar</li>
    </ol>
    <form role="form">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-lg-1" id="nombre" ng-model="usuario.nombre" required ng-change="cambioNombre()"/>
        </div>
        <div class="form-group">
            <label for="ape_paterno">Apellido Paterno:</label>
            <input type="text" class="form-control" id="ape_paterno" ng-model="usuario.apellido_paterno" required ng-change="cambioNombre()"/>
        </div>
        <div class="form-group">
            <label for="ape_materno">Apellido Materno:</label>
            <input type="text" class="form-control" id="ape_materno" ng-model="usuario.apellido_materno" required/>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="email">Correo Electronico:</label>
                <input type="email" class="form-control" id="email" ng-model="usuario.correo" required>
            </div>

            <div class="form-group col-lg-5">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" ng-model="usuario.usuario" ng-disabled="true">
            </div>
        </div>

        <div class="form-group">
            <label for="dependencia">Dependencia:</label>
            <select class="form-control" ng-model="usuario.id_dependencia" ng-options="item.dependencia_id as item.nombre for item in dependencias" required  id="dependencia">
                <option value="">Seleccione una dependencia</option>
            </select>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="rol">Rol:</label>
                <select class="form-control" ng-model="usuario.id_rol" ng-options="item.id_rol as item.rol for item in roles" required id="rol">
                    <option value="">Seleccione un rol</option>
                </select>
            </div>

            <div class="form-group col-lg-5">
                <label for="estatus">Estatus:</label>
                <select class="form-control" ng-model="usuario.estatus" ng-options="item.id as item.titulo for item in estatus" required id="estatus">
                    <option value="">Seleccione un estatus</option>
                </select>
            </div>
        </div>
        <div class="form-group col-lg-2 col-lg-offset-10">
            <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
            <a href="<?php echo base_url('usuarios/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
        </div>

    </form>       
</div>



