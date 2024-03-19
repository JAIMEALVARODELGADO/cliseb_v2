<!-- Guarda la Edicion del Usuario del Sistema -->
<HTML>
<head>
<title>Guarda Edicion de Usuario del Sistema</title>
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
$consulta="SELECT codi_ucs FROM u_cliseb WHERE iden_ucs='$_POST[iden_ucs]' and codi_ucs<>'$_POST[codi_ucs]'";
//echo $consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows==0){
  $sql="UPDATE u_cliseb SET iden_ucs='$_POST[iden_ucs]',nomb_ucs='$_POST[nomb_ucs]',logi_ucs='$_POST[logi_ucs]',tipo_ucs='$_POST[tipo_ucs]' WHERE codi_ucs='$_POST[codi_ucs]'";
  //echo "<br>".$sql;
  $link->query($sql);
  if(!empty($_POST['clav_ucs'])){
    $clav_ucs=MD5($_POST['clav_ucs']);
	   $sql="UPDATE u_cliseb SET clav_ucs='$clav_ucs'
               WHERE codi_ucs='$_POST[codi_ucs]'";
      //echo "<br>".$sql;
      $link->query($sql);
  }
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
