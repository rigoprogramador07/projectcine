 
<?php 
// CONFIGURACIÓN PREVIA
require('../fpdf181/fpdf.php');
require '../bd/conexion_bd.php';
include_once "../bd/base_de_datos.php";
$obj = new BD_PDO();
$pdf = new FPDF('P','mm',array(80,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();


  $sentencia = $base_de_datos->query("SELECT ventas.total,ventas.abono, ventas.id,GROUP_CONCAT(  productos.nombre, '..',  productos.descripcion, '..',productos.id_categoria, '..',productos.precioVenta, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id  ORDER BY ventas.id DESC LIMIT 1");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ); 
// CABECERA

$pdf->Image('../images/iconopeli.png',32,11,14);
$pdf->Ln(16);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,'  C I N E M A R T E ',0,1,'C');
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(60,4,'',0,1,'C');
$pdf->Cell(60,4,'Victor Rosales #509, ',0,1,'C');
$pdf->Cell(60,4,'C.P.: 26600, VIlla Union ',0,1,'C');
$pdf->Cell(60,4,' 8621235802',0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(10);

 
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 9);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(10, 10, 'Cantidad',0,0,'R');
$pdf->Cell(13, 10, 'Precio',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(3);
 ?>
 <?php foreach($ventas as $venta){ 
foreach(explode("__", $venta->productos) as $productosConcatenados){ $producto = explode("..", $productosConcatenados)?><?php 

// PRODUCTOS

$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(25, 4,  $producto[0] ,0,0,'C');
$pdf->Cell(13, 4,  $producto[4] ,0,0,'R');
$pdf->Cell(16, 4,  $producto[3] ,0,0,'R');
$pdf->Ln(4);
} 

// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(6);
$pdf->Cell(60,0,'','T');
$pdf->Ln(4);    
$pdf->Cell(25, 10, 'TOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, $venta->total,0,0,'R');
$pdf->Ln(4);    
$pdf->Cell(25, 10, 'PAGO', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, $venta->abono,0,0,'R');
$pdf->Ln(4);    
$pdf->Cell(25, 10, 'CAMBIO', 0);    
$pdf->Cell(20, 10, '', 0);
?><?php $cambio=$venta->total-$venta->abono;  $cambio; ?>
<?php 
$pdf->Cell(15, 10, $cambio,0,0,'R');
 }
// PIE DE PAGINA
$pdf->Ln(18);
$pdf->Cell(60,0,'Le atendio: Rodrigo Gutierrez',0,1,'C');
$pdf->Ln(5);
$pdf->Cell(60,0,'Gracias por tu compra!',0,1,'C');
$pdf->Ln(6);
$pdf->Cell(60,0,'',0,1,'C');
$pdf->Cell(60,8,date('d/m/Y'),0,1,'C'); 
$pdf->Output('ticket.pdf','f');
$pdf->Output('ticket.pdf','i');
?>