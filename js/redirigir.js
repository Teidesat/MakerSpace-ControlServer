function redirigir() {
  let opcion = document.getElementById("opcion").value;
  if (opcion != "") {window.location.href = "paginas/editar_usuario.php?id=" + opcion;}
}


