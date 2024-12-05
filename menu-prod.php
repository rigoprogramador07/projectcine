<?php require 'bd/conexion_bd.php';
$obj = new BD_PDO();
$regis = $obj ->Ejecutar_Instruccion("Select * from productos");

if(isset($_POST["btnregistrar"])){
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
      }
    }

 ?>


<!DOCTYPE html>
<html>
  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Catalogo
        </h2>
      </div>

     <ul class="filters_menu">
        <li class="active" data-filter="*">Todas</li>
        <li data-filter=".Accion">Accion</li>
        <li data-filter=".Drama">Drama</li>
        <li data-filter=".Comedia">Comedia</li>
        <li data-filter=".Terror">Terror</li>
      </ul>

      <div class="filters-content">
        <div class="row">
             <?php foreach ($regis as $renglon) {  ?>
           
           <div class="col-sm-4 col-lg-4 all pasta">
            <div class="box">
              <div>
                <div class="img-box">
                 <img src="data:image/jpg;base64,<?php echo base64_encode($renglon[7]);?>" alt="">
                  </div>
                   <div class="detail-box">
                        <h5>
                        <h3><?php echo $renglon[1];?></h3>
                        </h5>
                        <p><?php echo $renglon[2];?></p>
                      <div class="options">
                          <h6>
                          <h6 style="margin-right: 200px;"></h6>
                          </h6>
                     </div>
                  </div>
                     <div>
                      <form method="POST" action="carrito/agregarAlCarrito.php ">
<button type="submit" name="codigo" id="codigo" class="btn btn-default"value="<?php echo $renglon[1];?>" style="background-color: #ffbe33;border-radius: 45px; padding: 10px 30px;; margin-bottom: 10px; margin-left: 65px;">
<i class="fa fa-shopping-cart fa-lg"></i> Ordena ahora $<?php echo $renglon[3];?> </button>
                      </form>
                      </div>
              </div>
          </div>
        </div>
      <?php } ?>
            </div>
        </div>
                <div class="btn-box">
                  <a href="">
                    Ver mas
                  </a>
                </div>
  </section>