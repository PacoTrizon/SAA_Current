<script type="text/javascript" src="/SAA/js/controllers/sindicaturasCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="sindicaturaEditCtrl">
    <div class="panel-heading"><h4>Sindicaturas</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('sindicaturas/index'); ?>">Sindicaturas</a></li>
        <li class="active">Editar</li>
    </ol>
    <form role="form" name="frmSindicatura" id="frmSindicatura" novalidate="" class="form-horizontal">        
        <div class="form-group has-feedback"  ng-class="cssInput(frmSindicatura.descripcion)">
            <label for="descripcion" class="control-label col-lg-1">Descripción:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control col-lg-1" id="descripcion" name="descripcion" ng-model="sindicatura.descripcion"  ng-maxlength="100" ng-minlength="2" ng-pattern="/^[a-zA-Z\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmSindicatura.descripcion)"></span>
            </div>
            <div ng-show="frmSindicatura.$submitted || frmSindicatura.descripcion.$touched">
                <p ng-show="frmSindicatura.descripcion.$error.required" class="help-block errorRequerido">El nombre de la sindicatura es requerido.</p>                        
            </div>
            <p ng-show="frmSindicatura.descripcion.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
            <p ng-show="frmSindicatura.descripcion.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
        </div>  

        <div class="form-group has-feedback" ng-class="cssInput(frmSindicatura.id_municipio)">
            <label for="id_municipio" class="control-label col-lg-1">Municipio:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="id_municipio" name="id_municipio" ng-model="datos.id_municipio">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmSindicatura.id_municipio)"></span>
                <div ng-show="frmSindicatura.$submitted || frmSindicatura.id_municipio.$touched">
                    <p ng-show="frmSindicatura.id_municipio.$error.required" class="help-block errorRequerido">El municipio es requerido.</p>   
                </div>
            </div>
        </div>
        <div class="form-group ">
            <label for="estatus" class="col-sm-1 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> 
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmSindicatura)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('sindicaturas/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>        
    </form>       
</div>
