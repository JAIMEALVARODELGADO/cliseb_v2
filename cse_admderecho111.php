<!-- Inactiva/Activa Derecho a la opcion -->
<HTML>
<head>
<title>Inactiva/Activa Derecho a la Opcion</title>
<Script Language="JavaScript">
function cargar(codi_ucs){
  window.open("cse_admderecho11.php?codi_ucs="+codi_ucs,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
if($_GET['opc_']==1){
  $sql="INSERT INTO um_cliseb(codi_umc,codi_men,codi_ucs) VALUES (0,$_GET[codi_men],$_GET[codi_ucs])";
}
else{
  $sql="DELETE FROM um_cliseb WHERE codi_men=$_GET[codi_men] and codi_ucs=$_GET[codi_ucs]";
}
//echo $sql;
$link->query($sql);
$link->close();
?>
<body onload='javascript:cargar(<?php echo $_GET['codi_ucs'];?>)'>
</body>
</HTML>
