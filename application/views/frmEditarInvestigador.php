<script type="text/javascript" src="/SAA/js/controllers/investigadoresCtrl.js"></script>
<style>
    hr {
        -moz-border-bottom-colors: none;
        -moz-border-image: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #EEEEEE -moz-use-text-color #FFFFFF;
        border-style: dotted;
        border-width: 1px 0;
        margin: 18px 0;
    }
</style>
<div class="panel panel-default col-lg-10 col-lg-offset-1" ng-controller="investigadoresEditCtrl">
    <div class="panel-heading"><h4>Investigador</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('investigadores/index'); ?>">Investigadores</a></li>
        <li class="active">Editar</li>
    </ol>
    <form class="form-horizontal" name="formEditarInvestigadores" id="formEditarInvestigadores" novalidate="" style="margin-top: 11px;">
        <div class="row" style="    margin-left: -65px;">
            <div class="form-group col-sm-9">
                <div class="form-group">
                    <label for="numero_investigador" class="col-sm-3 control-label">Número Investigador:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" readonly id="numero_investigador" ng-model="investigador.numero_investigador" />               
                    </div>   
                </div>
                <div class="form-group has-feedback"  ng-class="cssInput(formEditarInvestigadores.nombre)">
                    <label for="nombre" class="col-sm-3 control-label">Nombre:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" autofocus id="nombre" name="nombre" ng-maxlength="50" ng-minlength="2" ng-pattern="/^[a-zA-Z\s\. ñáéíóú]*$/" ng-model="investigador.nombre" required/>
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.nombre)"></span>
                        <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.nombre.$touched">
                            <p ng-show="formEditarInvestigadores.nombre.$error.required" class="help-block errorRequerido">El nombre del investigador es requirido.</p>                        
                        </div>
                        <p ng-show="formEditarInvestigadores.nombre.$error.minlength" class="help-block errorRequerido">El mínimo es de 2</p>
                        <p ng-show="formEditarInvestigadores.nombre.$error.maxlength" class="help-block errorRequerido">El máximo es de 50</p>
                    </div>                      
                </div>
                <div class="form-group has-feedback"  ng-class="cssInput(formEditarInvestigadores.apellido_paterno)">
                    <label for="apellido_paterno" class="col-sm-3 control-label">Apellido Paterno:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z\s\. ñáéíóú]*$/"  ng-model="investigador.apellido_paterno" required/>               
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.apellido_paterno)"></span>
                        <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.apellido_paterno.$touched">
                            <p ng-show="formEditarInvestigadores.apellido_paterno.$error.required" class="help-block errorRequerido">El apellido paterno es requirido.</p>                        
                        </div>
                        <p ng-show="formEditarInvestigadores.apellido_paterno.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                        <p ng-show="formEditarInvestigadores.apellido_paterno.$error.maxlength" class="help-block errorRequerido">El máximo es de 50</p>
                    </div>                       
                </div>
                <div class="form-group has-feedback"  ng-class="cssInput(formEditarInvestigadores.apellido_materno)">
                    <label for ="apellido_materno" class="col-sm-3 control-label">Apellido Materno:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z\s\. ñáéíóú]*$/" ng-model="investigador.apellido_materno" />               
                        <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.apellido_materno)"></span>
                        <p ng-show="formEditarInvestigadores.apellido_materno.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                        <p ng-show="formEditarInvestigadores.apellido_materno.$error.maxlength" class="help-block errorRequerido">El máximo es de 50</p>
                    </div>                   
                </div>
            </div>
            <div class="form col-sm-1 ">
                <div class="form-group">
                    <img src="/SAA/img/desconocido.png" alt="Desconocido" id="imagenPreview" class="img-rounded col-sm-offset-1" style="    width: 147px;">
                </div>
                <div class="col-lg-10">
                    <input type="file" id="fileInput" name="fileInput" class="filestyle" data-input="false" data-buttonName="btn-primary" data-buttonText="Imagen">      
                </div>                    
            </div>                  
        </div>  
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.calle)" style="margin-left: -40px;">
            <label for="calle" class="col-sm-2 control-label">Calle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="calle" name="calle" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="investigador.calle"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.calle)"></span>
                <p ng-show="formEditarInvestigadores.calle.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formEditarInvestigadores.calle.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
            </div>                  
        </div> 
        <div class="row" style="margin-left: 53px;" >
            <div class="form-group col-sm-3 has-feedback" ng-class="cssInput(formEditarInvestigadores.numero_exterior)">
                <label for="numero_exterior" class="col-sm-6 control-label">Número Exterior:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" id="numero_exterior" name="numero_exterior" ng-maxlength="10" ng-minlength="1"ng-pattern="/^[a-zA-Z0-9\-]*$/" ng-model="investigador.numero_exterior"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.numero_exterior)"></span>
                    <p ng-show="formEditarInvestigadores.numero_exterior.$error.minlength" class="help-block errorRequerido">El mínimo es de 1 </p>
                    <p ng-show="formEditarInvestigadores.numero_exterior.$error.maxlength" class="help-block errorRequerido">El máximo es de 10</p>
                </div>                
            </div> 
            <div class="form-group col-sm-3 has-feedback" ng-class="cssInput(formEditarInvestigadores.numero_interior)">
                <label for="numero_interior" class="col-sm-6 control-label">Número Interior:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" ng-maxlength="10" ng-minlength="1" id="numero_interior" ng-pattern="/^[a-zA-Z0-9\-]*$/" name="numero_interior" ng-model="investigador.numero_interior"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.numero_interior)"></span>
                    <p ng-show="formEditarInvestigadores.numero_interior.$error.minlength" class="help-block errorRequerido">El mínimo es de 1</p>
                    <p ng-show="formEditarInvestigadores.numero_interior.$error.maxlength" class="help-block errorRequerido">El máximo es de 10</p>
                </div>               
            </div> 
            <div class="form-group col-sm-3  has-feedback" ng-class="cssInput(formEditarInvestigadores.extension)">
                <label for="extension" class="col-sm-5 control-label">Extensión:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="extension" name="extension" ng-minlength="1" ng-maxlength="4" ng-pattern="/^[0-9]{1,4}$/" ng-model="investigador.extension"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.extension)"></span>
                    <p ng-show="formEditarInvestigadores.extension.$error.minlength" class="help-block errorRequerido">El mínimo es de 4 y no se aceptan letras</p>
                    <p ng-show="formEditarInvestigadores.extension.$error.maxlength" class="help-block errorRequerido">El máximo es de 4 y no se aceptan letras</p>
                </div>               
            </div>
            <div class="form-group col-sm-3  has-feedback" ng-class="cssInput(formEditarInvestigadores.codigo_postal)">
                <label for="codigo_postal" class="col-sm-5 control-label">Codigo Postal:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="codigo_postal" name="codigo_postal" ng-minlength="5" ng-disabled="true" ng-model="investigador.codigo_postal" required/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.codigo_postal)"></span>
                    <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.codigo_postal.$touched">
                        <p ng-show="formEditarInvestigadores.codigo_postal.$error.required" class="help-block col-lg-offset-2 errorRequerido">El código postal del investigador es requirido.</p>                        
                    </div>
                    <p ng-show="formEditarInvestigadores.codigo_postal.$error.minlength" class="help-block errorRequerido">El mínimo es de 5</p>
                </div>               
            </div>
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.colonia)" style="    margin-left: -40px;">
            <label for="colonia" class="col-sm-2 control-label">Colonia / Comunidad:</label>
            <div class="col-sm-10">
                <input type="text" ng-change="busqueda_colonias(formEditarInvestigadores.colonia, 'investigador')" class="form-control col-lg-1" id="colonia" name="colonia" ng-minlength="5" ng-model="dato.nombre_colonia" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.colonia)"></span>
                <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.colonia.$touched">
                    <p ng-show="formEditarInvestigadores.colonia.$error.required" class="help-block errorRequerido">La colonia es requirido.</p>
                </div>
            </div>           
        </div>        
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.sindicatura)" style="    margin-left: -40px;">
            <label for="sindicatura" class="col-sm-2 control-label">Sindicatura:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="sindicatura" name="sindicatura" ng-maxlength="100" ng-minlength="3" ng-model="investigador.sindicatura" />
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.sindicatura)"></span>
            </div>           
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.municipio)" style="    margin-left: -40px;">
            <label for="municipio" class="col-sm-2 control-label">Municipio:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="municipio" name="municipio" ng-maxlength="100" ng-minlength="3" ng-model="investigador.municipio" />
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.municipio)"></span>
            </div>        
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.estado)" style="    margin-left: -40px;">
            <label for="estado" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="estado" name="estado" ng-maxlength="100" ng-minlength="3" ng-model="investigador.estado"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.estado)"></span>
            </div>

        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.pais)" style="    margin-left: -40px;">
            <label for="pais" class="col-sm-2 control-label">Pais:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="pais" name="pais" ng-maxlength="100" ng-minlength="3" ng-model="investigador.pais"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.pais)"></span>
            </div>

        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.telefono)" style="    margin-left: -40px;">
            <label for="telefono" class="col-sm-2 control-label">Télefono:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="telefono" name="telefono" ng-maxlength="7" ng-minlength="7" ng-pattern="/^[0-9]{1,7}$/" ng-model="investigador.telefono" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.telefono)"></span>
                <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.telefono.$touched">
                    <p ng-show="formEditarInvestigadores.telefono.$error.required" class="help-block col-lg-offset-2 errorRequerido">El télefono es requirido.</p>
                </div>
                <p ng-show="formEditarInvestigadores.telefono.$error.minlength" class="help-block errorRequerido">El mínimo es de 7</p>
                <p ng-show="formEditarInvestigadores.telefono.$error.maxlength" class="help-block errorRequerido">El máximo es de 7</p>
            </div>          
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.correo)" style="    margin-left: -40px;">
            <label for="correo" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control col-lg-1" id="correo" name="correo" ng-model="investigador.correo"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.correo)"></span>
            </div>
            <p ng-show="formEditarInvestigadores.correo.$invalid && !formEditarInvestigadores.correo.$pristine" class="help-block col-lg-offset-2 errorRequerido">La dirección de correo no es valida.</p>
        </div> 

        <div class="form-group">
            <label for="estatusDependencia" class="col-sm-2 control-label">Estatus:</label>
            <div class="col-sm-8">
                <div class="btn-group">
                    <button type="button" id="activo" name="activo" ng-click="claseEstatus('activo')" class="btn btn-success botonEstatus">ACTIVO</button>
                    <button type="button" id="inactivo" name="inactivo" ng-click="claseEstatus('inactivo')" class="btn btn-default botonEstatus">INACTIVO</button>
                </div>
            </div>
        </div> 
        <h4><strong>Institución</strong></h4>
        <hr size="10px"/>
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.nombre_institucion)">
            <label for="nombre_institucion" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="nombre_institucion" name="nombre_institucion" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="investigador.nombre_institucion" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.nombre_institucion)"></span>
                <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.nombre_institucion.$touched">
                    <p ng-show="formEditarInvestigadores.nombre_institucion.$error.required" class="help-block errorRequerido">El nombre de la institución es requirido.</p>
                </div>
                <p ng-show="formEditarInvestigadores.nombre_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formEditarInvestigadores.nombre_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 100</p>
            </div>           
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.cargo)">
            <label for="cargo" class="col-sm-2 control-label">Cargo:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="cargo" name="cargo" ng-maxlength="50" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="investigador.cargo"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.cargo)"></span>
                <p ng-show="formEditarInvestigadores.cargo.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formEditarInvestigadores.cargo.$error.maxlength" class="help-block errorRequerido">El máximo es de 50</p>
            </div>            
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.calle_institucion)">
            <label for="calle_institucion" class="col-sm-2 control-label">Calle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="calle_institucion" name="calle_institucion" ng-maxlength="100" ng-minlength="3" ng-pattern="/^[a-zA-Z0-9\s\. ñáéíóú]*$/" ng-model="investigador.calle_institucion"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.calle_institucion)"></span>
                <p ng-show="formEditarInvestigadores.calle_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 3</p>
                <p ng-show="formEditarInvestigadores.calle_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 50</p>
            </div>           
        </div> 
        <div class="row col-sm-offset-1" style="margin-left: 97px;">
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formEditarInvestigadores.numero_exterior_institucion)">
                <label for="numero_exterior_institucion" class="col-sm-4 control-label">Número Exterior:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" id="numero_exterior_institucion" name="numero_exterior_institucion" ng-pattern="/^[a-zA-Z0-9\-]*$/" ng-maxlength="10" ng-minlength="1" ng-model="investigador.numero_exterior_institucion"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.numero_exterior_institucion)"></span>
                    <p ng-show="formEditarInvestigadores.numero_exterior_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 1</p>
                    <p ng-show="formEditarInvestigadores.numero_exterior_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 10</p>
                </div>                    
            </div> 
            <div class="form-group col-sm-4 has-feedback" ng-class="cssInput(formEditarInvestigadores.numero_interior_institucion)">
                <label for="numero_interior_institucion" class="col-sm-4 control-label">Número Interior:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" ng-maxlength="10" ng-minlength="1" id="numero_interior_institucion" ng-pattern="/^[a-zA-Z0-9\-]*$/" name="numero_interior_institucion" ng-model="investigador.numero_interior_institucion"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.numero_interior_institucion)"></span>
                    <p ng-show="formEditarInvestigadores.numero_interior_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 1</p>
                    <p ng-show="formEditarInvestigadores.numero_interior_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 10</p>
                </div>               
            </div> 
            <div class="form-group col-sm-4  has-feedback" ng-class="cssInput(formEditarInvestigadores.codigo_postal_institucion)">
                <label for="codigo_postal_institucion" class="col-sm-4 control-label">Código Postal:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" id="codigo_postal_institucion" name="codigo_postal_institucion" ng-minlength="5" ng-disabled="true" ng-model="investigador.codigo_postal_institucion"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.codigo_postal_institucion)"></span>
                    <p ng-show="formEditarInvestigadores.codigo_postal_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 5 y no se acepta letras</p>
                </div>              
            </div>
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.colonia_institucion)">
            <label for="colonia_institucion" class="col-sm-2 control-label">Colonia / Comunidad:</label>
            <div class="col-sm-10">
                <input type="text" ng-change="busqueda_colonias(formEditarInvestigadores.colonia_institucion, 'institucion')" class="form-control col-lg-1" id="colonia_institucion" name="colonia_institucion" ng-minlength="5" ng-model="dato.nombre_colonia_institucion" required/>                
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.colonia_institucion)"></span>
                <p ng-show="formEditarInvestigadores.codigo_postal_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 5</p>
            </div>
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.sindicatura_institucion)">
            <label for="sindicatura_institucion" class="col-sm-2 control-label">Sindicatura:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="sindicatura_institucion" name="sindicatura_institucion" ng-model="investigador.sindicatura_institucion"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.sindicatura_institucion)"></span>
            </div>           
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.municipio_institucion)">
            <label for="municipio_institucion" class="col-sm-2 control-label">Municipio:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="municipio_institucion" name="municipio_institucion" ng-model="investigador.municipio_institucion"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.municipio_institucion)"></span>
            </div>           
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.estado_institucion)">
            <label for="estado_institucion" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="estado_institucion" name="estado_institucion" ng-model="investigador.estado_institucion"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.estado_institucion)"></span>
            </div>           
        </div> 
        <div class="form-group has-feedback" ng-class="cssInput(formEditarInvestigadores.pais_institucion)">
            <label for="pais_institucion" class="col-sm-2 control-label">País:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="pais_institucion" name="pais_institucion" ng-model="investigador.pais_institucion"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.pais_institucion)"></span>
            </div>          
        </div> 
        <div class="form-horizontal" style="margin-left: 137px;">
            <div class="form-group col-sm-6 has-feedback" ng-class="cssInput(formEditarInvestigadores.telefono_institucion)">
                <label for="telefono_institucion" class="col-sm-2 control-label">Télefono:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-lg-1" id="telefono_institucion" name="telefono_institucion" ng-minlength="7" ng-maxlength="7" ng-pattern="/^[0-9]{1,7}$/" ng-model="investigador.telefono_institucion"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.telefono_institucion)"></span>
                    <div ng-show="formEditarInvestigadores.$submitted || formEditarInvestigadores.telefono_institucion.$touched">
                        <p ng-show="formEditarInvestigadores.telefono_institucion.$error.required" class="help-block errorRequerido">El télefono de la institución es requirido.</p>
                    </div>
                    <p ng-show="formEditarInvestigadores.telefono_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 7 y no se aceptan letras</p>
                    <p ng-show="formEditarInvestigadores.telefono_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 7 y no se aceptan letras</p>
                </div>                   
            </div>           
            <div class="form-group col-sm-6  has-feedback" ng-class="cssInput(formEditarInvestigadores.extension_institucion)">
                <label for="extension_institucion" class="col-sm-2 control-label">Extensión:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control col-lg-1" id="extension_institucion" name="extension_institucion" ng-minlength="1" ng-maxlength="4" ng-minlength="1" ng-pattern="/^[0-9]{1,4}$/" ng-model="investigador.extension_institucion"/>
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formEditarInvestigadores.extension_institucion)"></span>
                    <p ng-show="formEditarInvestigadores.extension_institucion.$error.minlength" class="help-block errorRequerido">El mínimo es de 4 y no se aceptan letras</p>
                    <p ng-show="formEditarInvestigadores.extension_institucion.$error.maxlength" class="help-block errorRequerido">El máximo es de 4 y no se aceptan letras</p>
                </div>              
            </div>
        </div> 
        <div class="form-group">
            <div class="col-sm-1 col-sm-offset-10">
                <button type="submit" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>               
            </div> 
            <a href="<?php echo base_url('investigadores/index'); ?>"><button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ban-circle"></span> Cancelar</button></a>            
        </div>         
    </form>      
</div>







