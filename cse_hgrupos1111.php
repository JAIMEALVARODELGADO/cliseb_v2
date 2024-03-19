<?php
session_start();
//session_register("gcodi_gru");
//session_register("gdesc_gru");
?>
<HTML>
<head>
<title>Guarda Tipos</title>
<Script Language="JavaScript">
function cargar() {
var load = window.open('cse_hgrupos11.php','fr03','');
window.opener = top;
window.close();
}
</Script>
<?php
//Aqui cargo las funciones 
include("funciones.php");
$link=conectarbd();
$consulta="SELECT desc_tip FROM tipo WHERE desc_tip='$_POST[desc_tip]'";
//echo $consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows==0){
  $consulta="SELECT max(codi_tip) FROM tipo WHERE codi_gru='$_SESSION[gcodi_gru]'";
  //echo "<br>".$consulta;
  $consulta=$link->query($consulta);
  $row=$consulta->fetch_array();
  if(empty($row['max(codi_tip)'])){
     $codi_tip=$_SESSION['gcodi_gru'].'001';}
  else{
       $codi_tip=substr($row['max(codi_tip)'],2,3)+1;
	     $codi_tip=STR_PAD($row['max(codi_tip)']+1,5,'0',STR_PAD_LEFT);
	     //echo "<br>".$codi_tip;
    }
    $sql="INSERT INTO tipo (codi_tip,codi_gru,desc_tip,valo_tip,fijo_tip) VALUES ('$codi_tip','$_SESSION[gcodi_gru]','$_POST[desc_tip]','$_POST[valo_tip]','N')";
    //echo "<br>".$sql;
    $link->query($sql);
  }
  $link->close();
?>

</head>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">

</form>
</body>
</HTML>
