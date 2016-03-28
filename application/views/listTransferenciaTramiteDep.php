<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Transferencias <?php echo $nombre ?></h4></div>
    <div class="row" >
            <div class="col-lg-5" style="margin-top:13px;margin-left:25%;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Dependencia" style=" margin-top: 1px;"  id="buscarTTD" name="buscar">
                    <span class="input-group-btn" >
                        <button class="btn btn-default glyphicon glyphicon-search" type="button" onclick="getTranferenciaTramiteDep()" ></span></button>
                    </span>
                </div>
            </div>

            <div class="col-lg-2" style="margin-top: 13px;">
              <input type="button" class="btn btn-primary" onclick="transferirRev()" value="Transferir">
            </div>
    </div>
    <div class="panel-body">
        <input type="hidden" id="tipoed" >
        <input type="hidden" name="std" id="std" value="<?php echo $std?>">
        <input type="hidden" name="std2" id="std2" value="<?php echo $std2?>">
        <table class="table table-striped">
            <thead style="background-color: darkorange;">
                <tr>
                    <th>Clave</th>
                    <th>Descrición</th>
                    <th>Disponibilidad</th>
                    <th>Estado</th>
                    <th style="text-align:center;">Selecionar</th>
                </tr>
            </thead>
            <tbody id="tbodyTTD">


            </tbody>
        </table>
    </div>
    <nav class="col-lg-6">
        <ul class="pagination">
            <?php if(isset($links)){
            foreach ($links as $link) {
                echo "<li>" . $link . "</li>";
            }}
            ?>
        </ul>
    </nav>
</div>
