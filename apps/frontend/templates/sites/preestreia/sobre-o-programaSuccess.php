<link rel="stylesheet" href="http://cmais.com.br/portal/css/tvcultura/secoes/programaSimplesSobre.css" type="text/css" />

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

    <!-- CAPA SITE -->
    <div id="capa-site">

      <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>

      <!-- BARRA SITE -->
      <div id="barra-site">
        <div class="topo-programa">
          <?php if(isset($program) && $program->id > 0): ?>
          <h2>
            <a href="<?php echo $program->retriveUrl() ?>">
              <img src="http://midia.cmais.com.br/programs/<?php echo $program->getImageThumb() ?>" alt="<?php echo $program->getTitle() ?>" title="<?php echo $program->getTitle() ?>" />
            </a>
          </h2>
          <?php endif; ?>

          <?php if(isset($program) && $program->id > 0): ?>
          <?php include_partial_from_folder('blocks','global/like', array('site' => $site, 'uri' => $uri, 'program' => $program)) ?>
          <?php endif; ?>
          
          <?php if(isset($program) && $program->id > 0): ?>
          <!-- horario -->
          <div id="horario">
            <p><?php echo html_entity_decode($program->getSchedule()) ?></p>
          </div>
          <!-- /horario -->
          <?php endif; ?>
        </div>

        <?php if(isset($siteSections)): ?>
        <!-- box-topo -->
        <div class="box-topo grid3">
          
          <?php include_partial_from_folder('blocks','global/sections-menu', array('siteSections' => $siteSections)) ?>

          <div class="navegacao txt-10">
            <a href="./<?php echo $section->getSlug() ?>" title="<?php echo $section->getTitle() ?>"><?php echo $section->getTitle() ?></a>
          </div>

        </div>
        <!-- /box-topo -->
        <?php endif; ?>

      </div>
      <!-- /BARRA SITE -->

      <!-- MIOLO -->
      <div id="miolo">

        <!-- BOX LATERAL -->
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        <!-- BOX LATERAL -->

        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina">

          <!-- CAPA -->
          <div class="capa grid3">

            <div id="esquerda" class="grid2">
                        
              <!-- NOTICIA INTERNA -->
              <div class="box-interna grid2">

                <!-- <div class="box-relacionados grid1">
                  <a href="#"><img class="310x186" src="images/img-310x186.jpg" alt="300x186" /></a>
                </div> -->
                <div class="texto">
                <?php if(count($pager) > 0): ?>
                  <?php echo html_entity_decode($pager->getCurrent()->AssetContent->render()) ?>
                <?php endif; ?>
                </div>
                
              </div>

              <!-- /NOTICIA INTERNA -->

              <?php include_partial_from_folder('blocks','global/share-2c', array('site' => $site, 'uri' => $uri, 'asset' => $asset)) ?>
             
            </div>
            
            <div id="direita" class="grid1">

              <!-- BOX PUBLICIDADE -->
              <div class="box-publicidade grid1">
                <!-- preestreia-assets-300x250 -->
                <script type='text/javascript'>
                GA_googleFillSlot("cmais-assets-300x250");
                </script>
              </div>
              <!-- / BOX PUBLICIDADE -->
              
               <?php include_partial_from_folder('blocks','global/facebook-1c', array('site' => $site, 'uri' => $uri)) ?>

              <?php if(isset($displays["destaque-links"][0])): ?>
              <!-- PARA OUVIR -->
              <div class="box-padrao box-borda grid1">
                <div class="topo claro">
                  <span></span>
                  <div class="capa-titulo">
                    <h4><?php if(isset($displays["destaque-links"])) echo $displays["destaque-links"][0]->Block->getTitle() ?></h4>
                  </div>
                </div>
                <div class="conteudo top tipo2">
                  <?php if(isset($displays["destaque-links"])) include_partial_from_folder('blocks','global/popular-news', array('displays' => $displays["destaque-links"])) ?>
                </div>
                <div class="detalhe-borda grid1"></div>
              </div>
              <!-- PARA OUVIR -->
              <?php endif; ?>

            </div>
            <!-- rodape preestreia-->
	        <div class="grid3 apoio">
	          <img src="http://cmais.com.br/portal/images/capaPrograma/preestreia/rodape_preestreia.jpg" />	
	         </div>
	         <!-- /rodape preestreia-->

          </div>
          <!-- /CAPA -->

        </div>
        <!-- /CONTEUDO PAGINA -->

      </div>
      <!-- /MIOLO -->

    </div>
    <!-- / CAPA SITE -->
