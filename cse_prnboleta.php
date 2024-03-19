<?php
//ob_end_clean();

require('fpdf.php');
include("funciones.php");
$codi_com=$_GET['codi_com'];
$link=conectarbd();

$consultaplan="SELECT codi_ppm,fsor_ppm,nota_ppm FROM plan_premio";
$consultaplan=$link->query($consultaplan);
$rowplan=$consultaplan->fetch_array();
//$rowplan=mysql_fetch_array($consultaplan);

$consultaval="SELECT valxb_ent FROM entidad";
$consultaval=$link->query($consultaval);
$rowval=$consultaval->fetch_array();
$valxb=$rowval['valxb_ent'];
//http://localhost/cliseb_v2/cse_prnboleta.php?codi_com=51534
$consulta="SELECT compra.codi_com,compra.codi_cli,cliente.tpid_cli,tipo.valo_tip,cliente.nrod_cli,CONCAT(cliente.nomb_cli,' ',cliente.apel_cli) AS nombre,cliente.dire_cli,cliente.tele_cli,SUM(detalle_compra.valo_dcom) AS valo_com 
FROM detalle_compra 
INNER JOIN compra ON compra.codi_com=detalle_compra.codi_com
INNER JOIN cliente ON cliente.codi_cli=compra.codi_cli
INNER JOIN tipo ON tipo.codi_tip=cliente.tpid_cli
WHERE detalle_compra.codi_com=$codi_com";
//echo $consulta;
$consulta=$link->query($consulta);
$row=$consulta->fetch_array();

if($valxb==0){
	$l=1;
}
else{
	$l=floor($row['valo_com']/$valxb);
}

$pdf=new FPDF('P','mm','p1');

for($c=1;$c<=$l;$c++){
  $pdf->AddPage();
  $pdf->SetFont('Arial','',8);
  $f=3;
  //$pdf->Image('img\logo23.png',2,2,50,40,'','');
  
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"CENTRO COMERCIAL",0,0,'C');
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"SEBASTIAN DE BELALCAZAR P.H.",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"NIT 800005421-2",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"PLAN DE PREMIOS",0,0,'C');
  
  $pdf->SetFont('Arial','',6);
  $consultapre="SELECT desc_pre FROM premio WHERE codi_ppm=$rowplan[codi_ppm]";
  //echo $consultapre;
  $consultapre=$link->query($consultapre);
  while($rowpre=$consultapre->fetch_array()){
    $f=$f+3;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,$rowpre['desc_pre'],0,0,'L');
  }
  $f=$f+3;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Sorteo: ".cambiafechadmy($rowplan['fsor_ppm']),0,0,'L');
  $f=$f+3;
  $pdf->SetXY(2,$f);
  $pdf->Multicell(68,3,$rowplan['nota_ppm'],0,'J');
  
  $pdf->SetFont('Arial','',8);
  $f=$f+6;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"$row[nombre]",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,$row['valo_tip'].' '. $row['nrod_cli'],0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Telefono: ".$row['tele_cli'],0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Datos de la Compra",0,0,'C');

  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(15,4,"Fecha",1,0,'C');
  $pdf->SetXY(17,$f);
  $pdf->Cell(25,4,"Local",1,0,'C');
  $pdf->SetXY(42,$f);
  $pdf->Cell(13,4,"Numero",1,0,'C');
  $pdf->SetXY(55,$f);
  $pdf->Cell(15,4,"Valor",1,0,'C');

  $consultadet="SELECT detalle_compra.fecha_dcom,tipo.desc_tip AS local,detalle_compra.ndoc_dcom,detalle_compra.valo_dcom FROM detalle_compra
  INNER JOIN tipo ON tipo.codi_tip=detalle_compra.loca_dcom
  WHERE codi_com=$codi_com";
  //echo $consultadet;
  $pdf->SetFont('Arial','',6);
  $consultadet=$link->Query($consultadet);
  $total=0;
  while($rowdet=$consultadet->fetch_array()){
    $f=$f+4;
    $pdf->SetXY(2,$f);
    $pdf->Cell(15,4,cambiafechadmy($rowdet['fecha_dcom']),0,0,'C');
    $pdf->SetXY(17,$f);
    $pdf->Cell(25,4,SUBSTR($rowdet['local'],0,20),0,0,'L');
    $pdf->SetXY(42,$f);
    $pdf->Cell(13,4,$rowdet['ndoc_dcom'],0,0,'C');
    $pdf->SetXY(55,$f);
    $pdf->Cell(15,4,$rowdet['valo_dcom'],0,0,'R');
    $total=$total+$rowdet['valo_dcom'];
  }
  $f=$f+4;
  $pdf->SetXY(40,$f);
  $pdf->Cell(15,4,'Total:',0,0,'R');
  $pdf->SetXY(55,$f);
  $pdf->Cell(15,4,$total,0,0,'R');

  $pdf->SetFont('Arial','',8);
  $f=$f+7;
  $pdf->SetXY(0,$f);
  $pdf->Cell(68,2,"°<",0,0,'L');
  $f=$f+1;
  $pdf->SetXY(0,$f);
  $pdf->Cell(68,2,"°",0,0,'L');
}

$link->query("UPDATE compra SET impr_com='S' WHERE codi_com=$codi_com");
//mysql_free_result($consultaval);
//mysql_free_result($consulta);"UPDATE compra SET impr_com='S' WHERE codi_com=$codi_com"
//mysql_free_result($consultalo);
//mysql_free_result($consultado);
//mysql_close($link);
$pdf->Output();
?> 

