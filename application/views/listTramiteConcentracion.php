<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="tramiteConcentracionCtrl">
    <div class="panel-heading"><h4>Tramite y concentración</h4></div>
    <div class="row" style="margin-top: 11px;">
        <form method="GET" style="margin-top: 13px;" action="<?php echo base_url('tramite_concentracion/index'); ?>">
            <div class="btn-group col-lg-3 col-lg-offset-0">
                <select class="form-control" id="estatus" name="estatus">
                    <option value="1" >Activo</option>
                    <option value="0" >Inactivo</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar" style=" margin-top: 1px;"  id="buscar" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default glyphicon glyphicon-search" type="submit"></span></button>
                    </span>
                </div>
            </div>
        </form>
        <a href="<?php echo base_url('Tramite_Concentracion/agregar'); ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</button></a>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>Disponibilidad</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado != 0) {
                    foreach ($resultado as $key => $results) {
                        $disponibilidad = "";
                        switch (intval($results->disponibilidad)) {
                            case 0:
                                $disponibilidad = "Disponible";
                                break;
                            case 1:
                                $disponibilidad = "Prestado";
                                break;
                            case 2:
                                $disponibilidad = "Prestado Parcialmente";
                                break;
                        }

                        echo '<tr>';
                        echo '<td>' . $results->clave . '</td>';
                        echo '<td>' . $results->descripcion . '</td>';
                        echo '<td>' . $disponibilidad . '</td>';
                        if (intval($results->estatus) == 1)
                            echo '<td>ACTIVO</td>';
                        else
                            echo '<td>INACTIVO</td>';
                        echo '<td><a href="' . base_url('Tramite_Concentracion/editar/?id=' . base64_encode($results->id_tramite)) . '"><button type="button" title="Editar" class="btn btn-primary glyphicon glyphicon-pencil"></button></a></td>';
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
