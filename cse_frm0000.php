<?php
session_start();
$_SESSION['Gcodi_ucs']='';
?>
<!-- Aqui se definen los frames para la búsqueda del usuarios y de la solicitud -->
<HTML>
<HEAD>
<title>CLISEB v2</title>
<script languaje='javascript'>
function validar(){
  alert("Acceso Denegado");
  window.open("index.php");
  window.close();
}
</script>
</HEAD>
<?php
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$usuario=$_POST['usuario'];
$clave=substr(MD5($_POST['clave']),0,32);
$link=conectarbd();
$consulta="SELECT codi_ucs,logi_ucs,clav_ucs,tipo_ucs
                       FROM u_cliseb WHERE logi_ucs='$usuario' and clav_ucs='$clave' and esta_ucs='A'";

$consulta=$link->query($consulta);
if($consulta->num_rows == 1){
  $row=$consulta->fetch_array();
  $_SESSION['Gcodi_ucs']=$row['codi_ucs'];
  ?>
    <FRAMESET cols="15%,*" framespacing="0" border="0" frameborder="0"> 
      <FRAME SRC=cse_left2.php NAME=fr01>
        <FRAMESET rows="15%,*" framespacing="0" border="0" frameborder="0"> 
          <FRAME SRC=cse_top.html NAME=fr02>
          <FRAME SRC=cse_fondo.html NAME=fr03>
        </FRAMESET><noframes></noframes> 
    </FRAMESET><noframes></noframes> 
  <?php
}
else{
  ?>
    <script languaje='javascript'>
      validar();
	</script>
  <?php
}
mysqli_close($link);
?>
</HTML>
