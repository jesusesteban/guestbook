<?php

  mysql_connect("carbono", "root", "m0chu3lo")or die("cannot connect server ");
  mysql_select_db("tecnilogica_guestbook")or die("cannot select DB");

  $ent_nombre = mysql_real_escape_string($_POST["ent_nombre"]);
  $ent_comentarios = mysql_real_escape_string($_POST["ent_comentarios"]);

  $hasContent = $ent_nombre!='' && $ent_comentarios!='';

  if ($hasContent) {
    $sql="INSERT INTO entry(ent_nombre, ent_comentarios, ent_fecha)VALUES('$ent_nombre', '$ent_comentarios', now())";
    $result=mysql_query($sql);
  }

  $sql="SELECT ent_nombre, ent_comentarios FROM entry ORDER BY ent_fecha DESC LIMIT 10";
  $result=mysql_query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<html>

  <head>

    <title>Libro de visitas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <!-- TYPEKIT FONTS -->
    <script type="text/javascript" src="//use.typekit.net/twl1njp.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>    
    <!-- END TYPEKIT FONTS -->

  </head>

  <body>

    <div class="jumbotron">
      <div class="container">
        <div class="text">
          <h1>Libro de visitas</h1>
          <p>Gracias por acompañarnos en nuestros primeros diez años. Para recordar este momento, por al menos una década más, <span>déjanos un mensaje.</span></p>          
        </div>
        <div class="bg-logo"></div>
      </div>
    </div>
    
    <div class="container">

      <div class="row">
        <div class="col-lg-7">

          <?php while($rows=mysql_fetch_array($result)){ ?>
              <blockquote>
                <p><?= $rows["ent_comentarios"] ?></p>
                <small><?= $rows["ent_nombre"] ?></small>
              </blockquote>
          <?php } ?>

        </div>
        <div class="col-lg-5">
          <form role="form" method="POST" action="index.php">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre" name= "ent_nombre">
            </div>
            <div class="form-group">
              <label for="texto">Comentarios</label>
              <textarea class="form-control" id="texto" rows="6" name= "ent_comentarios"></textarea>
            </div>
            <button type="submit" class="btn btn-lg btn-primary send">Enviar</button>
          </form>
        </div>
      </div>
    </div> 

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>




