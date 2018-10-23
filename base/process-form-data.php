<?php
$name = $_POST["name"];
$last_name = $_POST["last_name"];
$tdoc = $_POST["tdoc"];
$documento = $_POST["documento"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$vinculacion = $_POST["vinculacion"];
$fac_dep = $_POST["fac_dep"];
$pcurricular = $_POST["pcurricular"];
$codigo = $_POST["codigo"];
$cursos = $_POST["cursos"];

$fp = fopen("inscripcion_diplomados.csv", "a");
$savestring =  date('Y-m-d'). "," . $name . "," . $last_name .  "," . $tdoc . "," . $documento . "," . $phone . "," . $email .  "," . $vinculacion . "," . $fac_dep .  "," . $pcurricular . "," . $codigo . "," . $cursos . "\n";
fwrite($fp, $savestring);
fclose($fp);
echo"<script>alert('Gracias por realizar la inscripcion ') 

window.location.href='https://campusvirtual.udistrital.edu.co/'; 

</script>";
?>