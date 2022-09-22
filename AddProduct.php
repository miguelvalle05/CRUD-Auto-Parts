<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicaciones </title>
    <link rel="stylesheet" href="./css/AddProduct.css">
    <link rel="stylesheet" href="./css/sweetalert2.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php		
		include("./funciones.php");
		$conexion = conectar();
		require_once("../../../programas/utiles/funciones_globales.php");

?>
<h1 class="labeltopicmain">Productos</h1>
<div class="container">


<form id="frmGeneral" name="frmGeneral" method="POST" >
 <div class="row">
            <div class="col-md-3">
            <label class="labeltittle">Codigo</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-key"></i></span>
            <input type="text" class="form-control" name="code" id="code" title="Cosigo" placeholder="Codigo">
            </div>
            </div>

            <div class="col-md-3">
            <label class="labeltittle">Tipo de parte</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select"name="partType" id="partType" title="Tipo de Parte">
														<option selected value="">Tipo de parte</option>
														
															
														
														<?php
															$result = $conexion->query("SELECT DISTINCT T1.Id, T1.Descripcion 
															FROM  tiposparte_ap T1
															INNER JOIN aplicaciones_ap T2 ON T1.Id=T2.tipo_parte
															ORDER BY Descripcion");
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) { 
																	echo '<option value="'.$row['Id'].'">'.$row['Descripcion'].'</option>';
																}
															}
															?>
			</select>
            </div>
            </div>

        
 
</div>





<span class="man" name="attributes" id="attributes">
   
 

</span>	



<label class="labeltopic">Aplicaciones: </label>


<div class="input-group mb-3">


           

            <div class="col-md-2">
            <label class="labeltittle">Marca</label>
            <div class="input-group mb-2">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select" name="brand" id="brand" title="Marca">
														<option selected value="">Marca</option>
														
															
														
										
									<?php
									$result = $conexion->query("SELECT IdMarca, maDescripcion FROM tiposmarca_ap ");
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) { 
											echo '<option value="'.$row['IdMarca'].'">'.$row['maDescripcion'].'</option>';
										}
									}
									?>
			</select>
            </div>
            </div>

			<div class="col-md-2">
            <label class="labeltittle">Modelo</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select" name="model" id="model" title="Modelo">
														<option selected value="">Modelo</option>
														
															
														
													
													
			</select>
            </div>
            </div>

			<div class="col-md-2">
            <label class="labeltittle">Version</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select" name="version" id="version" title="Version">
														<option selected value="">Version</option>
														
															
														
													
													
			</select>
            </div>
            </div>

			<div class="col-md-2">
            <label class="labeltittle">Año Inicial</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select" name="initialYear" id="initialYear" title="Año Inicial">
														<option selected value="">Año Inicial</option>

														<?php
														$result = $conexion->query("SELECT `Id`, `Anio` FROM `anios` ");
														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) { 
																echo '<option value="'.$row['Id'].'">'.$row['Anio'].'</option>';
															}
														}
														?>
														
															
														
													
													
			</select>
            </div>
            </div>


			<div class="col-md-2">
            <label class="labeltittle">Año Final</label>
            <div class="input-group mb-2">
            <span class="input-group-text" id="basic-addon1">  <i class="fas fa-cogs"></i></span>
            <select class="form-select" name="finalYear" id="finalYear" title="Año Final">
														<option selected value="">Año Final</option>

														
															
														
													
													
			</select>
            </div>
            </div>
          


			<div class="col-md-2">
            <label class="labelbutton"> </label>
            <div class="input-group mb-2">
            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-danger" >
							<span class="icon">
								<i class="fas fa-plus"></i>
							</span>
						</button>
            
            </div>
            </div>

			

        
 
</div>




          

</form>

<div id="divElements">

</div>
<br>
<div class="d-grid gap-2 col-4 mx-auto">
    
                <button id="btnSave" name="btnSave" type="button" class="btn btn-primary" >
					Save
				</button>

</div>



            


</div>





<footer>
   <p style="text-align:center"> <img src="../../../programas/imagenes/footer.png" width="125" height="55" /> </p>
   <p style="text-align:center "> <strong><i class="fas fa-laptop-code"> </i> Miguel Valle</strong></p>
</footer>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>



<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="./js/sweetalert2.all.js"></script>
<script language="javascript"src="./js/AddProduct.js"></script>
</body>
</html>