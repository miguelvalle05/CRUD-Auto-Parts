<?php

include("./funciones.php");

$conexion=conectar();
$id_partType = $_POST['id_partType'];

function optenval($opc, $conexion)
{	
	$result2 = $conexion->query("SELECT T1.Id, T1.Id_tipoatributo, T1.avDescripcion, T2.AtTipo FROM tiposatributovalor_ap T1 
INNER JOIN tiposatributo_ap T2 ON T2.aId = T1.Id_tipoatributo WHERE T1.Id_tipoatributo = ".$opc." ORDER BY avDescripcion ASC ");
		
	if ($result2->num_rows > 0) {
		
		
		
		while ($row2 = $result2->fetch_assoc()) {  			
			$opciones .= '<option value="'.$opc.".".$row2['Id'].'">'.$row2['avDescripcion'].'</option>';
		}		
		
		
	}
	return $opciones;
};

$result = $conexion->query("SELECT T1.Id, T1.Descripcion, T2.Id_tipoparte, T2.Id_atributo,T3.aId,T3.aDescripcion,T2.Orden, t3.AtTipo
FROM tiposparte_ap T1 
INNER JOIN tiposasignaatributos_ap T2 ON T1.Id = T2.Id_tipoparte 
INNER JOIN tiposatributo_ap T3 ON T3.aId = T2.Id_atributo
WHERE T1.Id = ".$id_partType." ORDER BY T2.Orden ASC 	");
		
$recordcon=$result->num_rows;
if ($result->num_rows > 0) 
{
	$cont=0;
	$contTwo=0;
	$contOne=5;
	$html .= '<label class="labeltopic">Atributos: </label>
    <div class="row">';
    while ($row = $result->fetch_assoc()) {  			
	$cont++;
    $contOne--;
		$html .= ' <div class="col-md-3">
        <label class="labeltittle">'.$row['aDescripcion'].'</label>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"> <i class="fas fa-list"></i></span>
        <select  class="form-select" id="atributo'.$cont.'" name="atributo'.$cont.'">
        <option selected value="">'.$row['aDescripcion'].'</option>
        '.optenval($row['Id_atributo'],$conexion).'</select>
        </div>
        </div>';

        if($contOne==1){
            $contTwo++;
            if($contTwo>=1){
                $html .= '</div>';	

            }
            $html .= '<div class="row">';
            $contOne=5;
        
    
        }
	 }
	$html .= '</div>';	
}

echo $valor='<input style="display:none" class="input is-normal" id="record" name="record"  type="text" placeholder="record" value="'.$recordcon.'">';
$cont=0;
echo $html;
?>

