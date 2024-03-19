<!-- Captura de clientes -->
<HTML>
<head>
<title>Captura de Clientes</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta charset="UTF-8">
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificación\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificación\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    if (document.form1.sexo_cli.value == "") { a += " Sexo\n"; }
    /*if (document.form1.fnac_cli.value != "") {
	   if(validahoy(document.form1.fnac_cli.value)==false){
	    a += " La fecha de nacimiento no puede ser mayor a la actual\n";
	   }
	   if(validafechamen(document.form1.fnac_cli.value)==true){
	    a += " La fecha de nacimiento no puede ser menor a 1900\n";
	   }
    }*/

    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
function recarga(){
  document.form1.action='cse_ccompra2.php';
  document.form1.submit();
}
function buscar(){
  document.form1.action='cse_ccompra21.php';
  document.form1.submit();
}
</script>

<script language='vBscript'>
'Funcion que retorna true si la fecha es válida y false si la fecha no es válida
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

'Funcion que retorna true si la fecha es menor a la fecha actual
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function

'Funcion que retorna true si la fecha es mayor a 1900
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=-1
  end if
  if(diferencia>=39911) then
    validafechamen=true
  else
    validafechamen=false
  end if
end function
</script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
//conectarbd();
$link=conectarbd();
$disp='';
$nrod_cli='';
$nomb_cli='';
$apel_cli='';
$dire_cli='';
$tele_cli='';
$fnac_cli='';
$sexo_cli='';
$emai_cli='';
$prof_cli='';
$punt_cli='';

if(isset($_POST['nrod_cli'])){$nrod_cli=$_POST['nrod_cli'];}
if(isset($_POST['nomb_cli'])){$nomb_cli=$_POST['nomb_cli'];}
if(isset($_POST['apel_cli'])){$apel_cli=$_POST['apel_cli'];}
if(isset($_POST['dire_cli'])){$dire_cli=$_POST['dire_cli'];}
if(isset($_POST['tele_cli'])){$tele_cli=$_POST['tele_cli'];}
if(isset($_POST['fnac_cli'])){$fnac_cli=$_POST['fnac_cli'];}
if(isset($_POST['sexo_cli'])){$sexo_cli=$_POST['sexo_cli'];}
if(isset($_POST['emai_cli'])){$emai_cli=$_POST['emai_cli'];}
if(isset($_POST['prof_cli'])){$prof_cli=$_POST['prof_cli'];}

if(!empty($_POST['nrod_cli'])||!empty($_POST['codi_cli'])){
  if(!empty($_POST['codi_cli'])){
    $consultacli="select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where codi_cli=$_POST[codi_cli]";
  }
  else{
    $consultacli="select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where tpid_cli='$_POST[tpid_cli]' and nrod_cli='$_POST[nrod_cli]'";
  }
  //echo $consultacli;
  $consultacli=$link->query($consultacli);
  //if(mysql_num_rows($consultacli)<>0){
  if($consultacli->num_rows!=0){
    $rowcli=$consultacli->fetch_array();
    $codi_cli=$rowcli['codi_cli'];
  	$tpid_cli=$rowcli['tpid_cli'];
  	$nrod_cli=$rowcli['nrod_cli'];
  	$nomb_cli=$rowcli['nomb_cli'];
  	$apel_cli=$rowcli['apel_cli'];
  	$dire_cli=$rowcli['dire_cli'];
  	$tele_cli=$rowcli['tele_cli'];
  	//$fnac_cli=cambiafechadmy($rowcli['fnac_cli']);
    $fnac_cli=$rowcli['fnac_cli'];
  	$sexo_cli=$rowcli['sexo_cli'];
  	$emai_cli=$rowcli['emai_cli'];
  	$prof_cli=$rowcli['prof_cli'];
  	$punt_cli=$rowcli['punt_cli'];
  	$disp='disabled';
  }
}
?>
</head>
<body>
<form name='form1' method='post' action='cse_ccompra21.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Capura de Clientes</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos del Cliente</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	<option value=''>
	<?php
	  $consultatp="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='01'";
    $consultatp=$link->query($consultatp);
	  while($rowtp=$consultatp->fetch_array()){
	    echo "<option value='$rowtp[codi_tip]'>$rowtp[desc_tip]";
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' onblur='recarga()' value='<?php echo $nrod_cli;?>'></td>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $nomb_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $apel_cli;?>' <?php echo $disp;?>></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli' <?echo $disp;?>>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	  </select>
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	<td class='Td2' align='left'><input type='date' name='fnac_cli' size='10' maxlength='10' value='<?php echo $fnac_cli;?>' <?echo $disp;?></td>
	<td class='Td2' align='right'>Dirección:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?php echo $dire_cli;?>' <?echo $disp;?></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?php echo $tele_cli;?>' <?echo $disp;?></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?php echo $emai_cli;?>' <?echo $disp;?></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesión:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?echo $disp;?>>
	<option value=''>
	<?php
	  $consultapr="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='04'";
    $consultapr=$link->query($consultapr);
	  while($rowpr=$consultapr->fetch_array()){
	    echo "<option value='$rowpr[codi_tip]'>$rowpr[desc_tip]";
	  }
	?>
	</select>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?echo $punt_cli;?></font></td>
  </tr>
</table>

<input type='hidden' name='codigo' value='<?echo $codi_cli?>'>
<script language='javascript'>
  document.form1.tpid_cli.value='<?php echo $_POST['tpid_cli'];?>';
  document.form1.sexo_cli.value='<?php echo $_POST['sexo_cli'];?>';
  document.form1.prof_cli.value='<?php echo $_POST['prof_cli'];?>';
</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <?php
  if(empty($disp)){
    echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border='0' height='20' width='20' alt='Nuevo'></a></td>";
	echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>";
  }
  ?>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?php
//mysql_free_result($consultatp);
//mysql_free_result($consultalo);
//mysql_free_result($consultado);
//mysql_free_result($consultapr);
//mysql_close();
?>
</body>
</HTML>