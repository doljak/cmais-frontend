<?php include_partial_from_folder('blocks', 'global/topo-fpa', array('siteSections'=>$siteSections, 'site' => $site, 'section' => $section)) ?>
<!--container-->
<div class="container">
  <?php include_partial_from_folder('sites/central-de-relacionamento', 'global/topo', array('site' => $site,'siteSections' => $siteSections, 'section' => $section)) ?>
  <!--colunas-->
  <div class="row-fluid">
    <!--coluna esquerda-->
     
    <div class="col-esquerda span5">
      <a id="perguntas"></a>
      <h1>PERGUNTAS FREQUENTES</h1>
      
      <p> 
        A Central de Relacionamento é uma área
        de atendimento exclusiva para telespectadores
        e ouvintes de nossas emissoras. Queremos  conhecer
        melhor e estreitar nossos laços com o público de nossas
        emissoras, por isso seu contato e a sua opinião são muito
        importantes para a Fundação Padre Anchieta.<br/>
        Antes de enviar sua mensagem, verifique se sua pergunta
        ou informação não está contemplada nos itens 
        <?php foreach($section->Blocks as $b): ?>
          <?php if(count($b->Displays) > 0): ?>
            <a href="javascript:;" id="#<?php echo $b->getSlug() ?>"><?php echo $b->getDescription() ?>,</a>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php /* if(isset($displays)):?> 
          <?php if(count($displays) > 0): ?>
             <?php foreach($displays as $display): ?>
               <?php if(count($display) > 0): ?>
              <a href="javascript:;" id="#<?php echo $display[0]->Block->getSlug() ?>"><?php echo $display[0]->Block->getDescription() ?>,</a>
               <?php endif; ?>
            <?php endforeach; ?>  
          <?php endif; ?>
        <?php endif; */ ?>        
        Perguntas Frequentes.
      </p>
    </div>
    <!--/coluna esquerda-->
    <!--coluna direita-->
    <div class="col-direita pull-right span7 ">
    <?php if(isset($displays)):?>
     <?php if(count($displays) > 0): ?>
       <!-- COLUNA SUB DIR 1 -->
       <?php $i = 1; ?>
       <?php foreach($displays as $display): ?>
         <?php if(count($display) > 0): ?>
           <!--ancora-->
           <a id="<?php echo $display[0]->Block->getSlug() ?>"></a>
           <!--/ancora-->
           <div id="<?php echo $display[0]->Block->getId() ?>" class="coluna-sub cinza-claro-2">
             <span class="titulo bold"><?php echo $display[0]->Block->getDescription() ?></span>
              <!-- COLUNA SUB DIR 2 -->
              <div id="col-sub" class="texto-preto">
               <ul>
               <?php foreach($display as $value=>$d): ?>
                 <li class="<?php if($value%2==0){echo "tarja1";}else{echo "tarja2";}?>">
                   <i class="icon-circle-arrow-right"></i>  
                   <a href="javascript:;" class="formas" data-toggle="collapse" data-parent="#<?php echo $display[0]->Block->getSlug() ?>" data-target="#<?php echo $display[0]->Block->getId()."-".$display[$value]->Asset->getId() ?>">
                     <?php echo $d->Asset->getTitle() ?>
                   </a>
                   <div id="<?php echo $display[0]->Block->getId()."-".$display[$value]->Asset->getId() ?>" class="fundo-cinza collapse in"style="overflow: hidden; clear: both;">
                     <?php echo html_entity_decode($d->Asset->AssetContent->render()) ?> 
                   </div>
                 </li>
              <?php $i++; ?>
              <?php endforeach; ?>
              </ul>    
              </div>
                <a id="voltar" class="voltar-perguntas pull-right" href="javascript:;" >voltar</a> 
              </div>
           <?php endif; ?>
         <?php endforeach; ?>         
         <!-- /COLUNA SUB DIR 1 -->
      <?php endif; ?> 
    <?php endif; ?>
    <!--pergunta-->
    </div>   
    <!--/coluna direita-->
  </div>
  <!--/colunas-->  
</div>
<!--container--> 
<script>
$(document).ready(function(){
  $(".collapse").collapse();
  $(".dicas").click(function(){
    $(this).prev().toggleClass('icon-minus');
  });
  $('.formas').click(function(){
    $(this).prev().toggleClass('icon-circle-arrow-down');
    goTop($(this).attr('data-parent'));
  });
  $('.col-esquerda a').click(function(){ 
    goTop($(this).attr('id'));
  });
  $('.voltar-perguntas').click(function(){ 
    goTop('#fundo-topo');
  });
  function goTop(id){
    $('html, body').animate({
      scrollTop: $(id).offset().top
    }, "slow");
  }
});
</script>

