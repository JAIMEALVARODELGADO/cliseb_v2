<!-- Captura de compras -->
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Captura de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(){
var error = "Para continuar complete los siguientes campos:\n";
var a = ""
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificación\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificación\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    if (document.form1.sexo_cli.value == "") { a += " Sexo\n";}
    /*if (document.form1.fnac_cli.value != "") {
	  //if(validafecha(document.form1.fnac_cli.value)==false){
	  //  a += " Fecha de Nacimiento Inválida\n";
	  //}

	  if(validahoy(document.form1.fnac_cli.value)==false){
	    a += " La fecha de nacimiento no puede ser mayor a la actual\n";
	  }
	  if(validafechamen(document.form1.fnac_cli.value)==true){
	    a += " La fecha de nacimiento no puede ser menor a 1900\n";
	  }
	}*/
    //if (document.form1.tele_cli.value == "") { a += " Teléfono\n"; }
    if (document.form1.loca_com.value == "") { a += " Local\n"; }
    if (document.form1.tdoc_com.value == "") { a += " Documento\n"; }
    if (document.form1.ndoc_com.value == "") { a += " Numero\n"; }
    if (document.form1.fech_com.value == "") { a += " Fecha de Compra\n"; }
	/*if (document.form1.fech_com.value!=""){
	  if(validafecha(document.form1.fech_com.value)==false){
	    a += " Fecha de Compra Inválida\n";
	  }
	  if(validahoy(document.form1.fech_com.value)==false){
	    a += " La fecha de compra no puede ser mayor a la actual\n";
	  }
	  if(validafechamen(document.form1.fech_com.value)==true){
	    a += " La fecha de compra no puede ser menor a 1900\n";
	  }
    }*/
    if (document.form1.valo_com.value == "") { a += " Valor de la Compra\n"; }
    if (a != ""){
    	alert(error + a);
    	return true;
    }
	document.form1.submit()
}

function eliminar(id_){
	if(confirm("Desea eliminar este registro?")){
		//alert(id_);
		document.form1.id_detalle.value=id_;
		document.form1.action='cse_ccompra111.php';
		document.form1.submit();
	}
}

function cerrar(){
	if(confirm("Desea cerrar esta compra?")){
	 	document.form1.action='cse_ccompra112.php';
	 	document.form1.submit(); 	
	}
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
$codi_cli='';
$tpid_cli='';
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
$codi_com='';
$ndoc_com='';
$valo_com='';
$loca_com='';
$tdoc_com='';
$ndoc_com='';
$fech_com=hoy();
$valo_com='';
if(isset($_POST['codi_cli'])){$codi_cli=$_POST['codi_cli'];}
if(isset($_POST['tpid_cli'])){$tpid_cli=$_POST['tpid_cli'];}
if(isset($_POST['nrod_cli'])){$nrod_cli=$_POST['nrod_cli'];}
if(isset($_POST['nomb_cli'])){$nomb_cli=$_POST['nomb_cli'];}
if(isset($_POST['apel_cli'])){$apel_cli=$_POST['apel_cli'];}
if(isset($_POST['dire_cli'])){$dire_cli=$_POST['dire_cli'];}
if(isset($_POST['tele_cli'])){$tele_cli=$_POST['tele_cli'];}
if(isset($_POST['fnac_cli'])){$fnac_cli=$_POST['fnac_cli'];}
if(isset($_POST['sexo_cli'])){$sexo_cli=$_POST['sexo_cli'];}
if(isset($_POST['emai_cli'])){$emai_cli=$_POST['emai_cli'];}
if(isset($_POST['prof_cli'])){$prof_cli=$_POST['prof_cli'];}
if(isset($_POST['loca_com'])){$loca_com=$_POST['loca_com'];}
if(isset($_POST['tdoc_com'])){$tdoc_com=$_POST['tdoc_com'];}
if(isset($_POST['ndoc_com'])){$ndoc_com=$_POST['ndoc_com'];}
if(isset($_POST['fech_com'])){$fech_com=$_POST['fech_com'];}
if(isset($_POST['valo_com'])){$valo_com=$_POST['valo_com'];}
	//$punt_cli=$_POST['punt_cli'];


//conectarbd();
$link=conectarbd();
$disp='';
if(!empty($_POST['nrod_cli']) || !empty($codi_cli)){
  //if(!empty($_POST['codi_cli'])){$codi_cli=$_POST['codi_cli'];}
  if(!empty($codi_cli)){
    $consultacli="select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where codi_cli=$codi_cli";
  }
  else{
    $consultacli="select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where tpid_cli='$tpid_cli' and nrod_cli='$nrod_cli'";
  }
  $consultacli=$link->query($consultacli);
  //if(mysql_num_rows($consultacli)<>0){
  if($consultacli->num_rows!=0){
    //$rowcli=mysql_fetch_array($consultacli);
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
<form name='form1' method='post' action='cse_ccompra11.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Capura de Compras</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos del Cliente</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	<option value=''></option>
	<?php
	  $consultatp="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='01'";
	  $consultatp=$link->query($consultatp);
	  while($rowtp=$consultatp->fetch_array()){
	    echo "<option value='".$rowtp['codi_tip']."'>".$rowtp['desc_tip']."</option>";
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' onblur='recarga()' value='<?php echo $nrod_cli;?>'></td>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?php echo $nomb_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?php echo $apel_cli;?>' <?php echo $disp;?>>
	<a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli' <?php echo $disp;?>>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	  </select>
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: </td>
	<td class='Td2' align='left'><input type='date' name='fnac_cli' size='10' maxlength='10' value='<?php echo $fnac_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' align='right'>Dirección:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?php echo $dire_cli;?>' <?php echo $disp;?>></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?php echo $tele_cli;?>' <?php echo $disp;?>></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?php echo $emai_cli;?>' <?php echo $disp;?>></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesión:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?php echo $disp;?>>
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
	<td class='Td2' align='left'><font color='#ff0000'><b><?php echo $punt_cli;?></font></td>
  </tr>
</table>

<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de la Compra</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <th class='Th0' align='center'>Opc</th>
    <th class='Th0' align='center'>Local</th>
    <th class='Th0' align='center'>Documento</th>
    <th class='Th0' align='center'>Número</th>
    <th class='Th0' align='center'>Fecha</th>
    <th class='Th0' align='center'>Valor</th>
   </tr>
   <?php
   $total=0;
   	$consultadet="SELECT compra.codi_com,detalle_compra.id_detalle,detalle_compra.tdoc_dcom,doc.desc_tip AS documento,detalle_compra.ndoc_dcom,detalle_compra.fecha_dcom,detalle_compra.valo_dcom,detalle_compra.loca_dcom,loc.desc_tip AS local
   	FROM compra
   	INNER JOIN detalle_compra ON detalle_compra.codi_com=compra.codi_com 
   	INNER JOIN tipo AS doc ON doc.codi_tip=detalle_compra.tdoc_dcom
   	INNER JOIN tipo AS loc ON loc.codi_tip=detalle_compra.loca_dcom
   	WHERE codi_cli='$codi_cli' AND esta_com='A' ORDER BY id_detalle";
   	//echo $consultadet;
   	$consultadet=$link->query($consultadet);
	while($rowdet=$consultadet->fetch_array()){
		$codi_com=$rowdet['codi_com'];
		echo "<tr>";
		echo "<td>
		<a href='#' onclick='eliminar($rowdet[id_detalle])'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Borrar Registro' title='Borrar Registro'></a></td>";
	    echo "<td>$rowdet[local]</td>";
	    echo "<td>$rowdet[documento]</td>";
	    echo "<td>$rowdet[ndoc_dcom]</td>";
	    echo "<td>$rowdet[fecha_dcom]</td>";
	    echo "<td>$rowdet[valo_dcom]</td>";
	    echo "</tr>";
	    $total=$total+$rowdet['valo_dcom'];
	 }
 	echo "<tr>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td align='right'>Total:</td>";
    echo "<td>$total</td>";
    echo "</tr>";
   ?>

   <tr>
   	<td></td>
    <td class='Td2' align='left'><select name='loca_com'>
	<option value=''>
	<?php
	  $consultalo="SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_gru='03' ORDER BY desc_tip";
	  $consultalo=$link->query($consultalo);
	  while($rowlo=$consultalo->fetch_array()){
	    echo "<option value='$rowlo[codi_tip]'>".
	    $rowlo['valo_tip'].' '.substr($rowlo['desc_tip'],0,15);
	    echo "</option>";
	  }
	?>
	</select>    
    <td class='Td2' align='left'><select name='tdoc_com'>
	<option value=''>
	<?php
	  $consultado="SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='02'";
	  $consultado=$link->query($consultado);
	  while($rowdo=$consultado->fetch_array()){
	    echo "<option value='$rowdo[codi_tip]'>$rowdo[desc_tip]</option>";
	  }
	?>
	</select>
	</td>
	
	<td class='Td2' align='left'><input type='text' name='ndoc_com' size='6' maxlength='6' value='<?php echo $ndoc_com;?>'></td>
	
    <td class='Td2' align='left'><input type='date' name='fech_com' size='10' maxlength='10' value='<?php echo $fech_com;?>'></td>
	
	<td class='Td2' align='left'><input type='text' name='valo_com' size='7' maxlength='7' value='<?php echo $valo_com;?>'>
	<a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Guardar'>Guardar</a>
	</td>
  </tr>
</table>
<input type='hidden' name='codigo' value='<?php echo $codi_cli;?>'>
<input type='hidden' name='codi_com' value='<?php echo $codi_com;?>'>
<input type='hidden' name='id_detalle' value=''>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <!--<td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>-->
  <td class='Td2' align='center' colspan=4><a href='#' onclick='cerrar()'><img src='img/32px-Crystal_Clear_action_decrypted.png' border=0 height='20' width='20' alt='Cerrar Compra '>Cerrar Compra</a></td>
  </tr>
</table>
<script language='javascript'>
	document.form1.tpid_cli.value='<?php echo $tpid_cli;?>';
	document.form1.sexo_cli.value='<?php echo $sexo_cli;?>';
	document.form1.prof_cli.value='<?php echo $prof_cli;?>';
	document.form1.loca_com.value='<?php echo $loca_com;?>';
	document.form1.tdoc_com.value='<?php echo $tdoc_com;?>';
</script>
</form>

<?php
/*mysql_free_result($consultatp);
mysql_free_result($consultalo);
mysql_free_result($consultado);
mysql_free_result($consultapr);*/

?>
</body>
</HTML>