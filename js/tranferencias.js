jQuery(document).ready(function()
{
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
  var uri = $("#base_url").val();
  $.ajax({
      url : uri+'Transferencias/transferirRec',
      data : {transf: arreglo},
      type : 'post',
      dataType : 'html',
      success : function(html) {
        console.log(html);
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
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
  var uri = $("#base_url").val();
  $.ajax({
      url : uri+'Transferencias/transferirRev',
      data : {transf: arreglo,est: std},
      type : 'post',
      dataType : 'html',
      success : function(html) {
        console.log(html);
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
}
