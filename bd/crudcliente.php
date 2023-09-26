<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';
$razon = (isset($_POST['razon'])) ? $_POST['razon'] : '';
$calle = (isset($_POST['calle'])) ? $_POST['calle'] : '';
$colonia = (isset($_POST['colonia'])) ? $_POST['colonia'] : '';
$cp = (isset($_POST['cp'])) ? $_POST['cp'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$telm = (isset($_POST['telm'])) ? $_POST['telm'] : '';
$telc = (isset($_POST['telc'])) ? $_POST['telc'] : '';
$telt = (isset($_POST['telt'])) ? $_POST['telt'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$nacionalidad = (isset($_POST['nacionalidad'])) ? $_POST['nacionalidad'] : '';
$edoc = (isset($_POST['edoc'])) ? $_POST['edoc'] : '';
$banco = (isset($_POST['banco'])) ? $_POST['banco'] : '';
$cuenta = (isset($_POST['cuenta'])) ? $_POST['cuenta'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';



switch($opcion){
    case 1: //alta
        $consulta = "SELECT * FROM cliente ORDER BY clave DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row){
            $clave=$row['clave'];
            $clave=intval($clave)+1;
            $clave=str_pad((string)$clave, 8, '0', STR_PAD_LEFT);
        }
        $res=$clave;

        $consulta = "INSERT INTO cliente (clave,nombre,dir_calle,dir_ciudad,dir_colonia,dir_cp,folio,nacionalidad,estado,tel_cel,tel_casa,tel_trab,email,rfc,dir_edo,cuenta,banco) 
        VALUES('$clave','$razon','$calle','$ciudad','$colonia','$cp','$folio','$nacionalidad','$edoc','$telm','$telc''$telt','$correo','$estado','$cuenta','$banco') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM cliente ORDER BY clave DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE w_concepto SET clave_concepto='$clave',nom_concepto='$concepto',unidad='$unidad' WHERE id_concepto='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
      
        $data=1;
        break;        
    case 3://baja
        $consulta = "UPDATE w_concepto SET estado_concepto=0 WHERE id_concepto='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=1;                          
        break;   
  
}

print json_encode($res, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
