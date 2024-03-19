<!-- Cambia el estado de la compra para imprimir la boleta -->
<HTML>
<head>
<title>Activa la compra para impresion de las boletas</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_ecompra11.php?codi_com="+codi_,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE compra SET impr_com='N' WHERE codi_com=$_GET[codi_com]";
$link->query($sql);
$link->close();
echo "<body onload='javascript:cargar($_GET[codi_com])'>";
?>
</body>
</HTML>
