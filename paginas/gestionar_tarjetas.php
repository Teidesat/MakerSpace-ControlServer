<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino-->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza-paginas.html')?>

  <body>
    <?php include('./../html/cabecera-paginas.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>

    <!-- Acceso a la base de datos de usuarios y consultas-->
    <?php
      $db = new SQLite3('./../bbdd/acceso_makerspace.db');
      $consulta = "SELECT * FROM tarjetas";
      $resultado = $db->query($consulta);
      if(!$resultado) {die($db->lastErrorMsg());}
    ?>

    <!-- Lista de usuarios para modificar -->
    <form>
      <label>Editar tarjeta</label>
      <select id="opcion" onchange="redirigirEdicionTarjeta()">
        <option value="">------</option>
        <?php
          while ($tarjeta = $resultado->fetchArray()) {
            echo '<option value="'.$tarjeta['id_tarjeta'].'">'.$tarjeta['id_tarjeta'].'<br>'.'</option>';
          }
        ?>
      </select>
    </form>

    <!-- Tabla de usuarios -->
    <div id="fondoElementos">
      <table >
        <tr id='index'>
          <th>ID Tarjeta</th>
          <th>Contrasena</th>
        </tr>
      <?php
        //mostrar las filas de la tabla de usuarios
        while ($tarjeta = $resultado->fetchArray()) {
          echo '<tr>';
            echo '<td>'.$tarjeta['id_tarjeta'].'</td>';
            echo '<td>'.$tarjeta['contrasena'].'</td>';
          echo '</tr>';
        }
        $db->close();
      ?>
      </table>
    </div>
  </body>
  <script src="./../js/redirigir.js"></script>
</html>