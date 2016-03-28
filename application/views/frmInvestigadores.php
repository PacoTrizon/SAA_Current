<div class="panel panel-default col-lg-10 col-lg-offset-1">
    <div class="panel-heading"><h4>Investigador</h4></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('investigadores/index'); ?>">Investigadores</a></li>
        <li class="active">Agregar</li>
    </ol>
    <form class="form-horizontal" name="formInvestigadores" id="formInvestigadores" style="margin-top: 11px;">
        <div class="row" style="    margin-left: -65px;">
            <div class="form-group col-sm-9">

                <div class="form-group has-feedback">
                    <label for="nombre" class="col-sm-3 control-label">Nombre:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" autofocus id="nombre" name="nombre" maxlength="50" minlength="2" required/>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group has-feedback" >
                    <label for="apellido_paterno" class="col-sm-3 control-label">Apellido Paterno:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="50" minlength="3" required/>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                </div>
                <div class="form-group has-feedback" >
                    <label for ="apellido_materno" class="col-sm-3 control-label">Apellido Materno:</label>
                    <div class="col-sm-8 ">
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="50" minlength="3"/>
                        <span class="glyphicon form-control-feedback" ></span>
                    </div>
                </div>
            </div>
            <div class="form col-sm-1 ">
                <div class="form-group">
                    <img src="<?php echo base_url('img/desconocido.png')?>" alt="Desconocido" id="imagenPreview" class="img-rounded col-sm-offset-1" style="width:122px;">
                </div>
                <div class="col-lg-10">
                    <input type="file" id="fileInput" name="fileInput" class="filestyle" data-input="false" data-buttonName="btn-primary" data-buttonText="Imagen">
                </div>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px; margin-top: inherit;">
            <label for="calle" class="col-sm-2 control-label">Calle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="calle" name="calle" maxlength="100" minlength="3" />
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.calle)"></span>
            </div>
        </div>
        <div class="row" style="margin-left: 53px;" >
            <div class="form-group col-sm-3 has-feedback" >
                <label for="numero_exterior" class="col-sm-6 control-label">Número Exterior:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" id="numero_exterior" name="numero_exterior" maxlength="10" minlength="1" />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.numero_exterior)"></span>
                </div>
            </div>
            <div class="form-group col-sm-3 has-feedback">
                <label for="numero_interior" class="col-sm-6 control-label">Número Interior:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control col-lg-1" maxlength="10" minlength="1" id="numero_interior" name="numero_interior" />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.numero_interior)"></span>
                </div>
            </div>
            <div class="form-group col-sm-3  has-feedback" >
                <label for="extension" class="col-sm-5 control-label">Extensión:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control col-lg-1" id="extension" name="extension" minlength="1" maxlength="4" />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.extension)"></span>
                </div>
            </div>
            <div class="form-group col-sm-3  has-feedback" >
                <label for="codigo_postal" class="col-sm-5 control-label">Codigo Postal:</label>
                <div class="col-sm-7">
                    <input type="text" disabled="true" class="form-control col-lg-1" id="codigo_postal" name="codigo_postal" minlength="5" required/>
                    <span class="glyphicon form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="colonia" class="col-sm-2 control-label">Colonia / Comunidad:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="coloniaInv" name="colonia" minlength="5" required/>
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="sindicatura" class="col-sm-2 control-label">Sindicatura:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="sindicatura" name="sindicatura" maxlength="100" minlength="3" />
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="municipio" class="col-sm-2 control-label">Municipio:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="municipio" name="municipio" maxlength="100" minlength="3" />
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="estado" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="estado" name="estado" maxlength="100" minlength="3"/>
                <span class="glyphicon form-control-feedback"></span>
            </div>

        </div>
        <div class="form-group has-feedback" ng-class="cssInput(formInvestigadores.pais)" style="    margin-left: -40px;">
            <label for="pais" class="col-sm-2 control-label">Pais:</label>
            <div class="col-sm-10">
                <input type="text" ng-disabled="true" class="form-control col-lg-1" id="pais" name="pais" ng-maxlength="100" ng-minlength="3" ng-model="investigador.pais"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.pais)"></span>
            </div>

        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="telefono" class="col-sm-2 control-label">Télefono:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="telefono" name="telefono" maxlength="7" minlength="7" required/>
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" style="margin-left: -40px;">
            <label for="correo" class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control col-lg-1" id="correo" name="correo" ng-model="investigador.correo"/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.correo)"></span>
            </div>
        </div>
        <h4><strong>Institución</strong></h4>
        <hr size="10px"/>
        <div class="form-group has-feedback" >
            <label for="nombre_institucion" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="nombre_institucion" name="nombre_institucion" maxlength="100" minlength="3" required/>
                <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.nombre_institucion)"></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="cargo" class="col-sm-2 control-label">Cargo:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="cargo" name="cargo" maxlength="50" minlength="3" />
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="calle_institucion" class="col-sm-2 control-label">Calle:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="calle_institucion" name="calle_institucion" maxlength="100" minlength="3"/>
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>
        <div class="row col-sm-offset-1" style="margin-left: 97px;">
            <div class="form-group col-sm-4 has-feedback" >
                <label for="numero_exterior_institucion" class="col-sm-4 control-label">Número Exterior:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" id="numero_exterior_institucion" name="numero_exterior_institucion" maxlength="10" minlength="1"/>
                    <span class="glyphicon form-control-feedback"></span>
                </div>
            </div>
            <div class="form-group col-sm-4 has-feedback">
                <label for="numero_interior_institucion" class="col-sm-4 control-label">Número Interior:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control col-lg-1" maxlength="10" minlength="1" id="numero_interior_institucion" name="numero_interior_institucion" />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.numero_interior_institucion)"></span>
                </div>
            </div>
            <div class="form-group col-sm-4  has-feedback" >
                <label for="codigo_postal_institucion" class="col-sm-4 control-label">Código Postal:</label>
                <div class="col-sm-8">
                    <input type="text" disabled="true" class="form-control col-lg-1" id="codigo_postal_institucion" name="codigo_postal_institucion" minlength="5" maxlength="5" />
                    <span class="glyphicon form-control-feedback"></span>
                </div>
              </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="colonia_institucion" class="col-sm-2 control-label">Colonia / Comunidad:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control col-lg-1" id="colonia_institucion" name="colonia_institucion" minlength="5" required/>
                <span class="glyphicon form-control-feedback"></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="sindicatura_institucion" class="col-sm-2 control-label">Sindicatura:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="sindicatura_institucion" name="sindicatura_institucion" />
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="municipio_institucion" class="col-sm-2 control-label">Municipio:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="municipio_institucion" name="municipio_institucion" />
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="estado_institucion" class="col-sm-2 control-label">Estado:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="estado_institucion" name="estado_institucion" />
                <span class="glyphicon form-control-feedback" ></span>
            </div>
        </div>
        <div class="form-group has-feedback" >
            <label for="pais_institucion" class="col-sm-2 control-label">País:</label>
            <div class="col-sm-10">
                <input type="text" disabled="true" class="form-control col-lg-1" id="pais_institucion" name="pais_institucion" />
                <span class="glyphicon form-control-feedback"  ></span>
            </div>
        </div>
        <div class="form-horizontal" style="margin-left: 136px;">
            <div class="form-group col-sm-6 has-feedback" >
                <label for="telefono_institucion" class="col-sm-2 control-label">Télefono:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telefono_institucion" name="telefono_institucion" minlength="7" maxlength="7" required />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.telefono_institucion)"></span></p>
                </div>
            </div>
            <div class="form-group col-sm-6  has-feedback">
                <label for="extension_institucion" class="col-sm-3 control-label">Extensión:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="extension_institucion" name="extension_institucion" minlength="1" maxlength="4" minlength="1" />
                    <span class="glyphicon form-control-feedback" ng-class="cssIcono(formInvestigadores.extension_institucion)"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-offset-10">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-click="guardar()"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                <span>
                    <a href="<?php echo base_url('investigadores/index'); ?>"><button type="button" class="btn btn-warning"  title="Cerrar"><span class="glyphicon glyphicon-ban-circle"></span> Cerrar</button></a>
                </span>
            </div>
        </div>
    </form>
</div>
