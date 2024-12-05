<!DOCTYPE html>
<html>

<head>
    <!-- Conexión al archivo manifest -->
    <link rel="manifest" href="manifest.json" />

    <!-- Soporte para iOS -->
    <link rel="apple-touch-icon" sizes="72x72" href="images/logo_large(1).png" />
    <link rel="apple-touch-icon" sizes="96x96" href="images/logo_large(1).png" />
    <link rel="apple-touch-icon" sizes="128x128" href="images/logo_large(1).png" />
    <link rel="apple-touch-icon" sizes="192x192" href="images/logo_large(1).png" />
    <link rel="apple-touch-icon" sizes="512x512" href="images/logo_large(1).png" />

    <!-- Colores personalizados -->
    <meta name="apple-mobile-web-app-status-bar" content="#FFA500" />
    <meta name="theme-color" content="#FFA500" />

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

    <!-- Bootstrap and Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <title>CineMarte</title>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="assets/css/variables.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />

    <!-- Other Vendor CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Owl Carousel Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- jivosite widget -->
    <script src="//code.jivosite.com/widget/pZF4qOoR9w" async></script>

</head>

<body>
    <div class="container">
        <h1>Bienvenido a CineMarte</h1>
        <button id="enable-notifications" class="btn btn-primary">Habilitar Notificaciones</button>
        <div id="movie-list">
            <!-- Aquí se agregarán las películas -->
        </div>

        <form id="movie-form">
            <input type="text" id="movie-input" placeholder="Escribe el nombre de una película" required />
            <button type="submit" class="btn btn-success">Agregar Película</button>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        // Verificar si el navegador soporta Service Workers
        if ('serviceWorker' in navigator && location.protocol === 'https:') {
            navigator.serviceWorker.register('service-worker.js')
                .then(reg => {
                    console.log('Service Worker registrado:', reg);

                    // Después de registrar el Service Worker, intentar obtener la suscripción para Push Notifications
                    reg.pushManager.getSubscription()
                        .then((subscription) => {
                            if (!subscription) {
                                // Clave pública de FCM (asegúrate de reemplazar con la clave correcta)
                                const applicationServerKey = 'BOKcIx93kERD-d3-rB0nS-3tRSYxYmXzdeOWa8gH7EU5TvpDMW2gRg44IwrriSVe3LFwuS6UeOMDA0_Oiop0Pmg';

                                // Suscribir al cliente para Push Notifications
                                reg.pushManager.subscribe({
                                    userVisibleOnly: true,
                                    applicationServerKey: urlBase64ToUint8Array(applicationServerKey)
                                }).then((subscription) => {
                                    console.log('Suscripción Push:', subscription);
                                }).catch((error) => {
                                    console.error('Error al suscribirse a Push Notifications:', error);
                                });
                            }
                        })
                        .catch((error) => {
                            console.error('Error al obtener suscripción:', error);
                        });
                })
                .catch((error) => {
                    console.error('Error al registrar el Service Worker:', error);
                });
        } else {
            console.error('Service Workers no son soportados en este navegador.');
        }

        // Convertir la clave base64 a Uint8Array (para la suscripción de Push Notifications)
        function urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
            const rawData = window.atob(base64);
            const outputArray = new Uint8Array(rawData.length);
            for (let i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        }

        // Manejo de la interfaz de películas
        document.getElementById('movie-form').addEventListener('submit', (event) => {
            event.preventDefault();

            const movieInput = document.getElementById('movie-input');
            const movie = movieInput.value;

            if (movie) {
                // Agregar película a la lista
                const movieList = document.getElementById('movie-list');
                const listItem = document.createElement('li');
                listItem.textContent = movie;
                movieList.appendChild(listItem);

                // Limpiar campo de entrada
                movieInput.value = '';

                // Mostrar alerta
                alert('¡Película agregada a la lista!');

                // Verificar si el navegador soporta notificaciones
                if ('Notification' in window) {
                    if (Notification.permission === 'granted') {
                        // Si ya se tiene permiso, muestra una notificación
                        new Notification('Nueva película agregada', { body: movie });
                    } else if (Notification.permission !== 'denied') {
                        // Si no se ha dado permiso, lo solicitamos
                        Notification.requestPermission().then((permission) => {
                            if (permission === 'granted') {
                                new Notification('Nueva película agregada', { body: movie });
                            }
                        });
                    }
                }
            }
        });

        // Función para habilitar las notificaciones push
        document.getElementById('enable-notifications').addEventListener('click', () => {
            if ('Notification' in window) {
                // Verificar si el permiso ya ha sido concedido
                if (Notification.permission === 'granted') {
                    alert('Las notificaciones ya están habilitadas.');
                } else {
                    // Solicitar permiso para mostrar notificaciones
                    Notification.requestPermission().then(permission => {
                        if (permission === 'granted') {
                            alert('Notificaciones habilitadas.');
                        } else {
                            alert('No se han habilitado las notificaciones.');
                        }
                    });
                }
            } else {
                alert('Este navegador no soporta notificaciones.');
            }
        });
    </script>
</body>

<!-- Modal de Iniciar Sesión -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: black;margin-top: 150px;">
            <div class="modal-header" style="padding-bottom: 2px;">
                <h4 class="login100-form-title" style="margin-left: 160px; margin-bottom: 2px; color: #FFA500;">Iniciar Sesión</h4>
                <button type="button" style="background-color: #FFA500; border-radius: 10px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="left: 80px;">
                <form id="login-form" role="form" method="post" action="controlador.php" class="login100-form validate-form">        
                    <div class="wrap-input100 validate-input" data-validate="Correo invalido, ejemplo: ex@abc.xyz">
                        <input class="input100" type="text" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" name="correo" id="correo" placeholder="Correo" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br>
                    <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                        <input class="input100" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required="" >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="iniciar" id="iniciar" style="background-color: #FFA500; margin-left: 110px;">
                            <h6 style="color: black;">Entrar</h6>
                        </button>
                        <a href="recuperar_contrasena.php" style="color: #FFA500;">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="width: 300px; margin-top: 18px;">
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro -->
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: black;margin-top: 150px;">
            <div class="modal-header" style="padding-bottom: 2px;">
                <h4 class="login100-form-title" style="margin-left: 180px;margin-bottom: 2px;color:#FFA500">Registrarse</h4>
                <button type="button" class="close" style="background-color: #FFA500; border-radius:10px" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="left:80px;">
                <form id="register-form" role="form" method="post" action="controlador.php" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input" data-validate="Correo invalido, ejemplo: ex@abc.xyz">
                        <input class="input100" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" type="email" name="correo" id="correo" onkeypress="return alfanumerico(event)"  required="" placeholder="Correo">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br> 
                    <div class="wrap-input100 validate-input" data-validate="Contraseña requerida">
                        <input class="input100" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required="" maxlength="8" >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br>
                    <div class="wrap-input100 validate-input" data-validate="Pregunta de seguridad requerida">
                        <input class="input100" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" type="text" name="pregunta" id="pregunta" placeholder="Pregunta de seguridad" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br>
                    <div class="wrap-input100 validate-input" data-validate="Respuesta de seguridad requerida">
                        <input class="input100" style="border: none; outline: none; border-bottom: 1px solid; margin-left: 58px; text-align: center; border-radius: 5px;" type="text" name="respuesta" id="respuesta" placeholder="Respuesta de seguridad" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-commenting" aria-hidden="true"></i>
                        </span>
                    </div>
                    <br>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="btnregistrar" id="btnregistrar" style="background-color: #FFA500; margin-left: 110px;">
                            <h6 style="color: black;">Registrarse</h6>
                        </button> 
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="width: 300px; margin-left: 110px" >
                <br>
            </div>
        </div>
    </div>
</div>
<body>
<style>
  h4, h5, h6, span {font-family: "Comic Sans MS", "Comic Sans", cursive; /* Aplica la fuente Comic Sans al elemento p */}

  h3 {font-family: "Comic Sans MS", "Comic Sans", cursive; /* Aplica la fuente Comic Sans al elemento p */}
    
  h2 {
    font-family: "Comic Sans MS", "Comic Sans", cursive; /* Aplica la fuente Comic Sans al elemento p */
  }
  h1 {font-family: "Comic Sans MS", "Comic Sans", cursive; /* Aplica la fuente Comic Sans al elemento p */}
  
    p {
        font-family: "Comic Sans MS", "Comic Sans", cursive; /* Aplica la fuente Comic Sans al elemento p */
    }
</style>

<div class="hero_area">
  <div class="bg-box">
    <img src="images/pexels-tima-miroshnichenko-7991303.jpg" alt="Fondo cinematográfico">
  </div>
  <!-- header section starts -->
  <header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a href="index.php">
          <img class="img-responsive" style="width: 160px; height: 60px;" src="images/icons/logo_small.png" alt="Logo Cinemarte">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span> </span>
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
            <li class="nav-item"><a class="nav-link" href="#miModal" data-toggle="modal" data-target="#myModal2" style="font-family: Arial, Helvetica, sans-serif;">Registrarse</a></li>
            <li class="nav-item"><a class="nav-link" href="#miModal" data-toggle="modal" data-target="#myModal" style="font-family: Arial, Helvetica, sans-serif;">Iniciar Sesión</a></li>
          </ul>
          <div class="user_option">
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
  <section class="slider_section">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-lg-6">
                <div class="detail-box">
                  <div class="miDiv">
                    <h1>El mejor lugar para disfrutar tus peliculas.</h1>
                    <p>Estas visitando el lugar ideal para gozar de tus peliculas favoritas, adquierelas y disfrutalas en el momento que desees.</p>
                    <div class="btn-box">
                      <a href="" class="btn1">Ordena Ahora</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-lg-6">
                <div class="detail-box">
                  <div class="miDiv">
                    <h1>Amplio catalogo</h1>
                    <p>Contamos con un extenso repertorio de peliculas, desde Acción hasta Dramas, puedes adquirirlas en el momento que desees.</p>
                    <div class="btn-box">
                      <a href="" class="btn1">Ordena Ahora</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-lg-6">
                <div class="detail-box">
                  <div class="miDiv">
                    <h1>Facil y rápido</h1>
                    <p>Estas a solo un par de clicks de disfrutar de tus cintas favoritas en cualquier momento, ¿Qué esperas?, ¡Ordena ya!</p>
                    <div class="btn-box">
                      <a href="" class="btn1">Ordena Ahora</a>
                    </div>
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

  <!-- offer section -->
  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="box">
              <div class="img-box">
                <img src="images/justiceleague.jpg" alt="Oferta Justice League">
              </div>
              <div class="detail-box">
                <div class="miDiv">
                  <h5>Oferta del día</h5>
                  <h6><span>25%</span> Off</h6>
                  <button type="submit" name="codigo" id="codigo" class="btn btn-default" style="background-color: #ffbe33;border-radius: 45px; padding: 10px 30px;margin-bottom: 10px;margin-left: 65px;">
                    <i class="fa fa-shopping-cart fa-lg"></i> Ordena ahora
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box">
              <div class="img-box">
                <img src="images/nowayhome.jpg" alt="Oferta No Way Home">
              </div>
              <div class="detail-box">
                <div class="miDiv">
                  <h5>Oferta del día</h5>
                  <h6><span>15%</span> Off</h6>
                  <button type="submit" name="codigo" id="codigo" class="btn btn-default" style="background-color: #ffbe33;border-radius: 45px; padding: 10px 30px;margin-bottom: 10px;margin-left: 65px;">
                    <i class="fa fa-shopping-cart fa-lg"></i> Ordena ahora
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end offer section -->

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/iconopelicula.png" alt="Icono Cinemarte">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <div class="miDiv">
                <h2>Somos CineMarte</h2>
              </div>
              <p>Somos un sitio donde puedes adquirir de forma fácil y sencilla tus películas preferidas, desde esos clásicos hasta los estrenos más recientes. Quédate con nosotros y forma parte de la familia de CineMarte, tu página que te brinda diversión de aquí a Marte.</p>
              <a href="">Leer Más</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->
</div>


  <!-- end about section -->

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
      <div class="miDiv">
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
          <div class="miDiv">
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
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
          <div class="miDiv">
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
        </div>
        <div class="col-md-4 footer-col">
        <div class="miDiv">
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