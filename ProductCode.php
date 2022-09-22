<?php

include("./Functions.php");
$conexion = conectar();
$codeV=$_POST['codeV'];
//echo $codigo;

                    $result = $conexion->query("
                    SELECT codigo
                    FROM aplicaciones_ap
                    WHERE codigo=$codeV");

                    $resultOne = $conexion->query("
                    SELECT codigo
                    FROM valatributos_ap
                    WHERE codigo=$codeV");
                            

                    if ($result->num_rows > 0 || $resultOne->num_rows > 0) 

                    {
                        echo 0;

                    }
                    else{
                         echo 1;
                    }

                   
?>