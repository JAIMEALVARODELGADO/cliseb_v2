<!-- Listado de compras para su edicion -->
<HTML>
<head>
<title>Listado de Edicion de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
<script language='javascript'>
function anular(codi_){
var url=''
	if(confirm('Desea anular el documento: ')){
		url="cse_ecompra113.php?codi_com="+codi_;
		window.open(url,'fr05');
	}
}
function editar(nrod_,tpid_){
	document.form1.action="cse_ccompra1.php";
	document.form1.target="fr03";
	document.form1.nrod_cli.value=nrod_;
	document.form1.tpid_cli.value=tpid_;
	document.form1.submit();
}
</script>
</head>
<body>
<form name='form1' method='post' action=''>
<?php
$condicion='';
if(!empty($_POST['nrod_cli'])){
  $condicion=$condicion."cl.nrod_cli='$_POST[nrod_cli]' and ";}
if(!empty($_POST['nomb_cli'])){
  $condicion=$condicion."cl.nomb_cli like '$_POST[nomb_cli]%' and ";}
if(!empty($_POST['apel_cli'])){
  $condicion=$condicion."cl.apel_cli like '$_POST[apel_cli]%' and ";}
if(!empty($_POST['fechreg_com'])){
  $condicion=$condicion."co.fechreg_com='$_POST[fechreg_com]' and ";}
if(!empty($_GET['codi_com'])){
  $condicion=$condicion."co.codi_com='$_GET[codi_com]' and ";}

/*if(!empty($_POST['loca_com'])){
  $condicion=$condicion."co.loca_com='$_POST[loca_com]' and ";}
if(!empty($_POST['tdoc_com'])){
  $condicion=$condicion."co.tdoc_com='$_POST[tdoc_com]' and ";}
if(!empty($_POST['ndoc_com'])){
  $condicion=$condicion."co.ndoc_com='$_POST[ndoc_com]' and ";}*/
$condicion=substr($condicion,0,(strlen($condicion)-5));
/*$consulta="SELECT co.codi_com,co.ndoc_com,co.fech_com,co.loca_com,co.valo_com,co.impr_com,co.anul_com,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre,lo.desc_tip,lo.valo_tip 
           FROM compra as co 
		   INNER JOIN cliente as cl ON cl.codi_cli=co.codi_cli
		   INNER JOIN tipo as lo ON lo.codi_tip=co.loca_com";*/
$consulta="SELECT co.codi_com,co.fechreg_com,co.impr_com,co.esta_com,co.anul_com,cl.tpid_cli,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre FROM compra as co INNER JOIN cliente as cl ON cl.codi_cli=co.codi_cli";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='cl.nomb_cli';
}
$consulta=$consulta." ORDER BY $orden";
//echo $consulta;
$consultacom=$link->query($consulta);
if($consultacom->num_rows==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrados</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Compras</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' colspan='4'>Opcion</th>
    <th class='Th0'>Identif</th>
    <th class='Th0'>Nombre</th>
    <th class='Th0'>Fecha Registro</th>
    <!--<th class='Th0'>Valor</th>-->
	<th class='Th0'>Est</th>
	<?php
	while($rowcom=$consultacom->fetch_array()){
	  echo "<tr>";
	  if($rowcom['anul_com']=='S' or $rowcom['esta_com']=='C'){
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></td>";
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Boleta Impresa Anteriormente'></td>";
		  echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' alt='Activar Impresion de Boleta'></td>";
		  echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Anular Documento'></td>";
	  }
	  else{
	  		//echo "<td class='Td2'><a href='cse_ecompra111.php?codi_com=$rowcom[codi_com]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar' title='Editar'></a></td>";
	  		echo "<td class='Td2'><a href='#' onclick=\"editar('$rowcom[nrod_cli]','$rowcom[tpid_cli]')\"><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar' title='Editar'></a></td>";
	      if($rowcom['impr_com']=='S'){
		    echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Boleta Impresa Anteriormente'></td>";
		  }
		  else{
		    echo "<td class='Td2'><a href='cse_prnboleta.php?codi_com=$rowcom[codi_com]' target='blank'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas' title='Imprimir Boletas'></a></td>";
	      }
		  //echo "<td class='Td2'><a href='cse_ecompra112.php?codi_com=$rowcom[codi_com]&ndoc_com=$rowcom[ndoc_com]'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' alt='Activar Impresion de Boleta'></a></td>";
		  echo "<td class='Td2'><a href='cse_ecompra112.php?codi_com=$rowcom[codi_com]'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' alt='Activar Impresion de Boleta' title='Activar Impresion de Boleta'></a></td>";
		  

		  //echo "<td class='Td2'><a href='#' onclick='anular(\"$rowcom[codi_com]\",\"$rowcom[ndoc_com]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Anular Documento'></a></td>";
		  echo "<td class='Td2'><a href='#' onclick='anular(\"$rowcom[codi_com]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Anular Documento' title='Anular Documento'></a></td>";
	  }
	  //echo "<td class='Td2'>$rowcom[ndoc_com]</td>";
	  echo "<td class='Td2'>$rowcom[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcom[nombre]</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowcom['fechreg_com'])."</td>";
	  //echo "<td class='Td2'>".$rowcom[valo_tip].' '.$rowcom[desc_tip]."</td>";
	  //echo "<td class='Td2' align='right'>$rowcom[valo_com]</td>";
	  if($rowcom['anul_com']=='S'){
	  	echo "<td class='Td2' align='right'>Anulada</td>";}
	  elseif($rowcom['esta_com']=='C'){
	  	echo "<td class='Td2' align='right'>Cerrada</td>";}
	  else{
	  	echo "<td class='Td2' align='right'></td>";}	  
	  echo "</tr>";
	}
	?>
  </table>
  <?php
}
?>
<input type='hidden' name='nrod_cli' />
<input type='hidden' name='tpid_cli' />
</form>
<?php
$link->close();
?>
</body>
</HTML>