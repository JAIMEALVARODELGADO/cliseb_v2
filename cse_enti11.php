<!-- Guarda la Edicion de la entidad -->
<HTML>
<head>
<title>Guarda Edicion de la Entidad</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_enti1.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE entidad SET nit_ent='$_POST[nit_ent]',nomb_ent='$_POST[nomb_ent]',valxb_ent='$_POST[valxb_ent]'";
$link->query($sql);
$link->close();
?>
<body onload='javascript:cargar()'>
</body>
</HTML>
