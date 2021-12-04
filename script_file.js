function pulsanti () {
  $('#btn_home').click(function(){
    window.open("index.php","_self");
  });
  
  $('#btn_file_xml').click(function(){    
    window.open("page_menu1.php","_self");
  });
  
  $('#btn_file_no_xml').click(function(){
    window.open("page_menu2.php","_self");
  });

  $('#btn_scadenze').click(function(){
    window.open("page_menu3.php","_self");
  });

  $('#btn_pagamenti').click(function(){
    window.open("page_menu4.php","_self");
  });

  $('#btn_test').click(function(){
    window.open("test.php","_self");
  });

};

function sc_index (){
  $("#btn_home").addClass("active");
}

function sc_menu1 (){
  $("#btn_file_xml").addClass("active");

  // $("#tbl_xml").hide();
  // $("#btn_table_xml").click(function(){
  //   $("#tbl_xml").toggle();
  // });

  // $("#dati_generali").hide();
  // $("#btn_view_dati_generali").click(function(){
    // $("#dati_generali").toggle();
  // });

  // $(".scadenze").hide();
  // $("#btn_view_scadenze").click(function(){
  //   $(".scadenze").toggle();
  // });

  // $(".ritenute").hide();
  // $("#btn_view_ritenute").click(function(){
  //   $(".ritenute").toggle();
  // });

  // $(".beniservizi").hide();
  // $("#btn_view_beniservizi").click(function(){
  //   $(".beniservizi").toggle();
  // });

  $("#btn_new_file").click(function(){
    window.location.reload(ture);
  });
}

function sc_menu2 (){
  $("#btn_file_no_xml").addClass("active");
}

function sc_menu3 (){
  $("#btn_scadenze").addClass("active");
}

function sc_menu4 (){
  $("#btn_pagamenti").addClass("active");
}

function sc_test (){
  $("#btn_test").addClass("active");
}

