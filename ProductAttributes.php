<?

include("./funciones.php");
$conexion = conectar();
$str_json = file_get_contents('php://input');

    //  $str_json = '[{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"424","version":null,"anio":"49","aniof":"70","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"417","version":null,"anio":"47","aniof":"69","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"443","version":null,"anio":"55","aniof":"70","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"440","version":null,"anio":"59","aniof":"70","compati":"1","usaren":["4","5","6","7","8","9"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"450","version":null,"anio":"51","aniof":"66","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"449","version":null,"anio":"63","aniof":"70","compati":"1","usaren":["9","8","7","5","6","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"433","version":null,"anio":"46","aniof":"65","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"428","version":null,"anio":"62","aniof":"68","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"415","version":null,"anio":"60","aniof":"70","compati":"1","usaren":["9","8","7","6","5","4"]},{"codigo":"20301","tipo_parte":"17","marca":"51","modelo":"439","version":null,"anio":"50","aniof":"68","compati":"1","usaren":["9","8","7","6","5","4"]}]';

$array = json_decode($str_json, true);
var_dump($array);
$codigo=$array[0]['code'];
echo $codigo;




            Foreach ($array as $item) 
            { 

                $valor="INSERT INTO valatributos_ap (codigo, id_atributos, id_valores) VALUES ('" . $item[ "code" ] . "','" . $item[ "attribute" ] . "','" . $item[ "value" ] ."');";							
            
                $result = $conexion->query($valor);												
                if (!$result){									
                    die("<br />ERROR al agregar Atributos: ".mysql_error());
                    
                    }									
                else {
                  
               
                    echo "ATRIBUTOS CARGADOS=".$valor."<br /><br />"; 										
                									
                }	
                
            }


    
                            
                    $conexion->close();
            
        


?>