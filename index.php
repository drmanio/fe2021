<html>
  <head>
      <!-- CSS -->
      <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
      <!-- JS -->
      <script src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
      <script src="jquery-3.6.0.min.js"></script>
      <script>
          $(document).ready(function(){
                        
              $('#btn_test').click(function(){
                $("#test").load("test.html");
              });
                          
          });
        </script>
      <!-- <script>
          $(document).ready(function(){
              // $("#home").load("page_home.html");
              $('#btn_home').click(function(){
                $("#home").load("page_home.html");
              });
              $('#btn_file_xml').click(function(){
                $("#menu1").load("page_menu1.html");
              });
              $('#btn_file_no_xml').click(function(){
                $("#menu2").load("page_menu2.html");
              });
          });
      </script> -->
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
      <li class="nav-item">
        <a class="nav-link" Id="btn_test" data-bs-toggle="pill" href="#test">Test</a>
      </li>
    </ul>
  </div>
  </nav>
    <!-- Tab panes -->
    <div class="tab-content container-fluid" style="margin-top:80px">
      <div class="tab-pane container active" id="home"><iframe src="page_home.html" height="100%" width="100%"></iframe></div>
      <div class="tab-pane container fade" id="menu1"><iframe src="page_menu1.php"height="100%" width="100%"></iframe></div>
      <div class="tab-pane container fade" id="menu2"><iframe src="page_menu2.html" height="100%" width="100%"></iframe></div>
      <div class="tab-pane container fade" id="test"></div>
    </div>
  </body>
</html>