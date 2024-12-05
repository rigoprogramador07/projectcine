
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <title> CineMarte </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

   <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <link href="assets/css/variables.css" rel="stylesheet">

<!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
 <script src="//code.jivosite.com/widget/pZF4qOoR9w" async></script>

</head>
<body>
  

<div class="hero_area">
    <div class="bg-box">
        <img src="images/pexels-tima-miroshnichenko-7991303.jpg" alt="">
    </div>
    <!-- header section starts -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a href="index.php">
                    <img class="img-responsive" style="width: 160px; height: 60px;" src="images/logo_small.png">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
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
                        <?php if(isset($_SESSION['privilegio']) && $_SESSION['privilegio'] == "Admin"): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="productosinsert.php">Registrar</a>
                                <a class="dropdown-item" href="listado_productos.php">Listado</a>
                            </div>
                        </li>
                        <?php endif; ?> 
                    </ul>
                    <a href="salir.php" class="nav-item nav-link" style="color: white;">Cerrar Sesión</a>
                </div>
            </nav>
        </div>
    </header>
</div>

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
            <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      El mejor lugar para disfrutar tus peliculas.
                    </h1>
                    <p>
                     Estas visitando el lugar ideal para gozar de tus peliculas favoritas, adquierelas y disfrutalas en el momento que desees.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Ordena Ahora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Amplio catalogo
                    </h1>
                    <p>
                      Contamos con un extenso repertorio de peliculas, desde Accion hasta Dramas, puedes adquirirlas en el momento que desees.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        Ordena Ahora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Facil y rapido
                    </h1>
                    <p>
                       Estas a solo un par de clicks de disfrutar de tus cintas favoritas en cualquier momento, ¿Que esperas?, Ordena Ya!!
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                       Ordena Ahora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- offer section -->

  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="images/justiceleague.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Oferta del dia
                </h5>
                <h6>
                  <span>25%</span> Off
                </h6>
               <button type="submit" name="codigo" id="codigo" class="btn btn-default"value="" style="background-color: #ffbe33;border-radius: 45px; padding: 10px 30px;; margin-bottom: 10px; margin-left: 65px;">
<i class="fa fa-shopping-cart fa-lg"></i> Ordena ahora  </button>
              </div>
            </div>
          </div>
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="images/nowayhome.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Oferta del dia
                </h5>
                <h6>
                  <span>15%</span> Off
                </h6>
<button type="submit" name="codigo" id="codigo" class="btn btn-default"value="" style="background-color: #ffbe33;border-radius: 45px; padding: 10px 30px;; margin-bottom: 10px; margin-left: 65px;">
<i class="fa fa-shopping-cart fa-lg"></i> Ordena ahora  </button>
        
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end offer section -->

  <!-- food section -->

  <section class="food_section layout_padding-bottom">
    <?php require 'menu-prod.php'; ?>
  </section>

  <!-- end food section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/iconopelicula.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Somos CineMarte
              </h2>
            </div>
            <p>
              Somos un sitio donde puedes adquirir de una forma muy facil y sencilla tus peliculas preferidas, desde esas peliculas de antaño hasta los estrenos mas recientes, quedate con  nosotros y forma parte de la familia de CineMarte, tu pagina que te brinda diversion de aqui a Marte.
            </p>
            <a href="">
              Leer Mas
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
         Contactanos
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Nombre" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Numero de Telefono" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo Electronico" />
              </div>

              <div>
                <input type="date" class="form-control">
              </div>
              <div class="btn_box">
                <button>
                  Contactanos Ahora
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.909616465896!2d-100.61828208574127!3d28.57247668244153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865ff586598af941%3A0xf0e5df7612124b7d!2sUniversidad%20Tecnol%C3%B3gica%20del%20Norte%20de%20Coahuila!5e0!3m2!1ses-419!2smx!4v1663597151478!5m2!1ses-419!2smx" width="600" height="349"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fweb.facebook.com%2Fprofile.php%3Fid%3D100085515231198&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

  <iframe width="560" height="315" src="https://www.youtube.com/embed/E3FQ1i8LGUI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

  <!-- end book section -->

  <!-- client section -->

 
  <!-- end client section -->

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
                <a href="https://wa.me/528621235802?text=Hola, ¿en que podemos ayudarte?"id=100085515231198">
                  <img src="images/logowha.png" width="50" height="50">
                </a> <p>Whatsapp</p>
                <a href="https://web.facebook.com/profile.php?id=100085515231198">
                  <img src="images/facelogo.png" width="50" height="50">
                </a> <p>Facebook</p>
                <a href="tel: +528621235802">
                  <img src="images/logotel.png" width="50" height="50">
                </a> <p>Telefono</p>
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
                <i class="fa fa-facebook" aria-hidden="true" href="https://web.facebook.com/profile.php?id=100085515231198"></i>
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
     <!-- jQuery-2.2.4 js -->
     <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  <!-- End Google Map -->



</body>

</html>