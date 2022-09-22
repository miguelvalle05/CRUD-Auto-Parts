<?php


include("./funciones.php");
$conexion=conectar();
//if ($_POST['id_marca2']!="")$id_category = $_POST['id_marca2'];
 $id_brand = $_POST['id_brand'];

	$result = $conexion->query("SELECT * FROM  tiposmodelo_ap
                            WHERE Id_tipomarca= ".$id_brand." ORDER BY moDescripcion ASC");
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {                
			$html .= '<option value="'.$row['IdModelo'].'">'.$row['moDescripcion'].'</option>';
		}
	}


$html = '<option value="">Modelo</option>'.$html;
echo $html;
?>