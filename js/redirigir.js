function redirigirEdicion() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "editar_usuario.php?id=" + opcion;}
}

function redirigirBorrado() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "borrar_usuario.php?id=" + opcion;}
}