  $(function(){
     
    var $container = $('#container');
    
    $container.isotope({
      itemSelector : '.element',
      layoutMode:'fitRows'
    }); 
    
    var filter_selected;
    
    //filtro personagens para atividades, jogos e videos
    $('.filtro-personagem a').click(function(){
      var $i=0;
      var $j=0
      var $select = '';
      filter_selected = "";
      
      $(this).parent().parent().toggleClass("ativo");

      $('.filtro-personagem li.ativo').each(function(i){
        
        
        filter_selected += $(this).find('a').attr('data-filter') + ",";
        $select += $(this).find('a').attr('data-filter') + ', ';
        
        $(this).find('img').css('top','33px!important');
        
        $i++;
        
        
      });
      
      $container.isotope({ filter:filter_selected });
      
      $('#container.isotope .element').each(function(i){
        if(!$(this).hasClass('isotope-hidden')){
          $j++;
        }
      });

      if($i > 0){
        $('#filtro-descricao').html('<span>Você selecionou filtrar os links pelos personagens:' + $select +'com '+ $j +' itens</span>');
      }else{
        $('#filtro-descricao').html('Todos os links dos personagens estão ativos');
      }
      
      return false;
    });
    
    
    //filtro artigos por categoria
    $('.dropdown-menu li a').click(function(){ 
      var $i=0;
      var $j=0
      var $select_cat = $(this).attr('data-filter');
      filter_selected = $select_cat;
      
      $container.isotope({ filter:filter_selected });
      
      return false;
    });
    
    /*lista destaque small
     $('.todos-itens li').each(function(i){
       el = $(this);
       if(i%3==0){
         $(el).css('margin-left', '0px');
         //$(el).css('clear', 'both');
         //i = 0;
       }else{
         $(el).css('margin-left', '15px');
         i++;
       }
     });*/
    
  });
  
 