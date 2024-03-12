<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza.html')?>

  <body>
    <?php include('./../html/cabecera.html')?>
    <?php include('./../html/barra-navegacion.html')?>

    <button class="button" onclick="location.href='../index.php'">Volver atrás</button>
   
    <?php
      $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
      
      // ID de la tarjeta
      $uid = $_GET["id"];
      
      // Gardado de los nuevos datos
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // si pulsa botón guardar
        if(isset($_POST['guardar'])) {
          
          // Actualizar datos del usuario
          $uid = $_GET["id"];
          $nombre = $_POST['nombre'];
          $apellidos = $_POST['apellidos'];
          $correo = $_POST['correo'];
          $rol = $_POST['rol'];
          $consulta = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol' WHERE uid = '$uid';";
          $resultado = pg_query($consulta);
          
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
          $consulta = "UPDATE permisos SET entrada = $entrada, almacen = $almacen, armario_1 = $armario_1, armario_2 = $armario_2, armario_3 = $armario_3, armario_4 = $armario_4, armario_5 = $armario_5, armario_6 = $armario_6, armario_7 = $armario_7, armario_8 = $armario_8, armario_9 = $armario_9, armario_3d = $armario_3d WHERE uid = '$uid';";
          $resultado = pg_query($consulta);
          
          echo "Usuario modificado con éxito!";
          
        // Si pulsa botón borrar
        } elseif (isset($_POST['borrar'])) {
          $uid = $_GET["id"];

          // Borrar usuario (permisos se borran en cascada)
          $consulta = "DELETE FROM permisos WHERE uid = '$uid';";
          $resultado = pg_query($consulta);
          $consulta = "DELETE FROM usuarios WHERE uid = '$uid';";
          $resultado = pg_query($consulta);

          echo "Usuario eliminado con éxito!";
        } 
      }
      
      // Recuperar datos de usuarios
      $consulta = "SELECT * FROM usuarios WHERE uid = '$uid';";
      $resultado = pg_query($consulta);
      $usuario = pg_fetch_row($resultado);
      
      // Recuperar datos de permisos
      $consulta = "SELECT * FROM permisos WHERE uid = '$uid';";
      $resultado = pg_query($consulta);
      $permisos = pg_fetch_row($resultado);

    ?>
    <!-- Información del usuario a almacenar -->
    <div class="userinfo">
      <br>ID tarjeta: <?php echo $usuario[0]?>
    </div> 
    <form method="POST" action="editar_usuario.php?id=<?php echo $uid?>">
      <!-- Atributos del usuario-->

      <div class="userinfo">Nombre:
        <input type="text" name="nombre" value=<?php echo $usuario[2]?>>
      </div> 
      <div class="userinfo">Apellidos:
        <input type="text" name="apellidos" value=<?php echo $usuario[3]?>>
      </div> 
      <div class="userinfo">Correo Electrónico:
        <input type="text" name="correo" value=<?php echo $usuario[4]?>>
      </div> 
      <div class="userinfo">Rol:
        <input type="text" name="rol" value=<?php echo $usuario[5]?>>
      </div>
      
      <!-- Permisos del usuario -->
      <div class="userinfo">Permisos:</div>
      <div class="permisos">
        <label>Entrada</label>
        <input type="checkbox" name="entrada" <?php echo ($permisos[1] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Almacén</label>
        <input type="checkbox" name="almacen" <?php echo ($permisos[2] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 1</label>
        <input type="checkbox" name="armario_1" <?php echo ($permisos[3] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 2</label>
        <input type="checkbox" name="armario_2" <?php echo ($permisos[4] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 3</label>
        <input type="checkbox" name="armario_3" <?php echo ($permisos[5] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 4</label>
        <input type="checkbox" name="armario_4" <?php echo ($permisos[6] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 5</label>
        <input type="checkbox" name="armario_5" <?php echo ($permisos[7] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 6</label>
        <input type="checkbox" name="armario_6" <?php echo ($permisos[8] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 7</label>
        <input type="checkbox" name="armario_7" <?php echo ($permisos[9] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 8</label>
        <input type="checkbox" name="armario_8" <?php echo ($permisos[10] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Armario 9</label>
        <input type="checkbox" name="armario_9" <?php echo ($permisos[11] == 1) ? 'checked' : ''; ?>><br>
        
        <label>Impresoras 3D</label>
        <input type="checkbox" name="armario_3d" <?php echo ($permisos[12] == 1) ? 'checked' : ''; ?>>
      </div>
      
      <!-- Botones para guardar o borar ususario -->
      <div class="permisos">
        <br><button class="guardar" name="guardar">Guardar cambios</button>
      </div>
      <div class="permisos">
        <button class="guardar" name="borrar">Borrar Usuario</button>
      </div>
    </form>
  </body>
</html>