<?php  
session_start();
error_reporting(1);
require 'log.php';
require 'bd/conexion_bd.php';
$obj = new BD_PDO();
$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; 

if(isset($_GET['ideliminar'])) {
    $obj->Ejecutar_Instruccion("DELETE FROM productos WHERE id = '".$_GET['ideliminar']."'");
    $log = "Se eliminó el producto (ID: '".$_GET['ideliminar']."') por el usuario $user. Categoría: 3";
    log_past($log, "Productos", "Eliminación");
}

if(isset($_POST['txtbuscar'])) {
    $buscar = trim($_POST['txtbuscar']); 

    if(empty($buscar)) {
        $consulta = "SELECT * FROM productos INNER JOIN Categoria ON productos.id_categoria = Categoria.id_categoria GROUP BY productos.id";

        $log = "Se realizó una búsqueda general por el usuario $user. Término de búsqueda: ''. Categoría: 1";
        log_past($log, "Productos", "Busqueda");
    } else {
      
        $consulta = "SELECT * FROM productos INNER JOIN Categoria ON productos.id_categoria = Categoria.id_categoria WHERE nombre LIKE '%$buscar%' OR precioVenta LIKE '%$buscar%' GROUP BY productos.id";

        $log = "Se realizó una búsqueda por el usuario $user. Término de búsqueda: '$buscar'. Categoría: 1";
        log_past($log, "Productos", "Busqueda");
    }

    $registrocli = $obj->Ejecutar_Instruccion($consulta);
} else {
   
  $consulta = "SELECT * FROM productos INNER JOIN Categoria ON productos.id_categoria = Categoria.id_categoria GROUP BY productos.id";
    $registrocli = $obj->Ejecutar_Instruccion($consulta);
}
?>





<html lang="en">
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
  <link rel="shortcut icon" href="images/iconopeli.png" type="">

  <title> CineMarte </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

<script type="text/javascript">
  function Eliminar(id) 
  {
    if (confirm("¿Esta seguro de que desea eliminar el producto?")) 
    {
      window.location = "listado productos.php?ideliminar=" + id;
    }
    return false;
  }
</script>

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
           <img class="img-responsive" style="width: 160px; height: 60px;" src="images/logo_small.png">
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
              <a class="dropdown-item" href="productosinsert.php">Registrar</a>
              <a class="dropdown-item" href="listado productos.php">Listado</a>
              </div>
              </li> 
            </ul>
            <div class="user_option">
              <a href="" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a class="cart_link" href="carrito/vender.php">
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

  <!-- food section -->

  <section class="caviar-regular-page section-padding-100" style="background-color: #FFFFFF;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="regular-page-content">
                <div class="post-title">
                    <h2 style="text-align: center; color: #000000;">Listado de productos</h2>
                    <center>
                        <form id="frmbuscar" method="post" action="listado_productos.php">
                            <div class="table-responsive">
                                <input type="search" name="txtbuscar" placeholder="Buscar" id="txtbuscar">
                                <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar">
                            </div>
                        </form>
                    </center>
                    <br>
                    <table class="table table-bordered table-hover" style="background-color: #FFFFFF;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="color: #000000;">Nombre</th>
                                <th scope="col" style="color: #000000;">Descripción</th>
                                <th scope="col" style="color: #000000;">Categoría</th>
                                <th scope="col" style="color: #000000;">Precio</th>
                                <th scope="col" style="color: #000000;">Imagen</th>
                                <th scope="col" style="color: #000000;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registrocli as $renglon) { ?>
                            <tr>
                                <td><?php echo $renglon[1]; ?></td>
                                <td><?php echo $renglon[2]; ?></td>
                                <td><?php echo $renglon[9]; ?></td>
                                <td><?php echo $renglon[3]; ?></td>
                                <td><img src="data:image/jpg;base64,<?php echo base64_encode($renglon[7]); ?>"
                                        width="200" height="150" alt=""></td>
                                <td class='text-center'>
                                    <div class="row">
                                        <div class="col">
                                            <a href="productosmodif.php?idmodificar4=<?php echo $renglon[0]; ?>"><img
                                                    src="images/icons/editar.png" style="width: 30px;"> </a>
                                        </div>
                                        <div class="col">
                                            <a href="JavaScript: Eliminar(<?php echo $renglon[0]; ?>)"><img
                                                    src="images/icons/eliminar.png" style="width: 30px;"> </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form action="index.php" style="text-align: center;">
                        <input type="submit" value="Regresar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




  <!-- end food section -->

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
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>