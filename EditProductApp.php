<html>
    <head>

    </head>

    <body>
    <?php		
		include("./Functions.php");
		$conexion = conectar();
		
        $str_json = file_get_contents('php://input');

        $array = json_decode($str_json, true);

            var_dump($array);

            $codigo=$array[0]['code'];
            echo $codigo;

               
                    $consulta= "DELETE FROM aplicaciones_ap WHERE codigo = '$codigo'";		
                    if ($result = $conexion->query($consulta)) {
                         echo $resultado=$consulta."<br />SE ELIMINO SERVICIO";		
                    }
                    else {
                        echo $resultado=$consulta."Error: al eliminar SERVICIO";
                    }
		
			Foreach ($array as $item) 
            { 
               
               
				$query="INSERT INTO aplicaciones_ap (codigo,tipo_parte,id_marca,id_modelo,id_version,id_ano_in,id_ano_fin) VALUES ('" . $item[ "code" ] . "', '" . $item[ "partType" ] . "', '" . $item[ "brand" ] . "', '"  . $item[ "model" ] . "', '"  . $item[ "version" ] . "', '"  . $item[ "initialYear" ] . "', '"  . $item[ "finalYear" ] . "');"; 
			    $result=$conexion->query($query);
                if (!$result)
                    {									
					die("<br />ERROR al agregar Servicio de equipo: ".mysql_error());
				
					}
                    else    
                    
                    {
                        
                        $id=mysqli_insert_id($conexion);
                        echo "Servicios cargados=".$query."<br /><br />";

                    }

            }

	?>
    </body>
</htm>
