
<link rel="stylesheet" href="http://cmais.com.br/portal/js/layer-slider/model06/jquery.layerSlider.css">
<link rel="stylesheet" href="http://cmais.com.br/portal/js/layer-slider/model06/main.css">

<link type="text/css" rel="stylesheet" href="http://cmais.com.br/portal/js/responsive-carousel/style-vilasesamo.css"/>
<link rel="stylesheet" href="http://cmais.com.br/portal/css/tvcultura/sites/vilasesamo2/home.css" type="text/css" />


<div id="content">

  <?php include_partial_from_folder('sites/vilasesamo2', 'global/menuprincipal', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)); ?>
  <?php include_partial_from_folder('sites/vilasesamo2', 'global/bannerprincipal'); ?>
  <?php include_partial_from_folder('sites/vilasesamo2', 'global/bannerprincipalmobile'); ?> 


  <!--carrossel personagens-->
  <?php include_partial_from_folder('sites/vilasesamo2', 'global/menupersonagens', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section));?>
  <!--carrossel personagens-->

  <!-- link seções -->
  <section class="bgtotal">
    <span class="divisa1"></span>
    <div class="destaques row-fluid container">
      <section class="span8">
        <article class="span6 jogo">
          <a href="/vilasesamo2/jogos" title="Jogo">
            <i class="sprite-icon-jogos-peq"></i>Jogos
            
          </a>
          <a href="/vilasesamo2/jogos" class="img" ><img src="http://cmais.com.br/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="Jogos" /></a> 
          <a class="asset" href="/vilasesamo2/jogos-interna" title="Jogos">Nome do Jogo</a>  
        </article>
        <article class="span6 video">
          <a href="/vilasesamo2/clipes" title="Vídeos">
            <i class="sprite-icon-videos-peq"></i>Vídeos
            
          </a>
          <a href="/vilasesamo2/clipes" class="img"><img src="http://cmais.com.br/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="Clipes" /></a> 
          <a class="asset" href="/vilasesamo2/videos-interna" title="Clipes">Nome do Video</a>      
        </article>
        <article class="span6 atividade">
          <a href="/vilasesamo2/atividades" title="Atividades">
            <i class="sprite-icon-atividades-peq"></i>atividades
            
          </a> 
          <a href="/vilasesamo2/atividades" class="img" ><img src="http://cmais.com.br/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="Atividades" /></a>
          <a class="asset" href="/vilasesamo2/atividades-interna" title="Para Colorir">Nome da atividade</a>       
        </article>
      
      </sect0ion>
      <div class="span4 banner" >
        <a href="#" title="Incluir Brincando" class="sprite-btn-incluir"></a>
        <a href="#" title="Hábitos para uma vida saudável" class="sprite-btn-habitos"></a>
        <a href="#" title="O que achou do novo site?" class="sprite-btn-contato"></a>
      </div>
    </div>
  </section>
  <!-- link seções -->
  
</div>

<!--scripts e css banner-->
<script type="text/javascript" src="http://cmais.com.br/portal/js/layer-slider/jQuery.layerSlider.js"></script>
<script src="http://cmais.com.br/portal/js/jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="http://cmais.com.br/portal/js/modernizr/modernizr.min.js"></script>
<script type="text/javascript" src="http://cmais.com.br/portal/js/hammer.min.js"></script>
<script type="text/javascript" src="http://cmais.com.br/portal/js/responsive-carousel/script.js"></script>

<script>
//verificação de tela


//carrossel personagens home
$('#carrossel-p').responsiveCarousel({
  arrowLeft: '.arrow-left span.personagens',
  arrowRight: '.arrow-right span.personagens',
  target:'#carrossel-p .slider-target',
  unitElement:'#carrossel-p .slider-target > li',
  mask:'#carrossel-p .slider-mask',
  easing:'linear',
  dragEvents:true,
  speed:200,
  slideSpeed:1000,
  responsiveUnitSize : function() {
    return 2;
  },
  step : -1
});

if(screen.width > 1024){
  $('#carrossel-p').mouseenter(function(){
    $('.arrow.personagem').fadeIn('fast');
  });
  
  $('#carrossel-mobile').mouseenter(function(){
    $('.arrow.destaque-mobile').fadeIn('fast');
  });
};
if(navigator.appName!='Microsoft Internet Explorer'){
  //carrossel personagens redraw pra tablet e celular home
  window.addEventListener('load', function() {
    $('.carrossel-p, #carrossel-mobile').responsiveCarousel('redraw');
    machineScreenSize();
  });
  window.addEventListener("orientationchange", function() {
    $('.carrossel-p, #carrossel-mobile').responsiveCarousel('redraw');
    machineScreenSize();
  }, false);
  window.addEventListener("resize", function() {
    $('.carrossel-p, #carrossel-mobile').responsiveCarousel('redraw');
    machineScreenSize();
  }, false);
  //carrossel personagens redraw pra tablet e celular home
}
/*
var alturaImg;
var alturaBox;
var altura;
$(".inner a img").each(function(i){
  if(i==0){
    $(this).attr("src", $(this).attr("src")).load(function() {
      alert('rodei load');
      alturaImg = this.height;
      alturaBox = $('.inner').height();
      altura = alturaBox - alturaImg;
    });
  }
});
*/
$('.inner.personagens a').mouseenter(function(){
  $(this).find('img').animate({top:-70, easing:"swing"},'fast');
});
$('.inner.personagens a').mouseleave(function(){
  $(this).find('img').stop();
  $(this).find('img').animate({top:0, easing:"swing"},'fast');  
});

//carrossel personagens
function windowSize(){
  if(screen.width >= 640){
    $('#carrossel-destaque').css('display','block');
    $('#carrossel-destaque-mobile').css('display','none');
  }else{
    $('#carrossel-destaque').css('display','none');
    $('#carrossel-destaque-mobile').css('display','block');
  }
}
function machineScreenSize(){
  //alert(window.innerWidth);
  //alert(window.screen.width);
  var ua = navigator.userAgent.toLowerCase();
  //alert(ua);

  if(ua.indexOf("mobile") > -1 && (ua.indexOf("iphone") > -1 || ua.indexOf("android") > -1)) {
    //alert("Aplicar Versão Mobile");
    botoesPersonagensMobile();
    //Verificar Windows Phone
  }else{
    if(window.screen.width <= 640){
      //alert("Aplicar Versão Mobile");
      botoesPersonagensMobile();
      
    }else if(window.screen.width <= 1024){
      //alert("Aplicar Versão TABLET");
      botoesPersonagensTablet();
    }else{
      //alert("Aplicar Versão Desktop");

    }
  }
}
function botoesPersonagensMobile(){
  $('.inner.personagens a').each(function(i){
    $(this).find('img').delay(1000 + (i*400)).animate({top:-50},'fast');
  });
}

function botoesPersonagensTablet(){
  $('.inner.personagens a').each(function(i){
    $(this).find('img').delay(1000 + (i*400)).animate({top:60},'fast');
  });
}
</script>