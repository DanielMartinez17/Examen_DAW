<?php 
session_start();
//session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Universidades</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>

<a class='btn btn-primary btn-sm' href='index.php'>
  <button type='but' name='editar' id='editar' class='btn btn-primary' style="float: left;">Regresar</button>
</a>

<div class='container'>
    <div class='alert alert-primary' role='alert'>
        <strong>Administrar Universidades</strong> 
    </div>
    
    <form method=post>
        <div class='mb-3 row'>
            <label for='inputName' class='col-4 col-form-label'>Nombre de la universidad</label>
            <div class='col-8'>
                <input type='text' class='form-control' required name='txtnombre' id='inputName' placeholder='Ingrese el nombre de la universidad' required>
            </div>
        </div>
        <div class='mb-3 row'>
            <div class='offset-sm-4 col-sm-8'>
                <button type='submit'value="enviar" name=ok1 class='btn btn-primary'>Agregar universidad</button>
            </div>
        </div>
    </form>

    <table class='table table-dark table-hover'>
    <thead>
      <tr>
        <th>Universidades</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(isset($_POST["ok1"])){
            $txtnombre=$_POST["txtnombre"];

            if (isset($_SESSION['universidades'])) {
                $universidad = $_SESSION['universidades'];
                $universidad[$txtnombre]= $txtnombre;
                $_SESSION['universidades'] = $universidad;
            }
            else {
                $universidad[$txtnombre]= $txtnombre;
                $_SESSION['universidades'] = $universidad;
            }
        }

        if(isset($_SESSION["universidades"])){
            foreach($_SESSION["universidades"]  as $key=>$valor){
                echo "<tr>
                <td>$valor</td>
                <td>
                <form method='get' action='eliminaruniversidades.php'>
                    <input type='hidden' name= 'var' value='$key' >
                    
                    <input type='submit' value='Eliminar' style='background-color: red;'>
    
                </form>
                </td>
                <td>
                <form method='get' action='editaruniversidad.php'>
                    <input type='hidden' name= 'var' value='$key' >
                    
                    <input type='submit' value='Editar' style='background-color: yellow;'>
    
                </form>
                </td>
              </tr>";
            }
           
        }
        ?>
    </tbody>
</div>

</body>
</html>