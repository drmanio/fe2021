// script che vengono eseguiti alla pressione dei pulsanti
function pulsanti () {
  // visualizza/nasconde la sidebar e adatta il margine sinistro della pagina di conseguenza
  $('#btn_sidenav').click(function(){
    var x = document.getElementById("div_sidenav");
    var y = document.getElementById("v-pills-tabContent");
    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.marginLeft="165";
    } else {
      x.style.display = "none";
      y.style.marginLeft="10";
    }
  });

  

  // apre la pagina index
  $('#btn_home').click(function(){
    window.open("index.php","_self");
  });
  
  // apre la pagina page_menu1
  $('#btn_file_xml').click(function(){    
    window.open("page_menu1.php","_self");
  });
  
  // apre la pagina page_menu2
  $('#btn_file_no_xml').click(function(){
    window.open("page_menu2.php","_self");
  });

  // apre la pagina page_menu3
  $('#btn_page_menu3').click(function(){
    window.open("page_menu3.php","_self");
  });

  // apre la pagina page_menu4
  $('#btn_pagamenti').click(function(){
    window.open("page_menu4.php","_self");
  });

  // apre la pagina page_menu5
  $('#btn_pagamenti_sc').click(function(){
    window.open("page_menu5.php","_self");
  });

  // apre la pagina test
  $('#btn_test').click(function(){
    window.open("test.html","_self");
  });

};

function sc_index (){
  $("#btn_home").addClass("active");
}

// script attivati dalla pressione del tasto di scelta menu1
function sc_menu1 (){
  // aggiunge la class active al button premuto per evidenziarlo
  // $("#btn_file_xml").addClass("active");
}

function sc_menu2 (){
  $("#btn_file_no_xml").addClass("active");
}

function sc_menu3 (){
  // $("#btn_scadenze").addClass("active");
}

function sc_menu4 (){
  // $("#btn_pagamenti").addClass("active");
}

function sc_test (){
  $("#btn_test").addClass("active");
}

