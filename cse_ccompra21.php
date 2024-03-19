<!-- Guarda las Clientes -->
<HTML>
<head>
<title>Guarda Clientes</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar() {
  document.form1.submit();
}
function regresar(){
  history.go(-1);
}
</Script>
<form name='form1' action='cse_ccompra2.php' target='fr03'>
<?php
//Aqui cargo las funciones 
include("funciones.php");
//conectarbd();
$link=conectarbd();
/*if(!empty($fnac_cli)){
  $fnac_cli=cambiafecha($fnac_cli);
}
else{
  $fnac_cli='0000-00-00';
}*/
//$fech_com=cambiafecha($fech_com);
//$hoy=cambiafecha(hoy());
//$puntos=floor($valo_com/1000);
$puntos=0;
$consulta="SELECT codi_cli FROM cliente WHERE tpid_cli='$_POST[tpid_cli]' and nrod_cli='$_POST[nrod_cli]'";
//echo $consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows==0){
  $sql="INSERT INTO cliente (codi_cli, tpid_cli, nrod_cli, nomb_cli, apel_cli, dire_cli, tele_cli, fnac_cli, sexo_cli, emai_cli, prof_cli) VALUES (0,'$_POST[tpid_cli]', '$_POST[nrod_cli]', '$_POST[nomb_cli]', '$_POST[apel_cli]', '$_POST[dire_cli]', '$_POST[tele_cli]', '$_POST[fnac_cli]', '$_POST[sexo_cli]', '$_POST[emai_cli]', '$_POST[prof_cli]')";
  echo $sql;
  $link->query($sql);
  $codi_cli=$link->insert_id;
  echo "<input type='hidden' name='tpid_cli' value='$_POST[tpid_cli]'>";
  echo "<input type='hidden' name='nrod_cli' value='$_POST[nrod_cli]'>";
  ?>
    <script language='javascript'>cargar()</script>;
  <?php
}
else{
  $codi_cli=$_POST['codigo'];
}
$link->close();
?>
</form>
</body>
</HTML>
