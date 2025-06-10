<?php
$host = "localhost";   
$usuario = "root"; 
$clave = "";     
$base = "simulador";

$conexion = new mysqli($host, $usuario, $clave, $base);

//var_dump($conexion);die();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


/*$titulo_site = "Simulador";
$conf_destino_userfiles = "sitio";
$conf_direccion = "Urquiza 827 - Concordia";
$conf_telefono = "+ 54 0345 423 0003";
$conf_cp = "3100";
$conf_ciudad = "Concordia, Entre RÃ­os";
$conf_responsable = "Cristhian";
$conf_email = "cristhiancarballo@constru.com.ar";
$conf_horario_atencion = '';


     $conf_sitio = 'http://autos.financia.com.ar';
     $server = 'localhost';

     $bd = "275732_wordpress";
     $bd_usuario = "275732-admin";
     $bd_pass = "heCL16-}.,$)";
     
     
     $conexion = new mysqli($server,$bd_usuario,$bd_pass,$bd);
     $conexion->set_charset('utf8');

    
date_default_timezone_set('America/Argentina/Buenos_Aires');

$fechaactual = date("Y-m-d");
$horaactual = date ("H:i:s");
$mesactual = date ("m");
$anioactual = date ("Y");
$diaactual = date("j");
*/
?>

