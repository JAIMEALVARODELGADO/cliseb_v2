<!-- Informe de Clientes -->
<HTML>
<head>
<title>Informe de Clientes</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente1.php'>
<?php
$correos='';
$condicion='';
if(!empty($_POST['codi_cli'])){
  $condicion=$condicion."codi_cli='$_POST[codi_cli]' and ";}
if(!empty($_POST['nrod_cli'])){
  $condicion=$condicion."nrod_cli='$_POST[nrod_cli]' and ";}
if(!empty($_POST['nomb_cli'])){
  $condicion=$condicion."nomb_cli like '$_POST[nomb_cli]%' and ";}
if(!empty($_POST['apel_cli'])){
  $condicion=$condicion."apel_cli like '$_POST[apel_cli]%' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
$consulta="SELECT codi_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,emai_cli FROM cliente";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='nomb_cli';
}
else{
  $orden=$_POST['orden'];
}
$consulta=$consulta." ORDER BY $orden";
//echo $consulta;
$consultacli=$link->query($consulta);
if($consultacli->num_rows==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrados</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Listado Clientes</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' width='15%'>Nro Identif</th>
    <th class='Th0' width='15%'>Nombres</th>
    <th class='Th0' width='20'>Apellidos</th>
    <th class='Th0' width='25%'>Dirección</th>
    <th class='Th0' width='15%'>Teléfono</th>
  	<?php
  	while($rowcli=$consultacli->fetch_array()){
  	  echo "<tr>";
  	  echo "<td class='Td2'>$rowcli[nrod_cli]</td>";
  	  echo "<td class='Td2'>$rowcli[nomb_cli]</td>";
  	  echo "<td class='Td2'>$rowcli[apel_cli]</td>";
  	  echo "<td class='Td2'>$rowcli[dire_cli]</td>";
  	  echo "<td class='Td2'>$rowcli[tele_cli]</td>";
  	  echo "</tr>";
  	  if(!empty($rowcli['emai_cli'])){
  	    $correos=$correos.$rowcli['emai_cli'].";";
  	  }
  	}
  	?>
  </table>
  <?php
  if(isset($_POST['correo']) and $_POST['correo']=='on'){
    echo "Correos Generados: ";
    echo "<br>".$correos;
  }
}
?> 
</form>
<?php
$link->close();
?>
</body>
</HTML>