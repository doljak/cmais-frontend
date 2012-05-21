<?php /*
 if((date('H:i:s') >= '18:00:00') && (date('w') == 1))  {
 header('Location: http://tvcultura.cmais.com.br/metropolis/bastidores');
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
	function timer1() {
		var request = $.ajax({
			data : {
				asset_id : '32782',
				url_in : 'http://tvcultura.cmais.com.br/metropolis/transmissao'
			},
			dataType : 'jsonp',
			success : function(data) {
				eval(data);
			},
			url : '/ajax/timer'
		});
	}

	function timer2() {
		var request = $.ajax({
			data : {
				asset_id : '32761',
				url_in : 'http://tvcultura.cmais.com.br/metropolis/bastidores'
			},
			dataType : 'jsonp',
			success : function(data) {
				eval(data);
			},
			url : '/ajax/timer'
		});
	}


	$(window).load(function() {
		var t = setInterval("timer1()", 60000);
		var t = setInterval("timer2()", 60000);
	});
	$(function() {

		// destaque principal
		$('#slider').nivoSlider({
			pauseTime : 10000,
			effect : 'fade'
		});
		$('.destaque').show();

		// acervo em destaque
		$('.carrossel').jcarousel({
			wrap : "both"
		});
		$('.acervoDestaque').show();

		// charges caruso
		$('a.charges_caruso').fancybox();
		//$('#gallery ul li:last').remove();

		// Newsletter
		$("#assine-news").hide();
		$("a.news").click(function() {
			$("#assine-news").slideToggle("slow");
			return true;
		});
		// Validador Newsletter
		var validator = $("#form-contact").validate({
			rules : {
				nome : {
					required : true,
					minlength : 2
				},
				email : {
					required : true,
					email : true
				},
				captcha : {
					required : true,
					remote : "/portal/js/validate/demo/captcha/process.php"
				}
			}
		});

		// comportamento dos botões das redes sociais
		$('.boxRedes li a.twitter').mouseover(function() {
			$('.boxRedes li a.twitter .nome').css('color', '#3399ff');
		});
		$('.boxRedes li a.twitter').mouseout(function() {
			$('.boxRedes li a.twitter .nome').css('color', '#5b5a50');
		});
	});

</script>
<?php use_helper('I18N', 'Date')
?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section))
?>

<!-- CAPA SITE -->
<div class="bg-metropolis">
	<div id="capa-site">
		<!-- BREAKING NEWS -->
		<?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"]))
		?>
		<!-- /BREAKING NEWS -->
		<!-- BARRA SITE -->
		<div id="barra-site">
			<div class="topo-programa">
				<h2><a href="http://www.cmais.com.br/metropolis" title="Metrópolis"> <img title="Metrópolis" alt="Metrópolis" src="/portal/images/capaPrograma/metropolis/logometropolis.png"> </a></h2>
				<!--
				<?php if(isset($program) && $program->id > 0):
				?>
				<h2><a href="<?php echo $program->retriveUrl() ?>" title="<?php echo $program->getTitle() ?>"> <img title="<?php echo $program->getTitle() ?>" alt="<?php echo $program->getTitle() ?>" src="/uploads/programs/<?php echo $program->getImageThumb() ?>"> </a></h2>
				<?php endif;?>
				-->
				<?php if(isset($program) && $program->id > 0):
				?>
				<?php include_partial_from_folder('blocks','global/like', array('site' => $site, 'uri' => $uri, 'program' => $program))
				?>
				<?php endif;?>

				<?php if(isset($program) && $program->id > 0):
				?>
				<!-- horario -->
				<div id="horario">
					<p>
						<?php echo html_entity_decode($program->getSchedule())
						?>
					</p>
				</div>
				<!-- /horario -->
				<?php endif;?>
			</div>
			<div class="box-topo grid3">
				<?php if(count($siteSections) > 0):
				?>
				<ul class="menu">
					<?php foreach($siteSections as $s):
					?>
					<li>
						<a href="<?php echo $s->retriveUrl() ?>" title="<?php echo $s->getTitle() ?>"><span><?php echo $s->getTitle()
							?></span></a>
					</li>
					<?php endforeach;?>
				</ul>
				<?php endif;?>
			</div>
			<!-- /box-topo -->
		</div>
		<!-- /BARRA SITE -->
		<!-- MIOLO -->
		<div id="miolo">
			<!-- BOX LATERAL -->
			<?php include_partial_from_folder('blocks','global/shortcuts')
			?>
			<!-- BOX LATERAL -->
			<!-- CONTEUDO PAGINA -->
			<div id="conteudo-pagina exceptionn">
				<!-- CAPA -->
				<div class="capa grid3 exceptionn">
					<div class="tudo-metropolis">
						<span class="bordaTopRV"></span>
						<div class="centroRV">
							<?php if(isset($displays['destaque-principal'])):
							?>
							<?php if(count($displays['destaque-principal']) > 0):
							?>
							<div class="destaque">
								<div id="wrapper">
									<div class="slider-wrapper">
										<div class="ribbon"></div>
										<div id="slider" class="nivoSlider">
											<?php foreach($displays['destaque-principal'] as $k=>$d):
											?>
											<?php if($d->Asset->AssetType->getSlug() == "image"):
											?>
											<a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>"><img src="<?php echo $d->retriveImageUrlByImageUsage('image-10-b') ?>" alt="<?php echo $d->Asset->getTitle() ?>" title="#<?php echo $d->getId() ?>" /></a>
											<?php endif;?>
											<?php endforeach;?>
										</div>
										<?php foreach($displays['destaque-principal'] as $k=>$d):
										?>
										<?php if($d->Asset->AssetType->getSlug() == "image"):
										?>
										<div id="<?php echo $d->getId() ?>" class="nivo-html-caption">
											<h4 style="color:#333;font-size:14px;font-weight:normal;margin-top:25px;width:275px"><?php echo strtoupper($d->getTitle())
											?></h4>
											<h2 style="color:#333;font-size:24px;font-weight:normal;margin-top:10px;line-height:25px;width:275px"><a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>" style="font-size:24px"><?php echo $d->getHeadline()
											?></a></h2>
											<p style="color:#333;font-size:14px;margin-top:10px;margin-left:-25px;width:255px">
												<a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>"><?php echo $d->getDescription()
												?></a>
											</p>
										</div>
										<?php endif;?>
										<?php endforeach;?>
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php endif;?>
							<div class="esq">
								<?php if(isset($displays['destaque-playlist'])):
								?>
								<?php if(count($displays['destaque-playlist']) > 0):
								?>
								<div class="acervoDestaque">
									<h3><?php echo $displays['destaque-playlist'][0]->Block->getTitle()
									?></h3>
									<div class="carrossel">
										<ul>
											<?php foreach($displays['destaque-playlist'] as $k=>$d):
											?>
											<li>
												<?php if($d->retriveImageUrlByImageUsage("image-2") != ""):
												?>
												<a class="aImg" href="<?php echo $d->retriveUrl() ?>"> <img src="<?php echo $d->retriveImageUrlByImageUsage("image-2") ?>" alt="<?php echo $d->getTitle() ?>" /> <span class="ico"></span> </a>
												<?php endif;?>
												<?php if($d->retriveLabel() != ""):
												?>
												<a class="aTxt" href="<?php echo $d->retriveUrl() ?>"> <span class="nomeRlacionado"><?php echo $d->retriveLabel()
													?></span> <span class="nomeTxt"><?php echo $d->getDescription()
													?></span> </a>
												<?php endif;?>
											</li>
											<?php endforeach;?>
										</ul>
									</div>
									<a class="acervoCompleto" href="/metropolis/programas"><span>Acervo</span></a>
								</div>
								<?php endif;?>
								<?php endif;?>
								<div class="grid1" style="margin-right:10px; ">
									<?php if(isset($displays["destaque-padrao-1"])) include_partial_from_folder('sites/metropolis','global/display1c-news', array('displays' => $displays["destaque-padrao-1"])) ?>
								</div>
								<div class="grid1">
									<?php if(isset($displays["destaque-padrao-2"])) include_partial_from_folder('sites/metropolis','global/display1c-news', array('displays' => $displays["destaque-padrao-2"])) ?>
								</div>
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
										<li>
											<a class="twitter" href="http://twitter.com/metropolis" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Siga o @metropolis</span></a>
										</li>
										<li>
											<a class="facebook" href="http://www.facebook.com/metropolis" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Curta a p&aacute;gina no facebook</span></a>
										</li>
										<li>
											<a class="youtube" href="http://www.youtube.com/metropolis" target="_blank"><span class="ico"></span><span class="borda"></span><span class="nome">Veja os v&iacute;deos no YouTube</span></a>
										</li>
									</ul>
								</div>
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
