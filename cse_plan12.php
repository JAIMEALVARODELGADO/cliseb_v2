<!-- Edicion de premios -->
<HTML>
<head>
<title>Edicion del Premios</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_plan1.php","fr03");
}

function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.desc_pre.value == "") { a += " Descripci�n\n";}
    if (a != "") 
    { alert(error + a);return true;}
document.form1.submit()
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_plan121.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Editar Premio</td></tr>
</table>
<br>
<?php
$consultapre="SELECT codi_pre,desc_pre FROM premio WHERE codi_pre='$_GET[codi_pre]'";
//echo $consultapre;
$consultapre=$link->query($consultapre);
$rowpre=$consultapre->fetch_array();
?>
<table class='Tb0' width='60%' border='0'>
  <th class='Th0' width='5%'</th>
  <th class='Th0' width='10%'></th>
  <th class='Th0' width='10%'></th>
  <th class='Th0' width='75%'>Descripci�n</th>
  <tr>
    <td class='Td2'></td>
	<td class='Td2'></td>
	<td class='Td2'></td>
	<td class='Td2'><input type='text' name='desc_pre' size='50' maxlength='50' value='<?php echo $rowpre['desc_pre'];?>'></td>
  </tr>
</table>
<input type='hidden' name='codi_pre' value='<?php echo $rowpre['codi_pre'];?>'>
<br>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
$link->close();
?>
</body>
</HTML>