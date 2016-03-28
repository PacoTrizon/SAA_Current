jQuery(document).ready(function()
{
  var uri = $("#base_url").val();
  $("#seccion").attr('disabled','disabled');
  $("#sub_seccion").attr('disabled','disabled');
  $("#sub_serie").attr('disabled','disabled');
  $("#sub_serie").attr('required','required');


  $("#subfondo").autocomplete({
    source : uri+'Dependencias/busquedaPadre',
    select : function(event,ui){
        $("#seccion").val(" ");
        $("#subfondo").val(ui.item.id);
        $("#hsf").attr('value',ui.item.id);
        $("#seccion").removeAttr('disabled');
        autocompletarSeccion($("#subfondo").val());
    }
  });


  $("#serie").autocomplete({
    source : uri+'Series/buscarSeriePadres',
    select : function(event,ui){
        $("#sub_serie").val(" ");
        $("#serie").val(ui.item.id);
        $("#hsr").attr('value',ui.item.id);
        $("#sub_serie").removeAttr('disabled');
        autocompletarSerie($("#serie").val());
    }
  });

});


function autocompletarSeccion(valor)
{
  var secciones = [];
  var uri = $("#base_url").val();
  $.ajax({
      url : uri+'Dependencias/busquedaHijos',
      data : {dependencia: valor},
      type : 'GET',
      dataType : 'json',
      success : function(json) {
        if (json.id != 'vacio') {
          $("#seccion").autocomplete({
            source : json,
            select : function(event,ui){
                $("#sub_seccion").val(" ");
                $("#seccion").val(ui.item.id);
                $("#hsc").attr('value',ui.item.id);
                $("#sub_seccion").removeAttr('disabled');
                autocompletarsubSeccion($("#seccion").val());
            }
          });
        }else {
          $("#seccion").attr('disabled','disabled');
          $("#seccion").val("vacio");
        }
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
}





function autocompletarsubSeccion(valor)
{
  var secciones = [];
  var uri = $("#base_url").val();
  $.ajax({
      url : uri+'Dependencias/busquedaHijos',
      data : {dependencia: valor},
      type : 'GET',
      dataType : 'json',
      success : function(json) {
        console.log(json);
        if (json.id != 'vacio') {
          $("#sub_seccion").autocomplete({
            source : json,
            select : function(event,ui){
                $("#sub_seccion").val(ui.item.id);
                $("#hsss").attr('value',ui.item.id);
            }
          });
        }else {
          $("#sub_seccion").attr('disabled','disabled');
          $("#sub_seccion").val("vacio");
        }
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });
}



function autocompletarSerie(valor)
{
  var uri = $("#base_url").val();
  $.ajax({
      url : uri+'Series/buscarHijosSerie',
      data : {serie: valor},
      type : 'GET',
      dataType : 'json',
      success : function(json) {
        console.log(json);
        if (json.id != 'vacio') {
          $("#sub_serie").autocomplete({
            source : json,
            select : function(event,ui){
                $("#sub_serie").val(ui.item.id);
                $("#hssr").attr('value',ui.item.id);
            }
          });
        }else {
          $("#sub_serie").attr('disabled','disabled');
          $("#sub_serie").val("vacio");
        }
      },
      error : function(xhr, status) {
          console.log(status);
      },
  });

}



  function ClasificarInfo(identificador)
  {
    if (identificador == 0) {
      $("#CONFIDENCIAL").removeAttr('class');
      $("#PUBLICO").removeAttr('class');
      $("#RESERVADA").removeAttr('class');
      $("#CONFIDENCIAL").attr('class','btn btn-default');
      $("#PUBLICO").attr('class','btn btn-default');
      $("#RESERVADA").attr('class','btn btn-success');
      $("#clasificacionInfo").attr('value',identificador);
    }else if (identificador == 1) {
      $("#CONFIDENCIAL").removeAttr('class');
      $("#PUBLICO").removeAttr('class');
      $("#RESERVADA").removeAttr('class');
      $("#CONFIDENCIAL").attr('class','btn btn-default');
      $("#PUBLICO").attr('class','btn btn-success');
      $("#RESERVADA").attr('class','btn btn-default');
      $("#clasificacionInfo").attr('value',identificador);
    }else if (identificador == 2) {
      $("#CONFIDENCIAL").removeAttr('class');
      $("#PUBLICO").removeAttr('class');
      $("#RESERVADA").removeAttr('class');
      $("#CONFIDENCIAL").attr('class','btn btn-success');
      $("#PUBLICO").attr('class','btn btn-default');
      $("#RESERVADA").attr('class','btn btn-default');
      $("#clasificacionInfo").attr('value',identificador);
    }
  }
