<script type="text/javascript" src="/SAA/js/controllers/asentamientosCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="asentamientosCtrl">
    <div class="panel-heading"><h4>Tipo de Asentamientos</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('asentamientos/index'); ?>">
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
<!--        <button type="button" class="btn btn-primary" ng-click="agregar()"><span class="glyphicon glyphicon-plus"></span> Nuevo</button>-->
        <a href="<?php echo base_url('asentamientos/agregar'); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a>
               <!--<a href="<?php echo base_url('asentamientos/imprimir'); ?>"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> Imprimir</button></a>-->
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado != 0) {
                    foreach ($resultado as $key => $results) {
                        echo '<tr>';
                        echo '<td>' . $results->descripcion . '</td>';
                        if (intval($results->estatus) == 1)
                            echo '<td>ACTIVO</td>';
                        else
                            echo '<td>INACTIVO</td>';
                        echo '<td><a href="' . base_url('asentamientos/editar/?id=' . $results->id_asentamiento) . '"><button type="button" title="Editar" class="btn btn-primary glyphicon glyphicon-pencil"></button></a></td>';
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
    <!--    <modal title="REGISTRO DE ASENTAMIENTO" visible="showModal">
            <form role="form">
                <div class="form-group">
                    <label for="nombre">Descipcion:</label>
                    <input type="text" class="form-control" ng-focus="true" ng-model="asentamiento.descripcion" id="editAsentamientoDescripcion" name="editAsentamientoDescripcion" required/>
                </div>   
                <div class="form-group">
                    <label for="estatus">Estatus:</label>
                    <select class="form-control" ng-model="asentamiento.estatus" ng-options="item.id as item.titulo for item in estatus" required id="estatus">
                        <option value="">Seleccione un estatus</option>
                    </select>
                </div>          
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar()">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" title="Cerrar">Cerrar</button>
                </div>
            </form>       
        </modal>-->
</div>




