<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 8]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link rel="stylesheet" href="http://cmais.com.br/portal/css/tvcultura/sites/vilasesamo2/internas.css" type="text/css" />

<script>
  $("body").addClass("cuidadores");
</script>

<!-- HEADER -->
<?php include_partial_from_folder('sites/vila-sesamo', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>
<!-- /HEADER -->

<!--content-->
<div id="content">
  
  <!--section -->
  <section class="filtro row-fluid">
    
    <!--container carrossel-->
    <div class="container-carrossel b-verde borda-arredonda">
      <h1>
        <span class="sprite sprite-cuidadores-gd"></span>
        <?php echo $section->getTitle() ?>
      </h1>
      
      <?php if(isset($displays['destaque-principal'])): ?>
        <?php if(count($displays['destaque-principal']) > 0): ?>
      <!--inicio carrossel--> 
      <div id="carrossel-interna-artigo">
        <!--slider-->
        <div class="slider">
          <!--slider-mask-wrap-->
          <div class="slider-mask-wrap">
            <!--slider-mask-->
            <div class="slider-mask">
              <!--slider-mask-wrap--> 
              <ul class="slider-target">
                <?php foreach($displays['destaque-principal'] as $d): ?>
                <!--item-->
                <li>
                  <div class="pull-left videoorimage">
                    <img src="<?php echo $d->retriveImageUrlByImageUsage("image-13") ?>" alt="<?php echo $d->getTitle() ?>" />
                  </div>
                  <div class="descritivo">
                    <h3><?php echo $d->getTitle() ?></h3>
                    <p><?php echo $d->getDescription() ?></p>
                    <p>Por <span><?php echo $d->getAuthor() ?></span></p>
                  </div>
                </li>
                <!--/item-->
                <?php endforeach; ?>
              </ul>
              <!--slider-mask-->
              <div class="clearit"></div>
            </div>
          </div>
          <!--slider-mask-wrap--> 
          <!--slider-nav-->
          <div class="slider-nav">
            <div class="arrow-left arrow"><span title="Anterior" class="back"></span></div>
            <div class="arrow-right arrow"><span title="Proximo" class="next"></span></div>
          </div> 
          <!--slider-nav-->
        </div>
        <!--/slider-->
        <!--seletor carrossel-->
        <div class="container-itens"> 
          <ul id="selector-interna-artigo">
            <?php foreach($displays['destaque-principal'] as $k=>$d): ?>
            <li><a href="#" rel="frame_<?php echo $k ?>"></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!--/seletor carrossel--> 
      </div>
      <!--/inicio carrossel-->
        <?php endif; ?>
      <?php endif; ?>
       
    </div>
    <!--/container carrossel-->
      
  </section>
  <!--/section-->
  
  <div class="divisa"></div>
  
  <!--section-->
  <section class="row-fluid" verde>
    
    <!-- col esquerda -->
    <div class="span8">
      
      <!--selecione-->
      <div class="selecione">
        
        <!--barra selecao-->
        <div class="barra-selecao b-verdeescuro">
          <h3>Todos os Artigos de:</h3>
          <!-- selecione uma categoria-->
          <?php
            $sectionCategorias = Doctrine::getTable('Section')->findOneBySiteIdAndSlug($site->getId(),"categorias");
            $allCategories = $sectionCategorias->subsections(); // pega todas as categorias para o usuário poder navegar por elas
          ?>        
          <?php if(isset($allCategories)): ?>
            <?php if(count($allCategories) > 0): ?>
            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:;"> Selecione a categoria <span class="caret sprite-seta-down-amarela"></span> </a>
              <ul class="dropdown-menu">
                <?php foreach($allCategories as $c): ?>
                <li><a href="<?php echo $c->retriveUrl() ?>" title="<?php echo $c->getTitle() ?>" title="<?php echo $c->getTitle() ?>"><?php echo $c->getTitle() ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <!--/barra selecao-->
        
        <!--/section-->
        <section class="todos-itens ">
          <!--lista-->
          <ul id="container" class="row-fluid">
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo1
                </div>
              </a>
            </li>
    
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo2
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo1
                </div>
              </a>
            </li>
    
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo2
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
            <li class="span4 element"> 
              <a href="#" title="title">
                <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="titulo/descrição" />
                <i class="sprite-icons-new sprite-icone_atividades"></i>
                <div>
                  <img class="altura" src="/portal/images/capaPrograma/vilasesamo2/altura.png"/>
                  Nome do Artigo3
                </div>
              </a>
            </li>
            
                        
          </ul> 
          <!--lista-->  
          
        </section>
        <!--/section-->
        
      </div>
      <!--/selecione-->
      
      <input type="hidden" id="filter-choice" value="">

      <nav id="page_nav">
        <a href="/testes/vilasesamo2/pages/2.html" class="mais">Carregar mais<i class="sprite-icon-mais"></i></a>
      </nav>

    </div>  
    <!--/col esquerda-->
    
    <!--col direita-->
    <div class="span4 col-direita">
    
      <!--destaque 1-->
      <a class="destaque-small" href="#" title="titulo 1">
        <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="descricao" />
      </a>
      <!-- destaque 1 -->
      
      <!--destaque 2-->
      <a class="destaque-small" href="#" title="titulo 2">
        <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="descricao" />
      </a>
      <!-- destaque 2 -->
      
      <!--destaque 3-->
      <a class="destaque-small" href="#" title="titulo 3">
        <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="descricao" />
      </a>
      <!-- destaque 3 -->
      
      <!--destaque 4-->
      <a class="destaque-small" href="#" title="titulo 4">
        <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="descricao" />
      </a>
      <!-- destaque 4 -->
      
      <!--destaque 5-->
      <a class="destaque-small" href="#" title="titulo 5">
        <img src="http://midia.cmais.com.br/assets/image/image-13-b/255f75fd3506598980f287c10fa1ddc925872e96.jpg" alt="descricao" />
      </a>
      <!-- destaque 5 -->

    </div>
    <!--/col direita--> 
    
  </section>  
  <!--/section-->
  
</div> 
<!--/content-->
  
  <!--scripts e css carrossel-->
  <script src="http://cmais.com.br/portal/js/isotope/jquery.isotope.min.js"></script>
  <script src="http://cmais.com.br/portal/js/isotope/jquery.infinitescroll.min.js"></script>
  <script src="http://cmais.com.br/portal/js/vilasesamo2/internas-isotope.js"></script>
  <script src="http://cmais.com.br/portal/js/jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
  <script type="text/javascript" src="http://cmais.com.br/portal/js/modernizr/modernizr.min.js"></script>
  <script type="text/javascript" src="http://cmais.com.br/portal/js/hammer.min.js"></script>
  <script type="text/javascript" src="http://cmais.com.br/portal/js/responsive-carousel/script.js"></script>
  <link type="text/css" rel="stylesheet" href="http://cmais.com.br/portal/js/responsive-carousel/style-vilasesamo.css"/>
  
  <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script> 
  <script type="text/javascript" src="http://cmais.com.br/portal/js/vilasesamo2/youtubeapi.js"></script> 
  
  
  <script>
  //carrossel
  var total=0;
  $('#selector-interna-artigo  li').each(function(i){
    var width = $(this).width();
    total = width + total + 14; 
  });
  
  $('#selector-interna-artigo ').css('width', total);
  
  $('#carrossel-interna-artigo').responsiveCarousel({
      unitWidth:          'inherit',
      target:             '#carrossel-interna-artigo .slider-target',
      unitElement:        '#carrossel-interna-artigo .slider-target > li',
      mask:               '#carrossel-interna-artigo .slider-mask',
      arrowLeft:          '#carrossel-interna-artigo .arrow-left',
      arrowRight:         '#carrossel-interna-artigo .arrow-right',
      dragEvents:         true,
      step:-1,
      onShift:function (i) {
          var $current = $('#selector-interna-artigo  li a[rel=frame_' + i + ']');
          $('#selector-interna-artigo  li a').removeClass('current');
          $current.addClass('current');
      },
      slideSpeed: 8000
  });
  
  //$('.arrow, #selector-interna-artigo  a').click(function(){
    //slideShow(); 
  //});
  
  $('#selector-interna-artigo  a').on('click', function (ev) {
    ev.preventDefault();
    var i = /\d/.exec($(this).attr('rel'));
    $('#carrossel-interna-artigo').responsiveCarousel('goToSlide', i);

    stop();
    slideShow(); 
  });
  
  $(window).on('load', function (ev) {
    ev.preventDefault();
    $('#carrossel-interna-artigo').responsiveCarousel('redraw');
    $('#carrossel-interna-artigo').responsiveCarousel('toggleSlideShow');
    slideShow();
  });
  
  slideShow = function(ev){
    ev.preventDefault();
    $('#carrossel-interna-artigo').responsiveCarousel('toggleSlideShow');
  };
  stop = function(ev){
    ev.preventDefault();
    $('#carrossel-interna-artigo').responsiveCarousel('stopSlideShow');
  };
  </script>
<!--scripts-->
