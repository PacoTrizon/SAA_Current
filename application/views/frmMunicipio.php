<script type="text/javascript" src="/SAA/js/controllers/municipiosCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="municipioAgregarCtrl">
    <div class="panel-heading"><h4>Municipios</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('municipios/index'); ?>">Municipios</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form role="form" class="form-horizontal" name="frmMuncipio" id="frmMuncipio" novalidate="">     
        <div class="form-group has-feedback"  ng-class="cssInput(frmMuncipio.descripcion)">
            <label for="descripcion" class="control-label col-lg-1">Descripción:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control col-lg-1" id="descripcion" name="descripcion" ng-model="municipio.descripcion"  ng-maxlength="100" ng-minlength="2" ng-pattern="/^[a-zA-Z\s\. ñáéíóú ÑÁÉÍÓÚ]*$/" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmMuncipio.descripcion)"></span>
            </div>
            <div ng-show="frmMuncipio.$submitted || frmMuncipio.descripcion.$touched">
                <p ng-show="frmMuncipio.descripcion.$error.required" class="help-block errorRequerido">El nombre del municipio es requerido.</p>                        
            </div>
            <p ng-show="frmMuncipio.descripcion.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
            <p ng-show="frmMuncipio.descripcion.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
        </div>  


        <div class="form-group has-feedback" ng-class="cssInput(frmMuncipio.id_estado)">
            <label for="id_pais" class="control-label col-lg-1">Estado:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" required id="id_estado" name="id_estado" ng-model="datos.id_estado">
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(frmMuncipio.id_estado)"></span>
                <div ng-show="frmMuncipio.$submitted || frmMuncipio.id_estado.$touched">
                    <p ng-show="frmMuncipio.id_estado.$error.required" class="help-block errorRequerido">El estado es requerido.</p>   
                </div>
            </div>
        </div>
<!--        <div class="form-group ">
            <label for="estatus" class="col-sm-1 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> -->
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" title="Guardar" ng-click="guardar(frmMuncipio)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('municipios/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>

    </form>       
</div>      