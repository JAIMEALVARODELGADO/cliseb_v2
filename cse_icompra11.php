<!-- Informe de Compras -->
<HTML>
<head>
<title>Informe de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action=''>
<?
$condicion="bol.anul_bol='N' and ";
if(!empty($nrod_cli)){
  $condicion=$condicion."cl.nrod_cli='$nrod_cli' and ";}
if(!empty($nomb_cli)){
  $condicion=$condicion."cl.nomb_cli like '$nomb_cli%' and ";}
if(!empty($apel_cli)){
  $condicion=$condicion."cl.apel_cli like '$apel_cli%' and ";}
if(!empty($loca_com)){
  $condicion=$condicion."co.loca_com='$loca_com' and ";}
if(!empty($tdoc_com)){
  $condicion=$condicion."co.tdoc_com='$tdoc_com' and ";}
if(!empty($loca_com)){
  $condicion=$condicion."co.loca_com='$loca_com' and ";}
if(!empty($fechaini)){
    $fechaini=cambiafecha($fechaini);
  $condicion=$condicion."co.fech_com>='$fechaini' and ";}
if(!empty($fechafin)){
    $fechafin=cambiafecha($fechafin);
  $condicion=$condicion."co.fech_com<='$fechafin' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
$consulta="SELECT cl.codi_cli,cl.nrod_cli,cl.nomb_cli,cl.apel_cli,cl.dire_cli,cl.tele_cli,sexo_cli,fnac_cli,
           tp.valo_tip,co.ndoc_com,co.fech_com,co.valo_com,loc.desc_tip AS local 
           FROM compra as co
           INNER JOIN boleta AS bol ON bol.codi_bol=co.codi_bol
           INNER JOIN cliente as cl ON cl.codi_cli=bol.codi_cli
           INNER JOIN tipo as tp ON tp.codi_tip=co.tdoc_com
           INNER JOIN tipo AS loc ON loc.codi_tip=co.loca_com";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='cl.nomb_cli';
}
$consulta=$consulta." ORDER BY $orden";
//echo $consulta;
$consultacom=mysql_query($consulta);
if(mysql_num_rows($consultacom)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Compras No Encontradas</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Listado Clientes</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0'>Nro Identif</th>
    <th class='Th0'>Nombres</th>
    <th class='Th0'>Apellidos</th>
	<th class='Th0'>Direccion</th>
    <th class='Th0'>Tel�fono</th>
	<th class='Th0'>Sexo</th>
	<th class='Th0'>Fecha Nac</th>
    <th class='Th0'>Local</th>
    <th class='Th0'>Docum</th>
    <th class='Th0'>N�mero</th>
    <th class='Th0'>Fecha</th>
    <th class='Th0'>Valor</th>    
	<?
	while($rowcom=mysql_fetch_array($consultacom)){
	  echo "<tr>";
	  echo "<td class='Td2'>$rowcom[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcom[nomb_cli]</td>";
	  echo "<td class='Td2'>$rowcom[apel_cli]</td>";
	  echo "<td class='Td2'>$rowcom[dire_cli]</td>";
	  echo "<td class='Td2'>$rowcom[tele_cli]</td>";
	  echo "<td class='Td2'>$rowcom[sexo_cli]</td>";
	  echo "<td class='Td2'>$rowcom[fnac_cli]</td>";
      echo "<td class='Td2'>$rowcom[local]</td>";
	  echo "<td class='Td2'>$rowcom[valo_tip]</td>";
	  echo "<td class='Td2'>$rowcom[ndoc_com]</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowcom[fech_com])."</td>";
	  echo "<td class='Td2'>$rowcom[valo_com]</td>";
	  echo "</tr>";
	}
	?>
  </table>
  <?
}
?>  
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>
</form>
<?
mysql_close();
?>
</body>
</HTML>