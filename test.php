<html>
  <head>

    <?php
    include "header.html";
    include "navbar.html";
    ?>

    <!-- EVIDENZIO IL PULSANTE HOME MODIFICANDO LA CLASSE AGGANCIATA ALL'ELEMENTO a (viene caricato con il file navbar.html) CON id="btn_file_xml" -->
    <script>
      $(document).ready(function(){
          pulsanti();
          sc_test();
      });
    </script>

<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

<link rel="stylesheet" href="sidebar.css" type="text/css">
<link rel="stylesheet" href="mytable.css" type="text/css">

  </head>
  <body>

    
  
    
  <div class="offcanvas offcanvas-start" id="demo">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Heading</h1>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas">A Button</button>
  </div>
</div>



<!-- MY TABLE -->
<nav class="mynavbar">
  <!-- <a href="">Insert Brand / Logo</a> -->
</nav>
<section class="content-area">
  <div class="mytable-area">
    <table class="myresponsive-table table">
      <thead>
        <tr>
          <th><input type="checkbox"> First name</th>
          <th>Last name</th>
          <th>Points</th>
          <th>Content</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="checkbox">  Jill</td>
          <td>Smith</td>
          <td>50</td>
          <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </td>
        </tr>
        <tr>
          <td><input type="checkbox">  Eve</td>
          <td>Jackson</td>
          <td>94</td>
          <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
        </tr>
        <tr>
          <td><input type="checkbox">  Jill</td>
          <td>Smith</td>
          <td>50</td>
          <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </td>
        </tr>
        <tr>
          <td><input type="checkbox">  Eve</td>
          <td>Jackson</td>
          <td>94</td>
          <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
        </tr>
        <tr>
          <td><input type="checkbox">  Jill</td>
          <td>Smith</td>
          <td>50</td>
          <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </td>
        </tr>
        <tr>
          <td><input type="checkbox">  Eve</td>
          <td>Jackson</td>
          <td>94</td>
          <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
        </tr>
        <tr>
          <td><input type="checkbox">  Jill</td>
          <td>Smith</td>
          <td>50</td>
          <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </td>
        </tr>
        <tr>
          <td><input type="checkbox">  Eve</td>
          <td>Jackson</td>
          <td>94</td>
          <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
        </tr>
 
      </tbody>
    </table>
  </div>
</section>
           
  
  </body>
</html>