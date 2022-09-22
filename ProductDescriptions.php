<html>
    <head>

    </head>

    <body>
    <?php		
		include("./funciones.php");
        $option = $_POST['option'];
        $codeV= $_POST['codeV'];
        



        if($option==0){


          
                        $conexion = conectar();
                        $consulta="SELECT  `ap1`.`id` , `ap1`.`codigo` ,  `ma2`.`maDescripcion` ,  `ma2`.`maDescripcion_corta` ,  `mo3`.`moDescripcion` ,  `ve4`.`vDescripcion` ,  `ai5`.`Anio` AS Anioi, `ai6`.`Anio` AS Aniof,  `mo3`.`moDescripcion_corta` ,  `ve4`.`vDescripcion_corta` ,  `tp2`.`Descripcion_corta` AS Tipopartec, `tp2`.descricorta_radec AS descRadec,  `tp2`.`Descripcion` AS Tipoparte
                        FROM  `aplicaciones_ap` AS  `ap1` 
                        RIGHT JOIN  `tiposparte_ap` AS  `tp2` ON  `tp2`.`Id` =  `ap1`.`tipo_parte` 
                        LEFT JOIN  `tiposmarca_ap` AS  `ma2` ON  `ma2`.`IdMarca` =  `ap1`.`id_marca` 
                        LEFT JOIN  `tiposmodelo_ap` AS  `mo3` ON  `mo3`.`IdModelo` =  `ap1`.`id_modelo` 
                        LEFT JOIN  `tiposversion_ap` AS  `ve4` ON  `ve4`.`IdVersion` =  `ap1`.`id_version` 
                        LEFT JOIN  `anios` AS ai5 ON  `ai5`.`Id` =  `ap1`.`id_ano_in` 
                        LEFT  JOIN  `anios` AS ai6 ON  `ai6`.`Id` =  `ap1`.`id_ano_fin` 
                        WHERE  `ap1`.`codigo` =  '$codeV' ORDER BY `ap1`.`id`;";
                                            
                                            
                                            //$consulta="SELECT t2.codigo, t5.Descripcion, t3.maDescripcion, t4.moDescripcion, t8.vDescripcion,t6.Anio AS AnioI,t7.Anio AS AnioF from aplicaciones_ap t2 LEFT JOIN tiposmarca_ap t3 ON t2.id_marca = t3.IdMarca LEFT JOIN tiposmodelo_ap t4 ON t2.id_modelo = t4.IdModelo LEFT JOIN tiposversion_ap t8 ON t2.id_version = t8.IdVersion INNER JOIN tiposparte_ap t5 ON t5.Id= t2.tipo_parte LEFT JOIN anios AS t6 ON t2.id_ano_in = t6.Id LEFT JOIN anios AS t7 ON t2.id_ano_fin = t7.Id WHERE t2.codigo=$codeV ORDER BY t3.maDescripcion,t4.moDescripcion,t8.vDescripcion,t5.Descripcion,AnioI,AnioF,t2.codigo ASC";
                                            
                                            
                                            //echo "PRIMERA CONSULTA:".$consulta."<br />";
                                            $result = $conexion->query($consulta);
                                            $cont=0;
                                            //echo "<br />ALGO".$result->fetch_assoc()."TERMINA<br />";
                                            $descripcionw="";
                                            while($row = $result->fetch_assoc()){
                                                $aplicaciones[$cont][0]         = $row['maDescripcion_corta'];
                                                $aplicaciones[$cont][1]     = $row['moDescripcion'];										
                                                $aplicaciones[$cont][2]     = $row['vDescripcion'];
                                                $aplicaciones[$cont][3]      = anio($row['Anioi'],$row['Aniof']);
                                                $aplicaciones[$cont][4]      = $row['moDescripcion_corta'];
                                                $aplicaciones[$cont][5]      = $row['Tipopartec'];
                                                $aplicaciones[$cont][6]      = $row['Tipoparte'];
                                                $aplicaciones[$cont][7]      = $row['descRadec'];
                                                $descripcionw.="<br />".$row['maDescripcion']."<strong> <span class=\"textnara\">"." ".$row['moDescripcion']."</span> </strong>"." ".$row['vDescripcion']." ".$row['Anioi']."-".$row['Aniof'];
                                                $cont++;
                                            }
                                            $cont2=0;
                                        //	echo "<br />cont:=".$cont."<br />";
                                            //SOLO PARA COMPROBAR
                                            while($cont > $cont2){
                                        //		echo "<br/>aplicaciones[$cont2][0]=".$aplicaciones[$cont2][0];
                                        //		echo "<br/>aplicaciones[$cont2][1]=".$aplicaciones[$cont2][1];     
                                        //		echo "<br/>aplicaciones[$cont2][2]=".$aplicaciones[$cont2][2];     
                                        //		echo "<br/>aplicaciones[$cont2][3]=".$aplicaciones[$cont2][3];     
                                        //	    echo "<br/>aplicaciones[0][5]=".$aplicaciones[0][5];      
                                                $cont2++;
                                            }
                                            //$cont2=$cont;
                                            echo "<br /><br />";
                                            if($aplicaciones[0][0]!=""){
                                                $descfinal.=$aplicaciones[0][0]." ";
                                                $descfinalc.=$aplicaciones[0][0]." ";
                                                $descfinalcRadec.=$aplicaciones[0][0]." ";
                                                }
                                            if($aplicaciones[0][1]!=""){
                                                $descfinal.=$aplicaciones[0][1]." ";
                                                $descfinalc.=$aplicaciones[0][4]." ";
                                                $descfinalcRadec.=$aplicaciones[0][4]." ";
                                                }
                                            if($aplicaciones[0][2]!=""){
                                                $descfinal.=$aplicaciones[0][2]." ";
                                                $descfinalc.=$aplicaciones[0][2]." ";
                                                $descfinalcRadec.=$aplicaciones[0][2]." ";
                                                }
                                            if($aplicaciones[0][3]!="" AND $cont2== 1 ){
                                                $descfinal.=$aplicaciones[0][3]." ";
                                            //	$descfinalc.=$aplicaciones[0][3]." ";
                                                }
                                            else if($aplicaciones[0][3]!="" AND $aplicaciones[0][3]!= $aplicaciones[1][3] ){
                                                $descfinal.=$aplicaciones[0][3]." ";
                                                //$descfinalc.=$aplicaciones[0][3]." ";
                                                }
                                            for($cont=1;$cont<=$cont2;$cont++){
                                                ////MARCA
                                                if($aplicaciones[$cont][0]!=""AND $aplicaciones[$cont][0]!=$aplicaciones[$cont-1][0]){
                                                    $descfinal.=" ".$aplicaciones[$cont][0]." ";
                                                    //$descfinalc.=" ".$aplicaciones[$cont][0]." ";
                                                    }
                                                else if($aplicaciones[$cont][0]=="") break;
                                                ////MODELO
                                                if($aplicaciones[$cont][1]!="" AND $aplicaciones[$cont][1]!=$aplicaciones[$cont-1][1]){
                                                    if($aplicaciones[$cont-1][0]==$aplicaciones[$cont][0]){
                                                        $descfinal.="/";
                                                        //$descfinalc.="/";
                                                        }
                                                    $descfinal.=$aplicaciones[$cont][1]." ";
                                                    //$descfinalc.=$aplicaciones[$cont][4]." ";
                                                    }
                                                ////VERSION
                                                if($aplicaciones[$cont][2]!=""){
                                                    if($aplicaciones[$cont-1][1]==$aplicaciones[$cont][1]){
                                                        $descfinal.="/";
                                                        //$descfinalc.="/";
                                                        }
                                                    $descfinal.=$aplicaciones[$cont][2]." ";
                                                    //$descfinalc.=$aplicaciones[$cont][2]." ";
                                                    }
                                                ///AÑOS
                                                if($aplicaciones[$cont][3]!="" AND $aplicaciones[$cont][3]!=$aplicaciones[$cont+1][3]){
                                                        //echo "ENTRO A APLICACION ANIO 1";
                                                        $ultimo=substr($descfinal, -1);
                                                        if($ultimo=="/"){
                                                             $descfinal = substr($descfinal, 0, -1);
                                                            //$descfinalc = substr($descfinalc, 0, -1);
                                                        }
                                                        $descfinal.=$aplicaciones[$cont][3]." ";
                                                        
                                                    }
                                                    
                                                    
                                            }
                                            $descfinalc.=$aplicaciones[0][3]." ";
                                            $descfinalcRadec.=$aplicaciones[0][3]." ";
                                            
                                            $descfinal=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinal)));
                                            //$descfinal=$aplicaciones[0][5]." ".$descfinal;
                                            $descfinalc=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinalc)));
                                            $descfinalcRadec=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinalcRadec)));
                                            $descfinalc=$aplicaciones[0][5]." ".$descfinalc;
                                            $descfinalcRadec=$aplicaciones[0][7]." ".$descfinalcRadec;
                                            //echo "DESCRIPCION LARGA:<br />".$descfinal."<br /><br />";
                                            //echo "DESCRIPCION CORTA:<br />".$descfinalc."<br /><br />";
                                            //ATRIBUTOS
                                            //$consulta="SELECT `vat1`.`codigo` , `tav3`.`avDescripcion` , `tav3`.`avDescripcion_corta`, `ta2`.`orden` FROM `valatributos_ap` AS `vat1` RIGHT JOIN `tiposatributo_ap` AS `ta2` ON `ta2`.`aId` = `vat1`.`id_atributos` RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `vat1`.`Id_valores` WHERE `codigo` = '".$codeV."' ORDER BY `orden` ASC;";
                                            
                                            ///PENDIENTE
                                            //$consulta="SELECT `vat1`.`codigo` , `tav3`.`avDescripcion` , `tav3`.`avDescripcion_corta`, `ta2`.`orden` FROM `valatributos_ap` AS `vat1` RIGHT JOIN `tiposatributo_ap` AS `ta2` ON `ta2`.`aId` = `vat1`.`id_atributos` RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `vat1`.`Id_valores` WHERE `codigo` = '".$codeV."' ORDER BY `orden` ASC;";
                                            
                                            //CORREGIDA
                                            $consulta="SELECT DISTINCT t1.codigo,t2.tipo_parte,t1.id_atributos, t4.aDescripcion, t1.id_valores, tav3.avDescripcion,`tav3`.`avDescripcion_corta`, t3.Orden FROM valatributos_ap t1 INNER JOIN aplicaciones_ap t2 ON t2.codigo = t1.codigo 
                                            INNER JOIN tiposasignaatributos_ap t3 ON t2.tipo_parte = t3.Id_tipoparte AND t3.Id_atributo = t1.id_atributos
                                            RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `t1`.`id_valores`
                                            INNER JOIN tiposatributo_ap t4 ON t4.aId = t1.id_atributos
                                            WHERE t1.codigo = '".$codeV."'AND id_atributos <> 53 ORDER BY t3.Orden ASC";//id_atributos Quitamos la opcion de guardar el origen
                                            
        
        
                                            
                                            $result = $conexion->query($consulta);
                                            $cont=0;
                                            $valatributos;
                                            $descripcionw.="<br />";
                                            while($row = $result->fetch_assoc()){
                                                if($row['id_atributos']<>46){
                                                $valatributos.= " ".$row['avDescripcion'];
                                                }
                                                else $valatributoslado.= " ".$row['avDescripcion'];
                                                //JUNTAR LOS VALORES PARA GENERAR LA DESCRIPCION DE LA WEB.
                                                $descripcionw.="<br /><strong>".$row['aDescripcion'].": </strong>".$row['avDescripcion'];
                                                $valatributoscorta.= " ".$row['avDescripcion_corta'];
                                                if($row['id_atributos']==46){
                                                    $ladorad=$row['avDescripcion_corta'];
                                                    
                                                }
        
                                                //if($row['id_atributos']==15 ||$row['id_atributos']==22 ||$row['id_atributos']==4 ||$row['id_atributos']==49 ||$row['id_atributos']==65)		
                                                if($row['id_atributos']==15 )		
                                                $valatributoscortaRadec.= " ".$row['avDescripcion_corta'];
                                                $cont++;
                                            }
                                            $valatributoscortaRadec.=" ".$ladorad;
        
                                            ///CONCATENAR A 80 caracteres la suma de Descripcion corta + atributos
                                             /*if((strlen($valatributoscorta)+strlen($descfinalc))>80){
                                                 $quitar=80-strlen($valatributoscorta);
                                                 $quitar=0-(strlen($descfinalc)-$quitar);										 
                                                 $descfinalc=substr($descfinalc, 0, $quitar);										 */
                                                 
                                                 if((strlen($valatributoscorta)+strlen($descfinalc))>80){
                                                 $quitar=80-strlen($descfinalc);
                                                 $quitar=0-(strlen($valatributoscorta)-$quitar);										 
                                                 $valatributoscorta=substr($valatributoscorta, 0, $quitar);										 
                                             }
        
        
                                             if((strlen($valatributoscortaRadec)+strlen($descfinalcRadec))>40){
                                                $quitar=40-strlen($descfinalcRadec);
                                                $quitar=strlen($valatributoscortaRadec)-$quitar;										 
                                                $valatributoscortaRadec=substr($valatributoscortaRadec, $quitar);										 
                                            }
        
                                             $descripcionw=strtoupper($aplicaciones[0][6]).$descripcionw; 
                                             $descripcionw.="<br />";
                                             /*MODIFICACION 21-09-2019 agregar lado descripcion corta web*/
                                                 /*si existe lado concatenarlo a la descripcion corta si no existe no hacer nada.*/
                                                 
                                                 
                                                 $descCortaW=$descfinal;
                                                 $ConsLado="SELECT t1.codigo,t2.avDescripcion FROM valatributos_ap t1 INNER JOIN tiposatributovalor_ap t2 ON t2.id = t1.id_valores WHERE t1.codigo='$codeV' AND t1.id_atributos = 46 ";
                                                 $resultLado = $conexion->query($ConsLado);
                                                 while($row2 = $resultLado->fetch_assoc()){
                                                    $descCortaW = $descfinal." ".$row2['avDescripcion'];
                                                    //JUNTAR LOS VALORES PARA GENERAR LA DESCRIPCION DE LA WEB.
                                                }
                                                
                                                $meta_description=str_replace(array(')','(','<br />', '<strong>', '<span ', '</span>', '</strong>', 'class=', 'textnara', '"', '>', '/','   ','  ','  '),array('','',' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' '),$descripcionw);
                                                $descfinalc=$descfinalc." ".$valatributoscorta;
                                                $descfinalcRadec=$descfinalcRadec." ".$valatributoscortaRadec;
                                                //$descfinalc=strtoupper(str_replace(array('  ','  '),array(' ',' '),$descfinalc));
                                                $descfinalc=str_replace(array('  ','  '),array(' ',' '),$descfinalc);
                                                $descfinalcRadec=str_replace(array('  ','  '),array(' ',' '),$descfinalcRadec);
                                                $tamMetDes=strlen($meta_description);
                                                if($tamMetDes>160){
                                                    $ResTam=$tamMetDes-157;
                                                    $meta_description = substr($meta_description, 0, -$ResTam)."...";  // devuelve "abcde"
                                                    }
                                                 
                                                 $desclarga=strtoupper($aplicaciones[0][6])." ".$descfinal.ucwords(strtolower($valatributos));
                                                 $desclarga.=$valatributoslado;
                                                 $descfinalcRadec=strtoupper($descfinalcRadec);
                                                 $desclarga=strtoupper($desclarga);
                                                //$meta_description=$sus; 
                                             /*FIN MOD 21-09-2019*/
        
        
        
        
        
                                            $consulta="INSERT INTO  `descripciones_ap` (`id` ,
                                                `codigo` ,
                                                `descripcionl` ,
                                                `descripcionc` ,
                                                `descripcionw` ,
                                                `descripcioncw`,
                                                `meta_description`,
                                                `DescCorta_radec`
                                                )
                                                VALUES (
                                                NULL ,  '".$codeV."',  '".$desclarga."',  '".$descfinalc."',  '$descripcionw','".$descCortaW."','$meta_description','$descfinalcRadec');";
                                            $result = $conexion->query($consulta);
                                            $conexion->close();
                                            generaName($codeV);
                                            genKeyword($codeV);
                                            generaTags($codeV);
                                            generaTabApp($codeV);
                                            ActualizaWeb($codeV);
                                            ActualizaIntesys($codeV,$desclarga,$descfinalc);
                                            updateApplicationWeb($codeV);
                                            
                                            
                                            return "<br /><br /><br />$codeV<br /><strong>DESCRIPCION LARGA:</strong><br />".$desclarga."<br /><br /><strong>DESCRIPCION CORTA:<br /></strong>".$descfinalc."<br /><br /><strong>DESCRIPCION WEB:</strong>".$descripcionw."<br />$tableapp"."<br /><br /><strong>DESCRIPCION CORTA RADEC:</strong>".$descfinalcRadec."<br />$tableapp";
            

        }
        if($option==1){

        
		$conexion = conectar();
		$consulta= "DELETE FROM `descripciones_ap` WHERE `descripciones_ap`.`codigo` = '$codeV'";		
		if ($result = $conexion->query($consulta)) {
			 $resultado="<br />SE ELIMINO LA DESCRIPCION";		
		}
		else $resultado=$resultado."ERROR EN:".$consulta."Error: al eliminar La descripcion";	
		$conexion->close();					
		return $resultado;	

        }

        if($option==2){

        
            $conexion = conectar();
            $consultaD= "DELETE FROM `descripciones_ap` WHERE `descripciones_ap`.`codigo` = '$codeV'";		
            if ($resultD = $conexion->query($consultaD)) {
                 $resultadoD="<br />SE ELIMINO LA DESCRIPCION";		
            }
            else $resultadoD=$resultadoD."ERROR EN:".$consultaD."Error: al eliminar La descripcion";	
           	
            
            
            $consulta="SELECT  `ap1`.`id` , `ap1`.`codigo` ,  `ma2`.`maDescripcion` ,  `ma2`.`maDescripcion_corta` ,  `mo3`.`moDescripcion` ,  `ve4`.`vDescripcion` ,  `ai5`.`Anio` AS Anioi, `ai6`.`Anio` AS Aniof,  `mo3`.`moDescripcion_corta` ,  `ve4`.`vDescripcion_corta` ,  `tp2`.`Descripcion_corta` AS Tipopartec, `tp2`.descricorta_radec AS descRadec,  `tp2`.`Descripcion` AS Tipoparte
            FROM  `aplicaciones_ap` AS  `ap1` 
            RIGHT JOIN  `tiposparte_ap` AS  `tp2` ON  `tp2`.`Id` =  `ap1`.`tipo_parte` 
            LEFT JOIN  `tiposmarca_ap` AS  `ma2` ON  `ma2`.`IdMarca` =  `ap1`.`id_marca` 
            LEFT JOIN  `tiposmodelo_ap` AS  `mo3` ON  `mo3`.`IdModelo` =  `ap1`.`id_modelo` 
            LEFT JOIN  `tiposversion_ap` AS  `ve4` ON  `ve4`.`IdVersion` =  `ap1`.`id_version` 
            LEFT JOIN  `anios` AS ai5 ON  `ai5`.`Id` =  `ap1`.`id_ano_in` 
            LEFT  JOIN  `anios` AS ai6 ON  `ai6`.`Id` =  `ap1`.`id_ano_fin` 
            WHERE  `ap1`.`codigo` =  '$codeV' ORDER BY `ap1`.`id`;";
                                
                                
                                //$consulta="SELECT t2.codigo, t5.Descripcion, t3.maDescripcion, t4.moDescripcion, t8.vDescripcion,t6.Anio AS AnioI,t7.Anio AS AnioF from aplicaciones_ap t2 LEFT JOIN tiposmarca_ap t3 ON t2.id_marca = t3.IdMarca LEFT JOIN tiposmodelo_ap t4 ON t2.id_modelo = t4.IdModelo LEFT JOIN tiposversion_ap t8 ON t2.id_version = t8.IdVersion INNER JOIN tiposparte_ap t5 ON t5.Id= t2.tipo_parte LEFT JOIN anios AS t6 ON t2.id_ano_in = t6.Id LEFT JOIN anios AS t7 ON t2.id_ano_fin = t7.Id WHERE t2.codigo=$codeV ORDER BY t3.maDescripcion,t4.moDescripcion,t8.vDescripcion,t5.Descripcion,AnioI,AnioF,t2.codigo ASC";
                                
                                
                                //echo "PRIMERA CONSULTA:".$consulta."<br />";
                                $result = $conexion->query($consulta);
                                $cont=0;
                                //echo "<br />ALGO".$result->fetch_assoc()."TERMINA<br />";
                                $descripcionw="";
                                while($row = $result->fetch_assoc()){
                                    $aplicaciones[$cont][0]         = $row['maDescripcion_corta'];
                                    $aplicaciones[$cont][1]     = $row['moDescripcion'];										
                                    $aplicaciones[$cont][2]     = $row['vDescripcion'];
                                    $aplicaciones[$cont][3]      = anio($row['Anioi'],$row['Aniof']);
                                    $aplicaciones[$cont][4]      = $row['moDescripcion_corta'];
                                    $aplicaciones[$cont][5]      = $row['Tipopartec'];
                                    $aplicaciones[$cont][6]      = $row['Tipoparte'];
                                    $aplicaciones[$cont][7]      = $row['descRadec'];
                                    $descripcionw.="<br />".$row['maDescripcion']."<strong> <span class=\"textnara\">"." ".$row['moDescripcion']."</span> </strong>"." ".$row['vDescripcion']." ".$row['Anioi']."-".$row['Aniof'];
                                    $cont++;
                                }
                                $cont2=0;
                            //	echo "<br />cont:=".$cont."<br />";
                                //SOLO PARA COMPROBAR
                                while($cont > $cont2){
                            //		echo "<br/>aplicaciones[$cont2][0]=".$aplicaciones[$cont2][0];
                            //		echo "<br/>aplicaciones[$cont2][1]=".$aplicaciones[$cont2][1];     
                            //		echo "<br/>aplicaciones[$cont2][2]=".$aplicaciones[$cont2][2];     
                            //		echo "<br/>aplicaciones[$cont2][3]=".$aplicaciones[$cont2][3];     
                            //	    echo "<br/>aplicaciones[0][5]=".$aplicaciones[0][5];      
                                    $cont2++;
                                }
                                //$cont2=$cont;
                                echo "<br /><br />";
                                if($aplicaciones[0][0]!=""){
                                    $descfinal.=$aplicaciones[0][0]." ";
                                    $descfinalc.=$aplicaciones[0][0]." ";
                                    $descfinalcRadec.=$aplicaciones[0][0]." ";
                                    }
                                if($aplicaciones[0][1]!=""){
                                    $descfinal.=$aplicaciones[0][1]." ";
                                    $descfinalc.=$aplicaciones[0][4]." ";
                                    $descfinalcRadec.=$aplicaciones[0][4]." ";
                                    }
                                if($aplicaciones[0][2]!=""){
                                    $descfinal.=$aplicaciones[0][2]." ";
                                    $descfinalc.=$aplicaciones[0][2]." ";
                                    $descfinalcRadec.=$aplicaciones[0][2]." ";
                                    }
                                if($aplicaciones[0][3]!="" AND $cont2== 1 ){
                                    $descfinal.=$aplicaciones[0][3]." ";
                                //	$descfinalc.=$aplicaciones[0][3]." ";
                                    }
                                else if($aplicaciones[0][3]!="" AND $aplicaciones[0][3]!= $aplicaciones[1][3] ){
                                    $descfinal.=$aplicaciones[0][3]." ";
                                    //$descfinalc.=$aplicaciones[0][3]." ";
                                    }
                                for($cont=1;$cont<=$cont2;$cont++){
                                    ////MARCA
                                    if($aplicaciones[$cont][0]!=""AND $aplicaciones[$cont][0]!=$aplicaciones[$cont-1][0]){
                                        $descfinal.=" ".$aplicaciones[$cont][0]." ";
                                        //$descfinalc.=" ".$aplicaciones[$cont][0]." ";
                                        }
                                    else if($aplicaciones[$cont][0]=="") break;
                                    ////MODELO
                                    if($aplicaciones[$cont][1]!="" AND $aplicaciones[$cont][1]!=$aplicaciones[$cont-1][1]){
                                        if($aplicaciones[$cont-1][0]==$aplicaciones[$cont][0]){
                                            $descfinal.="/";
                                            //$descfinalc.="/";
                                            }
                                        $descfinal.=$aplicaciones[$cont][1]." ";
                                        //$descfinalc.=$aplicaciones[$cont][4]." ";
                                        }
                                    ////VERSION
                                    if($aplicaciones[$cont][2]!=""){
                                        if($aplicaciones[$cont-1][1]==$aplicaciones[$cont][1]){
                                            $descfinal.="/";
                                            //$descfinalc.="/";
                                            }
                                        $descfinal.=$aplicaciones[$cont][2]." ";
                                        //$descfinalc.=$aplicaciones[$cont][2]." ";
                                        }
                                    ///AÑOS
                                    if($aplicaciones[$cont][3]!="" AND $aplicaciones[$cont][3]!=$aplicaciones[$cont+1][3]){
                                            //echo "ENTRO A APLICACION ANIO 1";
                                            $ultimo=substr($descfinal, -1);
                                            if($ultimo=="/"){
                                                 $descfinal = substr($descfinal, 0, -1);
                                                //$descfinalc = substr($descfinalc, 0, -1);
                                            }
                                            $descfinal.=$aplicaciones[$cont][3]." ";
                                            
                                        }
                                        
                                        
                                }
                                $descfinalc.=$aplicaciones[0][3]." ";
                                $descfinalcRadec.=$aplicaciones[0][3]." ";
                                
                                $descfinal=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinal)));
                                //$descfinal=$aplicaciones[0][5]." ".$descfinal;
                                $descfinalc=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinalc)));
                                $descfinalcRadec=str_replace("-/-"," / ",str_replace(" /","/",str_replace(" / ","-/-",$descfinalcRadec)));
                                $descfinalc=$aplicaciones[0][5]." ".$descfinalc;
                                $descfinalcRadec=$aplicaciones[0][7]." ".$descfinalcRadec;
                                //echo "DESCRIPCION LARGA:<br />".$descfinal."<br /><br />";
                                //echo "DESCRIPCION CORTA:<br />".$descfinalc."<br /><br />";
                                //ATRIBUTOS
                                //$consulta="SELECT `vat1`.`codigo` , `tav3`.`avDescripcion` , `tav3`.`avDescripcion_corta`, `ta2`.`orden` FROM `valatributos_ap` AS `vat1` RIGHT JOIN `tiposatributo_ap` AS `ta2` ON `ta2`.`aId` = `vat1`.`id_atributos` RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `vat1`.`Id_valores` WHERE `codigo` = '".$codeV."' ORDER BY `orden` ASC;";
                                
                                ///PENDIENTE
                                //$consulta="SELECT `vat1`.`codigo` , `tav3`.`avDescripcion` , `tav3`.`avDescripcion_corta`, `ta2`.`orden` FROM `valatributos_ap` AS `vat1` RIGHT JOIN `tiposatributo_ap` AS `ta2` ON `ta2`.`aId` = `vat1`.`id_atributos` RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `vat1`.`Id_valores` WHERE `codigo` = '".$codeV."' ORDER BY `orden` ASC;";
                                
                                //CORREGIDA
                                $consulta="SELECT DISTINCT t1.codigo,t2.tipo_parte,t1.id_atributos, t4.aDescripcion, t1.id_valores, tav3.avDescripcion,`tav3`.`avDescripcion_corta`, t3.Orden FROM valatributos_ap t1 INNER JOIN aplicaciones_ap t2 ON t2.codigo = t1.codigo 
                                INNER JOIN tiposasignaatributos_ap t3 ON t2.tipo_parte = t3.Id_tipoparte AND t3.Id_atributo = t1.id_atributos
                                RIGHT JOIN `tiposatributovalor_ap` AS tav3 ON `tav3`.`Id` = `t1`.`id_valores`
                                INNER JOIN tiposatributo_ap t4 ON t4.aId = t1.id_atributos
                                WHERE t1.codigo = '".$codeV."'AND id_atributos <> 53 ORDER BY t3.Orden ASC";//id_atributos Quitamos la opcion de guardar el origen
                                


                                
                                $result = $conexion->query($consulta);
                                $cont=0;
                                $valatributos;
                                $descripcionw.="<br />";
                                while($row = $result->fetch_assoc()){
                                    if($row['id_atributos']<>46){
                                    $valatributos.= " ".$row['avDescripcion'];
                                    }
                                    else $valatributoslado.= " ".$row['avDescripcion'];
                                    //JUNTAR LOS VALORES PARA GENERAR LA DESCRIPCION DE LA WEB.
                                    $descripcionw.="<br /><strong>".$row['aDescripcion'].": </strong>".$row['avDescripcion'];
                                    $valatributoscorta.= " ".$row['avDescripcion_corta'];
                                    if($row['id_atributos']==46){
                                        $ladorad=$row['avDescripcion_corta'];
                                        
                                    }

                                    //if($row['id_atributos']==15 ||$row['id_atributos']==22 ||$row['id_atributos']==4 ||$row['id_atributos']==49 ||$row['id_atributos']==65)		
                                    if($row['id_atributos']==15 )		
                                    $valatributoscortaRadec.= " ".$row['avDescripcion_corta'];
                                    $cont++;
                                }
                                $valatributoscortaRadec.=" ".$ladorad;

                                ///CONCATENAR A 80 caracteres la suma de Descripcion corta + atributos
                                 /*if((strlen($valatributoscorta)+strlen($descfinalc))>80){
                                     $quitar=80-strlen($valatributoscorta);
                                     $quitar=0-(strlen($descfinalc)-$quitar);										 
                                     $descfinalc=substr($descfinalc, 0, $quitar);										 */
                                     
                                     if((strlen($valatributoscorta)+strlen($descfinalc))>80){
                                     $quitar=80-strlen($descfinalc);
                                     $quitar=0-(strlen($valatributoscorta)-$quitar);										 
                                     $valatributoscorta=substr($valatributoscorta, 0, $quitar);										 
                                 }


                                 if((strlen($valatributoscortaRadec)+strlen($descfinalcRadec))>40){
                                    $quitar=40-strlen($descfinalcRadec);
                                    $quitar=strlen($valatributoscortaRadec)-$quitar;										 
                                    $valatributoscortaRadec=substr($valatributoscortaRadec, $quitar);										 
                                }

                                 $descripcionw=strtoupper($aplicaciones[0][6]).$descripcionw; 
                                 $descripcionw.="<br />";
                                 /*MODIFICACION 21-09-2019 agregar lado descripcion corta web*/
                                     /*si existe lado concatenarlo a la descripcion corta si no existe no hacer nada.*/
                                     
                                     
                                     $descCortaW=$descfinal;
                                     $ConsLado="SELECT t1.codigo,t2.avDescripcion FROM valatributos_ap t1 INNER JOIN tiposatributovalor_ap t2 ON t2.id = t1.id_valores WHERE t1.codigo='$codeV' AND t1.id_atributos = 46 ";
                                     $resultLado = $conexion->query($ConsLado);
                                     while($row2 = $resultLado->fetch_assoc()){
                                        $descCortaW = $descfinal." ".$row2['avDescripcion'];
                                        //JUNTAR LOS VALORES PARA GENERAR LA DESCRIPCION DE LA WEB.
                                    }
                                    
                                    $meta_description=str_replace(array(')','(','<br />', '<strong>', '<span ', '</span>', '</strong>', 'class=', 'textnara', '"', '>', '/','   ','  ','  '),array('','',' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' '),$descripcionw);
                                    $descfinalc=$descfinalc." ".$valatributoscorta;
                                    $descfinalcRadec=$descfinalcRadec." ".$valatributoscortaRadec;
                                    //$descfinalc=strtoupper(str_replace(array('  ','  '),array(' ',' '),$descfinalc));
                                    $descfinalc=str_replace(array('  ','  '),array(' ',' '),$descfinalc);
                                    $descfinalcRadec=str_replace(array('  ','  '),array(' ',' '),$descfinalcRadec);
                                    $tamMetDes=strlen($meta_description);
                                    if($tamMetDes>160){
                                        $ResTam=$tamMetDes-157;
                                        $meta_description = substr($meta_description, 0, -$ResTam)."...";  // devuelve "abcde"
                                        }
                                     
                                     $desclarga=strtoupper($aplicaciones[0][6])." ".$descfinal.ucwords(strtolower($valatributos));
                                     $desclarga.=$valatributoslado;
                                     $descfinalcRadec=strtoupper($descfinalcRadec);
                                     $desclarga=strtoupper($desclarga);
                                    //$meta_description=$sus; 
                                 /*FIN MOD 21-09-2019*/





                                $consulta="INSERT INTO `descripciones_ap` (`id` ,
                                    `codigo` ,
                                    `descripcionl` ,
                                    `descripcionc` ,
                                    `descripcionw` ,
                                    `descripcioncw`,
                                    `meta_description`,
                                    `DescCorta_radec`
                                    )
                                    VALUES (
                                    NULL ,  '".$codeV."',  '".$desclarga."',  '".$descfinalc."',  '$descripcionw','".$descCortaW."','$meta_description','$descfinalcRadec');";
                                $result = $conexion->query($consulta);
                                $conexion->close();
                                generaName($codeV);
                                genKeyword($codeV);
                                generaTags($codeV);
                                generaTabApp($codeV);
                                ActualizaWeb($codeV);
                                ActualizaIntesys($codeV,$desclarga,$descfinalc);
                                updateApplicationWeb($codeV);
                                
                                
                                return "<br /><br /><br />$codeV<br /><strong>DESCRIPCION LARGA:</strong><br />".$desclarga."<br /><br /><strong>DESCRIPCION CORTA:<br /></strong>".$descfinalc."<br /><br /><strong>DESCRIPCION WEB:</strong>".$descripcionw."<br />$tableapp"."<br /><br /><strong>DESCRIPCION CORTA RADEC:</strong>".$descfinalcRadec."<br />$tableapp";


           
    
        
        
        }


		
       

	?>
    </body>
</htm>
