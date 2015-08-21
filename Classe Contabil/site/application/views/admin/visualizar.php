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
img {
	border: none;
}
table {
	margin: 0 auto;
	padding: 0;
	width: 570px;
	background: #FFFFFF;
	border: 3px solid #F3F3F3;
}
thead {
	text-align: left;
	background: url("http://www.classecontabil.com.br/v3/site/img/topoBase.gif") no-repeat bottom;
}
thead h1 {
	margin: 0;
	padding: 0;
	font-size: 20px;
	color: #03497A;
}
thead h2 {
	margin: 0;
	padding: 0;
	font-size: 12px;
	font-weight: normal;
	color: #03497A;
}
th {
	padding-bottom: 10px;
	padding-left: 15px;
	padding-right: 15px;
}
tfoot {
	font-size: 10px;
	text-align: center;
	color: #FFFFFF;
	background: #01A38C url("http://www.classecontabil.com.br/v3/site/img/creditosFundoTopo.gif") repeat-x top;
}
tfoot a {
	text-decoration: none;
	color: #FFFFFF;
}
tfoot a:hover {
	text-decoration: underline;
}
td {
	margin: 0;
	padding: 20px;
}
h1.titulo {
	margin-top: 0;
	font-size: 20px;
	font-weight: normal;
	color: #008D79;
}
div.divisa {
	height: 2px;
	background: #CFF6F0;
}
ul {
	margin: 0;
	padding: 0;
	list-style: none;
}
ul li {
	padding: 4px 3px;
	border-bottom: 1px solid #E0E0E0;
}
ul li h1 {
	margin: 5px 0;
	font-size: 12px;
	font-weight: bold;
}
ul li p {
	margin: 0;
	font-size: 10px;
}
ul li a {
	text-decoration: none;
	color: #03497A;
}
ul li a:hover {
	text-decoration: underline;
}
.dir {
	float: right;
	text-align: right;
}
</style>
</head>
<body>
<table>
	<thead>
		<tr>

			<th>
				<span class="dir">
					<br />
					<h1>Boletim Eletrônico</h1>
					<h2><?=sqlToDate($data_envio)?></h2>
				</span>
				<a href="http://www.classecontabil.com.br/" target="_blank"><img src="http://www.classecontabil.com.br/v3/site/img/topoLogo.gif" alt="Portal da Classe Contábil" /></a>
			</th>

		</tr>
	</thead>
	<tbody>
	<?php if ($noticias) {?>
		<tr>
			<td>
				<h1 class="titulo">Notícias</h1>
				<div class="divisa"></div>
				<ul>
					<?php foreach ($noticias as $rowNoticia) {?>
					<li>
							<h1><a href="#"><?= sqlToDate($rowNoticia['data']) ?> - <?=$rowNoticia['titulo'] ?></a></h1>
							<p><?=$rowNoticia['resumo']?></p>
					</li>
					<?php }?>
				</ul>

			</td>
		</tr>
	<?php } ?>	
		<tr>
			<td>
				<a href="#" target="_blank">
					<img src="http://www.classecontabil.com.br/v3/site/banners/bannerTopo1.jpg" width="500" height="61" border="0">
				</a>
			</td>
		</tr>
	<?php if ($artigos) {?>
		<tr>
			
			<td>
				<h1 class="titulo">Artigos</h1>
				<div class="divisa"></div>
				<ul>
					<?php foreach ($artigos as $rowArtigo) { ?>
					<li>
							<h1><a href="#"><?= sqlToDate($rowArtigo['data']) ?> - <?= $rowArtigo['titulo'] ?></a></h1>
							<p><?= $rowArtigo['resumo'] ?></p>

					</li>
					<?php } ?>
				</ul>
			</td>
		</tr>
				<?php } if ($juizo) {?>
		<tr>
			<td>
				<h1 class="titulo">Juizo Semanal</h1>
				<div class="divisa"></div>
				<ul>
					<?php foreach ($juizo as $rowJuizo) {?>

					<li>
							<h1><a href="#"><?= $rowJuizo['pergunta']?></a></h1>
					</li>
					<?php }?>
				</ul>

			</td>
		</tr>
		<?php } else {?>
		<tr>
			<td>Nenhum juizo pra esse período.</td>
		</tr>
		<?php } ?>
			
	</tbody>
	<tfoot>

		<tr>
			
			<td>
				<p>O <a href="http://www.classecontabil.com.br/" target="_blank"><b>Classe Contábil</b></a> é o mais completo portal de informações contábeis do país.<br />
				Conheça também as empresas do <a href="http://www.grupofortes.com.br/" target="_blank"><b>Grupo Fortes de Seviços</b></a>.</p>
				<a href="http://www.grupofortes.com.br/"target="_blank"><img src="http://www.classecontabil.com.br/v3/site/img/creditosLogo.gif" alt="Grupo Fortes de Serviços" /></a>

			</td>
		</tr>
	</tfoot>
</table>
</body>
</html>
<?=$enviar?>