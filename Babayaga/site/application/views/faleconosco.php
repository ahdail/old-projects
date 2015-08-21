<?php include("inicio.inc.php"); ?>




<div id="faleconosco_diret">
    <img src="<?php echo base_url()?>site/images/telefone_g.png" width="431" height="387" /></p>
<p class="textonormal"><img src="<?php echo base_url()?>site/images/tit_nossalocalizacao2.gif" width="243" height="38" /></p>
<iframe width="400" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $row['localizacao']?>"></iframe><br /><small class="textonormal">Visualizar <a href="http://maps.google.com.br/maps/ms?oe=utf-8&amp;client=firefox-a&amp;ie=UTF8&amp;fb=1&amp;gl=br&amp;hnear=Fortaleza+-+CE&amp;hl=pt-BR&amp;view=map&amp;ved=0CCsQpQY&amp;ei=dFXtTMOWN6TuyAXRqMHNBg&amp;msa=0&amp;msid=107609155395532369178.000495d07bd419030d1ed&amp;ll=-3.744929,-38.522422&amp;spn=0.001338,0.002146&amp;z=18&amp;source=embed" style="color:#0000FF;text-align:left">Babayaga</a> em um mapa maior</small>
    <p class="textonormal"><br />
    </p>
  </div>
  <div id="faleconosco">
<span class="TitulosGrandes">Fale conosco</span>
<p class="textonormal"><?php echo $felecom['mensagem']?></p>

		<?php if (validation_errors()) { ?>
		<div class="msgErro"><?php echo validation_errors(); ?></div>
		<?php }  ?>
		<?php if ($sucesso) { ?>
		<div class="msgOk"><?php echo $sucesso; ?></div>
		<?php }  ?>


<form id="form1" name="form1" method="post" action="<?php echo base_url()?>faleconosco/enviar">
  <p><span class="textonormal">nome</span><br />
  <input name="nomeremetente" type="text" class="formulario" id="textfield" value="" />
  </p>
  <p><span class="textonormal">e-mail</span><br />
    <input name="emailremetente" type="text" class="formulario" id="textfield" value="" />
</p>
  <p><span class="textonormal">telefone</span><br />
    <input name="telefoneremetente" type="text" class="formulario" id="textfield" value="" />
</p>
  <p><span class="textonormal">assunto</span><br />
    <input name="assuntoremetente" type="text" class="formulario" id="textfield" value="" />
  </p>
  <p><span class="textonormal">mensagem</span><br />
    <textarea name="mensagemremetente" cols="45" rows="5" class="formulario" id="textarea"></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="enviar" style="color:#ffffff; border-color:#ffffff;background:#5E0E11;font-weight:bold;width:60px;height:25px;"/>
	<input type="reset" name="button" id="button" value="limpar" style="color:#ffffff; border-color:#ffffff;background:#5E0E11;font-weight:bold;width:60px;height:25px;" />
	<input type="hidden" name="enviar" id="button" value="true" />
  </p>
</form>
<img src="<?php echo base_url()?>site/images/grafico_endereco.gif" width="445" height="57" /><span class="texto_bold_italic">Nosso Endereço</span><br />
  <span class="textonormal"><?php echo $row['endereco']?></span>
<p class="textonormal"><span class="texto_bold_italic">Nosso Telefone</span><br />
  <?php echo $row['telefone']?></p>
<p class="textonormal"><span class="texto_bold_italic">Nosso E-mail</span><br />
  <?php echo $row['email']?></p>
<p class="texto_bold_italic"><span class="Titulos">Babayaga nas midias sociais</span> | siga-nos<br />
  <img src="<?php echo base_url()?>site/images/blogger+twitter.jpg" width="225" height="57" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="116,10,217,42" href="#" />
    <area shape="rect" coords="4,8,99,42" href="http://babayagaonline.blogspot.com/" />
  </map>
  <br />
</p>
<p class="textonormal">&nbsp;</p>
  </div>


<?php include("final.inc.php");?>