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
  $('#btn_test').click(function(){
    window.open("test.php","_self");
  });
};

function sc_index (){
  $("#btn_home").addClass("active");
}

function sc_menu1 (){
  $("#btn_file_xml").addClass("active");
}

function sc_menu2 (){
  $("#btn_file_no_xml").addClass("active");
}

function sc_test (){
  $("#btn_test").addClass("active");
}

