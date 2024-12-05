<?php  
session_start();
error_reporting(1);
require 'log.php';
require 'bd/conexion_bd.php';
$obj = new BD_PDO();

$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

if(isset($_POST["btnregistrar"])){
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));


 $obj->Ejecutar_Instruccion("
  INSERT INTO `productos`( `nombre`, `descripcion`, `existencia`, `precioVenta`, `id_categoria`, `imagen`) 
  VALUES('".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['existencia']."','".$_POST['precioVenta']."','".$_POST['idcategoria']."','$imgContenido')");

        $log = "Se creó un nuevo producto ('".$_POST['nombre']."') por el usuario $user. Categoría: 1";
        log_past($log, "Productos", "Inserción");
        
        if($insertar){
           
  echo "<script>
                alert('Reintente nuevamente');
                window.location= 'productosinsert.php'
                </script>";
        }else{
            
  echo "<script>
                alert('Registro correcto');
                window.location= 'menu.php'
                </script>";
        } 
        // Sie el usuario no selecciona ninguna imagen
    }else{
        
  echo "<script>
                alert('Seleccione imagen a subir');
                window.location= 'productosinsert.php'
                </script>";
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
  <link rel="shortcut icon" href="images/logo_small_icon_only_inverted(1).png" type="">

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

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
    <script type="text/javascript">
    function solonumeros(e){
      key=e.keycode || e.which;
      //almacena la entrada del teclado

      teclado=String.fromCharCode(key);

      numeros="0123456789.";

      especiales="8-37-38-46";
      //(array) posicion de teclas

      teclado_especial=false;

      for(var i in especiales)
      {
        if(key==especiales[i])
        {
          teclado_especial=true;
        }
        break;
      }
      if(numeros.indexOf(teclado)==-1 && !teclado_especial)
      {
         alert ("Favor de ingresar solo numeros")
        return false;
      }
    }
  </script>
  <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales)
       {
            if(key == especiales[i])
            {
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial)
        { 
          alert ("Favor de ingresar solo letras")
            return false;
        }
    }
</script>
<script type="text/javascript">
function alfa(e) 
{
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) 
    {
        return true;

    }
    // Patron de entrada, en este caso solo acepta numeros y letras y caracteres que puse..
    patron = /[A-Za-zx]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
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
              <a class="dropdown-item" href="productosmodif.php">Registrar</a>
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

  <section class="food_section layout_padding">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="regular-page-content">
                <div class="post-title">
                    <div class="miDiv">
                        <h2 style="text-align: center;">Ingrese los datos del producto a registrar</h2>
                    </div>
                </div>
                <form method="POST" id="formregistrar" enctype="multipart/form-data" action="productosinsert.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="miDiv">
                                <div class="form-group">
                                    <label class="form-control-label" for="Nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" title="Completa los siguientes datos" class="form-control form-control-alternative" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control form-control-alternative" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Precio</label>
                                <input type="text" id="precioVenta" name="precioVenta" class="form-control form-control-alternative" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Cantidad o existencia</label>
                                <input type="text" id="existencia" name="existencia" class="form-control form-control-alternative" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <select required id="idcategoria" name="idcategoria" class="form-control form-control-alternative">
                                <option>Seleccione la categoría</option>
                                <?php
                                $fk_categoria = $obj->Ejecutar_Instruccion("SELECT * FROM `categoria`");

                                foreach ($fk_categoria as $ligas) {
                                    $id_liga = $ligas[0];
                                    $nombreliga = $ligas[1];
                                ?>
                                    <option value="<?php echo $id_liga ?>"><?php echo $nombreliga; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <br>
                            <input type="file" class="form-control" required id="image" name="image">
                            <br>
                        </div>
                        <div class="col-lg-12" style="text-align: center;">
                            <input type="submit" id="btnregistrar" name="btnregistrar" value="Registrar" class="btn btn-primary">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
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