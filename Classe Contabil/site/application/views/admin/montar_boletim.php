<?php
checkSessao("BOL.E");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<style>
body {
	margin: 0;
	padding: 0;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background: #F9F9F9;
}
</style>
</head>
<body>
<div>
<form action="<?=base_url() ?>admin/boletim/ver" method="post" style="width: 570px">

	<h1>Data Inicial</h1>
	<ul>
		<li>
			<span>Dia: </span>
			<select name="dia_i">
				<option value="01" <?php if ($dia_i == "01") { echo "selected=\"selected\"";} ?> >01</option>
				<option value="02" <?php if ($dia_i == "02") { echo "selected=\"selected\"";} ?> >02</option>
				<option value="03" <?php if ($dia_i == "03") { echo "selected=\"selected\"";} ?> >03</option>
				<option value="04" <?php if ($dia_i == "04") { echo "selected=\"selected\"";} ?> >04</option>
				<option value="05" <?php if ($dia_i == "05") { echo "selected=\"selected\"";} ?> >05</option>
				<option value="06" <?php if ($dia_i == "06") { echo "selected=\"selected\"";} ?> >06</option>
				<option value="07" <?php if ($dia_i == "07") { echo "selected=\"selected\"";} ?> >07</option>
				<option value="08" <?php if ($dia_i == "08") { echo "selected=\"selected\"";} ?> >08</option>
				<option value="09" <?php if ($dia_i == "09") { echo "selected=\"selected\"";} ?> >09</option>
				<option value="10" <?php if ($dia_i == "10") { echo "selected=\"selected\"";} ?> >10</option>
				<option value="11" <?php if ($dia_i == "11") { echo "selected=\"selected\"";} ?> >11</option>
				<option value="12" <?php if ($dia_i == "12") { echo "selected=\"selected\"";} ?> >12</option>
				<option value="13" <?php if ($dia_i == "13") { echo "selected=\"selected\"";} ?> >13</option>
				<option value="14" <?php if ($dia_i == "14") { echo "selected=\"selected\"";} ?> >14</option>
				<option value="15" <?php if ($dia_i == "15") { echo "selected=\"selected\"";} ?> >15</option>
				<option value="16" <?php if ($dia_i == "16") { echo "selected=\"selected\"";} ?> >16</option>
				<option value="17" <?php if ($dia_i == "17") { echo "selected=\"selected\"";} ?> >17</option>
				<option value="18" <?php if ($dia_i == "18") { echo "selected=\"selected\"";} ?> >18</option>
				<option value="19" <?php if ($dia_i == "19") { echo "selected=\"selected\"";} ?> >19</option>
				<option value="20" <?php if ($dia_i == "20") { echo "selected=\"selected\"";} ?> >20</option>
				<option value="21" <?php if ($dia_i == "21") { echo "selected=\"selected\"";} ?> >21</option>
				<option value="22" <?php if ($dia_i == "22") { echo "selected=\"selected\"";} ?> >22</option>
				<option value="23" <?php if ($dia_i == "23") { echo "selected=\"selected\"";} ?> >23</option>
				<option value="24" <?php if ($dia_i == "24") { echo "selected=\"selected\"";} ?> >24</option>
				<option value="25" <?php if ($dia_i == "25") { echo "selected=\"selected\"";} ?> >25</option>
				<option value="26" <?php if ($dia_i == "26") { echo "selected=\"selected\"";} ?> >26</option>
				<option value="27" <?php if ($dia_i == "27") { echo "selected=\"selected\"";} ?> >27</option>
				<option value="28" <?php if ($dia_i == "28") { echo "selected=\"selected\"";} ?> >28</option>
				<option value="29" <?php if ($dia_i == "29") { echo "selected=\"selected\"";} ?> >29</option>
				<option value="30" <?php if ($dia_i == "30") { echo "selected=\"selected\"";} ?> >30</option>
				<option value="31" <?php if ($dia_i == "31") { echo "selected=\"selected\"";} ?> >31</option>
			</select>
			<span>Mês: </span>
			<select name="mes_i">
				<option value="01" <?php if ($mes_i == "01") { echo "selected=\"selected\"";} ?> >JAN</option>
				<option value="02" <?php if ($mes_i == "02") { echo "selected=\"selected\"";} ?> >FEV</option>
				<option value="03" <?php if ($mes_i == "03") { echo "selected=\"selected\"";} ?> >MAR</option>
				<option value="04" <?php if ($mes_i == "04") { echo "selected=\"selected\"";} ?> >ABR</option>
				<option value="05" <?php if ($mes_i == "05") { echo "selected=\"selected\"";} ?> >MAI</option>
				<option value="06" <?php if ($mes_i == "06") { echo "selected=\"selected\"";} ?> >JUN</option>
				<option value="07" <?php if ($mes_i == "07") { echo "selected=\"selected\"";} ?> >JUL</option>
				<option value="08" <?php if ($mes_i == "08") { echo "selected=\"selected\"";} ?> >AGO</option>
				<option value="09" <?php if ($mes_i == "09") { echo "selected=\"selected\"";} ?> >SET</option>
				<option value="10" <?php if ($mes_i == "10") { echo "selected=\"selected\"";} ?> >OUT</option>
				<option value="11" <?php if ($mes_i == "11") { echo "selected=\"selected\"";} ?> >NOV</option>
				<option value="12" <?php if ($mes_i == "12") { echo "selected=\"selected\"";} ?> >DEZ</option>
			</select>
			<span>Ano: </span>
				<input type="text" name="ano_i" value="<?=$ano_i?>">
		</li>
		<h1>Data Final</h1>
		<li>
			<span>Dia:</span>
			<select name="dia_f" >
				<option value="01" <?php if ($dia_f == "01") { echo "selected=\"selected\"";} ?> >01</option>
				<option value="02" <?php if ($dia_f == "02") { echo "selected=\"selected\"";} ?> >02</option>
				<option value="03" <?php if ($dia_f == "03") { echo "selected=\"selected\"";} ?> >03</option>
				<option value="04" <?php if ($dia_f == "04") { echo "selected=\"selected\"";} ?>>04</option>
				<option value="05" <?php if ($dia_f == "05") { echo "selected=\"selected\"";} ?> >05</option>
				<option value="06" <?php if ($dia_f == "06") { echo "selected=\"selected\"";} ?> >06</option>
				<option value="07" <?php if ($dia_f == "07") { echo "selected=\"selected\"";} ?> >07</option>
				<option value="08" <?php if ($dia_f == "08") { echo "selected=\"selected\"";} ?> >08</option>
				<option value="09" <?php if ($dia_f == "09") { echo "selected=\"selected\"";} ?> >09</option>
				<option value="10" <?php if ($dia_f == "10") { echo "selected=\"selected\"";} ?> >10</option>
				<option value="11" <?php if ($dia_f == "11") { echo "selected=\"selected\"";} ?> >11</option>
				<option value="12" <?php if ($dia_f == "12") { echo "selected=\"selected\"";} ?> >12</option>
				<option value="13" <?php if ($dia_f == "13") { echo "selected=\"selected\"";} ?> >13</option>
				<option value="14" <?php if ($dia_f == "14") { echo "selected=\"selected\"";} ?> >14</option>
				<option value="15" <?php if ($dia_f == "15") { echo "selected=\"selected\"";} ?> >15</option>
				<option value="16" <?php if ($dia_f == "16") { echo "selected=\"selected\"";} ?> >16</option>
				<option value="17" <?php if ($dia_f == "17") { echo "selected=\"selected\"";} ?> >17</option>
				<option value="18" <?php if ($dia_f == "18") { echo "selected=\"selected\"";} ?> >18</option>
				<option value="19" <?php if ($dia_f == "19") { echo "selected=\"selected\"";} ?> >19</option>
				<option value="20" <?php if ($dia_f == "20") { echo "selected=\"selected\"";} ?> >20</option>
				<option value="21" <?php if ($dia_f == "21") { echo "selected=\"selected\"";} ?> >21</option>
				<option value="22" <?php if ($dia_f == "22") { echo "selected=\"selected\"";} ?>>22</option>
				<option value="23" <?php if ($dia_f == "23") { echo "selected=\"selected\"";} ?> >23</option>
				<option value="24" <?php if ($dia_f == "24") { echo "selected=\"selected\"";} ?> >24</option>
				<option value="25" <?php if ($dia_f == "25") { echo "selected=\"selected\"";} ?> >25</option>
				<option value="26" <?php if ($dia_f == "26") { echo "selected=\"selected\"";} ?> >26</option>
				<option value="27" <?php if ($dia_f == "27") { echo "selected=\"selected\"";} ?> >27</option>
				<option value="28" <?php if ($dia_f == "28") { echo "selected=\"selected\"";} ?> >28</option>
				<option value="29" <?php if ($dia_f == "29") { echo "selected=\"selected\"";} ?> >29</option>
				<option value="30" <?php if ($dia_f == "30") { echo "selected=\"selected\"";} ?> >30</option>
				<option value="31" <?php if ($dia_f == "31") { echo "selected=\"selected\"";} ?> >31</option>
			</select>
			<span>Mês:</span>
			<select name="mes_f">
				<option value="01" <?php if ($mes_f == "01") { echo "selected=\"selected\"";} ?> >JAN</option>
				<option value="02" <?php if ($mes_f == "02") { echo "selected=\"selected\"";} ?> >FEV</option>
				<option value="03" <?php if ($mes_f == "03") { echo "selected=\"selected\"";} ?> >MAR</option>
				<option value="04" <?php if ($mes_f == "04") { echo "selected=\"selected\"";} ?> >ABR</option>
				<option value="05" <?php if ($mes_f == "05") { echo "selected=\"selected\"";} ?> >MAI</option>
				<option value="06" <?php if ($mes_f == "06") { echo "selected=\"selected\"";} ?> >JUN</option>
				<option value="07" <?php if ($mes_f == "07") { echo "selected=\"selected\"";} ?> >JUL</option>
				<option value="08" <?php if ($mes_f == "08") { echo "selected=\"selected\"";} ?> >AGO</option>
				<option value="09" <?php if ($mes_f == "09") { echo "selected=\"selected\"";} ?> >SET</option>
				<option value="10" <?php if ($mes_f == "10") { echo "selected=\"selected\"";} ?> >OUT</option>
				<option value="11" <?php if ($mes_f == "11") { echo "selected=\"selected\"";} ?> >NOV</option>
				<option value="12" <?php if ($mes_f == "12") { echo "selected=\"selected\"";} ?> >DEZ</option>
			</select>
			<span>Ano:</span>
			<input type="text" name="ano_f" value="<?=$ano_f ?>">
		</li>
		<li>
			<center><input type=submit value="Montar"></center>
		</li>
	</ul>
</form>
</div>

<br />

<form class="limpa" action="<?=base_url() ?>admin/boletim/gravar" method="post">

<table cellpadding="20" style="margin: 0 auto; padding: 0; width: 570px; background: #FFFFFF; border: 3px solid #F3F3F3;">
	<thead style="text-align: left">
		<tr>
			<th style="padding-bottom: 10px; padding-left: 15px; padding-right: 15px; border-bottom: 5px solid #CFF6F0;">
				<span style="float: right; text-align: right;">
					<br />
					<h1 style="margin: 0; padding: 0; font-size: 20px; color: #03497A;">Boletim Eletrônico</h1>
					<h2	style="margin: 0; padding: 0; font-size: 12px; font-weight: normal; color: #03497A;"><?=sqlToDate($data_envio)?></h2>
				</span>
				<a href="http://www.classecontabil.com.br/" target="_blank"><img src="http://www.classecontabil.com.br/v3/site/img/topoLogo.gif" alt="Portal da Classe Contábil" border="0" /></a>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($noticias) { ?>
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Notícias</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($noticias as $rowNoticia) {
						if ($rowNoticia['exibirDestaque'] == "S") {
							$destaqueNoticia =  " <span style=\"color: red\">!</span> ";
						} else {
							$destaqueNoticia = "";
						}

					?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"><input type="checkbox" name="noticia_id[]" value="<?=$rowNoticia['id'] ?>"><a href="<?= base_url() ?>noticias/ver/<?=$rowNoticia['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><?= sqlToDate($rowNoticia['data']) ?> - <?=$rowNoticia['titulo']?>  <?=$destaqueNoticia?></a></h1>
								<p style="margin: 0; font-size: 10px; color: #000000"><?=$rowNoticia['resumo']?></p>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
		<?php if ($artigos) { ?>
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Artigos</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($artigos as $rowArtigo) {
						if ($rowArtigo['exibirDestaque'] == "S") {
							$destaqueArtigo =  " <span style=\"color: red\">!</span> ";
						} else {
							$destaqueArtigo = "";
						}
					?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"><input type="checkbox" name="artigo_id[]" value="<?=$rowArtigo['id'] ?>"><a href="<?= base_url() ?>artigos/ver/<?=$rowArtigo['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><?= sqlToDate($rowArtigo['data']) ?> - <?=$rowArtigo['titulo']?> <?=$destaqueArtigo?></a></h1>
								<p style="margin: 0; font-size: 10px; color: #000000"><?=$rowArtigo['resumo']?></p>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
		<?php if ($juizo) { ?>
			<tr>
				<td>
					<h1 style="margin-top: 0; font-size: 20px; font-weight: normal; color: #008D79;">Juizo</h1>
					<div style="border-top:2px solid #CFF6F0;"></div>
					<ul style="margin: 0; padding: 0; list-style: none;">
					<?php foreach ($juizo as $rowJuizo) {?>
						<li style="padding: 4px 3px; border-bottom: 1px solid #E0E0E0;">
								<h1 style="margin: 5px 0; font-size: 12px; font-weight: bold;"><input type="checkbox" name="juizo_id[]" value="<?=$rowJuizo['id'] ?>"><a href="<?= base_url() ?>juizodiario/ver/<?=$rowJuizo['id']?>" target="_BLANK" style="text-decoration: none; color: #03497A;"><?=$rowJuizo['pergunta']?></a></h1>
								<p style="margin: 0; font-size: 10px; color: #000000"><?=$rowJuizo['resposta']?></p>
						</li>
					<?php } // Fim do foreach ?>
				</ul>
			</td>
		</tr>
		<?php } // Fim do Noticia ?>
		<tr>
		<td>
<center><input type=submit value="Gravar"></center>
		</td>
		</tr>
	</tbody>
	<tfoot style="font-size: 10px; text-align: center; color: #666666;">
		<tr>
			<td style="border-top: 5px solid #CFF6F0;">
				O <a href="http://www.classecontabil.com.br/" target="_blank" style="color: #666666"><b>Classe Contábil</b></a> é o mais completo portal de informações contábeis do país.<br />
				Conheça também as empresas do <a href="http://www.grupofortes.com.br/" target="_blank" style="color: #666666"><b>Grupo Fortes de Seviços</b></a>.
			</td>
		</tr>
	</tfoot>
</table>

</form>
</body>
</html>
