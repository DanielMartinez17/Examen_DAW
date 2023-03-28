<?php
session_start();
//session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
<a class='btn btn-primary btn-sm' href='index.php'>
  <button type='but' name='editar' id='editar' class='btn btn-primary' style="float: left;">Regresar</button>
</a>
<br>
<div class='container'>
    <div class='alert alert-primary' role='alert'>
        <strong>Administrar equipos de basquetbol</strong> 
    </div>
    
    <form method=post ENCTYPE='multipart/form-data'>
        <div class='mb-3 row'>
            <label for='inputName' class='col-4 col-form-label'>Nombre del equipo</label>
            <div class='col-8'>
                <input type='text' class='form-control' required name='txtnombre' id='inputName' placeholder='Ingrese el nombre del equipo' required>
            </div>
        </div>
        <div class='mb-3 row'>
            <label for='inputName' class='col-4 col-form-label'>Imagen</label>
            <div class='col-8'>
                <input type='file' class='form-control' name='fichero' id='inputName' placeholder='Seleccione una imagen' required>
            </div>
        </div>
        <div class='mb-3 row'>
            <div class='offset-sm-4 col-sm-8'>
                <button type='submit'value="enviar" name=ok1 class='btn btn-primary'>Registrar equipo</button>
            </div>
        </div>
    </form>

    <br>



    <table class='table table-dark table-hover'>
    <thead>
      <tr>
        <th>Equipos</th>
        <th colspan=2>&nbsp;</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    <?php
    $nombreEquipo="";
    $nombrearchivo="";
    if(isset($_POST["ok1"])){
        if (isset($_FILES["fichero"])){
            if (is_uploaded_file ($_FILES['fichero']['tmp_name'])){ 
              //nombre temporal del fichero
              $tmp_name = $_FILES["fichero"]["tmp_name"];
              //nombre completo del archivo
              //crear una carpeta con el nombre imagenes en la misma carpeta
              //donde se encuentra el archivo subir.php
              $nombrearchivo = "imagenes/".$_FILES["fichero"]["name"];
             
              //pregunto si existe el fichero
              if (is_file($nombrearchivo)) {
                $idUnico=time();//si existe le coloco un nombre unico
                $nombrearchivo = "imagenes/".$idUnico."-".$_FILES["fichero"]["name"];        
              }
              //funcion para mover el fichero a la ruta que especifiquemos
              move_uploaded_file($tmp_name,$nombrearchivo);
                print("Fichero subido con exito");
            }else{
                echo "No se ha podido subir el fichero\n";
            }
        } 

        $txtnombre=$_POST["txtnombre"];

        if(isset($_SESSION["equipos"])){
            $equipos=$_SESSION["equipos"];
            $equipos[$txtnombre]=$nombrearchivo;
            $_SESSION["equipos"]=$equipos;
        }else{
            $equipos[$txtnombre]=$nombrearchivo;
            $_SESSION["equipos"]=$equipos;
        }
    }


    if(isset($_SESSION["equipos"])){
        foreach($_SESSION["equipos"]  as $key=>$valor){
            $nombreEquipo = $key;
            echo "<tr>
            <td>$key</td>
            <td><img src='$valor' style='width: 50px; height: 50px;' ></td>
            <td>
            <form method='get' action='agregarjugadores.php'>
                <input type='hidden' name= 'var' value='$nombreEquipo' >
                
                <input type='submit' value='Agregar jugadores' style='background-color: lightblue;'>

            </form>
            </td>
            <td>
            <form method='get' action='eliminarequipos.php'>
                <input type='hidden' name= 'var' value='$nombreEquipo' >
                
                <input type='submit' value='Eliminar' style='background-color: red;'>

            </form>
            </td>
          </tr>";
        }
       
    }
    
    ?>
    </tbody>
  </table>
</div>
</body>
</html>