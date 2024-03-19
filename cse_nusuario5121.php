<!-- Guarda al Nuevo Usuario del Sistema -->
<HTML>
<head>
<title>Guarda al Nuevo Usuario del Sistema</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_eusuario51.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$consulta="SELECT codi_ucs FROM u_cliseb WHERE iden_ucs='$_POST[iden_ucs]'";
//echo $consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows==0){
  $clav_ucs=MD5($_POST['clav_ucs']);
  $sql="INSERT INTO u_cliseb (codi_ucs,iden_ucs,nomb_ucs,logi_ucs,clav_ucs,tipo_ucs,esta_ucs) 
                   VALUES (0,'$_POST[iden_ucs]','$_POST[nomb_ucs]','$_POST[logi_ucs]','$_POST[clav_ucs]','$_POST[tipo_ucs]','A')";
  //echo "<br>".$sql;
  $link->query($sql);
  $link->close();
  echo "<body onload='javascript:cargar()'>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La identificación pertenece a otro Usuario</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='cargar()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='cargar()'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
</body>
</HTML>
