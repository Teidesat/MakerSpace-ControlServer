<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./css/content.css">
<html>
  <?php include('./html/cabeza.html')?>

  <body>
    <?php include('./html/cabecera.html')?>
    <?php include('./html/barra-navegacion.html')?>

    <button class="button" onclick="location.href='usuarios.php'">Volver atrás</button>
   
    <?php
      $db = new SQLite3('makerspace.db');
      $id = $_GET["id"];

      // Recuperar datos de usuarios
      $query = "SELECT * FROM usuarios WHERE id = $id";
      $resultado = $db->query($query);
      if(!$resultado) {die($db->lastErrorMsg());}
      $usuario = $resultado->fetchArray();

      // Recuperar datos de permisos
      $query = "SELECT * FROM permisos WHERE id = $id";
      $resultado = $db->query($query);
      if(!$resultado) {die($db->lastErrorMsg());}
      $permisos = $resultado->fetchArray();
      $db->close();

      // Gardado de los nuevos datos
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $db = new SQLite3('makerspace.db');
        // si pulsa botón guardar
        if(isset($_POST['guardar'])) {
          $nombre = $_POST['nombre'];
          $apellidos = $_POST['apellidos'];
          $correo = $_POST['correo'];
          $rol = $_POST['rol'];
          $card_id = $_POST['card_id'];
          
          // ctualizar datos del usuario
          $query = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol', card_id = '$card_id' WHERE id = $id;";
          $resultado = $db->query($query);
          if(!$resultado) {die($db->lastErrorMsg());}
  
          // Actualizar permisos del usuario
          //$query = "UPDATE permisos SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol', card_id = '$card_id' WHERE id = $id;";
          //$resultado = $db->query($query);
          //if(!$resultado) {die($db->lastErrorMsg());}
          
          // Recuperar los datos actualizados del usuario y permisos
          $query = "SELECT * FROM usuarios WHERE id = $id";
          $resultado = $db->query($query);
          if(!$resultado) {die($db->lastErrorMsg());}
          $usuario = $resultado->fetchArray();
  
          $query = "SELECT * FROM permisos WHERE id = $id";
          $resultado = $db->query($query);
          if(!$resultado) {die($db->lastErrorMsg());}
          $permisos = $resultado->fetchArray();
          
        // Si pulsa botón borrar
        } elseif (isset($_POST['borrar'])) {
          // Forzar foreing key en SQLite3
          $query = 'pragma foreign_keys = on';
          $resultado = $db->query($query);
          if(!$resultado) {die($db->lastErrorMsg());}

          // Borrar ususario (en cascada de permisos)
          $query = "DELETE FROM usuarios WHERE id = $id;";
          $resultado = $db->query($query);
          if(!$resultado) {die($db->lastErrorMsg());}
        } 
        $db->close();

        echo "Usuario modificado con éxito!";
      }
    ?>
    
    <form method="POST" action="editar_usuario.php?id=<?php echo $id?>">
      <!-- Atributos del usuario-->
      <div class="userinfo">Nombre:
        <input type="text" name="nombre" value=<?php echo $usuario['nombre']?> required>
      </div> 
      <div class="userinfo">Apellidos:
        <input type="text" name="apellidos" value=<?php echo $usuario['apellidos']?> required>
      </div> 
      <div class="userinfo">Correo Electrónico:
        <input type="text" name="correo" value=<?php echo $usuario['correo']?> required>
      </div> 
      <div class="userinfo">Rol:
        <input type="text" name="rol" value=<?php echo $usuario['rol']?>>
      </div>
      <div class="userinfo">ID Tarjeta:
        <input type="text" name="card_id" value=<?php echo $usuario['card_id']?>>    <!-- utilizar lista de todos los ids de tarjetas-->
      </div> 
    
      <!-- Permisos del usuario -->
      <div class="permisos">
        <label>Entrada</label>
        <input type="checkbox" <?php echo $permisos['entrada'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Impresoras 3D</label>
        <input type="checkbox" <?php echo $permisos['arm_3d'] == 1 ? 'checked' : '' ?>><br>

        <label>Almacén</label>
        <input type="checkbox" <?php echo $permisos['almacen'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 1</label>
        <input type="checkbox" <?php echo $permisos['arm_1'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 2</label>
        <input type="checkbox" <?php echo $permisos['arm_2'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 3</label>
        <input type="checkbox" <?php echo $permisos['arm_3'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 4</label>
        <input type="checkbox" <?php echo $permisos['arm_4'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 5</label>
        <input type="checkbox" <?php echo $permisos['arm_5'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 6</label>
        <input type="checkbox" <?php echo $permisos['arm_6'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 7</label>
        <input type="checkbox" <?php echo $permisos['arm_7'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 8</label>
        <input type="checkbox" <?php echo $permisos['arm_8'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 9</label>
        <input type="checkbox" <?php echo $permisos['arm_9'] == 1 ? 'checked' : '' ?>>
      </div>
      <div class="permisos">
        <button class="guardar" name="guardar">Guardar cambios</button>
      </div>
      <div class="permisos">
        <button class="guardar" name="borrar">Borrar Usuario</button>
      </div>
    </form>
  </body>
  <script src="./js/redirigir.js"></script>
</html>

