<script type="text/javascript" src="/SAA/js/controllers/investigadoresCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="investigadoresCtrl">
    <div class="panel-heading"><h4>Investigadores</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('investigadores/index'); ?>">
             <div class="btn-group col-lg-3 col-lg-offset-0">
                 <select class="form-control" id="estatus" name="estatus">
                    <option value="1" <?php if (intval($estatus == 1)) echo 'selected'; ?>>Activo</option> 
                    <option value="0" <?php if (intVal($estatus == 0)) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" style=" margin-top: 1px;" <?php echo 'value="'.$buscar.'"'; ?> id="buscar" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default glyphicon glyphicon-search" type="submit"></span></button>
                    </span>
                </div>
            </div>           
        </form>        
        <a href="<?php echo base_url('investigadores/agregar'); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a>
        <button type="button" class="btn btn-warning" ng-click="imprimir()"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
<!--        <a href="<?php echo base_url('investigadores/imprimir'); ?>"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> Imprimir</button></a>-->
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Número Investigador</th>
                    <th>Nombre</th>
                    <th>Télefono</th>
                    <th>Nombre De La Institución</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado != 0) {
                    foreach ($resultado as $key => $results) {
                        echo '<tr>';
                        echo '<td>' . $results->numero_investigador . '</td>';
                        echo '<td>' . $results->nombre . ' ' . $results->apellido_paterno . ' ' . $results->apellido_materno . '</td>';
                        echo '<td>' . $results->telefono . '</td>';
                        echo '<td>' . $results->nombre_institucion . '</td>';
                        if (intval($results->estatus) == 1)
                            echo '<td>ACTIVO</td>';
                        else
                            echo '<td>INACTIVO</td>';
                        echo '<td><a href="' . base_url('investigadores/editar/?id=' . $results->id_investigador) . '"><button type="button" title="Editar" class="btn btn-primary glyphicon glyphicon-pencil"></button></a></td>';
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




