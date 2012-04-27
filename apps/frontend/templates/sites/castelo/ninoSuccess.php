<link rel="stylesheet" href="/portal/css/tvcultura/secoes/defaultPrograma.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/castelo/geral.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/castelo/nino.css" type="text/css" />

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>

<div class="bg-site">
</div>

<!--CASTELO-->
<div id="bg" >
  
    <!-- CAPA SITE -->
    <div id="capa-site">      

      <!-- BARRA SITE -->
      <div id="barra-site">
        
        
        <div class="topo-programa">
          
          <h2>
            <a href="http://cmais.com.br/castelo" style="text-decoration: none;">
          
                <img src="/portal/images/capaPrograma/castelo/img-logo-castelo.png" class="logo" alt="Castelo Ra Tim Bum" />
              
            </a>
          </h2>
          

          <?php if(isset($program) && $program->id > 0): ?>
          <?php include_partial_from_folder('sites/castelo','global/like', array('site' => $site, 'uri' => $uri, 'program' => $program)) ?>
          <?php endif; ?>
          
          
        </div>

        <!-- box-topo -->
        <div class="box-topo grid3">

          <?php include_partial_from_folder('blocks','global/sections-menu', array('siteSections' => $siteSections)) ?>

         <div class="castelo18">
           <img src="/portal/images/capaPrograma/castelo/img-menu-hashtag.png" alt="#castelo18anos">
           <a href="https://twitter.com/#!/search/realtime/castelo18anos" target="_blank"><img src="/portal/images/capaPrograma/castelo/btn-menu-twitter.png" alt="Twitter"></a>
           <a href="#" target="_blank"><img src="/portal/images/capaPrograma/castelo/btn-menu-instagram.png" alt="Instangram"></a>

         </div>
         
        </div>
        <!-- /box-topo -->
        
        
      </div>
      <!-- /BARRA SITE -->

      <!-- MIOLO -->
      <div id="miolo">
        
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>

        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina">
          
          <!-- CAPA -->
          <div class="capa grid3">
            
            <!--NAVEGAÇÃO PG A PG-->
            <a hef="#" class="nav-Esquerda" title="Anterior">
              <img src="/portal/images/capaPrograma/castelo/btn-tela-anterior.png" alt="Tela Anterior" style="display: none;" />
            </a>
            <a hef="#" class="nav-Direita" title="Próxima">
              <img src="/portal/images/capaPrograma/castelo/btn-tela-proxima.png" alt="Próxima Tela" style="display: none;"/>
            </a>
            <!--/NAVEGAÇÃO PG A PG-->
            
           <div class="tudo">
            
            <?php if(isset($displays["nino"])): ?>
            	<?php if(count($displays["nino"]) > 0): ?>
            <!--nino-->
              <div class="botao-nino"></div>
              <a href="<?php echo $displays["nino"][0]->retriveUrl()?>" title="<?php echo $displays["nino"][0]->getTitle()?>" class="botao-nino-over" name="over-nino" style="display:none"></a>  
            <!--/nino-->
            	<?php endif; ?>
            <?php endif; ?>
            
            <?php if(isset($displays["zeca"])): ?>
            	<?php if(count($displays["zeca"]) > 0): ?>
            <!--zeca-->
              <div class="botao-zeca"></div>
              <a href="<?php echo $displays["zeca"][0]->retriveUrl()?>" title="<?php echo $displays["zeca"][0]->getTitle()?>" class="botao-zeca-over" name="over-zeca" style="display:none"></a>  
            <!--/zeca-->  
            	<?php endif; ?>
            <?php endif; ?>
            
            <?php if(isset($displays["biba"])): ?>
            	<?php if(count($displays["biba"]) > 0): ?>
            <!--biba-->
              <div class="botao-biba"></div>
              <a href="<?php echo $displays["biba"][0]->retriveUrl()?>" title="<?php echo $displays["biba"][0]->getTitle()?>" class="botao-biba-over" name="over-biba" style="display:none"></a>  
            <!--/biba-->
            	<?php endif; ?>
            <?php endif; ?>
            
            <?php if(isset($displays["telekid"])): ?>
            	<?php if(count($displays["telekid"]) > 0): ?>
             <!--telekid-->
              <div class="botao-telekid"></div>
              <a href="<?php echo $displays["telekid"][0]->retriveUrl()?>" title="<?php echo $displays["telekid"][0]->getTitle()?>" class="botao-telekid-over" name="over-telekid" style="display:none"></a>  
            <!--/telekid-->    
            	<?php endif; ?>
            <?php endif; ?>
            
            
            
            </div> 
            
            
            <!-- MENU NAVEGAÇÃO-->
            <?php include_partial_from_folder('sites/castelo','global/casteloMenuInternas') ?> 
            <!--/MENU NAVEGAÇÃO-->
            
          </div>
          <!-- /CAPA -->
          
        </div>
        <!-- /CONTEUDO PAGINA -->
        
      </div>
      <!-- /MIOLO -->
      
    </div>
    <!-- /CAPA SITE -->
    
</div>   
<!--/CASTELO-->

