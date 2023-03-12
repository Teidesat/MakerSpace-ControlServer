<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza-paginas.html')?>

  <body>
    <?php include('./../html/cabecera-paginas.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>

    <!-- Si pulsa botón de guardar ejecutar código para almacenar datos en la base de datos -->
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = new SQLite3('./../bbdd/acceso_makerspace.db');

        // Guardar en la base de datos los datos de la tarjeta
        $id_tarjeta = $_POST['id_tarjeta'];
        $contrasena = $_POST['contrasena'];
        $consulta = "INSERT INTO tarjetas (id_tarjeta, contrasena) VALUES ('$id_tarjeta', '$contrasena')";
        $resultado = $db->query($consulta);
        if (!$resultado) {die($db->lastErrorMsg());}
        $db->close();
        echo "¡Tarjeta añadida!";
      }
    ?>

    <!-- Formulario con los datos de la tarjeta -->
    <form method="POST" action="anadir_tarjeta.php">
      <div class="userinfo">ID Tarjeta:
        <input type="text" name="id_tarjeta" required>
      </div> 
      <div class="userinfo">Contraseña: 
        <input type="text" name="contrasena" required>
      </div> 

      <!-- Botón para guardar -->
      <div class="permisos">
        <button class="guardar">Guardar cambios</button>
      </div>
    </form>
  </body>
</html>

