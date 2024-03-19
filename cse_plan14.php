<!-- Guarda el Plan de Premios -->
<HTML>
<head>
<title>Guarda Plan de Premios</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$fsor_ppm=cambiafecha($_POST['fsor_ppm']);
$sql="UPDATE plan_premio SET fsor_ppm='$fsor_ppm',nota_ppm='$_POST[nota_ppm]'";
//echo $sql;
$link->query($sql);
$link->close();
?>
<script language='javascript'>
  alert("registro"+<?php echo $link->affected_rows;?>);
</script>
</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
