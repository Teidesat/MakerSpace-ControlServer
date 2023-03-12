<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza.html')?>

  <body>
    <?php include('./../html/cabecera.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>

    <button class="button" onclick="location.href='gestionar_tarjetas.php'">Volver atrás</button>
   
    <?php
      $db = new SQLite3('./../bbdd/acceso_makerspace.db');
      $id_tarjeta_viejo = $_GET["id"];

      // Recuperar datos
      $consulta = "SELECT * FROM tarjetas WHERE id_tarjeta = '$id_tarjeta_viejo';";
      $resultado = $db->query($consulta);
      if(!$resultado) {die($db->lastErrorMsg());}
      $tarjeta = $resultado->fetchArray();

      // Gardado de los nuevos datos
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // $db = new SQLite3('./../bbdd/acceso_makerspace.db');

        // si pulsa botón guardar
        if(isset($_POST['guardar'])) {

          // Actualizar datos
          $id_tarjeta_nuevo = $_POST['id_tarjeta'];
          $contrasena = $_POST['contrasena'];
          $consulta = "UPDATE tarjetas SET id_tarjeta = '$id_tarjeta_nuevo', contrasena = '$contrasena'WHERE id_tarjeta = '$id_tarjeta_viejo';";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
  
          // Recuperar los datos actualizados
          $consulta = "SELECT * FROM tarjetas;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
          $tarjeta = $resultado->fetchArray();

          echo "Tarjeta modificado con éxito!";
          
        // Si pulsa botón borrar
        } elseif (isset($_POST['borrar'])) {
          // Borrar ususario (en cascada de permisos)
          $consulta = "DELETE FROM tarjetas WHERE id_tarjeta = $id_tarjeta_viejo;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}

          echo "Tarjeta eliminado con éxito!";
        } 
        $db->close();

        
      }
    ?>

    <!-- Información de la tarjeta a almacenar -->
    <form method="POST" action="editar_tarjeta.php?id=<?php echo $id_tarjeta_viejo?>">
      <!-- Atributos de la tarjeta-->
      <div class="userinfo">ID Tarjeta:
        <input type="text" name="id_tarjeta" value=<?php echo $tarjeta['id_tarjeta']?> required>
      </div> 
      <div class="userinfo">Contrasena:
        <input type="text" name="contrasena" value=<?php echo $tarjeta['contrasena']?> required>
      </div> 

      <!-- Botones para guardar o borar ususario -->
      <div class="permisos">
        <button class="guardar" name="guardar">Guardar cambios</button>
      </div>
      <div class="permisos">
        <button class="guardar" name="borrar">Borrar tarjeta</button>
      </div>
    </form>
  </body>
</html>

