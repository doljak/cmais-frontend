<link rel="stylesheet" href="/portal/css/tvcultura/sites/amigosecreto.css" type="text/css" />
<script type="text/javascript" src="/portal/js/scrollTo/scripts/jquery.min.js"></script>
<script type="text/javascript" src="/portal/js/scrollTo/scripts/jquery.scrollto.js"></script>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>
<!--/CONTANER-->
<div class="container amigo-secreto">
  <!--CAPA-SITE-->
  <div id="capa-site">
    <!--botao-voltar-->
    <a id="btn-voltar-as" href="/amigosecreto" title="Amigo Secreto"></a>
    <!--/botao-voltar-->
    <?php
    $arrayNome      = array("osorio", "teobaldo", "ludovico", "doroteia", "filomena", "joao", "eric", "pedro", "matheus", "julio", "lilica", "caco");
    $arrayNomeExibi = array("Osório", "Teobaldo", "Ludovico", "Dorotéia", "Filomena", "João", "Eric", "Pedro", "Matheus", "Júlio", "Lilica", "Caco")
    ?>
    <!--DICAS-AS-->
    <div id="dica-as">
      <!--BOTOES PERSONAGENS-->
      <ul>
        <li class="first">
          <div class="btnc-hover-as" name="osorio-asset" title="Osório"></div>
          <a href="#" id="btn-osorio-as" style="opacity: 0.5" title="Osório"></a>
        </li>
        <li>
          <div class="btnc-hover-as"  name="teobaldo-asset" title="Teobaldo"></div>
          <a href="#" id="btn-teobaldo-as" style="opacity: 0.5" title="Teobaldo"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="ludovico-asset" title="Ludovico"></div>
          <a href="#" id="btn-ludovico-as" style="opacity: 0.5" title="Ludovico"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="doroteia-asset" title="Dorotéia"></div>
          <a href="#" id="btn-doroteia-as" style="opacity: 0.5" title="Dorotéia"></a>
        </li>
        <li>
          <div class="btnc-hover-as  selected" name="filomena-asset" title="Filomena"></div>
          <a href="#" id="btnc-filomena-as" title="Filomena"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="joao-asset" title="João"></div>
          <a href="#" id="btn-joao-as" style="opacity: 0.5" title="João"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="eric-asset" title="Eric"></div>
          <a href="#" id="btn-eric-as"  style="opacity: 0.5" title="Eric"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="pedro-asset" title="Pedro"></div>
          <a href="#" id="btn-pedro-as"  style="opacity: 0.5"  title="Pedro"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="matheus-asset" title="Matheus"></div>
          <a href="#" id="btn-matheus-as"  style="opacity: 0.5" title="Matheus"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="julio-asset" title="Júlio"></div>
          <a href="#" id="btn-julio-as"  style="opacity: 0.5" title="Júlio"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="lilica-asset" title="Lilica"></div>
          <a href="#" id="btnc-lilica-as"></a>
        </li>
        <li>
          <div class="btnc-hover-as" name="caco-asset" title="Caco"></div>
          <a href="#" id="btn-caco-as"  style="opacity: 0.5" title="Caco"></a>
        </li>
       
      </ul>
      <!--/BOTOES PERSONAGENS-->
      <!--BLOG-AS-->
      <div id="blog-as">
        <!--DIV NAO APAGAR-->
        <div style="padding:1px"></div>
        <!--/DIV NAO APAGAR-->
        <?php
        for($j=0;$j<count($arrayNome); $j++):
        $nome = $arrayNome[$j];
        ?>
          <!--ASSET-->
          <a id="<?php echo $arrayNome[$j]?>-asset"></a> 
            <?php if(isset($displays[$nome])): ?>
              <?php if(count($displays[$nome]) > 0): ?>
                <?php foreach($displays[$nome] as $k=>$d): ?>
                  <div class="blog-as-header">
                    <i class="ico-lateral"></i><h1><?php echo $d->getTitle() ?></h1>
                  </div>
                  <div class="blog-as-body">
                    <?php echo html_entity_decode($d->Asset->AssetContent->render()) ?>  
                  </div>        
                <?php endforeach; ?>
              <hr class="divisor"/> 
              <?php endif;?>
            <?php endif; ?>
   
          <!--ASSET-->
        <?php endfor;?>
      </div>
      <!--/BLOG-AS-->
    </div>
    <!--/DICAS-AS-->
   </div>
  <!--/CAPA-SITE-->
</div>
<!--/CONTANER-->
<script>
  $(document).ready(function(){
    goTop('osorio-asset')
    $('a[id|=btnc]').hover(function(){
      $(this).prev('.btnc-hover-as').css('display','block');
    });
    $('.btnc-hover-as').mouseout(function(){
      $(this).not('.selected').css('display','none');
    });
    $('.btnc-hover-as').click(function(){
      //alert($(this).attr('name'))
      $('.btnc-hover-as').css('display','none').removeClass('selected');
      $(this).addClass('selected');
      goTop($(this).attr('name'));
    });
    function goTop(id){
      $('#'+id).ScrollTo({
       duration: 1500,
       onlyIfOutside: true
      });
    }
  });
</script>