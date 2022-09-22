<html>
    <head>

    </head>

    <body>
    <?php		
		include("./funciones.php");
		$conexion = conectar();
		
        $str_json = file_get_contents('php://input');

        $array = json_decode($str_json, true);

            var_dump($array);
          
		
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
