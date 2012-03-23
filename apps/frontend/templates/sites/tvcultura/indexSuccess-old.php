<link rel="stylesheet" href="/portal/css/tvcultura/geral.css" type="text/css" />
<script type="text/javascript">
  $(function(){
    //carrossel
    $('.carrossel').jcarousel({
        wrap: "both"
    });
  })
</script>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

    <!-- CAPA SITE -->
    <div id="capa-site">

      <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>

      <!-- banner -->
      <div class="banner">

        <h2><a href="http://tvcultura.cmais.com.br">Tv Cultura</a></h2>

        <div class="curtir">
          <fb:like href="http://facebook.com/tvcultura" layout="button_count" show_faces="false" width="170"></fb:like>
        </div>

        <!-- publicidade -->
        <div class="box-publicidade pub-grd">
          <!-- tvcultura-homepage-728x90 -->
          <script type='text/javascript'>
          GA_googleFillSlot("tvcultura-homepage-728x90");
          </script>
        </div>
        <!-- /publicidade -->

      </div>
      <!-- /banner -->

      <!-- MIOLO -->
      <div id="miolo">

        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        
        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina">
        	
    		  <?php
    		  if((isset($displays["destaque-principal"]))&&(count($displays["destaque-principal"]) > 0))
            include_partial_from_folder('blocks','global/display3c', array('displays' => $displays["destaque-principal"]));
          else
            include_partial_from_folder('blocks','global/display5c', array('displays' => $displays["destaque-principal-2"]));
          ?>

          <!-- CAPA --> 
          <div class="capa grid3">
            
            <!-- ESQUERDA -->
            <div id="esquerda" class="grid2">
              
              <!-- col-esq -->
              <div class="col-esq grid1">
     
          <?php include_partial_from_folder('blocks','global/display-1c-live') ?> 
          
          <?php include_partial_from_folder('blocks','global/display-1c-coming') ?>
          
          <?php if(isset($displays["destaque-padrao-1"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-1"])) ?>
                
          <?php if(isset($displays["destaque-quintal-da-cultura"])) include_partial_from_folder('blocks','global/display1c-quintal', array('displays' => $displays["destaque-quintal-da-cultura"])) ?>

          <?php if(isset($displays["destaque-noticias"])) include_partial_from_folder('blocks','global/news', array('displays' => $displays["destaque-noticias"])) ?>

          <?php if(isset($displays["destaque-carrossel-1"])) include_partial_from_folder('blocks','global/display1c-carrossel', array('displays' => $displays["destaque-carrossel-1"])) ?>
          
          <?php if(isset($displays["publicidade-300x50"])) include_partial_from_folder('blocks','global/banner-300x50', array('displays' => $displays["publicidade-300x50"])) ?>      
              </div>
              <!-- /col-esq -->
              
              <!-- col-dir -->
              <div class="col-dir grid1">
                
          <?php if(isset($displays["destaque-padrao-2"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-2"])) ?>

          <?php if(isset($displays["destaque-padrao-3"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-3"])) ?>
                
          <?php if(isset($displays["destaque-padrao-4"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-4"])) ?>

          <?php if(isset($displays["destaque-carrossel-2"])) include_partial_from_folder('blocks','global/display1c-carrossel', array('displays' => $displays["destaque-carrossel-2"])) ?>
                
              </div>
              <!-- /col-dir -->
            </div>
            <!-- /ESQUERDA -->
            
            <!-- DIREITA -->
            <div id="direita" class="grid1">

              <!-- publicidade -->
              <div class="box-publicidade grid1">
                <!-- tvcultura-homepage-300x250 -->
                <script type='text/javascript'>
                GA_googleFillSlot("tvcultura-homepage-300x250");
                </script>
              </div>
              <!-- /publicidade -->

              <!-- BOX PADRAO Noticia -->
              <div class="box-padrao grid1">
                <div class="topo claro">
                  <span></span>
                  <div class="capa-titulo">
                    <h4>Not&iacute;cias + recentes</h4>
                    <a href="/feed" class="rss" title="rss" style="display: block"></a>
                  </div>
                </div>
                <?php if(isset($displays["destaque-noticias-recentes"])) include_partial_from_folder('blocks','global/recent-news', array('displays' => $displays["destaque-noticias-recentes"])) ?>
              </div>
              <!-- /BOX PADRAO Noticia -->

              <?php /*
              <!-- BOX PADRAO + Visitados -->
              <div class="box-padrao mais-visitados grid1">
                <div class="topo">
                  <span></span>
                  <div class="capa-titulo">
                    <h4>+ visitados</h4>
                  </div>
                </div>
                <?php // if(isset($displays["destaque-mais-visitados"])) include_partial_from_folder('blocks','global/popular-news', array('displays' => $displays["destaque-mais-visitados"])) ?>
              </div>
              <!-- /BOX PADRAO + Visitados -->
              */ ?>
              
              <!-- BOX PADRAO Para Ouvir -->
              <div class="box-padrao box-borda grid1">
                <div class="topo">
                  <span></span>
                  <div class="capa-titulo">
                    <h4>para ouvir</h4>
                  </div>
                </div>
                <?php if(isset($displays["destaque-para-ouvir"])) include_partial_from_folder('blocks','global/radios', array('displays' => $displays["destaque-para-ouvir"])) ?>
                <div class="detalhe-borda grid1">
                </div>
              </div>
              <!-- /BOX PADRAO Para Ouvir -->
              
            </div>
            <!-- /DIREITA -->
          </div>
          <!-- /CAPA -->
          
          <?php include_partial_from_folder('blocks','global/staffpick') ?>
          
        </div>
        <!-- /CONTEUDO PAGINA -->
      </div>
      <!-- /MIOLO -->
    </div>
    <!-- /CAPA SITE -->

