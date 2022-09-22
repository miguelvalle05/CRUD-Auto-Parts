<?php



include("./Functions.php");
$conexion = conectar();
$codeV=$_POST['codeV'];
//echo $codigo;

                    $result = $conexion->query("

                    SELECT 
                    `ap1`.`id` ,
                    `ap1`.`codigo` ,
                    `ap1`.`tipo_parte` ,
                    `tp2`.`Descripcion` ,
                    `ma2`.`maDescripcion` ,  
                    `ma2`.`IdMarca` ,  
                    `mo3`.`moDescripcion` ,  
                    `mo3`.`IdModelo`, 
                    `ve4`.`vDescripcion` ,  
                    `ve4`.`IdVersion`,
                    `ai5`.`Anio` AS Anioi, 
                    `ap1`.`id_ano_in` ,
                    `ai6`.`Anio` AS Aniof,
                    `ap1`.`id_ano_fin`
                    FROM  `aplicaciones_ap` AS  `ap1` 
                    RIGHT JOIN  `tiposparte_ap` AS  `tp2` ON  `tp2`.`Id` =  `ap1`.`tipo_parte` 
                    LEFT JOIN  `tiposmarca_ap` AS  `ma2` ON  `ma2`.`IdMarca` =  `ap1`.`id_marca` 
                    LEFT JOIN  `tiposmodelo_ap` AS  `mo3` ON  `mo3`.`IdModelo` =  `ap1`.`id_modelo` 
                    LEFT JOIN  `tiposversion_ap` AS  `ve4` ON  `ve4`.`IdVersion` =  `ap1`.`id_version` 
                    LEFT JOIN  `anios` AS ai5 ON  `ai5`.`Id` =  `ap1`.`id_ano_in` 
                    LEFT  JOIN  `anios` AS ai6 ON  `ai6`.`Id` =  `ap1`.`id_ano_fin` 
                    WHERE  `ap1`.`codigo` =  ".$codeV." ORDER BY `ap1`.`id`						
                    ");
                            

                    if ($result->num_rows > 0) 

                    {
                        $set=array();
                        $arr = array();


                        while ($row = $result->fetch_assoc()) {  	
                            
                            
                            $set[]=$row;
                           
                                
                            }
                            $arr['app'] = $set;





                            $resultOne = $conexion->query("
                            SELECT DISTINCT
                            va.codigo,
                            a.tipo_parte,
                            va.id_atributos,
                            tp.aDescripcion,
                            va.id_valores,
                            tav.avDescripcion
                            
                            FROM valatributos_ap AS va
                            INNER JOIN aplicaciones_ap a ON a.codigo = va.codigo 
                            INNER JOIN tiposasignaatributos_ap taa ON a.tipo_parte = taa.Id_tipoparte AND taa.Id_atributo = va.id_atributos
                            RIGHT JOIN tiposatributovalor_ap tav ON tav.Id = va.id_valores
                            INNER JOIN tiposatributo_ap tp ON tp.aId = va.id_atributos
                            WHERE va.codigo =".$codeV." ORDER BY tp.aDescripcion
                            ");
                                    
        
                            if ($resultOne->num_rows > 0) 
        
                            {
                                $setOne=array();
        
                                while ($rowOne = $resultOne->fetch_assoc()) {  	
                                    
                                    
                                    $setOne[]=$rowOne;
                                   
                                        
                                    }

                                    $arr['att'] = $setOne;
                                    
        
        
  
                                
                            }
                            else{
                                $arr['att'] = array(0);
                                    
                            }
                            

                            
                            

                            
                            echo json_encode($arr);


                        
                    }
                    else{
                        echo 0;
                    }

?>