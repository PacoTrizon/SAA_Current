var app = angular.module('app', []);

app.controller('tramiteConcentracionCtrl', function ($scope, $http) {
    $scope.estatus = [
        {id: '1', titulo: 'ACTIVO'},
        {id: '0', titulo: 'INACTIVO'}
    ];

    $scope.imprimir = function () {
        var filtros = {
            busquedaPadre: $('#solicitantesBuscar').val(),
            estatus: $scope.buscador.estatus
        };
        $http({
            method: 'POST',
            url: baseUrl + "solicitantes/existenDatos",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify(filtros)
        }).success(function (response) {
            var datos = response.data;
            console.log(datos);
            if (typeof (datos) === "undefined")
                $.growl.error({message: "No se encontro información.", title: 'Solicitante'});
            else {
                if (datos.length === 0)
                    $.growl.error({message: "No se encontro información.", title: 'Solicitante'});
                else {
                    if (typeof (filtros.estatus) === "undefined")
                        filtros.estatus = 1;
                    document.location = baseUrl + "solicitantes/imprimir?estatus=" + filtros.estatus + "&descripcion=" + filtros.busquedaPadre;
                }
            }
        });
    }
});

app.controller('tramiteConcentracionAgregarCtrl', function ($scope, $http, $filter) {
    $scope.tramite = {};
    $scope.campo = {};
    $scope.nombre = {};
    var seriesPadres = [];
    var seriesHijos = []
    var padres = [];
    var hijos = [];
    var nietos = [];
    $scope.campo.seccion = true;
    $scope.campo.sub_seccion = true;
    $scope.campo.sub_serie = true;
    $scope.tramite.clasificacion_informacion = "0";
    //Dependencias
    $scope.getDependenciasPadres = function () {
        $http({
            method: 'POST',
            url: baseUrl + "dependencias/busquedaPadre",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify($scope.padre)
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var obj = {
                    value: dato.dependencia_id,
                    label: dato.nombre,
                };
                padres.push(obj);
            });
        });
    }
    $scope.getHijos = function (id, hijo, id_input) {
        $http({
            method: 'POST',
            url: baseUrl + "dependencias/busquedaHijos",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id: id})
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {

                var obj = {
                    value: dato.dependencia_id,
                    label: dato.nombre
                };
                hijo.push(obj);
            });
            $('#' + id_input).autocomplete("option", {source: hijo});
        });
    }
    //padre
    $("#sub_fondo").autocomplete({
        source: padres,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#sub_fondo").val(ui.item.label);
                $scope.tramite.id_sub_fondo = ui.item.value;
                //consultar hijos
                $scope.getHijos(ui.item.value, hijos, "seccion");
                $("#sub_fondo").focus();
            }, 100);
            $scope.campo.seccion = false;
        }
    });
    //hijo
    $("#seccion").autocomplete({
        source: hijos,
        minlength: 10,
        select: function (event, ui) {
            setTimeout(function () {
                $scope.tramite.id_seccion = ui.item.value;
                $scope.campo.sub_seccion = false;
                $("#seccion").val(ui.item.label);
                $scope.getHijos(ui.item.value, nietos, "sub_seccion");
            }, 100);
        }
    });
    //nieto
    $("#sub_seccion").autocomplete({
        source: nietos,
        minlength: 10,
        select: function (event, ui) {
            $scope.tramite.id_sub_seccion = ui.item.value;
            setTimeout(function () {
                $("#sub_seccion").val(ui.item.label);
            }, 100);
        }
    });
//-------------------------------------------------------------------------------------------------------
    //Series
    $scope.getSeriesPadres = function () {
        $http({
            method: 'POST',
            url: baseUrl + "series/buscarSeriePadres"
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var valorDocumental = $scope.valorDocumental(dato.valor_documental);
                var obj = {
                    value: dato.id_serie,
                    label: dato.descripcion,
                    desc: valorDocumental,
                };
                seriesPadres.push(obj);
            });
        });
    }
    //Serie Hijos
    $scope.getHijosSerie = function (id, id_input) {
        $http({
            method: 'POST',
            url: baseUrl + "series/buscarHijosSerie",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id: id})
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var valorDocumental = $scope.valorDocumental(dato.valor_documental);
                var obj = {
                    value: dato.id_serie,
                    label: dato.descripcion,
                    desc: valorDocumental
                };
                seriesHijos.push(obj);
            });
            $('#' + id_input).autocomplete("option", {source: seriesHijos});
        });
    }
    //padre series
    $("#serie").autocomplete({
        source: seriesPadres,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#serie").val(ui.item.label);
                $scope.campo.sub_serie = false;
                $scope.tramite.id_serie = ui.item.value;
//                //consultar hijos
                $scope.getHijosSerie(ui.item.value, "sub_serie");
                $("#sub_serie").focus();
            }, 100);
            $scope.campo.sub_serie = false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a><strong>" + item.label + "</strong><br>Valor Documental: " + item.desc + "</a>")
                .appendTo(ul);
    };
    //hijo series
    $("#sub_serie").autocomplete({
        source: seriesHijos,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#sub_serie").val(ui.item.label);
                $scope.tramite.id_sub_serie = ui.item.value;
            }, 100);
            $scope.campo.sub_serie = false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a><strong>" + item.label + "</strong><br>Valor Documental: " + item.desc + "</a>")
                .appendTo(ul);
    };

    //limpiar hijos y nietos cuando seleccione o borre al padre
    $scope.cambioPadre = function () {
        if ($scope.nombre.sub_fondo === "" || typeof ($scope.nombre.sub_fondo) === "undefined") {
            $scope.campo.seccion = true;
            $scope.campo.sub_seccion = true;
            delete hijos;
            delete nietos;
            hijos = [];
            nietos = [];
            $("#seccion").val("");
            $("#sub_seccion").val("");
        }
    }
    $scope.cambioPadreSerie = function () {
        if ($scope.nombre.serie === "" || typeof ($scope.nombre.serie) === "undefined") {
            $scope.campo.sub_serie = true;
            delete seriesHijos;
            seriesHijos = [];
            $("#sub_serie").val("");
        }
    }

    $scope.getDependenciasPadres();
    $scope.getSeriesPadres();

    $scope.cssIcono = function (formInput) {
        return {'glyphicon-ok': formInput.$valid && formInput.$dirty,
            'glyphicon-remove': formInput.$invalid && formInput.$dirty};
    }

    $scope.cssInput = function (formInput) {
        return {'has-success': formInput.$valid && formInput.$dirty,
            'has-error': formInput.$invalid && formInput.$dirty};
    }


    $scope.claseEstatus = function (id) {
        var activo = angular.element(document.querySelector("#activo"));
        var inactivo = angular.element(document.querySelector("#inactivo"));
        var inactivo2 = angular.element(document.querySelector("#inactivo2"));
        if (id === "activo") {
            inactivo2.removeClass('btn-success');
            inactivo2.addClass('btn-default');
            inactivo.removeClass('btn-success');
            inactivo.addClass('btn-default');
            activo.removeClass('btn-default');
            activo.addClass('btn-success');
            activo.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "0";
        }
        if (id === "inactivo") {
            activo.removeClass('btn-success');
            activo.addClass('btn-default');
            inactivo2.removeClass('btn-success');
            inactivo2.addClass('btn-default');
            inactivo.removeClass('btn-default');
            inactivo.addClass('btn-success');
            inactivo.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "1";
        } else {
            inactivo.removeClass('btn-success');
            inactivo.addClass('btn-default');
            activo.removeClass('btn-success');
            activo.addClass('btn-default');
            inactivo2.removeClass('btn-default');
            inactivo2.addClass('btn-success');
            inactivo2.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "2";
        }


    }

    $scope.valorDocumental = function (valor) {
        switch (parseInt(valor)) {
            case 0:
                return "Administrativo";
                break;
            case 1:
                return "Legal";
                break;
            case 2:
                return "Contable";
                break;
            case 3:
                return "Técnico";
                break;
        }
    }

    $scope.guardar = function () {
        if ($scope.frmTramite.$valid) {
            $scope.tramite.fecha_apertura = $filter('date')(new Date($scope.tramite.fecha_apertura), 'yyyy-MM-dd');
            if (typeof $scope.tramite.fecha_cierre !== 'undefined')
                $scope.tramite.fecha_cierre = $filter('date')($scope.tramite.fecha_cierre, 'yyyy-MM-dd');
            if (typeof $('input[type=file]').val().replace(/C:\\fakepath\\/i, '') !== 'undefined')
                $scope.tramite.archivo_expediente = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
            console.log($scope.tramite);
            $http({
                method: 'POST',
                url: baseUrl + "tramite_concentracion/guardar",
                headers: {"Content-Type": 'application/x-www-form-urlencoded'},
                data: JSON.stringify($scope.tramite)
            }).success(function (response) {
                console.log('response', response);
                switch (response.data) {
                    case 0:
                        var formData = new FormData($("#frmTramite")[0]);
                        var request = new XMLHttpRequest();
                        request.open('post', 'subirPDF');
                        request.send(formData);
                        $.growl.notice({message: 'El tramite se agrego correctamente.', title: 'Tramite y concentración'});
                        setTimeout(function () {
                            $scope.investigador = {};
                            window.location.href = baseUrl + "tramite_concentracion/index";
                        }, 200);
                        break;

                    case 1:
                        $.growl.error({message: "Erro el tramite " + $scope.tramite.descripcion + " no se pudo agregar.", title: 'Tramite y concentración'});
                        break;
                    case 2:
                        $.growl.error({message: "Error el tramite " + $scope.tramite.descripcion + " ya existe.", title: 'Tramite y concentración'});
                        break;
                    case 3:
                        $.growl.error({message: "Error el pdf " + $scope.tramite.archivo_expediente + " ya existe.", title: 'Tramite y concentración'});
                        break;
                }
            });
        }

    };
});

app.controller('tramiteConcentracionEditarCtrl', function ($scope, $http, $filter) {
    $scope.tramite = {};
    $scope.campo = {};
    $scope.nombre = {};
    $scope.showModal = false;
    var busqueda_documentos = [];
    var seriesPadres = [];
    var seriesHijos = []
    var padres = [];
    var hijos = [];
    var nietos = [];
    var renglon_contador = 0;
    $scope.cuidades = [];
    $scope.tipologias = [];
    $scope.historico = {};
    $scope.documentos = [];

    // frm Historico
    $scope.estado_fisico = [
        {id: '0', titulo: 'Bueno'},
        {id: '1', titulo: 'Regular'},
        {id: '2', titulo: 'Malas Condiciones'}
    ];
    $scope.medidas_papel = [
        {id: '0', titulo: 'Carta'},
        {id: '1', titulo: 'Oficio'},
        {id: '2', titulo: 'Media Carta'},
        {id: '3', titulo: 'Doble Oficio'},
        {id: '4', titulo: 'Doble Carta'}
    ];
    $scope.formato = [
        {id: '0', titulo: 'Manuscrito'},
        {id: '1', titulo: 'Mecanuscrito'},
        {id: '2', titulo: 'Impreso'}
    ];
    $scope.idioma = [
        {id: '0', titulo: 'Español'},
        {id: '1', titulo: 'Inglés'},
        {id: '2', titulo: 'Francés'}
    ];

    var getParameterByName = (function (a) {
        if (a == "")
            return {};
        var b = {};
        for (var i = 0; i < a.length; ++i)
        {
            var p = a[i].split('=', 2);
            if (p.length == 1)
                b[p[0]] = "";
            else
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'))
    var id = getParameterByName["id"];

    $scope.buscarHistorico = function (doc) {
        $scope.showModal = !$scope.showModal;
        $http({
            method: 'POST',
            url: baseUrl + "tramite_concentracion/buscarHistorico",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id_tramite: id, id_documento: doc.id, renglon: doc.renglon})
        }).success(function (response) {
            if (response.data.length === 0) {
                $scope.historico = {};
                $scope.historico.id_documento = doc.id;
                $scope.historico.id_tramite = id;
                $scope.historico.renglon = doc.renglon;
            } else {
                $scope.historico = response.data[0];
            }
            console.log($scope.historico);
        });

    }
    //obtener el tramite con sus documentos de la sub serie
    $scope.getTramite = function () {
        console.log(id);
        $http({
            method: 'POST',
            url: baseUrl + "tramite_concentracion/buscarPorId",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id: id})
        }).success(function (response) {
            var datos = response.data;
            console.log(response);
            // $scope.documentos = response.documentos;
            $scope.cuidades = response.cuidades;
            $scope.tipologias = response.tipologias;
            $scope.date = $filter("date")(datos.fecha_apertura, 'yyyy-MM-dd');
            $scope.date2 = $filter("date")(datos.fecha_cierre, 'yyyy-MM-dd');

            $scope.nombre.sub_fondo = datos.nombre_sub_fondo;
            $scope.nombre.seccion = datos.nombre_seccion;
            $scope.nombre.sub_seccion = datos.nombre_sub_seccion;
            $scope.nombre.serie = datos.nombre_serie;
            $scope.nombre.sub_serie = datos.nombre_sub_serie;
            delete datos.nombre_sub_fondo;
            delete datos.nombre_seccion;
            delete datos.nombre_sub_seccion;
            delete datos.nombre_serie;
            delete datos.nombre_sub_serie;
            $scope.tramite = datos;
            console.log(response);
        });
    }

    $scope.getTramite();
    //Dependencias
    $scope.getDependenciasPadres = function () {
        $http({
            method: 'POST',
            url: baseUrl + "dependencias/busquedaPadre",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify($scope.padre)
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var obj = {
                    value: dato.dependencia_id,
                    label: dato.nombre,
                };
                padres.push(obj);
            });
        });
    }
    $scope.getHijos = function (id, hijo, id_input) {
        $http({
            method: 'POST',
            url: baseUrl + "dependencias/busquedaHijos",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id: id})
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {

                var obj = {
                    value: dato.dependencia_id,
                    label: dato.nombre
                };
                hijo.push(obj);
            });
            $('#' + id_input).autocomplete("option", {source: hijo});
        });
    }
    //padre
    $("#sub_fondo").autocomplete({
        source: padres,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#sub_fondo").val(ui.item.label);
                $scope.tramite.id_sub_fondo = ui.item.value;
                //consultar hijos
                $scope.getHijos(ui.item.value, hijos, "seccion");
                $("#sub_fondo").focus();
            }, 100);
            $scope.campo.seccion = false;
        }
    });
    //hijo
    $("#seccion").autocomplete({
        source: hijos,
        minlength: 10,
        select: function (event, ui) {
            setTimeout(function () {
                $scope.tramite.id_seccion = ui.item.value;
                $scope.campo.sub_seccion = false;
                $("#seccion").val(ui.item.label);
                $scope.getHijos(ui.item.value, nietos, "sub_seccion");
            }, 100);
        }
    });
    //nieto
    $("#sub_seccion").autocomplete({
        source: nietos,
        minlength: 10,
        select: function (event, ui) {
            $scope.tramite.id_sub_seccion = ui.item.value;
            setTimeout(function () {
                $("#sub_seccion").val(ui.item.label);
            }, 100);
        }
    });
//-------------------------------------------------------------------------------------------------------
    //Series
    $scope.getSeriesPadres = function () {
        $http({
            method: 'POST',
            url: baseUrl + "series/buscarSeriePadres"
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var valorDocumental = $scope.valorDocumental(dato.valor_documental);
                var obj = {
                    value: dato.id_serie,
                    label: dato.descripcion,
                    desc: valorDocumental,
                };
                seriesPadres.push(obj);
            });
        });
    }
    //Serie Hijos
    $scope.getHijosSerie = function (id, id_input) {
        $http({
            method: 'POST',
            url: baseUrl + "series/buscarHijosSerie",
            headers: {"Content-Type": 'application/x-www-form-urlencoded'},
            data: JSON.stringify({id: id})
        }).success(function (response) {
            angular.forEach(response.data, function (dato) {
                var valorDocumental = $scope.valorDocumental(dato.valor_documental);
                var obj = {
                    value: dato.id_serie,
                    label: dato.descripcion,
                    desc: valorDocumental
                };
                seriesHijos.push(obj);
            });
            $('#' + id_input).autocomplete("option", {source: seriesHijos});
        });
    }
    //padre series
    $("#serie").autocomplete({
        source: seriesPadres,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#serie").val(ui.item.label);
                $scope.campo.sub_serie = false;
                $scope.tramite.id_serie = ui.item.value;
//                //consultar hijos
                $scope.getHijosSerie(ui.item.value, "sub_serie");
                $("#sub_serie").focus();
            }, 100);
            $scope.campo.sub_serie = false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a><strong>" + item.label + "</strong><br>Valor Documental: " + item.desc + "</a>")
                .appendTo(ul);
    };
    //hijo series
    $("#sub_serie").autocomplete({
        source: seriesHijos,
        minlength: 10,
        select: function (event, ui) {
            // $scope.estado.id_pais = ui.item.value;           
            setTimeout(function () {
                $("#sub_serie").val(ui.item.label);
                $scope.tramite.id_sub_serie = ui.item.value;
            }, 100);
            $scope.campo.sub_serie = false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
                .append("<a><strong>" + item.label + "</strong><br>Valor Documental: " + item.desc + "</a>")
                .appendTo(ul);
    };

    //----------------------agregar documentos
    $scope.busqueda_documentos = function (input) {
        if (input.$valid) {
            $http({
                method: 'POST',
                url: baseUrl + "documentos/busqueda_descripcion",
                headers: {"Content-Type": 'application/x-www-form-urlencoded'},
                data: JSON.stringify({descripcion: $("#busqueda_documento").val()})
            }).success(function (response) {
//                console.log(response);
                busqueda_documentos = [];
                angular.forEach(response.data, function (dato) {
                    var obj = {
                        value: dato.descripcion,
                        label: dato.descripcion,
                        id: dato.id
                    };
                    busqueda_documentos.push(obj);
                });
                console.log(busqueda_documentos);
                $('#busqueda_documento').autocomplete("option", {source: busqueda_documentos});
            });
        }
    }
    $("#busqueda_documento").autocomplete({
        source: busqueda_documentos,
        minlength: 10,
        select: function (event, ui) {
            $scope.$apply(function () {
                renglon_contador++;
                var obj = {
                    descripcion: ui.item.value,
                    id: ui.item.id,
                    renglon: renglon_contador
                };
                $scope.documentos.push(obj);
            });
        }
    });

    $scope.remover_documento = function (index) {
        $scope.documentos.splice(index, 1);
    }

    //limpiar hijos y nietos cuando seleccione o borre al padre
    $scope.cambioPadre = function () {
        if ($scope.nombre.sub_fondo === "" || typeof ($scope.nombre.sub_fondo) === "undefined") {
            $scope.campo.seccion = true;
            $scope.campo.sub_seccion = true;
            delete hijos;
            delete nietos;
            hijos = [];
            nietos = [];
            $("#seccion").val("");
            $("#sub_seccion").val("");
        }
    }
    $scope.cambioPadreSerie = function () {
        if ($scope.nombre.serie === "" || typeof ($scope.nombre.serie) === "undefined") {
            $scope.campo.sub_serie = true;
            delete seriesHijos;
            seriesHijos = [];
            $("#sub_serie").val("");
        }
    }

    $scope.getDependenciasPadres();
    $scope.getSeriesPadres();

    $scope.cssIcono = function (formInput) {
        return {'glyphicon-ok': formInput.$valid && formInput.$dirty,
            'glyphicon-remove': formInput.$invalid && formInput.$dirty};
    }

    $scope.cssInput = function (formInput) {
        return {'has-success': formInput.$valid && formInput.$dirty,
            'has-error': formInput.$invalid && formInput.$dirty};
    }


    $scope.claseEstatus = function (id) {
        var activo = angular.element(document.querySelector("#activo"));
        var inactivo = angular.element(document.querySelector("#inactivo"));
        var inactivo2 = angular.element(document.querySelector("#inactivo2"));
        if (id === "activo") {
            inactivo2.removeClass('btn-success');
            inactivo2.addClass('btn-default');
            inactivo.removeClass('btn-success');
            inactivo.addClass('btn-default');
            activo.removeClass('btn-default');
            activo.addClass('btn-success');
            activo.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "0";
        }
        if (id === "inactivo") {
            activo.removeClass('btn-success');
            activo.addClass('btn-default');
            inactivo2.removeClass('btn-success');
            inactivo2.addClass('btn-default');
            inactivo.removeClass('btn-default');
            inactivo.addClass('btn-success');
            inactivo.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "1";
        } else {
            inactivo.removeClass('btn-success');
            inactivo.addClass('btn-default');
            activo.removeClass('btn-success');
            activo.addClass('btn-default');
            inactivo2.removeClass('btn-default');
            inactivo2.addClass('btn-success');
            inactivo2.addClass('active').not(this).removeClass('active');
            $scope.tramite.clasificacion_informacion = "2";
        }


    }

    $scope.valorDocumental = function (valor) {
        switch (parseInt(valor)) {
            case 0:
                return "Administrativo";
                break;
            case 1:
                return "Legal";
                break;
            case 2:
                return "Contable";
                break;
            case 3:
                return "Técnico";
                break;
        }
    }

    $scope.guardar = function () {
        if ($scope.frmTramite.$valid) {
            $scope.tramite.fecha_apertura = $filter('date')(new Date($scope.tramite.fecha_apertura), 'yyyy-MM-dd');
            if (typeof $scope.tramite.fecha_cierre !== 'undefined')
                $scope.tramite.fecha_cierre = $filter('date')($scope.tramite.fecha_cierre, 'yyyy-MM-dd');
            if (typeof $('input[type=file]').val().replace(/C:\\fakepath\\/i, '') !== 'undefined')
                $scope.tramite.archivo_expediente = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
            console.log($scope.tramite);
            $http({
                method: 'POST',
                url: baseUrl + "tramite_concentracion/guardar",
                headers: {"Content-Type": 'application/x-www-form-urlencoded'},
                data: JSON.stringify($scope.tramite)
            }).success(function (response) {
                console.log('response', response);
                switch (response.data) {
                    case 0:
                        var formData = new FormData($("#frmTramite")[0]);
                        var request = new XMLHttpRequest();
                        request.open('post', 'subirPDF');
                        request.send(formData);
                        $.growl.notice({message: 'El tramite se agrego correctamente.', title: 'Tramite y concentración'});
                        setTimeout(function () {
                            $scope.investigador = {};
                            window.location.href = baseUrl + "tramite_concentracion/index";
                        }, 200);
                        break;

                    case 1:
                        $.growl.error({message: "Erro el tramite " + $scope.tramite.descripcion + " no se pudo agregar.", title: 'Tramite y concentración'});
                        break;
                    case 2:
                        $.growl.error({message: "Error el tramite " + $scope.tramite.descripcion + " ya existe.", title: 'Tramite y concentración'});
                        break;
                    case 3:
                        $.growl.error({message: "Error el pdf " + $scope.tramite.archivo_expediente + " ya existe.", title: 'Tramite y concentración'});
                        break;
                }
            });
        }
    };

    $scope.guardarHistorico = function (frm) {
        if (frm.$valid) {
            console.log('guardando', $scope.historico);
            $http({
                method: 'POST',
                url: baseUrl + "tramite_concentracion/guardarHistorico",
                headers: {"Content-Type": 'application/x-www-form-urlencoded'},
                data: JSON.stringify($scope.historico)
            }).success(function (response) {
                console.log('response', response);
                switch (response.data) {
                    case 0:
                        $.growl.notice({message: 'Se guardo correctamente la descripción del documento.', title: 'Historico'});
                        $scope.showModal = false;
                        $scope.historico = {};
                        break;
                    case 1:
                        $.growl.error({message: "Error al guardar la descripción del doumento " + $scope.historico.descripcion, title: 'Historico'});
                        break;
                }
            });
        }
    }
});
app.directive('modal', function () {
    return {
        template: '<div class="modal fade">' +
                '<div class="modal-dialog modal-lg">' +
                '<div class="modal-content">' +
                '<div class="modal-header bg-primary">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                '<h4 class="modal-title">{{ title }}</h4>' +
                '</div>' +
                '<div class="modal-body" ng-transclude></div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>',
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: true,
        link: function postLink(scope, element, attrs) {
            scope.title = attrs.title;
            scope.$watch(attrs.visible, function (value) {
                if (value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });
            $(element).on('shown.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = true;
                });
            });
            $(element).on('hidden.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});