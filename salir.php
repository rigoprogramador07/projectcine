<?php 

session_start();
session_destroy(); 
echo "<script>
                alert('Hasta luego ".$_SESSION['']."');
                window.location= 'index.php'
    </script>"
 ?>