<?php include("inicio.inc.php"); ?>




<div id="areadefoto" style="margin:20px;">
    <p><img src="<?php echo base_url();?>site/images/aempresa_babayaga.png" width="260" height="405" /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>

  <div id="areadefoto" style="width:600px;margin:20px;">
    <span class="TitulosGrandes">A empresa</span>
    <p>&nbsp;</p>
    
    <span class="textonormal"><?php echo $empresa['descricao']?></span><br /><br />
   
    <span class="textonormal"><?php echo $empresa['missao']?></span>
    <p>&nbsp;</p>
	
  </div>
  


<?php include("final.inc.php");?>