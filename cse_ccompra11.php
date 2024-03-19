<!-- Guarda las Compras -->
<HTML>
<head>
<title>Guarda Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar() {
  //window.open('cse_ccompra1.php','fr03','');
  document.form1.submit();
}
function regresar(){
  history.go(-1);
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
/*if(!empty($fnac_cli)){
  $fnac_cli=cambiafecha($fnac_cli);
}
else{
  $fnac_cli='0000-00-00';
}*/
if(empty($fnac_cli)){
  $fnac_cli='0000-00-00';
}
//$fech_com=cambiafecha($fech_com);
$hoy=hoy();
//$puntos=floor($valo_com/1000);
//echo "<br>".$_POST["codigo"];
if(empty($_POST["codigo"])){
  $tpid_cli=$_POST["tpid_cli"];
  $nrod_cli=$_POST["nrod_cli"];
  $nomb_cli=$_POST["nomb_cli"];
  $apel_cli=$_POST["apel_cli"];
  $dire_cli=$_POST["dire_cli"];
  $tele_cli=$_POST["tele_cli"];
  $fnac_cli=$_POST["fnac_cli"];
  $sexo_cli=$_POST["sexo_cli"];
  $emai_cli=$_POST["emai_cli"];
  $prof_cli=$_POST["prof_cli"];
  $sql="INSERT INTO cliente (codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli)
               VALUES (0,'$tpid_cli','$nrod_cli','$nomb_cli','$apel_cli','$dire_cli','$tele_cli','$fnac_cli','$sexo_cli','$emai_cli','$prof_cli')";
  //echo"<br>".$sql;
  $link->query($sql);
  $codi_cli=$link->insert_id;
  //echo $codi_cli;
}
else{
  $codi_cli=$_POST["codigo"];
}

/*$consultacom="SELECT codi_com FROM compra WHERE tdoc_com='$_POST[tdoc_com]' and ndoc_com='$_POST[ndoc_com]' and loca_com='$_POST[loca_com]' and anul_com<>'S'";
echo $consultacom;*/

//$encon=mysql_num_rows($consultacom);
if(empty($_POST['codi_com'])){
  $sql="INSERT INTO compra (codi_com,codi_cli,fechreg_com,esta_com,impr_com,anul_com)
        VALUES (0,$codi_cli,'$hoy','A','N','N')";
  //echo $sql;
  $link->query($sql);
  $codi_com=$link->insert_id;
  //echo "<br>".$codi_com;
}
else{
  $codi_com=$_POST['codi_com'];
}

$sql="INSERT INTO detalle_compra (id_detalle,codi_com,tdoc_dcom,ndoc_dcom,fecha_dcom,valo_dcom,loca_dcom)
      VALUES (0,$codi_com,'$_POST[tdoc_com]','$_POST[ndoc_com]','$_POST[fech_com]','$_POST[valo_com]','$_POST[loca_com]')";
//echo $sql;
$link->query($sql);
$codi_com=$link->insert_id;
//echo "<br>".$codi_com;
/*  $codi_com=mysql_insert_id();
  $consultapun=mysql_query("SELECT punt_cli FROM cliente WHERE codi_cli=$codi_cli");
  $rowpun=mysql_fetch_array($consultapun);	 
  //mysql_query("UPDATE cliente SET punt_cli=$rowpun[punt_cli]+$puntos,fuco_cli='$hoy' WHERE codi_cli=$codi_cli");
}
mysql_close();*/
?>
</head>
<?php
$encon=0;
if($encon==0){
  echo "<body onload='javascript:cargar()'>";
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Compra Guardada</td></tr>";
  echo "</table>";
  echo "<br><br><br><br><br><br><br><br><br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='cse_prnboleta.php?codi_com=$codi_com' target='blank' onclick='cargar()'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='cse_prnboleta.php?codi_com=$codi_com' target='blank' onclick='cargar()'>Imprimir Boletas</a></td>";
  echo "</tr>";
  echo "</table>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La compra ya fue registrada anteriormente</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='regresar()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='regresar()'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
<form name='form1' method='post' action='cse_ccompra1.php'>
<input type='hidden' name='codi_cli' value='<?php echo $codi_cli;?>'>
<input type='hidden' name='codi_com' value='<?php echo $codi_com;?>'>
</body>
</HTML>
