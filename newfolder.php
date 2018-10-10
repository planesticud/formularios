<?php

$data = $_POST["data"];
$json_obj = json_decode($data,true);
$nombre = $json_obj['Titulo'];
$nameform  =  $json_obj['Titulo'];
$preguntas = $json_obj['Preguntas'];




if (!file_exists($nameform)) {
    //crea el directrio del formulario
    mkdir($nameform, 0777, true);
    // crea la carpeta de css
    mkdir($nameform . '/css', 0777, true);
    // crea la carpeta de js
    mkdir($nameform . '/js', 0777, true);
    //copia los archivos base
    // css
    copy('base/css/custom.css', $nameform . '/css/custom.css');
    copy('base/css/dataTables.bootstrap.css', $nameform . '/css/dataTables.bootstrap.css');
    copy('base/css/style.css', $nameform . '/css/style.css');
    //js
    copy('base/js/csv_to_html_table.js', $nameform . '/js/csv_to_html_table.js');
    copy('base/js/dataTables.bootstrap.js', $nameform . '/js/dataTables.bootstrap.js');
    copy('base/js/jquery.csv.min.js', $nameform . '/js/jquery.csv.min.js');
    copy('base/js/jquery.dataTables.min.js', $nameform . '/js/jquery.dataTables.min.js');
    //visualizacion inscritos
    copy('base/descargas.html', $nameform . '/descargas.html');
    

 
    //generar html
    $titulo = '<h1>' . $nombre . '</h1>';
    $uno = file_get_contents('base/html1.txt');
    $dos = file_get_contents('base/html2.txt');
    $pre = '';
    $selectB = '';
    
    foreach ($preguntas as $pregunta) {
    if($pregunta['Tipo']=='select'){
        $selectA = '<div class="form-group">' .
        '<label class="col-md-4 control-label">' . $pregunta['Nombre'] . '</label>' .
        '<div class="col-md-4 inputGroupContainer">' .
        '<div class="input-group">' .
        '<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>' .
        '<select name="' . $pregunta['Nombre_corto'] . '" class="form-control selectpicker" >';

        $selectB = '<option value=" " >Elija una opcion</option>';
        $valores =  $pregunta['Valores'];
        foreach ($valores as $valor) {
            $selectBB = '<option>' . $valor . '</option>';
            $selectB  = $selectB . $selectBB; 
        }
        $selectC = '</select>' .
                '</div>' .
                '</div>' .
                '</div>';
        $select = $selectA . $selectB . $selectC;
        $pre = $pre . $select;
    }

    if($pregunta['Tipo']=='input'){

        $input = '<div class="form-group">' .
        '<label class="col-md-4 control-label">'. $pregunta['Nombre'] . '</label>' .
        '<div class="col-md-4 inputGroupContainer">' .        '<div class="input-group">' .        
        '<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>' .        
        '<input  name="' . $pregunta['Nombre_corto'] . '" placeholder="' . $pregunta['Nombre'] . '" class="form-control"  type="' . $pregunta['Tipo_dato'] . '">' .       
        '</div>' .        
        '</div>' .        
        '</div>';
      $pre = $pre . $input;

    }

    
  }
  $todo = $uno . $titulo . $pre  . $dos;
  $fp = fopen($nameform . '/index.html', "a");
  fwrite($fp, $todo);
  fclose($fp);

  // generar php
  $csvfile = 'fecha';
  $phpfile = '<?php' ."\n";
  foreach ($preguntas as $pregunta) {
    $phpfile .= '$'. $pregunta['Nombre_corto'] .' = $_POST["'. $pregunta['Nombre_corto'] .'"];  '."\n";
    $csvfile .=  "," . $pregunta['Nombre_corto'] ;
   }
   $csvfile .= "\n";
   $phpfile .='$fp = fopen("datos.csv", "a"); '."\n";
   $phpfile .= '$savestring =  date(\'Y-m-d\').';
   foreach ($preguntas as $pregunta) {
    $phpfile .= ' "," . $'. $pregunta['Nombre_corto'] .' .';
   }
   $phpfile .= '"\\n";  '."\n";
    $phpfile .= 'fwrite($fp, $savestring);  '."\n".
    'fclose($fp); '."\n".
    'echo"<script>alert(\'Gracias por realizar la inscripcion \')  '."\n".
    'window.location.href=\'https://campusvirtual.udistrital.edu.co/\';  '."\n".
    '</script>";  '."\n".
    '?>';
  $fp = fopen($nameform . '/process-form-data.php', "a");
  fwrite($fp, $phpfile);
  fclose($fp);

  $fc = fopen($nameform . '/datos.csv', "a");
  fwrite($fc, $csvfile);
  fclose($fc);

  //generar validador 

  $jsfile = '';
  $validador = '';
  $js1 = file_get_contents('base/validador1.txt');
  $js2 = file_get_contents('base/validador2.txt');
  
  foreach ($preguntas as $pregunta) {
  $validador .= $pregunta['Nombre_corto'] . ': { validators: { stringLength: { min: 2, message: \'No valido\' }, notEmpty: {message: \'' . $pregunta['Mensaje_validacion'] .  '\'}}},';
  }
  $jsfile = $js1 . $validador . $js2;
  $fjs = fopen($nameform . '/js/index.js', "a");
  fwrite($fjs, $jsfile);
  fclose($fjs);





}else{
    echo "la carpeta ya existe";
}

?>