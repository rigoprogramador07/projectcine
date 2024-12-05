<?php 
session_start();
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
$cambio = 0;
require '../bd/conexion_bd.php';
$obj = new BD_PDO();

if (isset($_GET['idventa'])) 
{
  $cliente = $obj -> Ejecutar_Instruccion("SELECT * from cliente where id_cli='".$_GET['idventa']."'");
  $id_delcliente=$cliente[0][0];
  $nombre=$cliente[0][1];

} ?>
  <div class="col-xs-12">
    <?php

    

      if(isset($_GET["status"])){
        if($_GET["status"] === "1"){
          ?>
            <script>
                alert('Venta realizada');
                window.location= '../carrito/factura.php'
                  </script>
                  
          <?php
        }else if($_GET["status"] === "2"){
          ?>
          <script>
                alert('Venta Cancelada');
                  </script>
          <?php
        }else if($_GET["status"] === "3"){
          ?>
          <script>
                alert('Producto quitado de la lista');
                  </script>
          <?php
        }else if($_GET["status"] === "4"){
          ?>
          <script>
                alert('El producto que busca no existe');
                  </script>
          <?php
        }else if($_GET["status"] === "5"){
          ?>
          <script>
                alert('El producto esta agotado');
                  </script>
          <?php
        }
        else if($_GET["status"] === "6"){
          ?>
          <script>
                alert('Debe dar su pago o abono al realizar una compra');
                  </script>
          <?php
        }else{
          ?>
          <script>
                alert('Upps algo salio mal durante la venta');
                  </script>
          <?php
        }
      }
    ?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="../images/iconopeli.png" type="">

  <title> CineMarte </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="../css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <script src="https://www.paypal.com/sdk/js?client-id=AQ5r7luQkA8bOFhtRYBa-uT051kJtzG2z7dLM6KKxp1b486s21Y6CAK5iyF5fOaPs3vTeJwxeUz_oD82&currency=MXN"></script>
</head>


<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="../images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="../index.php">
            <span>
              CineMarte
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">Acerca</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="book.php">Contactanos</a>
              </li>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="productosmodif.php">Registrar</a>
              <a class="dropdown-item" href="listado productos.php">Listado</a>
              </div>
              </li> 
            </ul>
            <div class="user_option">
              <a href="" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a class="cart_link" href="#">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                    </g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                </svg>
              </a>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding" >
    <div class="container  ">
<div class="container" style="text-align: center;"  id="ventas">
<div class=" text-center rounded"style="border-radius:.5rem;content:'';top:-.5rem;bottom:-.5rem;left:-.5rem;right:-.5rem;padding: 3rem; margin: .5rem; background-color: rgba(255,255,255,.85);margin-right: 80px; margin-left: 80px;"> 
<h3 style="font-family: sans-serif; font-size: 40px; text-decoration-color: black;">Ventas</h3><br>
    <form method="post" action="agregarAlCarrito.php">
      <label for="codigo"></label>
      <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el nombre del producto">
    </form>
    
    <br><br>
    <table class="table table" class="text-black" style="font-family: sans-serif; font-size: 23px;">
      <thead>
        <tr class="text-black">
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio de venta</th>
          <th>Cantidad</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody class="text-black">
        <?php foreach($_SESSION["carrito"] as $indice => $producto){ 
            $granTotal += $producto->total;
          ?>
        <tr>
          <td hidden><?php echo $producto->id ?></td>
          <td><?php echo $producto->nombre ?></td>
          <td><?php echo $producto->descripcion ?></td>
          <td><?php echo $producto->precioVenta ?></td>
          <td><?php echo $producto->cantidad ?></td>
          <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <h3 style="text-decoration-color: black;">Total: <?php echo $granTotal; ?></h3>
    <form action="./terminarVenta.php" method="POST" class="text-black" class="table">
      <input name="total" type="hidden" value="<?php echo $granTotal;?>" class="table">
      <div>
      <input  style="width: 122.66666px;height: 35.66666px; text-align: center; text-decoration-color: black;" required placeholder="Su pago" title="Introduce la cantidad a pagar" id="billete" name="billete" class="table">
      </div>
        <button type="submit" class="btn btn-info">Terminar venta</button>
      <a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
      <br> <br>
      <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $granTotal; ?>', //Precio del producto
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
              return actions.order.capture().then(function(details) { // ACCIONES A REALIZAR AL TERMINAR DE PROCESAR EL PAGO
                // Retornar datos del comprador desde su cuenta de PayPal
                Swal.fire(
                  'Compra procesada!',
                  details.payer.name.given_name + ', Gracias por realizar tu compra!',
                  'success'
                )
                setTimeout(function() {
                  window.location.href = "index.php";
                }, 2000);
              });
            }
        }).render('#paypal-button-container');
    </script>

<div id="payment">
     <div id="paypal-button-container"></div>
    </div>
    </form>
  </div>
    </div>
  </div>  
</section>

  <!-- end about section -->

  <!-- footer section -->
   <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Nuestra Informacion
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Lugar
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Llamanos 8621235802
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  CineMarte01@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              CineMarte
            </a>
            <p>
             Tu lugar ideal, el que te brinda entretenimiento de aqui a Marte.
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Horario 
          </h4>
          <p>
            Todos los dias
          </p>
          <p>
            8:00 a.m a 12:00 p.m
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br><br>
          &copy; <span id="displayYear"></span> Distributed By
          <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="../js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>