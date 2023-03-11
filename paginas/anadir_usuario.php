<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza-paginas.html')?>

  <body>
    <?php include('./../html/cabecera-paginas.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>



    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = new SQLite3('./../makerspace.db');
        $query = "SELECT max(id) FROM usuarios";
        $next_id = intval($db->query($query)->fetchArray()[0]) + 1;
        // crear la consulta SQL para obtener el registro con el ID especificado
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $query = "INSERT INTO usuarios (id, nombre, apellidos, correo, rol) VALUES ($next_id, '$nombre', '$apellidos', '$correo', '$rol')";
        $resultado = $db->query($query);
        if (!$resultado) {die($db->lastErrorMsg());}
        $almacen = (isset($_POST['almacen']) == 1) ? 1 : 0;
        $arm_3d = (isset($_POST['arm_3d']) == 1) ? 1 : 0;
        $entrada = (isset($_POST['entrada']) == 1) ? 1 : 0;
        $arm_1 = (isset($_POST['arm_1']) == 1) ? 1 : 0;
        $arm_2 = (isset($_POST['arm_2']) == 1) ? 1 : 0;
        $arm_3 = (isset($_POST['arm_3']) == 1) ? 1 : 0;
        $arm_4 = (isset($_POST['arm_4']) == 1) ? 1 : 0;
        $arm_5 = (isset($_POST['arm_5']) == 1) ? 1 : 0;
        $arm_6 = (isset($_POST['arm_6']) == 1) ? 1 : 0;
        $arm_7 = (isset($_POST['arm_7']) == 1) ? 1 : 0;
        $arm_8 = (isset($_POST['arm_8']) == 1) ? 1 : 0;
        $arm_9 = (isset($_POST['arm_9']) == 1) ? 1 : 0;
        $query = "INSERT INTO permisos (id, arm_1, arm_2, arm_3, arm_4, arm_5, arm_6, arm_7, arm_8, arm_9, entrada, almacen, arm_3d) VALUES ($next_id, $arm_1, $arm_2, $arm_3, $arm_4, $arm_5, $arm_6, $arm_7, $arm_8, $arm_9, $entrada, $almacen, $arm_3d)";
        $resultado = $db->query($query);
        $db->close();
        echo "¡Usuario añadido!";
      }
    ?>



    <form method="POST" action="anadir_usuario.php">
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

      <div class="userinfo">Permisos:</div>
      <div class="permisos">
        <label>Entrada</label>
        <input type="checkbox" name="entrada"><br>
        
        <label>Impresoras 3D</label>
        <input type="checkbox" name="arm_3d"><br>
        
        <label>Almacén</label>
        <input type="checkbox" name="almacen"><br>

        <label>Armario 1</label>
        <input type="checkbox" name="arm_1"><br>

        <label>Armario 2</label>
        <input type="checkbox" name="arm_2"><br>

        <label>Armario 3</label>
        <input type="checkbox" name="arm_3"><br>

        <label>Armario 4</label>
        <input type="checkbox" name="arm_4"><br>

        <label>Armario 5</label>
        <input type="checkbox" name="arm_5"><br>

        <label>Armario 6</label>
        <input type="checkbox" name="arm_6"><br>

        <label>Armario 7</label>
        <input type="checkbox" name="arm_7"><br>

        <label>Armario 8</label>
        <input type="checkbox" name="arm_8"><br>

        <label>Armario 9</label>
        <input type="checkbox"name="arm_9">
      </div>
      <div class="permisos">
        <button class="guardar">Guardar cambios</button>
      </div>
    </form>
  </body>
</html>

