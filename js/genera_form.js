var qu = [];
function leer() {
  var titulo = document.getElementsByName("Titulo")[0].value;
  var ruta = document.getElementsByName("Ruta")[0].value;

  if (titulo==""||ruta==""){
    console.log("debe llenar los campos")
    document.getElementById("fallo").innerHTML = " ¡Debe llenar todos los campos para generar formulario!";
    document.getElementById("fallo").style.display = "block";
  }else{
    document.getElementById("fallo").style.display = "none";
    document.getElementsByName("Titulo")[0].value = "";
    document.getElementsByName("Ruta")[0].value = "";
     var fondo = "fondo1.jpg"
    var obj = '{'
      + '"Titulo" :"' + titulo + '",'
      + '"Ruta" :"' + ruta + '",'
      + '"Fondo" :"' + fondo + '",'
      + '"Preguntas" :[' + qu + ']'
      + '}';
    a = JSON.parse(obj);
    console.log(a)
  
    $.ajax({
      data: 'data=' + obj,
      url: 'newfolder.php',
      method: 'POST', // or GET
      success: function (msg) {
        console.log(msg)
       document.getElementById("bien").style.display = "block";
       document.getElementById("url").style.display = "block";
       document.getElementById("url_datos").style.display = "block";
       document.getElementById("bien").innerHTML = " ¡El formulario fue creado con exito ! ";
       document.getElementById("url").href = '/formularios/'+ruta;
       document.getElementById("url_datos").href = '/formularios/'+ruta+"/descargas.html";
       
      
      }
    });
  }
  
}
function add_pregunta() {
   
  var Nombre = document.getElementsByName("Nombre")[0].value;
  var Nombre_corto = document.getElementsByName("Nombre_corto")[0].value;
  var Tipo = document.getElementsByName("Tipo")[0].value;
  var Tipo_dato = document.getElementsByName("Tipo_dato")[0].value;
  var Mensaje_validacion = document.getElementsByName("Mensaje_validacion")[0].value;
  var Valores = document.getElementsByName("Valores")[0].value;
  if (Nombre==""||Nombre_corto==""||Tipo==""||Mensaje_validacion=="" || Tipo=="select" && Valores=="" || Tipo=="input" && Tipo_dato==""){
      console.log("debe llenar los campos")
      document.getElementById("fallo").innerHTML = " ¡Debe llenar todos los campos para generar formulario!";
      document.getElementById("fallo").style.display = "block";
  }else{

   

    document.getElementById("fallo").style.display = "none";
    document.getElementById("generar").disabled = false;

    document.getElementsByName("Nombre")[0].value = "";
    document.getElementsByName("Nombre_corto")[0].value = ""; 
    document.getElementsByName("Tipo")[0].value = "";
    document.getElementsByName("Tipo_dato")[0].value = "";
    document.getElementsByName("Mensaje_validacion")[0].value = "";
    document.getElementsByName("Valores")[0].value = "";
    var val = Valores.split(",");
    for (i = 0; i < val.length; i++) {
      val[i] = '"' + val[i] + '"'
    }
    console.log(val[0])
  
    var obj = '{'
      + '"Nombre" :"' + Nombre + '",'
      + '"Nombre_corto" :"' + Nombre_corto + '",'
      + '"Tipo" :"' + Tipo + '",'
      + '"Tipo_dato" :"' + Tipo_dato + '",'
      + '"Mensaje_validacion" :"' + Mensaje_validacion + '",'
      + '"Valores" :[' + val + ']'
      + '}';
    qu.push(obj);
    console.log(qu)
    document.getElementsByName("Num_preguntas")[0].innerHTML = "Numero de preguntas: "+qu.length;
  }
  
}

$('select').on('change', function() {
  var valor =  this.value;

  if(valor=="input"){
    document.getElementById("select_valores").style.display = "none";
    document.getElementById("select_tipodato").style.display = "block";
  }
  if(valor=="select"){
    document.getElementById("select_valores").style.display = "block";
    document.getElementById("select_tipodato").style.display = "none";
   }
  console.log(valor);
});