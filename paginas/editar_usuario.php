<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza.html')?>

  <body>
    <?php include('./../html/cabecera.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>

    <button class="button" onclick="location.href='gestionar_usuarios.php'">Volver atrás</button>
   
    <?php
      $db = new SQLite3('./../bbdd/acceso_makerspace.db');
      $id_usuario = $_GET["id"];

      // Datos de las tarjetas registradas
      $consulta = "SELECT * FROM tarjetas;";
      $tarjetas = $db->query($consulta);
      if(!$tarjetas) {die($db->lastErrorMsg());}

      // Recuperar datos de usuarios
      $consulta = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario;";
      $resultado = $db->query($consulta);
      if(!$resultado) {die($db->lastErrorMsg());}
      $usuario = $resultado->fetchArray();

      // Recuperar datos de permisos
      $consulta = "SELECT * FROM permisos WHERE id_usuario = $id_usuario;";
      $resultado = $db->query($consulta);
      if(!$resultado) {die($db->lastErrorMsg());}
      $permisos = $resultado->fetchArray();
      //$db->close();

      // Gardado de los nuevos datos
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //$db = new SQLite3('./../bbdd/acceso_makerspace.db');
        // si pulsa botón guardar
        if(isset($_POST['guardar'])) {

          // Actualizar datos del usuario
          $nombre = $_POST['nombre'];
          $apellidos = $_POST['apellidos'];
          $correo = $_POST['correo'];
          $rol = $_POST['rol'];
          $id_tarjeta = $_POST['id_tarjeta'];
          $consulta = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol', id_tarjeta = '$id_tarjeta' WHERE id_usuario = $id_usuario;";
          //$consulta = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol' WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
  
          // Actualizar permisos del usuario
          $entrada = (isset($_POST['entrada']) == 1) ? 1 : 0;
          $almacen = (isset($_POST['almacen']) == 1) ? 1 : 0;
          $armario_1 = (isset($_POST['armario_1']) == 1) ? 1 : 0;
          $armario_2 = (isset($_POST['armario_2']) == 1) ? 1 : 0;
          $armario_3 = (isset($_POST['armario_3']) == 1) ? 1 : 0;
          $armario_4 = (isset($_POST['armario_4']) == 1) ? 1 : 0;
          $armario_5 = (isset($_POST['armario_5']) == 1) ? 1 : 0;
          $armario_6 = (isset($_POST['armario_6']) == 1) ? 1 : 0;
          $armario_7 = (isset($_POST['armario_7']) == 1) ? 1 : 0;
          $armario_8 = (isset($_POST['armario_8']) == 1) ? 1 : 0;
          $armario_9 = (isset($_POST['armario_9']) == 1) ? 1 : 0;
          $armario_3d = (isset($_POST['armario_3d']) == 1) ? 1 : 0;
          $consulta = "UPDATE permisos SET entrada = $entrada, almacen = $almacen, armario_1 = $armario_1, armario_2 = $armario_2, armario_3 = $armario_3, armario_4 = $armario_4, armario_5 = $armario_5, armario_6 = $armario_6, armario_7 = $armario_7, armario_8 = $armario_8, armario_9 = $armario_9, armario_3d = $armario_3d WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
          
          // Recuperar los datos actualizados del usuario y permisos
          $consulta = "SELECT * FROM tarjetas;";
          $tarjetas = $db->query($consulta);
          if(!$tarjetas) {die($db->lastErrorMsg());}

          $consulta = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
          $usuario = $resultado->fetchArray();
  
          $consulta = "SELECT * FROM permisos WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}
          $permisos = $resultado->fetchArray();

          echo "Usuario modificado con éxito!";
          
        // Si pulsa botón borrar
        } elseif (isset($_POST['borrar'])) {
          // Borrar usuario
          $consulta = "DELETE FROM usuarios WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}

          // Borrar permisos del usuario
          $consulta = "DELETE FROM permisos WHERE id_usuario = $id_usuario;";
          $resultado = $db->query($consulta);
          if(!$resultado) {die($db->lastErrorMsg());}

          echo "Usuario eliminado con éxito!";
        } 
        $db->close();
      }
    ?>

    <!-- Información del usuario a almacenar -->
    <form method="POST" action="editar_usuario.php?id=<?php echo $id_usuario?>">
      <!-- Atributos del usuario-->
      <div class="userinfo">Nombre:
        <input type="text" name="nombre" value=<?php echo $usuario['nombre']?> required>
      </div> 
      <div class="userinfo">Apellidos:
        <input type="text" name="apellidos" value=<?php echo $usuario['apellidos']?> required>                    <!-- Error con que solo aparece un apellido al modificar -->
      </div> 
      <div class="userinfo">Correo Electrónico:
        <input type="text" name="correo" value=<?php echo $usuario['correo']?> required>
      </div> 
      <div class="userinfo">Rol:
        <input type="text" name="rol" value=<?php echo $usuario['rol']?>>
      </div>
    


            <!-- Selección de tarjeta -->
      <div class="userinfo">
        <label>Tarjeta:</label>
        <select id="seleccion" name="id_tarjeta">
          <option value=<?php echo $tarjeta['id_tarjeta'] ?>><?php echo $tarjeta['id_tarjeta'] ?></option>
          <?php
            while ($tarjeta = $tarjetas->fetchArray()) {
              echo '<option value="'.$tarjeta['id_tarjeta'].'">'.$tarjeta['id_tarjeta'].'<br>'.'</option>';
            }
          ?>
        </select>
      </div>





      <!-- Permisos del usuario -->
      <div class="userinfo">Permisos:</div>
      <div class="permisos">
        <label>Entrada</label>
        <input type="checkbox" name="entrada" <?php echo $permisos['entrada'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Almacén</label>
        <input type="checkbox" name="almacen" <?php echo $permisos['almacen'] == 1 ? 'checked' : '' ?>><br>

        <label>Armario 1</label>
        <input type="checkbox" name="armario_1" <?php echo $permisos['armario_1'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 2</label>
        <input type="checkbox" name="armario_2" <?php echo $permisos['armario_2'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 3</label>
        <input type="checkbox" name="armario_3" <?php echo $permisos['armario_3'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 4</label>
        <input type="checkbox" name="armario_4" <?php echo $permisos['armario_4'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 5</label>
        <input type="checkbox" name="armario_5" <?php echo $permisos['armario_5'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 6</label>
        <input type="checkbox" name="armario_6" <?php echo $permisos['armario_6'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 7</label>
        <input type="checkbox" name="armario_7" <?php echo $permisos['armario_7'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 8</label>
        <input type="checkbox" name="armario_8" <?php echo $permisos['armario_8'] == 1 ? 'checked' : '' ?>><br>
        
        <label>Armario 9</label>
        <input type="checkbox" name="armario_9" <?php echo $permisos['armario_9'] == 1 ? 'checked' : '' ?>><br>

        <label>Impresoras 3D</label>
        <input type="checkbox" name="armario_3d" <?php echo $permisos['armario_3d'] == 1 ? 'checked' : '' ?>>
      </div>

      <!-- Botones para guardar o borar ususario -->
      <div class="permisos">
        <button class="guardar" name="guardar">Guardar cambios</button>
      </div>
      <div class="permisos">
        <button class="guardar" name="borrar">Borrar Usuario</button>
      </div>
    </form>
  </body>
</html>