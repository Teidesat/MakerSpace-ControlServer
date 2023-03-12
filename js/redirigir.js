function redirigirEdicionUsuario() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "editar_usuario.php?id=" + opcion;}
}


