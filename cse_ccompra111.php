<!-- Guarda las Compras -->
<HTML>
<head>
<title>Guarda Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar() {
  document.form1.submit();
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="DELETE FROM detalle_compra WHERE id_detalle='$_POST[id_detalle]'";
//echo"<br>".$sql;
$link->query($sql);
$codi_cli=$_POST['codigo'];
?>
</head>
<body onload='javascript:cargar()'>

<form name='form1' method='post' action='cse_ccompra1.php'>
<input type='text' name='codi_cli' value='<?php echo $codi_cli;?>'>
<input type='hidden' name='codi_com' value='<?php echo $codi_com;?>'>
</form>
</body>
</HTML>
