<?php
/*
if((date('H:i:s') >= '18:00:00') && (date('w') == 1))  {
  header('Location: http://tvcultura.cmais.com.br/rodaviva/bastidores');
  die();
}
*/
?>
<link rel="stylesheet" href="/portal/css/tvcultura/sites/<?php echo $section->Site->getSlug() ?>.css" type="text/css" />
<script type="text/javascript" src="/portal/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="/portal/js/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="/portal/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="/portal/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="/portal/js/mediaplayer/swfobject.js"></script>
<script type="text/javascript" src="/portal/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="/portal/js/validate/jquery.validate.js"></script>

<script type="text/javascript">
  //TIMER TRANSMISSAO
  function timer1(){
    var request = $.ajax({
      data: {
        asset_id: '32782',
        url_in: 'http://tvcultura.cmais.com.br/rodaviva/transmissao'
      },
      dataType: 'jsonp',
      success: function(data) {
        eval(data);
      },
      url: '/ajax/timer'
    });
  }
  function timer2(){
    var request = $.ajax({
      data: {
        asset_id: '32761',
        url_in: 'http://tvcultura.cmais.com.br/rodaviva/bastidores'
      },
      dataType: 'jsonp',
      success: function(data) {
        eval(data);
      },
      url: '/ajax/timer'
    });
  }
  $(window).load(function(){
    var t=setInterval("timer1()",60000);
    var t=setInterval("timer2()",60000);
  });
  
  
  $(function(){
  
    // destaque principal
    $('#slider').nivoSlider({
      pauseTime: 10000,
      effect: 'fade'
    });
    $('.destaque').show();
    
    // acervo em destaque
    $('.carrossel').jcarousel({
      wrap: "both"			
    });
    $('.acervoDestaque').show();
    
    // charges caruso
    $('a.charges_caruso').fancybox();
    //$('#gallery ul li:last').remove();
    
	// Newsletter
    $("#assine-news").hide();
    $("a.news").click(function(){
      $("#assine-news").slideToggle("slow");
      return true;
    });
    
    // Validador Newsletter
    var validator = $("#form-contact").validate({
      rules:{
        nome:{
          required: true,
          minlength: 2
        },
        email:{
          required: true,
          email: true
        },
        captcha: {
          required: true,
          remote: "/portal/js/validate/demo/captcha/process.php"
        }
      }
    });

    // comportamento dos botões das redes sociais    
    $('.boxRedes li a.twitter').mouseover(function(){
      $('.boxRedes li a.twitter .nome').css('color','#3399ff');
    });
    $('.boxRedes li a.twitter').mouseout(function(){
      $('.boxRedes li a.twitter .nome').css('color','#5b5a50');
    });
  });
</script>


<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

    <!-- CAPA SITE -->
	<div class="bg-rodaviva">
    <div id="capa-site">

      <!-- BREAKING NEWS -->
      <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>
      <!-- /BREAKING NEWS -->
      
      <!-- BARRA SITE -->
      <div id="barra-site">
	  	<div class="topo-programa">
	  	  <?php if(isset($program) && $program->id > 0): ?>
		  <h2>
		    <a href="<?php echo $program->retriveUrl() ?>" title="<?php echo $program->getTitle() ?>">
		      <img title="<?php echo $program->getTitle() ?>" alt="<?php echo $program->getTitle() ?>" src="/uploads/programs/<?php echo $program->getImageThumb() ?>">
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
		
		<div class="box-topo grid3">
          <?php if(count($siteSections) > 0): ?>
          <ul class="menu">
            <?php foreach($siteSections as $s): ?>
				<li><a href="<?php echo $s->retriveUrl() ?>" title="<?php echo $s->getTitle() ?>"><span><?php echo $s->getTitle() ?></span></a></li>
			<?php endforeach; ?>
          </ul>
          <?php endif; ?>
		</div>
		<!-- /box-topo -->
	</div>
      <!-- /BARRA SITE -->
      <!-- MIOLO -->
      <div id="miolo">
      	
        <!-- BOX LATERAL -->
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        <!-- BOX LATERAL -->
              	
        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina exceptionn">
          <!-- CAPA -->
          <div class="capa grid3 exceptionn">
          	<div class="tudo-Rodaviva">
          		<span class="bordaTopRV"></span>
          		<div class="centroRV">
                  <?php if(isset($displays['destaque-principal'])): ?>
                    <?php if(count($displays['destaque-principal']) > 0): ?>
          			<div class="destaque">
          				<div id="wrapper">
          					<div class="slider-wrapper">
					            <div class="ribbon"></div>
					            <div id="slider" class="nivoSlider">
                                  <?php foreach($displays['destaque-principal'] as $k=>$d): ?>
                                  	<?php if($d->Asset->AssetType->getSlug() == "image"): ?>					            	
					                <a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>"><img src="<?php echo $d->retriveImageUrlByImageUsage('image-10-b') ?>" alt="<?php echo $d->Asset->getTitle() ?>" title="#<?php echo $d->getId() ?>" /></a>
					                <?php endif; ?>
                                  <?php endforeach; ?>					                
					            </div>
					          <?php foreach($displays['destaque-principal'] as $k=>$d): ?>
					          	<?php if($d->Asset->AssetType->getSlug() == "image"): ?>
					            <div id="<?php echo $d->getId() ?>" class="nivo-html-caption">
					                <h4 style="color:#5b5a50;font-size:14px;font-weight:normal;margin-top:25px;width:275px"><?php echo strtoupper($d->getTitle()) ?></h4>
					                <h2 style="color:#5b5a50;font-size:24px;font-weight:normal;margin-top:10px;line-height:25px;width:275px"><a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>" style="font-size:24px"><?php echo $d->getHeadline() ?></a></h2>
					                <p style="color:#333;font-size:14px;margin-top:10px;margin-left:-25px;width:255px"><a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>"><?php echo $d->getDescription() ?></a></p>
					            </div>
					            <?php endif; ?>
					          <?php endforeach; ?>
					        </div>
					    </div>
          			</div>
          			<?php endif; ?>
                  <?php endif; ?>
          			<div class="esq">
                      <?php if(isset($displays['destaque-playlist'])): ?>
                        <?php if(count($displays['destaque-playlist']) > 0): ?>
          				<div class="acervoDestaque">
          					<h3><?php echo $displays['destaque-playlist'][0]->Block->getTitle() ?></h3>
          					<div class="carrossel">
								<ul>
								  <?php foreach($displays['destaque-playlist'] as $k=>$d): ?>
									<li>
                                      <?php if($d->retriveImageUrlByImageUsage("image-2") != ""): ?>
										<a class="aImg" href="<?php echo $d->retriveUrl() ?>">
											<img src="<?php echo $d->retriveImageUrlByImageUsage("image-2") ?>" alt="<?php echo $d->getTitle() ?>" />
											<span class="ico"></span>
										</a>
			                          <?php endif; ?>
			                          <?php if($d->retriveLabel() != ""): ?>
										<a class="aTxt" href="<?php echo $d->retriveUrl() ?>">
											<span class="nomeRlacionado"><?php echo $d->retriveLabel() ?></span>
											<span class="nomeTxt"><?php echo $d->getDescription() ?></span>
										</a>
									  <?php endif; ?>
									</li>
								  <?php endforeach; ?>
								</ul>
							</div>
							<a class="acervoCompleto" href="/rodaviva/programas"><span>Acervo</span></a>
          				</div>
                        <?php endif; ?>
                      <?php endif; ?>
                      
                        <?php if(isset($displays['transmissao'])): ?>
          				<div class="transmissao">
          					<h3>TRANSMISSÃO<?php //echo $displays['transmissao'][0]->Block->getTitle() ?></h3>
          					<div class="box-transmissao">
          						<div class="ao-vivo">
          							<div id="aovivo"><img src="/portal/images/capaPrograma/rodaviva/img-transmissao-02.jpg" alt="Fique ligado!"></div>
          					   </div>
          					   <script type="text/javascript">
          					     timer1();
          					     timer2();
          					   </script>
          						<?php /* 
          						<div class="ao-vivo">
                                  <?php if(date('H:i:s') >= '22:00:00' and date('H:i:s') <= '23:35:00'): ?>
	          						<div id="aovivo"></div>
	          						
                                    <!--script>
                                      var so = new SWFObject('/portal/js/mediaplayer/player.swf','mpl','290','200','9');
                                      so.addVariable('controlbar', 'bottom');
                                      so.addVariable('autostart', 'true');
                                      so.addVariable('streamer', 'rtmp://200.136.27.12/live');
                                      so.addVariable('file', 'tv');
                                      so.addVariable('type', 'video');
                                      so.addParam('allowscriptaccess','always');
                                      so.addParam('allowfullscreen','true');
                                      so.addParam('wmode','transparent');
                                      so.write('aovivo');
                                    </script-->
				                  <?php else: ?>
				                  	<div id="aovivo"><img src="<?php echo $displays['transmissao'][0]->retriveImageUrlByImageUsage('image-11'); ?>" alt="<?php echo $displays['transmissao'][0]->getTitle() ?>" /></div>
				                  <?php endif; ?>
				                </div>
								 */ ?>
								 
				                <div class="ao-vivo-info">
				                	<h4><a href="/rodaviva/transmissao">Fique ligado<?php //echo $displays['transmissao'][0]->getTitle() ?></a></h4>
				                	<p><a href="/rodaviva/transmissao">A transmissão do programa Roda Viva acontece toda segunda-feira, a partir das 22h, pela TV Cultura de São Paulo.<?php //echo $displays['transmissao'][0]->getDescription() ?></a></p>
				                </div>
          					</div>
          				</div>
          				<?php endif; ?>
          				<?php if($displays['charges-do-caruso']): ?>
          				<div class="charges">
          					<h3><?php echo $displays['charges-do-caruso'][0]->Block->getTitle() ?></h3>
          					<div class="box-charges">
          						<div id="gallery">
								    <ul>
								      <?php foreach($displays['charges-do-caruso'] as $k=>$d): ?>
								        <li>
								            <a class="charges_caruso" href="<?php echo $d->retriveImageUrlByImageUsage("image-6-b") ?>" title="<?php echo $d->getTitle() ?>" rel="charges_caruso">
								                <img src="<?php echo $d->retriveImageUrlByImageUsage("image-1-b") ?>" alt="<?php echo $d->getTitle() ?>" />
								            </a>
								        </li>
								      <?php endforeach; ?>
								    </ul>
								</div>
          					</div>
          				</div>
          				<?php endif; ?>
          			</div>
          			<div class="dir">
          				<div class="publicidade">
                          <!-- tvcultura-homepage-300x250 -->
                          <script type='text/javascript'>
                            GA_googleFillSlot("tvcultura-homepage-300x250");
                          </script>
          				</div>
          				<div class="boxRedes">
          					<ul>
          						<li><a class="twitter" href="http://twitter.com/rodaviva" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Siga o @rodaviva</span></a></li>
          						<li><a class="facebook" href="http://www.facebook.com/rodaviva" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Curta a p&aacute;gina no facebook</span></a></li>
          						<li><a class="youtube" href="http://www.youtube.com/rodaviva" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Veja os v&iacute;deos no YouTube</span></a></li>
          						<li><a class="rss" href="http://cmais.com.br/rodaviva/feed" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Feed RSS</span></a></li>
								<li><a class="news" href="javascript:;"><span class="ico"></span><span class="borda"></span><span class="nome">Assine a newsletter</span></a></li>
          					</ul>
							<div id="assine-news">
          						<div class="wrapperAssine-news">
          							<form id="form-contact" name="news" method="post" action="">
	          							<label class="nome">
	          								Nome
	          								<input type="text" name="nome" id="nome">
	          							</label>
	          							<label class="email">
	          								E-mail
	          								<input type="text" name="email" id="email">
	          							</label>
	          							<label for="captcha">
	          								Confirmação
	          								<a class="img" href="javascript:;" onclick="$('#captcha_image').attr('src', '/portal/js/validate/demo/captcha/images/image.php?'+new Date)" id="refreshimg" title="Clique para gerar outro código" style="float:left">
	          									<img src="/portal/js/validate/demo/captcha/images/image.php?1322157115" width="132" height="46" alt="Captcha image" id="captcha_image">
	          								</a>
	          							</label>
                      		            <label class="msg" for="captcha" style="text-transform:lowercase;">
                      		            	Digite no campo abaixo os caracteres que você vê na imagem:
                      		            	<input class="caracteres" type="text" maxlength="6" name="captcha" id="captcha" style="float: left;">
                      		            </label>
	          							<input type="submit" class="assinar" name="newsletter" id="newsletter" value="assinar">
          							</form>          						
          						</div>
          					</div>
          				</div>
						<a class="memRoda" target="_blank" href="http://www.rodaviva.fapesp.br/"><img src="../portal/images/capaPrograma/rodaviva/banner-roda-viva.png" alt="Memória Roda Viva" title="Memória Roda Viva" /></a>
          			</div>
          		</div>
          		<span class="bordaBottomRV"></span>
          	</div>
          </div>
        
        </div>
        <!-- /CONTEUDO PAGINA -->

      </div>
      <!-- /MIOLO -->

    </div>
    </div>
    <!-- / CAPA SITE -->
    

