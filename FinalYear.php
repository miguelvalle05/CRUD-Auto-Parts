<?php

include("./funciones.php");
$conexion=conectar();
$id_initialYear = $_POST['id_initialYear'];


//echo $id_category;


$result = $conexion->query("SELECT `Id`, `Anio` FROM `anios` WHERE `Id` = ".$id_initialYear);

if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) {  			
		        $anio = $row['Anio'];
    }	
}



$result = $conexion->query("SELECT `Id`, `Anio` FROM `anios` WHERE `Anio` >= ".$anio);

if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) {  			
		        $html .= '<option value="'.$row['Id'].'">'.$row['Anio'].'</option>';
    }	
}



echo $html;
?>

