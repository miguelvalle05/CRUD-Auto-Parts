<?php

include("./funciones.php");
$conexion=conectar();

$id_model = $_POST['id_model'];
//echo $id_category;
$result = $conexion->query("SELECT * FROM  tiposversion_ap
                            WHERE Id_tipomodelo= ".$id_model." ORDER BY vDescripcion ASC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['IdVersion'].'">'.$row['vDescripcion'].'</option>';
    }
}
$html = '<option value="">Version</option>'.$html;
echo $html;
?>