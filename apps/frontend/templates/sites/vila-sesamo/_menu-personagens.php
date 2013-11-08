      <!--nav filtro personagem-->
      <nav role="navigation" class="span2">
        <h3>escolha o personagem</h3>
        <h3 aria-live="polite" id="filtro-descricao">todas as atividades estão para selecionar</h3>
        <ul class="filtro-personagem">
          
          <?php if(isset($personagens)): ?>
            <?php if(count($personagens) > 0 ): ?>
              <?php foreach($personagens as $p): ?>
                <li>
                  <div class="inner personagem <?php echo $p->getSlug() ?>">
                    <a href="<?php echo $site->retriveUrl() ?>/<?php echo $section->getSlug() ?>/<?php echo $p->getSlug(); ?>" target="_self" class="btn-<?php echo $p->getSlug() ?> <?php if($section->getSlug() == $p->getSlug()) echo "active"?>" data-filter=".<?php echo $p->getSlug() ?>">
                      <img src="http://cmais.com.br/portal/images/capaPrograma/vilasesamo2/botoes-carrossel/<?php echo $p->getSlug() ?>_personagem.png" alt="filtro <?php echo $p->getTitle() ?>" />
                    </a>
                  </div>
                </li>
              <?php endforeach;?>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </nav>
      <!--/nav filtro personagem-->
      <?php if($section->Parent->getSlug() != "personagens"): ?>
      <script>
        $('.inner a').not('.inner a.active').click(function(){
          var who = $(this).attr('href');
          window.location.assign(who)
          
        })
      </script>  
      <?php endif; ?>
      
      <script>  
        $('.inner a[class|="btn"]').click(function(){
          goTop();  
        });
        
        function goTop(){
          $('html, body').animate({
            scrollTop:parseInt($('.divisa').offset().top-126)
          }, "slow");
        }
        
        $('.inner a').not('.inner a.active').mouseenter(function(){
         if($(this).parent().hasClass('jogos')){ 
          $(this).find('img').animate({top:-33, easing:"swing"},'fast');
         }else{
          $(this).find('img').animate({top:-25, easing:"swing"},'fast');  
         }
        });
        $('.inner a').not('.inner a.active').mouseleave(function(){
          if(!$(this).parent().parent().hasClass('ativo')){
            $(this).find('img').stop();
            $(this).find('img').animate({top:0, easing:"swing"},'fast'); 
          } 
        });
      </script>