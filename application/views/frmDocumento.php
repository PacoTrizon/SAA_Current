<script type="text/javascript" src="/SAA/js/controllers/documentosCtrl.js"></script>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="documentosCtrl">
    <div class="panel-heading"><h4>Documentos</h4></div>
    <form class="form-horizontal" style="margin-top: 11px;">
        <div class="form-group">
            <label for="nombre" class="col-sm-1 control-label">Descripcion:</label>
            <div class="col-sm-11">
                <input type="text" class="form-control col-lg-1" id="descripcion" ng-model="documento.descripcion" required/>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-sm-1 col-sm-offset-10">
                <button type="button" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
            </div> 
        </div>       
    </form>        

</div>





