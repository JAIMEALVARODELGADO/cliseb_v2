<!-- Edicion de Datos del Cliente -->
<HTML>
<head>
<title>Edita Cliente</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificaci�n\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificaci�n\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    //if (document.form1.sexo_cli.value == "") { a += " Sexo\n"; }
    //if (document.form1.fnac_cli.value == "") { a += " Fecha de Nacimiento\n"; }
    //if (document.form1.tele_cli.value == "") { a += " Tel�fono\n"; }
    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
function recarga(){
  document.form1.action='cse_ccompra1.php';
  document.form1.submit();
}
function buscar(){
  document.form1.action='cse_ccompra12.php';
  document.form1.submit();
}
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
//conectarbd();
$link=conectarbd();
$consultacli="select codi_cli, tpid_cli, nrod_cli, nomb_cli, apel_cli, dire_cli, tele_cli, fnac_cli, sexo_cli, emai_cli, prof_cli, punt_cli from cliente where codi_cli=$_GET[codi_cli]";
//ECHO $consultacli;
$consultacli=$link->query($consultacli);
$rowcli=$consultacli->fetch_array();
$fnac_cli=$rowcli['fnac_cli'];
//echo "<br>".$rowcli['tpid_cli'];
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente111.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Editar Cliente</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos Personales</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificaci�n:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	   <option value=''></option>>
      	<?php
      	  $consultatp="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='01'";
          $consultatp=$link->query($consultatp);
      	  while($rowtp=$consultatp->fetch_array()){
      	    echo "<option value='$rowtp[codi_tip]'>$rowtp[desc_tip]</option>";
      	  }
      	?>
          </select>
	</td>
	<td class='Td2' width='10%' align='right'>N�mero:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' value='<?php echo $rowcli['nrod_cli'];?>'></td>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $rowcli['nomb_cli'];?>'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $rowcli['apel_cli'];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli'>
	  <option value=''></option>
	  <option value='F'>Femenino</option>
	  <option value='M'>Masculino</option>
	  <option value='I'>Indefinido</option>
    </select>
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	<td class='Td2' align='left'><input type='date' name='fnac_cli' size='10' maxlength='10' value='<?php echo $fnac_cli;?>'></td>
	<td class='Td2' align='right'>Direcci�n:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?php echo $rowcli['dire_cli'];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Tel�fono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?php echo $rowcli['tele_cli'];?>'></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?php echo $rowcli['emai_cli'];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesi�n:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?php echo $disp;?>>
	   <option value=''></option>
      	<?php
      	  $consultapr="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='04'";
          $consultapr=$link->query($consultapr);
      	  while($rowpr=$consultapr->fetch_array()){
      	    echo "<option value='$rowpr[codi_tip]'>$rowpr[desc_tip]</option>";
      	  }
      	?>
    </select>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?php echo $rowcli['punt_cli'];?></font></td>
  </tr>
</table>
<input type='hidden' name='codi_cli' value='<?php echo $_GET['codi_cli']?>'>
<script language='javascript'>
  document.form1.tpid_cli.value='<?php echo $rowcli['tpid_cli'];?>';
  document.form1.sexo_cli.value='<?php echo $rowcli['sexo_cli'];?>';
  document.form1.prof_cli.value='<?php echo $rowcli['prof_cli'];?>';
</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
//mysql_free_result($consultatp);
//mysql_free_result($consultacli);
$link->close();
?>
</body>
</HTML>