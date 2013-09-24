<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 8]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" href="/portal/css/tvcultura/sites/vilasesamo2/internas.css" type="text/css" />
<script>
  $("body").addClass("interna personagens");
</script>

<!-- HEADER -->
<?php include_partial_from_folder('sites/vilasesamo2', 'global/menuprincipal', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>
<!-- /HEADER -->
<div id="content">
  <section class="filtro row-fluid">
    <div class="span12">
      <?php
        include_partial_from_folder('sites/vilasesamo2', 'global/mobile_detect'); 
        $detect = new Mobile_Detect(); 
        if ($detect->isTablet() || $detect->isMobile()) {
            // Any tablet device.
      ?> 
         <!--script--> 
         <script type="text/javascript" src="/portal/js/smint/jquery.smint.js"></script>  
         <script type="text/javascript" src="/portal/js/superscrollorama/greensock/TweenMax.min.js"></script> 
         <script type="text/javascript" src="/portal/js/superscrollorama/jquery.superscrollorama.js"></script>
         
         <section class="scroll barra-topo row-fluid" >
           <a href="#content"></a>
           <h3>
             <i class="sprite-icon-jogos-med"></i>Jogos<i class="seta-scroll sprite-scroll-jogos"></i>
           </h3>
         </section>
         
         <script type="text/javascript">
       
            var controller = $.superscrollorama({reverse:true, triggerAtCenter:false}); 
            controller.addTween('.filtro', TweenMax.from( $('.barra-topo'), .5, {css:{opacity: 0}}));
            $('.barra-topo').smint();
         </script> 
        <?php
        }
        ?>   
      
      <h3><i class="sprite-icon-jogos-med"></i>Jogos</h3>
      
      <div class="span10 destaque-filtro">
        <article class="span6 atividade">
          <a class="img-destaque" href="/vilasesamo2/atividades" title="Para Colorir">
            <span class="sprite-selo">Novidade!</span>
            <img src="/portal/images/capaPrograma/vilasesamo2/img350x350.jpg" alt="Para Colorir" /> 
          </a> 
          <h1><a href="/vilasesamo2/atividades" title="Para Colorir">Para Colorir</a></h1>
        </article>
        <article class="span6 atividade">
          <a class="img-destaque" href="/vilasesamo2/atividades" title="Para Colorir"> 
            <span class="sprite-selo">Novidade!</span>
            <img src="/portal/images/capaPrograma/vilasesamo2/img350x350.jpg" alt="Para Colorir" /> 
          </a>
          <h1><a href="/vilasesamo2/atividades" title="Para Colorir">Para Colorir</a></h1>
        </article>
      </div>
      <nav class="span2">
        <p>escolha por personagem<span class="sprite-seta-down"></span></p>
        
        <ul class="filtro-personagem">
          <li><a href="javascript:;" title="" data-filter=".bel"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".beto"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".come-come"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".elmo"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".enio"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".garibaldo"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".grover"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
          <li><a href="javascript:;" title="" data-filter=".zoe"><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="personagem" /></a></li>
        </ul>
      </nav>
    </div>
    
  </section>

  <span class="divisa"></span>

  <section class="todos-itens ">
    <ul  id="container" class="row-fluid">
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="element span4">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="element span4">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="element span4">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
      <li class="span4 element">
        <a href="#" title=""><img src="/portal/images/capaPrograma/vilasesamo2/escola-pra-cachorro.jpg" alt="" /></a>
        <h2><a>Nome jogo</a></h2>
      </li>
    </ul>
  </section>
  
  <span class="divisa"></span>
</div> 

<input type="hidden" id="filter-choice" value="">
<nav id="page_nav">
  <a href="/testes/vilasesamo2/pages/2.html" class="mais"><i class="sprite-icon-mais"></i>Carregar mais jogos</a>
</nav>
<!--scripts-->

<script src="/portal/js/isotope/jquery.isotope.min.js"></script>
<script src="/portal/js/isotope/jquery.infinitescroll.min.js"></script>
<script src="/portal/js/vilasesamo2/internas-isotope.js"></script>
