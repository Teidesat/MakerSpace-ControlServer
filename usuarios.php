<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino-->
<!DOCTYPE html>
<link rel="stylesheet" href="./css/content.css">
<html>
  <?php include('./html/cabeza.html')?>

  <body>
    <?php include('./html/cabecera.html')?>
    <?php include('./html/barra-navegacion.html')?>

    <!-- Acceso a la base de datos de usuarios y consultas-->
    <?php
      $db = new SQLite3('makerspace.db');
      $consulta = "SELECT * FROM usuarios";
      $resultado = $db->query($consulta);
      if(!$resultado) {die($db->lastErrorMsg());}
    ?>

    <!-- Lista de ususarios para modificar-->
    <form>
      <label>Editar usuario</label>
      <select id="opcion" onchange="redirigirEdicion()">
        <option value="">------</option>
        <?php
          while ($usuario = $resultado->fetchArray()) {
            echo '<option value="'.$usuario['id'].'">'.$usuario['id'].': '.$usuario['nombre'].' '.$usuario['apellidos'].'<br>'.'</option>';
          }
        ?>
      </select>
    </form>

    <!-- Tabla de usuarios -->
    <div id="fondoElementos">
      <table >
        <tr id='index'>
          <th>ID Usuario</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>ID Tarjeta</th>
        </tr>
      <?php
        //mostrar las filas de la tabla de usuarios
        while ($usuario = $resultado->fetchArray()) {
          echo '<tr>';
            echo '<td>'.$usuario['id'].'</td>';
            echo '<td>'.$usuario['nombre'].'</td>';
            echo '<td>'.$usuario['apellidos'].'</td>';
            echo '<td>'.$usuario['correo'].'</td>';
            echo '<td>'.$usuario['rol'].'</td>';
            echo '<td>'.$usuario['card_id'].'</td>';
          echo '</tr>';
        }
        $db->close();
      ?>
      </table>
    </div>
  </body>
  <script src="./js/redirigir.js"></script>
</html>