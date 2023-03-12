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

      $db = new SQLite3('./../bbdd/acceso_makerspace.db');

      // Guardar datos si el botón de guardado es pulsado
      if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Guardar datos del ususario
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $consulta = "INSERT INTO usuarios (id_usuario, nombre, apellidos, correo, rol) VALUES ('$id_usuario', '$nombre', '$apellidos', '$correo', '$rol');";
        $resultado = $db->query($consulta);
        if (!$resultado) {die($db->lastErrorMsg());}

        // Guardar permisos del usuario
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
        $consulta = "INSERT INTO permisos (id_usuario, entrada, almacen, armario_1, armario_2, armario_3, armario_4, armario_5, armario_6, armario_7, armario_8, armario_9, armario_3d) VALUES ('$id_usuario', $entrada, $almacen, $armario_1, $armario_2, $armario_3, $armario_4, $armario_5, $armario_6, $armario_7, $armario_8, $armario_9, $armario_3d)";
        $resultado = $db->query($consulta);
        
        $db->close();
        echo "¡Usuario añadido!";
      }
    ?>


    <!-- Formulario con los datos y los permisos del usuario -->
    <form method="POST" action="anadir_usuario.php">
      <!-- Datos del usuario -->
      <!-- Selección de tarjeta -->
      <div class="userinfo">id_usuario:
        <input type="text" name="id_usuario">
      </div>
      <div class="userinfo">Nombre:
        <input type="text" name="nombre" required>
      </div> 
      <div class="userinfo">Apellidos: 
        <input type="text" name="apellidos" required>
      </div> 
      <div class="userinfo">Correo electrónico: 
        <input type="text" name="correo" required>
      </div>
      <div class="userinfo">Rol:
        <input type="text" name="rol">
      </div>
      

      <!-- Permisos del usuario -->
      <div class="userinfo">Permisos:</div>
      <div class="permisos">
        <label>Entrada</label>
        <input type="checkbox" name="entrada"><br>
                
        <label>Almacén</label>
        <input type="checkbox" name="almacen"><br>

        <label>Armario 1</label>
        <input type="checkbox" name="armario_1"><br>

        <label>Armario 2</label>
        <input type="checkbox" name="armario_2"><br>

        <label>Armario 3</label>
        <input type="checkbox" name="armario_3"><br>

        <label>Armario 4</label>
        <input type="checkbox" name="armario_4"><br>

        <label>Armario 5</label>
        <input type="checkbox" name="armario_5"><br>

        <label>Armario 6</label>
        <input type="checkbox" name="armario_6"><br>

        <label>Armario 7</label>
        <input type="checkbox" name="armario_7"><br>

        <label>Armario 8</label>
        <input type="checkbox" name="armario_8"><br>

        <label>Armario 9</label>
        <input type="checkbox"name="armario_9"><br>

        <label>Impresoras 3D</label>
        <input type="checkbox" name="armario_3d">
      </div>

      <!-- Botón para guardar -->
      <div class="permisos">
        <button class="guardar">Guardar cambios</button>
      </div>
    </form>
  </body>
</html>

