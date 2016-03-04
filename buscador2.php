<?php
include("dll/config.php");
include("dll/clase.php");
$miconexion = new DB_mysql;
$miconexion->conectar($dbname, $dbhost, $dbuname, $dbpass);
extract($_POST);
extract($_GET);
?>
<!DOCTYPE html>
<html> 
  <head> 
     <title>Evaluar una variable que contiene notación JSON...</title> 
     <meta http-equiv="Content-Type" 
              content="text/html; charset=UTF-8">
     <script src="http://code.jquery.com/jquery-1.8.0.min.js" type="text/javascript"></script> 
     <link rel="stylesheet" type="text/css" href="css/estilos.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">

      <link rel="stylesheet" type="text/css" href="DataTables/media/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="DataTables/media/css/demo.css">
      <link rel="stylesheet" type="text/css" href="DataTables/extensions/Buttons/css/buttons.dataTables.css">


      <script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.js"></script>
      <script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" language="javascript" src="DataTables/media/js/dataTables.tableTools.js"></script>
      <script type="text/javascript" language="javascript" src="DataTables/extensions/Buttons/js/buttons.flash.js"></script>
      <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">     </script>
      <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">      </script>
      <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">      </script>
      <script type="text/javascript" language="javascript" src="DataTables/extensions/Buttons/js/buttons.html5.js">      </script>
      <script type="text/javascript" language="javascript" src="DataTables/extensions/Buttons/js/buttons.print.js">      </script>

      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>

 </head> 
 <body> 
 <header><h1><span class="icon-stats-dots"> </span>SSN | Stadistic Social Nerworks</h1></header>
  <nav class="menu-principal">
    <a href="buscador.php"><span class="icon-home"> </span>Home</a> |
    <a href="buscador.php"><span class="icon-accessibility"> </span>About as</a>
  </nav>
  <section class="contenedor2">
    <section id="texto" class="cont1"></section>
    <section id="texto2" class="cont2"></section>
    <section id="texto3" class="cont3"></section>
    <section id="texto4" class="cont4">
      <h2>Twilts del usuario</h2>
      <table id="example" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Tweet</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Retweet</th>
                        <th>Favoritos</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Tweet</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Retweet</th>
                        <th>Favoritos</th>
            </tr>
          </tfoot>
          <tbody>
            <span id="texto"></span>
          </tbody>
        </table>
    </section>
      <script type="text/javascript">
      $(document).ready(function(){
      var cad="<br><strong>Ultimos Posts</strong><br><br>";
      var cadena= $.getJSON("http://127.0.0.1/visualizacion/taller/gettwiter.php?usuario=<?php echo $usuario;?>&num=<?php echo $num;?>", function (data){
        for (var c = 1; c < data.length; c++) {
          cad +="<aside class='grupo-post'><aside class='grupo1'><img height='' width='30' src='"+data[c].user.profile_image_url_https+"'></aside>";
          cad +="<aside class='grupo2'><span class='icon-twitter listaw'> </span><strong>"+data[c].text+"</strong><br>";
          cad +=data[c].created_at+"<br>";
          //cad +="User:"+data[c].user.name+"<br>";
          cad +="Retweet:"+data[c].retweet_count+"<br>";
          cad +="Favoritos:"+data[c].favorite_count+"</aside></aside><hr>";
           $("#contenidoOculto").load("insertar.php?tf="+data[c].favorite_count+"&user="+data[c].user.screen_name+"&rt="+data[c].retweet_count+"&fecha="+encodeURIComponent(data[c].created_at)+"&nombre="+encodeURIComponent(data[c].text), function(){
           //$("#alerta").slideUp(1200);
           });

        }
        $("#texto").html(cad);
      });

      var cad2="<br><strong>Top Posts</strong><br><br>";
      var cadena2= $.getJSON("http://127.0.0.1/visualizacion/taller/gettwiter2.php?usuario=<?php echo $usuario;?>", function (data2){
        for (var x = 0; x < data2.statuses.length; x++) {
          cad2 +=" <span class='icon-twitter listaw'> </span><strong>"+data2.statuses[x].text+"</strong><br>";
          cad2 +=data2.statuses[x].created_at+"<br>";
          cad2 +="<strong>Retweet: </strong>"+data2.statuses[x].retweet_count+"<br>";
          cad2 +="<strong>Favoritos: </strong>"+data2.statuses[x].favorite_count+"<hr>";
        }
        $("#texto2").html(cad2);
      })

      var cad3="<br><strong>Favorites Posts</strong><br><br>";
      var cadena3= $.getJSON("http://127.0.0.1/visualizacion/taller/gettwiter3.php?usuario=<?php echo $usuario;?>&num=<?php echo $num;?>", function (data3){
        for (var y = 0; y < data3.length; y++) {
          cad3 +="<aside class='grupo-post'><aside class='grupo1'><img height='' width='30' src='"+data3[y].user.profile_image_url_https+"''></aside>";
          cad3 +=" <span class='icon-twitter listaw'> </span><strong>"+data3[y].text+"</strong><br>";
          cad3 +=data3[y].created_at+"<br>";
          cad3 +="<strong>Retweet: </strong>"+data3[y].retweet_count+"<br>";
          cad3 +="<strong>Favoritos: </strong>"+data3[y].favorite_count+"<hr><br>";
        }
        $("#texto3").html(cad3);
      })
      /////////////////////////////////////////

      $('#example').DataTable( {
              "dom": 'T<"clear">lfrtip',
              "tableTools": {
                  "sSwfPath": "DataTables/extensions/Buttons/swf/flashExport.swf",
                  "aButtons": [
                      "copy",
                      "csv",
                      {
                          "sExtends": "xls",
                          "sFileName": "*.xls",
                          "sPdfOrientation": "landscape",
                          "sPdfMessage": "Your custom message would go here.",
                      },
                      "print"
                  ]
              },
              "ajax": {
                "url": "http://127.0.0.1/visualizacion/taller/gettwiter.php?usuario=<?php echo $usuario;?>&num=<?php echo $num;?>",
                "dataSrc": ""
              },
              "columns": [
                    { "data": "text" },
                    { "data": "created_at" },
                    { "data": "user.name" },
                    { "data": "retweet_count" },
                    { "data": "favorite_count" }
              ]
            } );

          //$( "#container" ).load():

    });
  </script>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"><a href="grafica.php?usuario=<?php echo $usuario; ?>" target="_blank"><span class="icon-stats-dots"> </span>Ver grafica</a></div>
  </section>
  <footer>
    <h6>  
    <section id="contenidoOculto">
      
    </section>
    <span class="icon-users"> </span>Derechos Reservados #kruskaya #rlramirez<br> UTPL 2016<br>
    <span class="icon-google-plus2"> </span><span class="icon-facebook"> </span><span class="icon-instagram"> </span><span class="icon-twitter"> </span><span class="icon-youtube"> </span><span class="icon-flickr"> </span><span class="icon-github"> </span><span class="icon-wordpress"> </span>
    </h6> 
  </footer>
 
 
    </body> 
</html>