<!-- Guarda los Premios -->
<HTML>
<head>
<title>Guarda Premios</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="INSERT INTO premio(codi_pre,codi_ppm,desc_pre)
               VALUES (0,1,'$_POST[desc_pre]')";
echo $sql;
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
