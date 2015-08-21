<?php
if (!$session_idUsuario){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	checkLogin($session_email);
}
?>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>

<script>
function mostrarForm(nome){
	ocultarForms();
	
	document.getElementById(nome).style.display 	= "block";
}
function ocultarForm(nome) {
	document.getElementById(nome).style.display 	= "none";
}
function ocultarForms(){
	ocultarForm("vf_valorPresente");
	ocultarForm("vf_valorFuturo");
	ocultarForm("vp_valorFuturo");
	ocultarForm("vp_valorPrestacao");
	ocultarForm("cd_valorNominal");
	ocultarForm("cp_valorPresente");
	ocultarForm("cp_valorFuturo");
	ocultarForm("tj_taxaEquivalente");
	ocultarForm("tf_matematicaFinanceira");
	ocultarForm("tf_taxaEquivalente");
	ocultarForm("pa_sfa");
	ocultarForm("pa_sac");
	ocultarForm("pa_sma");
	ocultarForm("apm_precoVenda");
	ocultarForm("apm_descontoDuplicata");
	ocultarForm("apm_vistaPrestacaoCartao");
}
</script>

<style>
#vf_valorPresente, #vf_valorFuturo, #vp_valorFuturo, #vp_valorPrestacao, #cd_valorNominal, #cp_valorPresente, #cp_valorFuturo, #tj_taxaEquivalente, #tf_matematicaFinanceira, #tf_taxaEquivalente, #pa_sfa, #pa_sac, #pa_sma, #apm_precoVenda, #apm_descontoDuplicata, #apm_vistaPrestacaoCartao {
	display: none;
}
</style>

<!-- CONTEÚDO -->
<div id="divConteudo">
	<h1 class="titulo">Cálculos Financeiros</h1>
	<div class="divisa"></div>
	<p>Selecione que tipo de cálculo você deseja fazer e preencha os campos	com os valores.</p>
	
	<!-- O FORMULÁRIO DE CÁLCULOS -->
    <center>
    <select onchange="mostrarForm(this.value)">
    	<option>SELECIONE UM OPÇÃO</option>
    	<optgroup label="Cálculo do Valor Futuro">
    		<option value='vf_valorPresente'>Dado Valor Presente</option>
    		<option value='vf_valorFuturo'>Dado Valor da Prestação</option>
    	</optgroup>
    	<optgroup label="Cálculo do Valor Presente">
    		<option value='vp_valorFuturo'>Dado Valor Futuro</option>
    		<option value='vp_valorPrestacao'>Dado Valor da Prestação</option>
    	</optgroup>
    	<optgroup label="Cálculo do Desconto">
    		<option value='cd_valorNominal'>Dado Valor Nominal</option>
    	</optgroup>
    	<optgroup label="Cálculo da Prestação">
    		<option value='cp_valorPresente'>Dado Valor Presente</option>
    		<option value='cp_valorFuturo'>Dado Valor Futuro</option>
    	</optgroup>
    	<optgroup label="Cálculo da Taxa de Juros">
    		<option value='tj_taxaEquivalente'>Taxa Equivalente</option>
    	</optgroup>
    	<optgroup label="Tabelas Financeiras">
    		<option value='tf_matematicaFinanceira'>Fatores da Matemática Financeira</option>
    		<option value='tf_taxaEquivalente'>Taxas Equivalentes</option>
    		<option disabled="disabled">Tabela Price (em construção)</option>
    	</optgroup>
    	<optgroup label="Planilhas de Amortização">
    		<option value='pa_sfa'>Sistema Francês de Amortização - SFA</option>
    		<option value='pa_sac'>Sistema de Amortização Constante - SAC</option>
    		<option value='pa_sma'>Sistema Misto de Amortização - SMA</option>
    		<option disabled="disabled">Sistema de Amoritzação Crescente - SACRE (SFH) (em construção)</option>
    	</optgroup>
    	<optgroup label="Aplicações Práticas do Mercado">
    		<option value='apm_precoVenda'>Formação do Preço de Venda</option>
    		<option value='apm_descontoDuplicata'>Desconto de Duplicata</option>
    		<option value='apm_vistaPrestacaoCartao'>Comprar à Vista, Prestação ou Cartão?</option>
    	</optgroup>
    </select>
    </center>
    <!--  -->
    <div id="vf_valorPresente">
    
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo do Valor Futuro  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<!-- <form method="post" action="valor_futuro.php?&amp;page=/valor_futuro_form.php" name="form_input">-->
<form method="post" action="../../calcfin/valor_futuro.php?&amp;page=/valor_futuro_form.php" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
	<table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
	<tbody>
		<tr>
			<td bgcolor="#eeeeee" align="right">
				<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
					Valor Presente:
	        	</font>
			</td>
			<td>
				<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
					<input type="text" maxlength="20" value="" size="20" onkeydown="" name="vr_presente"/>
				</font>
			</td>
		</tr>
	<tr>
		<td bgcolor="#eeeeee" align="right">
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
				Prazo:
			</font>
		</td>
		<td>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
				<input type="text" maxlength="5" value="" size="5" onkeydown="" name="prazo"/> dias
	        </fon>
		</td>
    </tr>
	<tr>
		<td bgcolor="#eeeeee" align="right">
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          		Taxa de Juros:
        	</font>
      	</td>
		<td>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
				<input type="text" maxlength="8" value="" size="8" onkeydown="" name="tx_juros"/> % aos <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodo_tx"/> dias
			</font>
		</td>
	</tr>
	<tr>
		<td bgcolor="#eeeeee" align="right">
        	<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
				Modalidades:
			</font>
		</td>
		<td>
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
			<input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_comp"/>Juros Compostos<br/>
			<input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_simp"/>Juros Simples
			</font>
		</td>
	</tr>
	</tbody>
	</table>

	<br/>
	<div align="center">
	    <input type="submit" name="submit" value="Calcular" />
	    <input type="reset" name="reset" value="Apagar"/>
	</div>
</form>
<br/>
	</td>    
   <!--
		<h2 class="centro">Cálculo do Valor Futuro</h2>
		<p class="centro">(Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)</p>
		<br />
		<div class="meio" style="display: table; *margin-left: 100px">
			<label style="width: 110px">Valor Presente: </label>
			<input type="text" name="vr_presente" value="" /><br />
			<label style="width: 110px">Prazo: </label>
			<input type="text" name="prazo" value="" /><span> dias</span><br />
			<label style="width: 110px">Taxa de juros: </label>
			<input type=text name="tx_juros" onkeydown="" size=8 value="" maxlength=8 /><span> % aos </span> 
			<input type=text name="periodo_tx" onkeydown="" size=5 value=""	maxlength=5 /><span> dias</span><br />
			<label style="width: 110px">Modalidades: </label>
			<input type="checkbox" name="mod_comp" checked="checked" /><span>Juros Compostos</span>
			<input type="checkbox" name="mod_simp" checked="checked" /><span>Juros Simples</span><br />
		</div>
		<br />
		<div class="centro">
			<input type=submit value="Calcular" name="submit">
			<input type=reset value="Apagar" name="reset">
		</div>  -->
	</div> 
    <!--  -->
    <div id="vf_valorFuturo">

<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo do Valor Futuro dado Valor da Prestação  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/valor_futuro_pmt.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor da Prestação:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" value="" size="20" onkeydown="" name="vr_pmt"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" size="5" onkeydown="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" value="" size="8" onkeydown="" name="taxa"/> % aos <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Modalidades:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_post"/>Postecipada (sem entrada)<br/>
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_ant"/>Antecipada (com entrada)
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>   
    
    <!--
		<h2 class="centro">Cálculo do Valor Futuro dado Valor da Prestação</h2>
		<p class="centro">(Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)</p>
		<br />
		<div class="meio" style="display: table; *margin-left: 100px">
			<label style="width: 190px">Valor da Prestação: </label>
			<input type=text name="vr_pmt" /><br />
			<label style="width: 190px">Quantidade de Prestações: </label>
			<input type=text name="quant_prestac" /><br />
			<label style="width: 190px">Periodicidade: </label>
			<input type=text name="periodicidade" /><span> dias</span><br />
			<label style="width: 190px">Taxa de Juros: </label>
			<input type=text name="taxa" /><span> % aos </span>
			<input type=text name="periodo_tx" /><span> dias</span><br />
			<label style="width: 190px">Modalidades: </label>
			<input type="checkbox" name="mod_post" checked="checked" /><span>Postecipada (sem entrada)</span>
			<input type="checkbox" name="mod_ant" checked="checked" /><span>Antecipada (com entrada)</span><br />
		</div>
		<br />
		<div class="centro">
			<input type=submit value="Calcular" name="submit">
			<input type=reset value="Apagar" name="reset">
		</div> -->
	</div>
    <!--  -->
    <div id="vp_valorFuturo">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo do Valor Presente  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/valor_presente.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
   <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Futuro:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" value="" onkeydown="" name="vr_futuro"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Prazo:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" onkeydown="" name="prazo"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" value="" size="8" onkeydown="" name="tx_juros"/> % aos <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Modalidades:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_comp"/>Juros Compostos<br/>
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_simp"/>Juros Simples
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="vp_valorPrestacao">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo do Valor Presente dado Valor da Prestação  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/valor_presente_pmt.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor da Prestação:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" value="" size="20" onkeydown="" name="vr_pmt"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" size="5" onkeydown="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" value="" size="8" onkeydown="" name="taxa"/> % aos <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Modalidades:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_post"/>Postecipada (sem entrada)<br/>
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_ant"/>Antecipada (com entrada)
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="cd_valorNominal">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo do Desconto  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/desconto.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
   <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Nominal:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" value="" onkeydown="" name="vr_nominal"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Prazo:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" value="" size="5" onkeydown="" name="prazo"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Desconto:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" value="" size="8" onkeydown="" name="tx_desconto"/> % aos <input type="text" maxlength="5" value="" size="5" onkeydown="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="cp_valorPresente">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo das Prestações Fixas dado Valor Presente  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/prestac_vp.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Presente:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" onkeydown="" value="" name="vr_presente"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="taxa"/> % aos <input type="text" maxlength="5" size="5" onkeydown="" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Modalidades:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_post"/>Postecipada (sem entrada)<br/>
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_ant"/>Antecipada (com entrada)
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="cp_valorFuturo">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo das Prestações Fixas dado Valor Futuro  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/prestac_vf.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Futuro:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" onkeydown="" value="" name="vr_futuro"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="taxa"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Modalidades:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_post"/>Postecipada (sem entrada)<br/>
          <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_ant"/>Antecipada (com entrada)
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="tj_taxaEquivalente">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Cálculo da Taxa Equivalente de Juros  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/taxa_equiv.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="tx_juros"/> % aos <input type="text" maxlength="5" size="5" onkeydown="" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Período da Taxa no Resultado:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="per_tx_res"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="tf_matematicaFinanceira">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Fatores da Matemática Financeira  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/tab_fat_mat.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="taxa"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Prazo Inicial:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="prazo_inicial"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Prazo Final:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="prazo_final"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="tf_taxaEquivalente">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Tabela de Taxas Equivalentes  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/tab_tx_equiv.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#fafafa" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa Base Inicial:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="taxa_inicial"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#fafafa" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa Base Final:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="taxa_final"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#fafafa" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Período da Taxa Base:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" value="" name="periodo_base"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#fafafa" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Incremento da Taxa:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" onkeydown="" value="" name="incremento_taxa"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <b>
            Período para equivalência da taxa
          </b>
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[1]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[2]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[3]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[4]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[5]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[6]"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" onkeydown="" name="periodo_equiv[7]"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>
</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="pa_sfa">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Planilha de Amortização - Empréstimos e Financiamentos  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1"); return CheckInputData(this)' method="post" action="../../calcfin/planilha.php?sistema=sfa" name="form_input" target="resultado">
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Sistema de Amortização:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <select name="sistema">
            <option selected="" value="sfa">Sistema Francês de Amortização - SFA</option>
            <option value="sac">Sistema de Amortização Constante - SAC</option>
            <option value="sma">Sistema Misto de Amortização - SMA</option>
          </select>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Presente:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" value="" onkeydown="" name="vr_presente"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" onkeydown="" name="taxa"/> % aos <input type="text" maxlength="5" size="5" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>

</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="pa_sac">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Planilha de Amortização - Empréstimos e Financiamentos  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1"); return CheckInputData(this)' method="post" action="../../calcfin/planilha.php?sistema=sac" name="form_input" target="resultado">
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Sistema de Amortização:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <select name="sistema">
            <option value="sfa">Sistema Francês de Amortização - SFA</option>
            <option selected="" value="sac">Sistema de Amortização Constante - SAC</option>
            <option value="sma">Sistema Misto de Amortização - SMA</option>
          </select>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Presente:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" value="" onkeydown="" name="vr_presente"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" onkeydown="" name="taxa"/> % aos <input type="text" maxlength="5" size="5" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>

</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="pa_sma">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Planilha de Amortização - Empréstimos e Financiamentos  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1"); return CheckInputData(this)' method="post" action="../../calcfin/planilha.php?sistema=sma" name="form_input" target="resultado">
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Sistema de Amortização:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <select name="sistema">
            <option value="sfa">Sistema Francês de Amortização - SFA</option>
            <option value="sac">Sistema de Amortização Constante - SAC</option>
            <option selected="" value="sma">Sistema Misto de Amortização - SMA</option>
          </select>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor Presente:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" value="" onkeydown="" name="vr_presente"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Quantidade de Prestações:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="quant_prestac"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Periodicidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" onkeydown="" name="periodicidade"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Juros:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" onkeydown="" name="taxa"/> % aos <input type="text" maxlength="5" size="5" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>

</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="apm_precoVenda">
<td width="470" valign="top">
<script>
function mudar(e,a){
	document.getElementById(a).innerHTML =	e;
}
</script>

<style>.rc3{width:15px;border:0;}</style>

<p align="center"><b>Formação do Preço de Venda - Entrada de Dados</b></p>
<p align="center">(Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)</p>

<form method="post" action="../../calcfin/preco_venda.php" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
<table align="center">
	<tbody><tr><td align="right">Custo de Aquisição/Produto:		</td><td><input type="text" value="" name="produto"/>	</td></tr>

	<tr><th colspan="2">Incidências Sobre o Preço de Venda</th></tr>

	<tr><td align="right">ICMS:							</td><td><input type="text" value="" name="icms"/> %		</td></tr>
	<tr><td align="right">PIS:							</td><td><input type="text" value="" name="pis"/> %			</td></tr>
	<tr><td align="right">COFINS:							</td><td><input type="text" value="" name="cofins"/> %	</td></tr>
	<tr><td align="right">IR:								</td><td><input type="text" value="" name="ir"/> %			</td></tr>
	<tr><td align="right">CSL:							</td><td><input type="text" value="" name="csl"/> %			</td></tr>
	<tr><td align="right">ISS:							</td><td><input type="text" value="" name="iss"/> %			</td></tr>
	<tr><td align="right">SIMPLES:						</td><td><input type="text" value="" name="simples"/> %	</td></tr>
	<tr><td align="right">Outros Tributos:				</td><td><input type="text" value="" name="outrosT"/> %	</td></tr>
	<tr><td align="right">Juros s/ Desconto de Títulos:	</td><td><input type="text" value="" name="juros"/> %		</td></tr>

	<tr><td align="right">Comissões		<input type="radio" value="1" name="Rcomissoes" checked="" onclick="mudar('%','Acomissoes')" class="rc3"/>% <input type="radio" value="2" name="Rcomissoes" onclick="mudar('$','Acomissoes')" class="rc3"/>$: 	</td><td><input type="text" value="" name="comissoes"/> <span id="Acomissoes">%</span></td></tr>
	<tr><td align="right">Frete			<input type="radio" value="1" name="Rfrete" checked="" onclick="mudar('%','Afrete')" class="rc3"/>% 		<input type="radio" value="2" name="Rfrete" onclick="mudar('$','Afrete')" class="rc3"/>$: 			</td><td><input type="text" value="" name="frete"/> <span id="Afrete">%</span>			</td></tr>
	<tr><td align="right">Outras Despesas	<input type="radio" value="1" name="RoutrasD" checked="" onclick="mudar('%','AoutrasD')" class="rc3"/>%		<input type="radio" value="2" name="RoutrasD" onclick="mudar('$','AoutrasD')" class="rc3"/>$: 		</td><td><input type="text" value="" name="outrasD"/> <span id="AoutrasD">%</span>		</td></tr>
	<tr><td align="right">Margem de Lucro	<input type="radio" value="1" name="Rlucro" checked="" onclick="mudar('%','Alucro')" class="rc3"/>%			<input type="radio" value="2" name="Rlucro" onclick="mudar('$','Alucro')" class="rc3"/>$: 			</td><td><input type="text" value="" name="lucro"/> <span id="Alucro">%</span>			</td></tr>

	<tr><td align="center" colspan="2"><input type="submit" value="Calcular" name="submit"/></td></tr>
</tbody></table>

</form>
	</td>
	</div>
    <!--  -->
    <div id="apm_descontoDuplicata">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Desconto de Duplicata  </font>
</h3>
<div align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
    (Use o ponto para separar casas decimais. Ex. 25.152,47 digite 25152.47)
  </font>
</div>
<form method="post" action="../../calcfin/desc_duplicata.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table cellspacing="0" bordercolor="#bbbbbb" border="1" align="center">
    <tbody><tr>
      <td width="50%" bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Valor da Duplicata:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="20" size="20" value="" name="vr_duplic"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Prazo Vencimento:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" name="prazo_venc"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa de Desconto:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" name="tx_desconto"/> % aos <input type="text" maxlength="5" size="5" value="" name="periodo_tx_desc"/> dias
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          IOF:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" name="iof"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Reciprocidade:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="8" size="8" value="" name="reciproc"/> %
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Taxa Administrativa:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <select onchange="change_tipo_tx_adm(this.value)" name="tipo_tx_adm">
            <option value="percent">%</option>
            <option value="monet">$</option>
          </select>
          <input type="text" maxlength="8" size="8" value="" name="tx_adm"/>
        </font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#eeeeee" align="right">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Período da Taxa no Resultado:
        </font>
      </td>
      <td>
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="text" maxlength="5" size="5" value="" name="periodo_tx"/> dias
        </font>
      </td>
    </tr>
  </tbody></table>

  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Calcular"/>
    <input type="reset" name="reset" value="Apagar"/>
  </div>

</form>
<br/>
	</td>
	</div>
    <!--  -->
    <div id="apm_vistaPrestacaoCartao">
<td width="470" valign="top">
<h3 align="center">
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
    Comprar à Vista, Prestação ou Cartão?  </font>
</h3>
<br/>
<form method="post" action="../../calcfin/opcoes_pagamento_form.php" name="form_input" target="resultado" onsubmit='window.open("","resultado","width=800,height=600,scrollbars=1")'>
  <table align="center">
    <tbody><tr>
      <td align="center">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          Selecione as modalidades de pagamento que você deseja comparar:
        </font>
      </td>
    </tr>
    <tr>
      <td>
        <table align="center">
          <tbody><tr>
            <td>
              <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_avista"/> À Vista<br/>
                <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_prestac"/> Prestação<br/>
                <input type="checkbox" style="border: 0px none ; width: 15px;" checked="" name="mod_cartao"/> Cartão
              </font>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
  </tbody></table>
  <br/>
  <div align="center">
    <input type="submit" name="submit" value="Avançar"/>
  </div>
</form>
<br/>
</td>
</div>

</div>
