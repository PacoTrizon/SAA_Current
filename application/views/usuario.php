<script type="text/javascript" src="/SAA/js/controllers/usuarioCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="usuarioCtrl">
    <div class="panel-heading"><h4>Usuarios</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('usuarios/index'); ?>">
            <div class="btn-group col-lg-3 col-lg-offset-0">
                <select class="form-control" id="estatus" name="estatus">
                    <option value="1" <?php if (intval($estatus == 1)) echo 'selected'; ?>>Activo</option> 
                    <option value="0" <?php if (intVal($estatus == 0)) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" style=" margin-top: 1px;" <?php echo 'value="' . $buscar . '"'; ?> id="buscar" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default glyphicon glyphicon-search" type="submit"></span></button>
                    </span>
                </div>
            </div>           
        </form>        
        <button type="button" class="btn btn-primary" ng-click="open()" ng-show="<?php $existe=property_exists($permisos, 'usuarios.guardar'); echo $existe; ?>"><span class="glyphicon glyphicon-plus"></span> Nuevo</button>
        <button type="button" class="btn btn-warning" ng-click="imprimir()" ng-show="<?php $existe=property_exists($permisos, 'usuarios.imprimir'); echo $existe; ?>"><span class="glyphicon glyphicon-print"></span> Imprimir</button></a>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Usuario</th>
                    <th>Nombre comleto</th>
                    <th>Dependencia</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th ng-show="<?php $existe=property_exists($permisos, 'usuarios.actualizar'); echo $existe; ?>">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($results != 0) {
                    foreach ($results as $key => $dataUser) {
                        echo '<tr>';
                        echo '<td>' . $results[$key]->usuario . '</td>';
                        echo '<td>' . $results[$key]->nombre . ' ' . $results[$key]->apellido_paterno . ' ' . $results[$key]->apellido_materno . '</td>';
                        echo '<td>' . $results[$key]->nombre_dependencia . '</td>';
                        echo '<td>' . $results[$key]->nombre_perfil . '</td>';
                        if (intval($results[$key]->estatus) == 1)
                            echo '<td>ACTIVO</td>';
                        else
                            echo '<td>INACTIVO</td>';
                        echo '<td ng-show="'.property_exists($permisos, "usuarios.actualizar").'"><a href="' . base_url('usuarios/editar/?id=' . $results[$key]->id) . '"><button type="button" class="btn btn-primary glyphicon glyphicon-pencil"></button></a></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>    

    <nav class="col-lg-6">
        <ul class="pagination">
            <?php
            foreach ($links as $link) {
                echo "<li>" . $link . "</li>";
            }
            ?>
        </ul>
    </nav>
    <modal title="REGISTRO DE USUARIOS" visible="showModal">
        <form name="formAgregarUsuario" id="formAgregarUsuario" novalidate="">
            <div class="form-group has-feedback" ng-class="cssInput(formAgregarUsuario.nombre)">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" ng-model="usuario.nombre" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/"  required ng-change="cambioNombre()"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.nombre)"></span>
                <div ng-show="formAgregarUsuario.$submitted || formAgregarUsuario.nombre.$touched">
                    <p ng-show="formAgregarUsuario.nombre.$error.required" class="help-block errorRequerido">El nombre del usuario es requirido.</p>
                </div>
                <p ng-show="formAgregarUsuario.nombre.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formAgregarUsuario.nombre.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(formAgregarUsuario.ape_paterno)">
                <label for="ape_paterno">Apellido Paterno:</label>
                <input type="text" class="form-control" id="ape_paterno" name="ape_paterno" ng-model="usuario.apellido_paterno" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" required ng-change="cambioNombre()"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.ape_paterno)"></span>
                <div ng-show="formAgregarUsuario.$submitted || formAgregarUsuario.ape_paterno.$touched">
                    <p ng-show="formAgregarUsuario.ape_paterno.$error.required" class="help-block errorRequerido">El apellido paterno es requirido.</p>
                </div>
                <p ng-show="formAgregarUsuario.ape_paterno.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formAgregarUsuario.ape_paterno.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
            </div>
            <div class="form-group has-feedback" ng-class="cssInput(formAgregarUsuario.ape_materno)">
                <label for="ape_materno">Apellido Materno:</label>
                <input type="text" class="form-control" id="ape_materno" name="ape_materno" ng-model="usuario.apellido_materno" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.ape_materno)"></span>
                <div ng-show="formAgregarUsuario.$submitted || formAgregarUsuario.ape_materno.$touched">
                    <p ng-show="formAgregarUsuario.ape_materno.$error.required" class="help-block errorRequerido">El apellido materno es requirido.</p>
                </div>
                <p ng-show="formAgregarUsuario.ape_materno.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formAgregarUsuario.ape_materno.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 has-feedback"  ng-class="cssInput(formAgregarUsuario.email)">
                    <label for="email">Correo Electronico:</label>
                    <input type="email" class="form-control" id="email" name="email" ng-model="usuario.correo" required>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.email)"></span>
                    <p ng-show="formAgregarUsuario.email.$invalid && !formAgregarUsuario.email.$pristine" class="help-block col-lg-offset-2 errorRequerido">La dirección de correo no es valida.</p>
                </div>

                <div class="form-group col-lg-5">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" ng-model="usuario.usuario" ng-disabled="true">
                </div>
            </div>

            <div class="form-group has-feedback" ng-class="cssInput(formAgregarUsuario.dependencia)">
                <label for="dependencia">Dependencia:</label>                
                <select class="form-control" ng-model="usuario.id_dependencia" ng-options="item.dependencia_id as item.nombre for item in dependencias" required  id="dependencia" name="dependencia">
                    <option value="">Seleccione una dependencia</option>
                </select>           
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.dependencia)"></span>
                <div ng-show="formAgregarUsuario.$submitted || formAgregarUsuario.dependencia.$touched">
                    <p ng-show="formAgregarUsuario.dependencia.$error.required" class="help-block errorRequerido">La dependencia es requirida.</p>
                </div>               
            </div>

            <div class="form-group has-feedback"  ng-class="cssInput(formAgregarUsuario.perfil)">
                <label for="perfil">Perfil:</label>
                <select class="form-control" ng-model="usuario.id_perfil" ng-options="item.id_perfil as item.descripcion for item in perfiles" required id="perfil" name="perfil">
                    <option value="">Seleccione un perfil</option>
                </select>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formAgregarUsuario.perfil)"></span>
                <div ng-show="formAgregarUsuario.$submitted || formAgregarUsuario.perfil.$touched">
                    <p ng-show="formAgregarUsuario.perfil.$error.required" class="help-block errorRequerido">El perfil es requirido.</p>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-disabled="mostrarGuardar" ng-click="guardar(formAgregarUsuario)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button>
            </div>
        </form>       
    </modal>
</div>

