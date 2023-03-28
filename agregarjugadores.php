<?php
$nombresession = $_GET['var'];

session_start();
//session_destroy();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar jugadores</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  
</head>
<body>

<!--boton para regresar-->
<a class='btn btn-primary btn-sm' href='equipos.php'>
  <button type='but' name='editar' id='editar' class='btn btn-primary' style="float: left;">Regresar</button>
</a>

<?php
$arregloPosiciones = array("Base"=> 1, "Alero" => 3, "Escolta" => 2, "Pivot" => 5, "Ala-pivot" => 4);

?>

<div class="container mt-4">  

    <h2 class="mb-4">Agregar jugador</h2>  

    <form action="" method="POST" enctype="multipart/form-data">  

        <div class="form-group">  
            <label for="foto">Fotografía</label>  
            <input type='file' class='form-control' name='fichero' id='inputName' placeholder='Seleccione una imagen' required>
        </div>

        <div class="form-group">  
            <label for="txtnombre">Nombre completo</label>  
            <input type="text" name="txtnombre" id="" class="form-control form-control-sm" required>  
        </div>

        <div class="form-group">  
            <label for="posi">Posición</label>  
            <select class="form form-control" name="posi" id="posi" placeholder="Seleccione la posición" required>
                <?php foreach ($arregloPosiciones as $key => $value) {
                   $posiciones = $key;
                   $cantidad = $value;

                   if ($cantidad != 0) {   
                    
                ?>
                <option hidden selected>Seleccione la posición</option>
                <option value="<?= $posiciones;?>"><?= $posiciones." (".$cantidad.")";?></option>
                <?php }}?>
            </select>
              
        </div>
        <div class="form-group">  
            <label for="edad">Edad</label>  
            <input type="number" name="edad" id="edad" class="form-control form-control-sm" required>  
        </div>
        <div class="form-group">  
            <label for="estatura">Estatura (en cm)</label>  
            <input type="number" step="0.01" name="estatura" id="estatura" class="form-control form-control-sm" required>  
        </div>
        <div class="form-group">  
            <label for="peso">Peso (en kg)</label>  
            <input type="number" step="0.01" name="peso" id="peso" class="form-control form-control-sm" required>  
        </div>
        <div class="form-group">  
            <label for="universidad">Universidad</label>  
            <select class="form form-control" name="universidad" id="universidad" placeholder="Seleccione el país" required>
                <?php foreach ($_SESSION["universidades"]  as $key => $origen) {  ?>

                <option hidden selected>Seleccione la universidad</option>
                <option value="<?= $origen;?>"><?= $origen;?></option>

                <?php  }?>
            </select>
              
        </div> 
        <br>    
<?php
$contador = 0;
if (isset( $_SESSION["$nombresession"])) {
   $contador= count( $_SESSION["$nombresession"]);
       
}

if ($contador < 5) {
    echo"
    <div class='offset-sm-4 col-sm-8'>
        <button type='submit'value='enviar' id='recargar' name=ok2 class='btn btn-primary' onclick='javascript:this.recargar()'>Registrar jugador</button>
    </div>
    ";
    
}
elseif ($contador == 5) {
    echo"
    <h2 style='margin-left: 15%; color:red;'>Ha llegado al limite permitido de jugadores por equipo</h2>      
    ";
}

?>
  
    </form>
</div>
<br><br><br>
<!-- Impresion del select -->
<select class="form form-control" name="equiposMostrar" id="universidad" placeholder="Más equipos" onchange="recargar(this.value)" style="width: 10%; float: right; margin-right:110px; background-color:lightgray;">
    <?php 
        foreach($_SESSION["equipos"]  as $key=>$valor){
    ?>
        <option hidden selected>Más equipos</option>
        <option value="<?=$key; ?>" style="background-color: lightblue;"><?=$key; ?></option>             
    <?php }?>
</select>

<script>
    function recargar(nombre){
        location.href="agregarjugadores.php?var="+nombre;
    }
</script>

<!-- Tabla que muestra los datos de los jugadores -->
<?php $nombreEquipo = strtoupper($nombresession);

print "<h1 style='margin-left:110px;'>JUGADORES DE $nombreEquipo</h1>";
?>

<div class="container mt-4">
<table class='table table-dark table-hover'>
    <thead>
      <tr>
        <th>Fotografia</th>
        <th>Nombre</th>
        <th>Posición</th>
        <th>Edad</th>
        <th>Estatura</th>
        <th>Peso</th>
        <th>Universidad</th>
      </tr>
    </thead>
    <tbody>

    <?php
    $nombrearchivo="";
    if(isset($_POST["ok2"])){
        if (isset($_FILES["fichero"])){
            if (is_uploaded_file ($_FILES['fichero']['tmp_name'])){ 
              //nombre temporal del fichero
              $tmp_name = $_FILES["fichero"]["tmp_name"];
              //nombre completo del archivo
              //crear una carpeta con el nombre imagenes en la misma carpeta
              //donde se encuentra el archivo subir.php
              $nombrearchivo = "jugadores/".$_FILES["fichero"]["name"];
             
              //pregunto si existe el fichero
              if (is_file($nombrearchivo)) {
                $idUnico=time();//si existe le coloco un nombre unico
                $nombrearchivo = "jugadores/".$idUnico."-".$_FILES["fichero"]["name"];        
              }
              //funcion para mover el fichero a la ruta que especifiquemos
              move_uploaded_file($tmp_name,$nombrearchivo);
            }  
        } 

        $txtnombre=$_POST["txtnombre"];
        $posicion = $_POST["posi"];
        echo"--$posicion";
        $edad = $_POST["edad"];
        $estatura = $_POST["estatura"];
        $peso = $_POST["peso"];
        $universidad = $_POST["universidad"];

        if (isset($_SESSION[$nombresession])) {
            $jugadores = $_SESSION[$nombresession];
            $jugadores[$txtnombre]= array('imagen'=>$nombrearchivo, 'posicion'=>$posicion, 'edad'=> $edad, 'estatura'=>$estatura, 'peso'=>$peso, 'universidad'=>$universidad);
            $_SESSION[$nombresession] = $jugadores; 

            print "<script>window.setTimeout(function() { window.location = 'http://localhost/Examen_DAW/agregarjugadores.php?var=$nombresession' }, 500);</script>";
        }
        else {
            $jugadores[$txtnombre]= array('imagen'=>$nombrearchivo, 'posicion'=>$posicion, 'edad'=> $edad, 'estatura'=>$estatura, 'peso'=>$peso, 'universidad'=>$universidad);
            $_SESSION[$nombresession] = $jugadores;

            print "<script>window.setTimeout(function() { window.location = 'http://localhost/Examen_DAW/agregarjugadores.php?var=$nombresession' }, 500);</script>";
        }

        

        $contador= count( $_SESSION["$nombresession"]);
    }


    if(isset($_SESSION["$nombresession"])){
        foreach($_SESSION["$nombresession"]  as $key => $origen){
            $nomEli = $key;
            echo "
            <tr>
            <td><img src='".$origen['imagen']."' style='width: 50px; height: 50px;' ></td>
            <td>$key</td>
            <td>".$origen['posicion']."</td>
            <td>".$origen['edad']."</td>
            <td>".$origen['estatura']." cm</td>
            <td>".$origen['peso']." kg</td>
            <td>".$origen['universidad']."</td>
            
          </tr>";
        }
          
        $contador= count( $_SESSION["$nombresession"]);
    }
    
    ?>
    
</div>


</body>
</htmml>