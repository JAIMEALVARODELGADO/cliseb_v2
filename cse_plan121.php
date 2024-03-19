<!-- Guarda la Edicion del  Premio -->
<HTML>
<head>
<title>Guarda la Edicion del Premio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$sql="UPDATE premio SET desc_pre='$_POST[desc_pre]'
             WHERE codi_pre='$_POST[codi_pre]'";
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
