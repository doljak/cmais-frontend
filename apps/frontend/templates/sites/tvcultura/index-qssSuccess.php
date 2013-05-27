<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>
<script type="text/javascript" src="/portal/js/redirect_mobile.js"></script>
<link rel="stylesheet" href="/portal/css/tvcultura/hometv/qss.css" type="text/css" />

<!-- CAPA SITE -->
<div id="capa-site">
  <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"]))  ?>

  
  <!-- MIOLO -->
  <div id="miolo" style="margin-top:40px" >
    <?php include_partial_from_folder('blocks','global/shortcuts')    ?>

    <!-- CONTEUDO PAGINA -->
    <div id="conteudo-pagina">
      <?php  if ((isset($displays["destaque-principal"])) && (count($displays["destaque-principal"]) > 0))
    include_partial_from_folder('blocks', 'global/display3c', array('displays' => $displays["destaque-principal"]));
  else
    include_partial_from_folder('blocks', 'global/display5c-v2', array('displays' => $displays["destaque-principal-2"])); ?>

      <!-- CAPA -->
      <div class="capa grid3">
        <!-- ESQUERDA -->
        <div id="esquerda" class="grid2">
          <!-- col-esq -->
          <div class="col-esq grid1">
            <?php include_partial_from_folder('blocks','global/display-1c-live') ?>

            <?php include_partial_from_folder('blocks','global/display-1c-coming') ?>

            <?php if(isset($displays["destaque-padrao-1"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-1"])) ?>

            <?php if(isset($displays["destaque-quintal-da-cultura"])) include_partial_from_folder('blocks','global/display1c-quintal', array('displays' => $displays["destaque-quintal-da-cultura"]))  ?>

            <?php if(isset($displays["destaque-noticias"])) include_partial_from_folder('blocks','global/news', array('displays' => $displays["destaque-noticias"])) ?>

            <?php if(isset($displays["publicidade-300x50"])) include_partial_from_folder('blocks','global/banner-300x50', array('displays' => $displays["publicidade-300x50"])) ?>
          </div>
          <!-- /col-esq -->
          <!-- col-dir -->
          <div class="col-dir grid1">
            <?php if(isset($displays["destaque-padrao-2"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-2"])) ?>

            <?php if(isset($displays["destaque-padrao-3"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-3"])) ?>

            <?php if(isset($displays["destaque-padrao-4"])) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-4"])) ?>

            <?php if(count($displays["destaque-padrao-5"]) > 0 ) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-5"])) ?>
          </div>
          <!-- /col-dir -->
        </div>
        <!-- /ESQUERDA -->
        <!-- DIREITA -->
        <div id="direita" class="grid1">
          <!-- publicidade -->
          <div class="box-publicidade grid1">
            <!-- home-geral300x250 -->
            <script type='text/javascript'>
              GA_googleFillSlot("tvcultura-homepage-300x250");
            </script>
          </div>
          <!-- /publicidade -->
          <!-- BOX PADRAO Noticia -->
          <div class="box-padrao grid1">
            <!--div class="topo claro">
            <span></span>
            <div class="capa-titulo">
            <h4>Conte&uacute;dos + recentes</h4>
            <a href="/feed" class="rss" title="rss" style="display: block"></a>
            </div>
            </div-->
            <?php //if(isset($displays["destaque-noticias-recentes"])) include_partial_from_folder('blocks','global/recent-news', array('displays' => $displays["destaque-noticias-recentes"])) ?>

            <?php if(count($displays["destaque-padrao-6"]) > 0 ) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-6"])) ?>

            <?php if(count($displays["destaque-padrao-7"]) > 0 ) include_partial_from_folder('blocks','global/display1c-news', array('displays' => $displays["destaque-padrao-7"])) ?>
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
       <?php // if(isset($displays["destaque-mais-visitados"])) include_partial_from_folder('blocks','global/popular-news', array('displays' => $displays["destaque-mais-visitados"]))
       ?>
       </div>
       <!-- /BOX PADRAO + Visitados -->
       */ ?> 
       
       <?php if(isset($displays["destaque-para-ouvir"])): ?>
        <?php if(count($displays["destaque-para-ouvir"]) > 0 ): ?>
        <!-- BOX PADRAO Para Ouvir -->
        <div class="box-padrao box-borda grid1">
          <div class="topo">
            <span></span>
            <div class="capa-titulo">
              <h4>para ouvir</h4>
            </div>
          </div>
          <?php if(isset($displays["destaque-para-ouvir"])) include_partial_from_folder('blocks','global/radios', array('displays' => $displays["destaque-para-ouvir"])) ?>
          <div class="detalhe-borda grid1"></div>
        </div>
        <!-- /BOX PADRAO Para Ouvir -->
        <?php endif;?>
        <?php endif;?>

        <?php if(isset($displays["destaque-carrossel-2"])) include_partial_from_folder('blocks','global/display1c-carrossel', array('displays' => $displays["destaque-carrossel-2"])) ?>
      </div>
      <!-- /DIREITA -->
    </div>
    <!-- /CAPA -->
    <?php include_partial_from_folder('blocks','global/staffpick') ?>
  </div>
  <!-- /CONTEUDO PAGINA -->
</div>
<!-- /MIOLO -->
</div> <!-- /CAPA SITE -->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
