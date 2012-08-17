<link rel="stylesheet" href="/portal/css/tvcultura/secoes/defaultPrograma.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/debate.css" type="text/css" />
<?php use_helper('I18N', 'Date')
?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section))
?>

<!-- CAPA SITE -->
<div id="capa-site" class="home-debate">
  <!-- CHAMADA -->
  <!--div id="chamada" class="grid3">
  <span>teste</span>
  <a href="#" target="#">fdsfsdf sdf sdf sd fsdf sd fsd fsd</a>
  </div-->
  <!-- /CHAMADA -->
  <div class="bg-chamada">
    <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"]))
    ?>
  </div>
  <!-- BARRA SITE -->
  <div id="barra-site">
    <h2>17 de setembro às 21h15</h2>
    <p class="eleicoes">Eleições 2012 - Debate</p>
    <ul class="patrocinio">
      <li class="estadao">Estadão</li>
      <li class="cultura">TV Cultura</li>
      <li class="youtube">Youtube</li>
    </ul>
    <!-- curtir -->
    <div class="redes">
      <div class="curtir">
        <div style="display:block; float: left; margin-right:10px;">
          <g:plusone size="medium" count="false"></g:plusone>
        </div>
        <fb:like href="<?php if($site->getFacebookUrl()): ?><?php echo $site->getFacebookUrl() ?><?php else:?><?php echo $uri ?><?php endif;?>" layout="button_count" show_faces="false" send="true" width="160"></fb:like>
      </div>
      <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php if($site->getTwitterAccount()): ?><?php echo $site->getTwitterAccount() ?><?php else:?>tvcultura<?php endif;?>">Tweet</a>
    </div>
    <!-- /curtir -->
  </div>
  <!-- /BARRA SITE -->
  <!-- MIOLO -->
  <div id="miolo" class="skin">
    <!-- BOX LATERAL -->
    <?php include_partial_from_folder('blocks','global/shortcuts')
    ?>
    <!-- BOX LATERAL -->
    <!-- CONTEUDO PAGINA -->
    <div id="conteudo-pagina">
      <!-- CAPA -->
      <div class="capa grid3">
        <div class="grid2" id="esquerda">
          <!-- DESTAQUE 2 COLUNAS -->
          <div class="duas-colunas destaque grid2">
            <iframe width="640" height="390" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/dyC7vRvzA-g?rel=0&amp;wmode=transparent#t=0m0s" title="'Uma História Bonita e Feliz', por Silvio Brito"></iframe>
            <p>Música é tema de seu novo show</p>
          </div>
          <!-- /DESTAQUE 2 COLUNAS -->
          
        </div>
        <!-- DIREITA -->
        <div id="direita" class="grid1">
        	 <!-- BOX PADRAO Noticia -->
            <div class="box-padrao grid1">
              <a href="http://politica.estadao.com.br/eleicoes/debate/participe-regras/" title="Envie sua perguntapara os candidatos" target="_blank">
              	<img src="/portal/images/capaPrograma/debate/participe.jpg" alt="Envie sua perguntapara os candidatos" />
              </a>
              
            </div>
            <!-- BOX PADRAO Noticia -->
          <!-- BOX PUBLICIDADE -->
          <div class="box-publicidade grid1">
            <!-- programas-homepage-300x250 -->
            <script type='text/javascript'>
				GA_googleFillSlot("cmais-homepage-300x250");

            </script>
          </div>
          <!-- / BOX PUBLICIDADE -->
         
        </div>
        <!-- /DIREITA -->
      </div>
      <!-- /CAPA -->
    </div>
    <!-- /CONTEUDO PAGINA -->
  </div>
  <!-- /MIOLO -->
</div>
<!-- / CAPA SITE -->
