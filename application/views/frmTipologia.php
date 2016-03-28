<script type="text/javascript" src="/SAA/js/controllers/tipologiasCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="tipologiasAgregarCtrl">
    <div class="panel-heading"><h4>Tipologías</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('tipologias/index'); ?>">Tipologías</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form role="form" class="form-horizontal" name="frmTipologia" id="frmTipologia" novalidate="">
        <div class="form-group has-feedback" ng-class="cssInput(frmTipologia.descripcion)">
            <label for="descripcion" class="col-sm-1 control-label">Descripcion:</label>
            <div class="col-sm-8">
                <input type="text" autofocus class="form-control col-lg-1" id="descripcion" name="descripcion" ng-maxlength="100" ng-minlength="2" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" ng-model="tipologia.descripcion" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmTipologia.descripcion)"></span>
            </div>
            <div ng-show="frmTipologia.$submitted || frmTipologia.descripcion.$touched">
                <p ng-show="frmTipologia.descripcion.$error.required" class="help-block errorRequerido">El nombre del asentamiento es requirido.</p>                        
            </div>
            <p ng-show="frmTipologia.descripcion.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
            <p ng-show="frmTipologia.descripcion.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
        </div>    
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmTipologia)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('tipologias/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>

    </form>       
</div>