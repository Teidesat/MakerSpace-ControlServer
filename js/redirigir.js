function redirigirEdicionUsuario() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "editar_usuario.php?id=" + opcion;}
}

function redirigirEdicionTarjeta() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "editar_tarjeta.php?id=" + opcion;}
}

