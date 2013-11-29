$(document).ready(function() {
  
    /*
    * 
    * PRINT JPGS
    * 1-a url do jpg a imprimir deve ser colocada no atributo "datasrc" da tag a
    * 2-deve conter class "print"
    * ex: <a href="javascript:;" class="print" datasrc="a_url_do_jpg" title="seu_titulo">
    * 
    */
   $('a[class*="print"]').click(function() {
      //alert($(this).attr('datasrc'));
      if (navigator.appName != 'Microsoft Internet Explorer'){
        newPage = window.open();
        newPage.document.write("<div><img src='"+$(this).attr('datasrc')+"' style='width:95%;'></div>");
        newPage.window.print();
        newPage.window.close();
        return false;
      }
    });
  
  //bug do responsive carousel que nao reconhece link
  $('#carrossel-p a, #carrossel-i a').click(function(){
    where = $(this).attr('href');
    window.location.assign(where);
  });
  
  //menu principal home
  var url = window.location;
  var urlString = url.toString();
  var urlArray = urlString.split("/");
  var field = urlArray.length -1;
  
  var w_default = 62;
  
  //botao inicial da tela aberto
  for(var i=0; i<urlArray.length; i++){
    if(urlArray[i].indexOf("jogos")!=-1 || urlArray[i].indexOf("videos")!=-1 || urlArray[i].indexOf("atividades")!=-1 || urlArray[i].indexOf("personagens")!=-1){
      var urlElement = urlArray[i];
      $(".btn-"+urlElement+" .fundo").show();
      $(".btn-"+urlElement+" .borda").show();
      
      $(".btn-"+urlElement).animate({
        width:$(".btn-"+urlElement).attr("data-width")
      }, $(".btn-"+urlElement).attr("data-time"));
      
      $(".btn-"+urlElement+" .fundo").animate({
        width:$(".btn-"+urlElement).attr("data-width")
      }, $(".btn-"+urlElement).attr("data-time"));
    }
  }
  //botao inicial da tela aberto
  
  //menu principal
  $('.header-bar ul li').not($(".btn-"+urlElement)).mouseenter(function() {
    var el = $("." + $(this).attr("class") + " .fundo");
    var elBorda = $("." + $(this).attr("class") + " .borda");
    var w_time = $(this).attr("data-time");
    var w_button = $(this).attr("data-width");
    
    el.stop();
    $(this).stop();
    
    el.show();
    elBorda.show();
    $(this).animate({
      width: w_button
    }, w_time);
    el.animate({
      width:  w_button
    }, w_time);
  });
  
  $('.header-bar ul li').not($(".btn-"+urlElement)).mouseleave(function() {
    var el = $("." + $(this).attr("class") + " .fundo");
    var elBorda = $("." + $(this).attr("class") + " .borda");
    var w_back = $(this).attr("data-back")
    
    $(this).stop();
    el.stop();
    
    $(this).animate({
      width: w_default
    }, w_back);
    el.animate({
      width: w_default
    }, w_back, function(){
      if(el.width() == w_default){
        el.hide();
        elBorda.hide();
      }
    });
  });
  //menu principal  

  //menu personagens tablet
  $('.icone-cuidadores-abrir').click(function() {
    $('.pais .filtro-personagem').stop().slideToggle('slow');
    $(".icone-cuidadores-abrir").toggleClass("ativo");
  });
  
  //aba para os pais
  $('.pais .icone-cuidadores-abrir').click(function() {
    $('.pais .content').stop().slideToggle('slow');
    $(".pais .icone-cuidadores-abrir").toggleClass("inativo");
    $(".pais .icone-cuidadores-fechar").toggleClass("ativo");
    $('.linha').show();
    $('.redes').fadeIn();
  });
  
  $('.pais .icone-cuidadores-fechar').click(function() {
    $('.pais .content').stop().slideToggle('fast');
    $(".pais .icone-cuidadores-abrir").toggleClass("inativo");
    $('.linha, .pais .redes').hide();
    if($('.icone-cat-abrir').hasClass('icone-cat-fechar')){
      $('.icone-cat-abrir').toggleClass('icone-cat-fechar');  
    }
    
  });
  
  $('.icone-cat-abrir, .dropdown-toggle').click(function(){
    $(this).toggleClass('icone-cat-fechar');
  });
  //menu personagens tablet
  
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
      
});//document.ready

//impressao no ie com close ativado
if (navigator.appName == 'Microsoft Internet Explorer'){
  function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=document.getElementById(divId).innerHTML;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
  }
}