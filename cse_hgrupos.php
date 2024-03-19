<!-- Tipos -->
<HTML>
<head>
<title>Grupos</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
//Aqui cargo las funciones 
include("funciones.php");
?>
</head>
<body>
<table class='Tb0' width='70%'>
  <tr><td class='Td0' align='center'>Grupos</td></tr>
</table>
<br>
<?php
  $link=conectarbd();
  $consulta="SELECT codi_gru,desc_gru FROM grupo";
  $consulta=$link->query($consulta);
  if($consulta->num_rows<>0){
    echo "<table class='Tb0' width='70%'>";
	  echo "<th class='Th0'>Opción</th>";
	  echo "<th class='Th0'>Descripción</th>";
    while($row=$consulta->fetch_array()){
      echo "<tr>";
      echo "<td class='Td2' width=10%><a href='cse_hgrupos11.php?codi_gru=$row[codi_gru]&desc_gru=$row[desc_gru]'><img src='img/32px-Crystal_Clear_action_player_play.png' border=0 height='20' width='20' alt='Abrir'></a></td>";
	  echo "<td class='Td2' width=90%>$row[desc_gru]</td>";
	  echo "</tr>";
      echo "<tr>";
	}
	echo "</table>";
  }
  $link->close();
?>
</body>
</HTML>
