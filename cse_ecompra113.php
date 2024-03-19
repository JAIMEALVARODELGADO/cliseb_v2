<!--Anula el documento -->
<HTML>
<head>
<title>Anula el documento</title>
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
$sql="UPDATE compra SET anul_com='S' WHERE codi_com=$_GET[codi_com]";
//echo $sql;
$link->query($sql);
$link->close();
echo "<body onload='javascript:cargar($_GET[codi_com])'>";
?>
</body>
</HTML>
