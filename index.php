<html>
  <head>
      <!-- CSS -->
      <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
      <!-- JS -->
      <script src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
      <script src="jquery-3.6.0.min.js"></script>

      <script>
          $(document).ready(function(){
              $("#home").load("pages.html #homepage");
              $('#btn_home').click(function(){
                // $("#Pagina").html="";
                $("#home").load("pages.html #homepage");
              });
              $('#btn_file_xml').click(function(){
                // $("#menu1").html=("<p>MENU 1</P>");
                $("#menu1").load("pages.html #xml");
              });
              $('#btn_file_no_xml').click(function(){
                // $("#Pagina").html="";
                $("#menu2").load("pages.html #noxml");
              });
          });
      </script>
  </head>
  <body>
  <nav class="navbar fixed-top bg-light">
  <div class="container-fluid">
    <!-- Nav pills -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" Id="btn_home" data-bs-toggle="pill" href="#home"><img src="bootstrap-icons/house-fill.svg" alt="Home" height="25" width="32"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" Id="btn_file_xml" data-bs-toggle="pill" href="#menu1">File xml</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" Id="btn_file_no_xml" data-bs-toggle="pill" href="#menu2">Documento non xml</a>
      </li>
    </ul>
  </div>
  </nav>
    <!-- Tab panes -->
    <div class="tab-content container-fluid" style="margin-top:80px">
      <div class="tab-pane container active" id="home"></div>
      <div class="tab-pane container fade" id="menu1"></div>
      <div class="tab-pane container fade" id="menu2"></div>
    </div>
  </body>
</html>