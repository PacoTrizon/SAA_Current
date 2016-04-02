<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Servicios de Expedientes</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('servicio_expediente/index'); ?>">           
            <div class="btn-group col-lg-3 col-lg-offset-0">
                <select class="form-control" id="estatus" name="estatus">
                    <option value="1" <?php if (intval($estatus == 1)) echo 'selected'; ?>>Activo</option> 
                    <option value="0" <?php if (intVal($estatus == 0)) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" style=" margin-top: 1px;"  <?php echo 'value="' . $buscar . '"'; ?> id="buscar" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default glyphicon glyphicon-search" type="submit"></span></button>
                    </span>
                </div>
            </div>
        </form>        
        <a href="<?php echo base_url('servicio_expediente/agregar'); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Clave</th>
                    <th>Nombre Solicitante</th>
                    <th>Motivo</th>
                    <th>Observaciones</th>
                    <th>Estatus</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado != 0) {
                    foreach ($resultado as $key => $results) {
                        $tipo_solicitante = 0;
                        if ($results->solicitante_id != null)
                            $tipo_solicitante = 1;
                        echo '<tr>';
                        echo '<td>' . $results->servicio_id . '</td>';
                        echo '<td>' . $results->nombre_solicitante . '</td>';
                        echo '<td>' . $results->motivo . '</td>';
                        echo '<td>' . $results->observaciones . '</td>';
                        if (intval($results->estatus) == 1)
                            echo '<td>PRESTADO</td>';
                        else
                            echo '<td>DEVUELTO</td>';
                        echo '<td><a href="' . base_url('servicio_expediente/imprimir/?servicio_id=' . $results->servicio_id) . '&tipo_solictante='.$tipo_solicitante.'"><button type="button" title="Imprimir" class="btn btn-primary glyphicon glyphicon-print"></button></a></td>';
//                        echo '<td><a href="' . base_url('servicio_expediente/devolucion/?servicio_id=' . $results->servicio_id) . '&tipo_solictante='.$tipo_solicitante.'"><button type="button" title="Devolución" class="btn btn-danger glyphicon glyphicon-transfer"></button></a></td>';
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
</div>




