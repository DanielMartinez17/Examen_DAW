<?php
$nombreUniversidad = $_GET['var'];

session_start();
//session_destroy();


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Universidad</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
  
<a class='btn btn-primary btn-sm' href='universidades.php'>
  <button type='but' name='editar' id='editar' class='btn btn-primary' style="float: left;">Regresar</button>
</a>


<div class='container'>
    <div class='alert alert-primary' role='alert'>
        <strong>Editar Universidad</strong> 
    </div>
  <?php
  if ( array_key_exists($nombreUniversidad, $_SESSION["universidades"])) {
  
  ?>
    

    <form method=post>
        <div class='mb-3 row'>
            <label for='inputName' class='col-4 col-form-label'>Nombre de la universidad</label>
            <div class='col-8'>
                <input type='text' class='form-control' required name='txtnombre' id='inputName' placeholder='Ingrese el nombre de la universidad' value="<?=$nombreUniversidad;?>" required>
            <?php }?>
            </div>
        </div>
        <br>
        <div class='mb-3 row'>
            <div class='offset-sm-4 col-sm-8'>
                <button type='submit'value="enviar" name=ok1 class='btn btn-primary'>Guardar</button>
            </div>
        </div>
    </form>
</div>
  
<?php
if(isset($_POST["ok1"])) {
    $txtnombre=$_POST["txtnombre"];

    $universidad = $_SESSION['universidades'];
    $universidad[$nombreUniversidad]= $txtnombre;
    $_SESSION['universidades']= $universidad;

    print "<script>window.setTimeout(function() { window.location = 'http://localhost/Examen_DAW/universidades.php' }, 500);</script>";
}
?>


</body>
</html>