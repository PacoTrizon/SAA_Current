jQuery(document).ready(function()
{
  $("#alertTransf").attr("hidden","hidden");
  var uri = $("#base_url").val();
  $("#buscarTTD").autocomplete({
    source : uri+'Dependencias/busquedaPadre',
    select : function(event,ui){
        $("#tipoed").attr('value',ui.item.id);
    }
  });
})

function getTranferenciaTramite()
{
  var caja = $("#buscarTT").val();
  var uri = $("#base_url").val();
  $("#tbodyTT").empty();
  $.ajax({
      url : uri+'Transferencias/obtenerTramites',
      data : {gaveta: caja},
      type : 'post',
      dataType : 'html',
      success : function(html) {
        $("#tbodyTT").append(html);
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
}

function getTranferenciaTramiteDep()
{
  var dependencia = $("#tipoed").val();
  var sdo = $("#std").val();
  var uri = $("#base_url").val();
  $("#tbodyTTD").empty();
  $.ajax({
      url : uri+'Transferencias/obtenerTramitesDep',
      data : {dep: dependencia,std: sdo},
      type : 'post',
      dataType : 'html',
      success : function(html) {
        $("#tbodyTTD").append(html);
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
}


function transferir()
{
  var arreglo = [];
  var data = { 'transf[]' : []};
  $(":checked").each(function() {
    data['transf[]'].push($(this).val());
    arreglo.push($(this).val());
  });
  if (arreglo.length > 0 ) {
    var uri = $("#base_url").val();
    $.ajax({
        url : uri+'Transferencias/transferirRec',
        data : {transf: arreglo},
        type : 'post',
        dataType : 'html',
        success : function(html) {
            $("#alertTransf").removeAttr("hidden");
            getTranferenciaTramite();

          console.log(html);
        },
        error : function(xhr, status) {
            console.log(status);
        },
    });
  }
}

function transferirRev()
{
  var std = $("#std2").val();
  var arreglo = [];
  var data = { 'transf[]' : []};
  $(":checked").each(function() {
    data['transf[]'].push($(this).val());
    arreglo.push($(this).val());
  });
  if (arreglo.length > 0) {

    var uri = $("#base_url").val();
    $.ajax({
        url : uri+'Transferencias/transferirRev',
        data : {transf: arreglo,est: std},
        type : 'post',
        dataType : 'html',
        success : function(html) {
          $("#alertTransf").removeAttr("hidden");
          getTranferenciaTramiteDep();
        },
        error : function(xhr, status) {
            console.log(status);
        },
    });
  }
}

function adddocs(event)
{
  var opcion_seleccionada = $("#documentosS option:selected").text();
  var html = '<tr><td id="td'+event.value+'">'+opcion_seleccionada+'</td>/tr>'+'<td><button data-toggle="modal" data-target="#MyModal" type="button" class="btn btn-primary glyphicon glyphicon-list-alt"></button><span><button onclick ="deletea($(this))" type="button" class="btn btn-danger glyphicon glyphicon-remove"></button></span></td>';
  $("#tbodyDoc").append(html);
}

function deletea(row)
{
  row.closest('tr').remove();
}
