<link type="text/css" href="http://cmais.com.br/portal/univesptv/css/geral.css" rel="stylesheet" />
<script type="text/javascript" src="http://cmais.com.br/portal/js/mediaplayer/swfobject.js"></script>


<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>

    <!-- CAPA SITE -->
	<div id="capa-site" class="a1964">
     	<!-- BARRA SITE -->
  		<div id="barra-site" onclick=location="1964" title="<?php echo $section->getTitle() . "  ". $section->getDescription() ?>">
	       <div class="topo-timeline">
		          <!-- <h2><a href="<?php echo $site->retriveUrl() ?>"><img title="<?php echo $site->getTitle() ?>" alt="<?php echo $site->getTitle() ?>" src="http://midia.cmais.com.br/programs/43cfb180f75e0cbc2c2823f4cfb603643151ab5a.png" /></a></h2>-->
		          
		          <!-- curtir -->
		          <!--?php include_partial_from_folder('blocks','global/like', array('site' => $site, 'uri' => $uri)) ?-->
		          <!-- /curtir -->
		                    
		          <!-- horario -->
		          <!--div id="horario"
		            <p>Canal digital 2.2 da multiprogramação da TV Cultura</p>
		          </div>-->
		          <!-- /horario -->
	          
	        </div>
			<!-- box-topo -->
	        <div class="box-topo grid3">
		       	<!-- menu interna -->
		       	<?php include_partial_from_folder('blocks','global/sections-menu2', array('siteSections' => $siteSections)) ?>
		        <!-- /menu interna -->                 
	    	</div>
	   		<!-- /box-topo -->
		  </div>
	      <!-- /BARRA SITE -->
      
      <!-- MIOLO -->
   	  <div id="miolo">
   	   	
   	    <!-- BOX LATERAL -->
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        <!-- BOX LATERAL -->
        
        <!--CONTEUDO-->
        <div id="conteudo-pagina">
	         
	         <!-- CAPA 3-->
         	 <div class="capa grid3">
         	 	
         	 	<!--TITULO-->
		   	   	 <div class="box-interna grid2">
			   	   
		   	   	 </div>
		   	   	 <!--TITULO-->
		   	   	
		          <!-- INICIO TIMELINE -->
		          <div class="" style="height: 500px;">
			            <div id="tvcultura-embed"></div>
			            <script type="text/javascript">
			              var timeline_config = {
			               width: "100%",
			               height: "100%",
			               source: "http://univesptv.cmais.com.br<?php echo url_for('homepage')?>1964/linha-do-tempo.jsonp",
			               start_at_slide: 0,
			               start_zoom_adjust: 2,
			               embed_id: "tvcultura-embed",
			               css: "http://univesptv.cmais.com.br/portal/js/timeline/1964.css",
			               js: "http://univesptv.cmais.com.br/portal/js/timeline/timeline-min.js"
			              }
			            </script>
			            <script type="text/javascript" src="http://univesptv.cmais.com.br/portal/js/timeline/storyjs-embed.js"></script>
		            </div>
		            <!-- /FIM TIMELINE -->
	            		         
     		</div><!--/CAPA-->
             <!-- APOIO -->
	          <ul id="apoio" class="grid3">
	              <li><a href="http://www.desenvolvimento.sp.gov.br" class="governoSp"><img src="http://cmais.com.br/portal/univesptv/images/logo-goversoSp.jpg" alt="Governo do Estado de S&atilde;o Paulo" /></a></li>
	              <li><a href="http://www.fapesp.br" class="fapesp"><img src="http://cmais.com.br/portal/univesptv/images/logo-fapesp.png" alt="FAPESP" /></a></li>
	              <li><a href="http://www.unicamp.br" class="unicamp"><img src="http://cmais.com.br/portal/univesptv/images/logo-unicamp.png" alt="UNICAMP" /></a></li>
	              <li><a href="http://www.unesp.br" class="unesp"><img src="http://cmais.com.br/portal/univesptv/images/logo-unesp.png" alt="UNESP" /></a></li>
	              <li><a href="http://www.usp.br" class="usp"><img src="http://cmais.com.br/portal/univesptv/images/logo-usp.png" alt="USP" /></a></li>
	              <li><a href="http://www.fundap.sp.gov.br" class="fundap"><img src="http://cmais.com.br/portal/univesptv/images/logo-fundap.jpg" alt="FUNDAP" /></a></li>
	              <li><a href="http://www.centropaulasouza.sp.gov.br" class="cps"><img src="http://cmais.com.br/portal/univesptv/images/logo-cps.png" alt="Centro Paula Souza" /></a></li>
	          </ul>
         	 <!-- APOIO -->

   			 <!--?php include_partial_from_folder('sites/univesptv', 'global/apoio') ?-->
	         <!-- APOIO -->
         	
        </div><!--/CONTEUDO-->
        
      </div><!--/MIOLO -->
      
    </div><!-- /CAPA SITE -->


 