<html>
    <head>
        <!-- CSS -->
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <!-- JS -->
        <script src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        <script src="jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function(){
                $('a').click(function(){
                    $('a').removeClass("nav-link active").addClass("nav-link");
                    $(this).addClass("nav-link active");
                });
                $('#file_xml').click(function(){
                  $("#Pagina").html="";
                  $("#Pagina").load("pages.html #xml");
                });
                $('#file_no_xml').click(function(){
                  $("#Pagina").html="";
                  $("#Pagina").load("pages.html #noxml");
                });
            });
        </script>
    </head>
    <body>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
              <a id="file_xml" class="nav-link" aria-current="page" href="#">File xml</a>
            </li>
            <li class="nav-item">
              <a id="file_no_xml" class="nav-link" href="#">Documento non xml</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
          <div id="Pagina"></div>
    </body>
</html>