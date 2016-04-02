<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Colonias</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('colonias/index'); ?>">Colonias</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url('colonias/guardar'); ?>">
        <div class="form-group has-feedback"  ng-class="cssInput(frmColonia.descripcion)">
            <label for="descripcion" class="control-label col-lg-1">Descripción:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control col-lg-1" autofocus id="descripcion" name="colonia[descripcion]" maxlength="200" minlength="2" required/>
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>   
        <div class="form-group has-feedback"  ng-class="cssInput(frmColonia.sindicatura)" >
            <label for="sindicatura" class="control-label col-lg-1">Sindicatura:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="sindicatura" name="colonia[id_sindicatura]" ng-model="datos.id_sindicatura">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.sindicatura)"></span>              
            </div>
        </div>
        <div class="form-group has-feedback" ng-class="cssInput(frmColonia.asentamiento)">
            <label for="asentamiento" class="col-sm-1 control-label">Tipo Asentamiento:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="asentamiento" name="colonia[id_asentamiento]" ng-model="datos.id_asentamiento">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.asentamiento)"></span>
            </div>
        </div>  
        <div class="form-group has-feedback" ng-class="cssInput(frmColonia.codigo_postal)">
            <label for="codigo_postal" class="col-sm-1 control-label">Código Postal:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="codigo_postal" name="colonia[codigo_postal]" ng-model="colonia.codigo_postal" ng-maxlength="5" ng-minlength="5" ng-pattern="/^[0-9]{1,5}$/">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmColonia.codigo_postal)"></span>
            </div>
           
        </div>  
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmColonia)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('colonias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>       
</div>