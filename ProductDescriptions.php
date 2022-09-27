<html>
    <head>

    </head>

    <body>
    <?php		
		include("./Functions.php");
        $option = $_POST['option'];
        $codeV= $_POST['codeV'];
        



        if($option==0){
            

            generadesc($codeV);                

        }
        if($option==1){

        
		$conexion = conectar();
		$consulta= "DELETE FROM `manijauto`.`descripciones_ap` WHERE `descripciones_ap`.`codigo` = '$codeV'";		
		if ($result = $conexion->query($consulta)) {
			 $resultado="<br />SE ELIMINO LA DESCRIPCION";		
		}
		else $resultado=$resultado."ERROR EN:".$consulta."Error: al eliminar La descripcion";	
		$conexion->close();					
		return $resultado;	

        }

        if($option==2){

        
            $conexion = conectar();
            $consultaD= "DELETE FROM `manijauto`.`descripciones_ap` WHERE `descripciones_ap`.`codigo` = '$codeV'";		
            if ($resultD = $conexion->query($consultaD)) {
                 $resultadoD="<br />SE ELIMINO LA DESCRIPCION";		
            }
            else $resultadoD=$resultadoD."ERROR EN:".$consultaD."Error: al eliminar La descripcion";	

            generadesc($codeV);            
           	
            
            
          
    
        
        
        }


		
       

	?>
    </body>
</htm>
