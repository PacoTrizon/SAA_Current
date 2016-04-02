<script type="text/javascript" src="/SAA/js/controllers/coloniasCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Colonias</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('colonias/index'); ?>">
            <div class="btn-group col-lg-3 col-lg-offset-0">
                <select class="form-control" id="estatus" name="estatus">
                    <option value="1" <?php if (intval($estatus == 1)) echo 'selected'; ?>>Activo</option> 
                    <option value="0" <?php if (intVal($estatus == 0)) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" style=" margin-top: 1px;" <?php echo 'value="'.$buscar.'"'; ?> id="coloniaBuscar" name="coloniaBuscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default glyphicon glyphicon-search" type="submit"></span></button>
                    </span>
                </div>
            </div>          
        </form>        
        <a href="<?php echo base_url('colonias/agregar'); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a>

<!--        <a href="<?php echo base_url('colonias/imprimir'); ?>"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> Imprimir</button></a>-->
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Descripcion</th>
                    <th>Sindicatura</th>
                    <th>Tipo de Asentamiento</th>
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
                        echo '<td>' . $results->nombre_sindicatura . '</td>';
                        echo '<td>' . $results->nombre_asentamiento . '</td>';
                        if (intval($results->estatus) == 1)
                            echo '<td>ACTIVO</td>';
                        else
                            echo '<td>INACTIVO</td>';
                        echo '<td><a href="' . base_url('colonias/editar/?id=' . $results->id_colonia) . '"><button type="button" title="Editar" class="btn btn-primary glyphicon glyphicon-pencil"></button></a></td>';
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
    <!--    <modal title="REGISTRO DE COLONIA" visible="showModal">
            <form role="form">
                <div class="form-group">
                    <label for="nombre">Descipcion:</label>
                    <input type="text" class="form-control" ng-focus="true" ng-model="colonia.descripcion" id="editMunicipioDescripcion" name="editMunicipioDescripcion" required/>
                </div>   
                <div class="form-group">
                        <label for="estatus">Sindicatura:</label>
                        <select class="form-control" ng-model="colonia.id_municipio" ng-options="item.id_sindicatura as item.descripcion for item in sindicaturas" required id="id_municipio">
                            <option value="">Seleccione una sindicatura</option>
                        </select>
                    </div>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label for="estatus">Asentamiento:</label>
                        <select class="form-control" ng-model="colonia.id_asentamiento" ng-options="item.id_asentamiento as item.descripcion for item in asentamientos" required id="id_municipio">
                            <option value="">Seleccione un asentamiento</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="estatus">Estatus:</label>
                        <select class="form-control" ng-model="colonia.estatus" ng-options="item.id as item.titulo for item in estatus" required id="estatus">
                            <option value="">Seleccione un estatus</option>
                        </select>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar()">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" title="Cerrar">Cerrar</button>
                </div>
            </form>       
        </modal>-->
</div>




