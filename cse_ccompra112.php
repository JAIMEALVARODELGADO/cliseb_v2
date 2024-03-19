<!-- Guarda las Compras -->
<HTML>
<head>
<title>Guarda Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar() {
  //document.form1.submit();
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
/*if(!empty($fnac_cli)){
  $fnac_cli=cambiafecha($fnac_cli);
}
else{
  $fnac_cli='0000-00-00';
}*/
//if(empty($fnac_cli)){
//  $fnac_cli='0000-00-00';
//}
//$fech_com=cambiafecha($fech_com);
//$hoy=hoy();
//$puntos=floor($valo_com/1000);
//echo "<br>".$_POST["codigo"];
$sql="UPDATE compra SET esta_com ='C' WHERE codi_com='$_POST[codi_com]'";
//echo"<br>".$sql;
$link->query($sql);

?>
</head>
<?php
echo "<body onload='javascript:cargar()'>";
echo "<body>";
echo "<table class='Tbl0' width='100%'>";
echo "<tr><td class='Td0' align='center'>Compra Guardada</td></tr>";
echo "</table>";
echo "<br><br><br><br><br><br><br><br><br>";
echo "<table class='Tb0' width='70%'>";
echo "<tr>";
echo "<td class='Td2' width='25%' align='right'><a href='cse_prnboleta.php?codi_com=$_POST[codi_com]' target='blank' onclick='cargar()'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas'></a></td>";
echo "<td class='Td2' width='25%' align='left'><a href='cse_prnboleta.php?codi_com=$_POST[codi_com]' target='blank' onclick='cargar()'>Imprimir Boletas</a></td>";
echo "</tr>";
echo "</table>";

?>
<form name='form1' method='post' action='cse_ccompra1.php'>
<input type='hidden' name='codi_cli' value=''>
<input type='hidden' name='codi_com' value=''>
</body>
</HTML>
