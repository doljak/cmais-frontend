<link rel="stylesheet" href="/portal/css/tvcultura/sites/segundatela/index.css?nocache=<?php echo time()?>" type="text/css" />

    <?php
      // live
      $live = Doctrine_Query::create()
      ->select('s.*')
      ->from('Schedule s')
      ->where('s.channel_id = ?', (int)1)
      ->andWhere('s.date_start <= ? AND s.date_end > ?', array(date('Y-m-d H:i:s', time()), date('Y-m-d H:i:s', time())))
      ->fetchOne();
    ?>
  
  <script>
     $(document).ready(function() {
     $('h1').hide();
     });  
  </script>
    
        
<div class="bgtopo2">
  <!--container-->
  <div class="container">
    <div class="bgtopo3"></div>
    <!-- topo-pg -->
    <div class="hero-unit">
      <div class="bgtopo"></div>
      <div class="col-esq">
        <h1>SEGUNDA TELA</h1>
        <p>Informações extras e pontos importantes,<br> em tempo real na programação da Cultura</p>
        <div class="redes">
          <div class="gplus">
            <g:plusone size="medium" count="false"></g:plusone>
          </div>
          <div class="fb">
            <fb:like href="http://cmais.com.br/segundatela" layout="button_count" show_faces="false" send="false" width="160"></fb:like>
          </div>
          <div class="twt">
            <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="portalcmais" data-related="tvcultura">Tweet</a>
          </div>
        </div>
      </div>
    </div>
    <!--/topo-pg-->
    <!--corpo-->
    <div class="row-fluid">
      <!--item-->
      <div class="span4 item" style="margin-left:0px;">
        <a href="http://cmais.com.br/segundatela/jornaldacultura">
          <div class="logo-programa">
            <img src="http://midia.cmais.com.br/programs/457e9bcad211c9c44b0e6dac2e603361c3d1baa8.png">
          </div>
          <div class="live-image">
            <img src="http://midia.cmais.com.br/programs/f277ca8606ddbca46ece887e5693a20c1d808e2d.jpg" alt="Jornal da Cultura">

          <?php if ($live->Program->id == "787" ): ?>  
            <span>NO AR</span>
          <?php endif; ?>

          </div>
          <p>
            Os principais fatos do <br>dia no Brasil e no mundo.
            <br>
            Segunda a sábado, às 21h
          </p>
        </a>
      </div>
      <!--/item--> 
      <!--item-->
      <div class="span4 item">
        <a href="http://cmais.com.br/segundatela/rodaviva">
          <div class="logo-programa">
            <img title="Roda Viva" alt="Roda Viva" src="http://midia.cmais.com.br/programs/891dc87780b6df7358a6960f7cf3966549229f45.png">
          </div>
          <div class="live-image">
            <img src="http://midia.cmais.com.br/programs/32129e1ef151f91bb63cd8ff2671f5e2715f043c.jpg" alt="Roda Viva ">
            <span>NO AR</span>
          </div>
          <p>
            O Brasil passa por aqui.
            <br>
            Segunda às 22h
          </p>
        </a>
      </div>
      <!--/item-->
      <!--item-->
      <div class="span4 item">
        <a href="http://cmais.com.br/segundatela/cartaoverde">
          <div class="logo-programa">
            <img src="http://midia.cmais.com.br/programs/fb83d5f012d0b874aaa1fa535b9317d3e3131848.png">
          </div>
          <div class="live-image">
           <img src="http://midia.cmais.com.br/programs/6c50d7937cd92a91939f94c3ef10aee1b2e06e47.jpg" alt="Cartão Verde">
           <span>NO AR</span>
          </div>
          <p>
            Futebol discutido com inteligência<br> e bom humor.
            <br>
            Terça, às 22h
          </p>
        </a>
      </div>
      <!-- /item-->
      <!--item>
      <div class="span3 item">
        <a href="#">
          <div class="logo-programa">
            <img src="http://midia.cmais.com.br/programs/74b7749b23a34a2a5cb6de4c04a40e1ef23d8c82.png">
          </div>
          <div class="live-image">
           <img src="http://midia.cmais.com.br/programs/393b1eb8dae28a0d1605345fae59601cc826afc5.jpg" alt="Mad Men">
          </div>
          <p>
            O que você é, o que você quer, o que ama, nada disso importa. O importante é o que você vende.
            <br>
            Segunda às 22h
          </p>
        </a>
      </div>
      <!item -->
      
    </div>  
    <!--corpo-->
    <div class="row-fluid" style="margin-top:20px;clear:both;">
      <div class="span8" style="margin-left:0px;">
        <h2>COMO FUNCIONA O SEGUNDA TELA</h2>
        <p>
         A Segunda Tela (ou Second Screen) é um complemento em tempo real à televisão (a primeira tela). 
Ao utilizá-la, seja em computadores, smartphones ou tablets, o “teleinternauta” recebe informações extras e pontos importantes sobre o assunto que está sendo tratado no programa que está no ar no momento. 
Por exemplo, se o Jornal da Cultura veicula uma matéria sobre o mercado imobiliário, o usuário recebe em sua Segunda Tela, simultaneamente, conteúdos e dicas complementares à reportagem, como um histórico dos preços de imóveis nos últimos meses e telefones úteis para obter mais informações sobre 
o assunto. E essa é apenas uma das muitas possibilidades que a Segunda Tela oferece! Fique ligado 
no cmais+ e na programação da TV Cultura para descobrir as próximas novidades que surgirão com o uso desta nova ferramenta de interatividade! 
        </p>  
      </div>   
      <div id="double-click" class="span4" style="display:none;">
        <!-- publicidade -->
        <!-- home-geral300x250 -->
        <script type='text/javascript'>
              GA_googleFillSlot("tvcultura-homepage-300x250");
        </script>
       <!-- /publicidade -->
      </div>
    </div>        

  </div>
  <!--/container-->
</div>
