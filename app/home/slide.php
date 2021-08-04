<? include(ACOES_APP_PATH."/home/slide.php"); ?>
<section class="slide-home">

	<? foreach ($slides as $slide) { ?>

    <!-- Repete -->
    <a class="slide-item" href="<?=$slide['url']?>" <?=$slide['target']?>>
      <div class="slide-image" style="background-image: url('<?=URL?>uploads/img/slide/<?=$slide['id']?>/thumb-2000-0/<?=$slide['foto']?>');"></div>
      <span class="slide-mask">	
      </span>
    </a>
    <!-- Repete -->

  <? } ?>

</section>

<!-- Divisor -->
<div class="section-divider sd-m19">
  <div class="section-divider-inner">
    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 75">
      <path d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
      <path opacity="0.5" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
      <path opacity="0.5" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
      <path opacity="0.5" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
    </svg>
  </div>
</div>
<!-- /.Divisor -->
