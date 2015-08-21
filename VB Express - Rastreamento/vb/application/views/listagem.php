<?php
echo $tipo;
echo " - ".$cod;

//print_r($dados[0]->titulo_noticia);

//foreach ($dados as $key => $value) {
	//echo $value->titulo_noticia;
//}
//die();


?>

	<div class="conteudo">

		<div class="container">
		
			<div class="pathway">
			
				<ul>
					<li><a href="#">início</a></li>

					<li><span>-</span></li>
				
					<li><a href="<?php //echo $this->uri->uri_string();?>"><?php echo $tipo;?></a></li>
					
					<li><span>-</span></li>
				
					<li><strong>Listagem de Cargas</strong></li>
					
				</ul>
			
				<br clear="all" />
			
			</div>
			
			
			<div>
				<div class="curvaCXBtopoEsq">
					<div class="curvaCXBtopoDir"></div>
				</div>
				
				<div class="contentCXB">
					<div class="cercaCampo">
						<div class="campo">
							<label>Núnero da Nota Fiscal</label>
							<input type="text" class="nomePesquisa" />
						</div>
						<div class="campo">
							<label>Data 1</label>
							<input type="text" value="10/12/1975" class="dataNascimento" />
						</div>
						
						<div class="campo">
							<label>Data 2</label>
							<input type="text" value="10/12/1975" class="dataNascimento" />
						</div>
						<div class="campo botoesFiltro">
							<input type="button" id="" value="enviar" class="tbBuscar" />
						</div>
						<br clear="all" />
					</div>	
				</div>

				<div class="curvaCXBbottomEsq">
					<div class="curvaCXBbottomDir"></div>
				</div>
			</div>
            
            
            
			<!-- ---------- caixa básica ---------- -->
			<div>
			
				<div class="curvaCXBtopoEsq">
					<div class="curvaCXBtopoDir"></div>
				</div>
				
				<div class="contentCXB">
				<!-- ----- colocar o conteudo aqui dentro ----- -->
				
					<div class="curvaDatagridTopEsq">
						<div class="curvaDatagridTopDir">
							<div class="linhaDatagridTop"></div>
						</div>
					</div>
				
					<div class="dataGrid">
						
						<div class="titDataGrid">
							<h2 class="tit">Listagem das Cargas</h2>
						</div>
						
						<div class="encolherTabela">
							<table cellspacing="0">
								<thead>
									<tr>
										<th> </th>
										<th>Nome</th>
										<th>Data</th>
										<th>Carga</th>
									</tr>
								</thead>
								
								<tbody>
								<?php
								if (is_array($dados)){
									foreach ($dados as $key => $value) {

								?>
									<tr class="linhaEscura">
										<td width="10">&nbsp;</td>
										<td><a href="<?php echo base_url();?><?php echo $this->uri->segment(1)?>/ver/<?php echo $value->id_noticia;?>"><?php echo $value->titulo_noticia?></a></td>
										<td><?php echo sqlToDataNew($value->data_noticia)?></td>
										<td><?php echo $value->texto_noticia;?></td>
									</tr>
								<?php
									}
								}
								?>	
								</tbody>
								
							</table>
							
							<!--  ---------- Paginação ---------- -->
							<div class="paginacao"> 
								<div>
									<ul>
										<li><?php echo $pag;?></li>
									</ul>
									<br clear="all" />
								</div>
							</div>
							
							
						</div>
					
					</div>		
					
					<div class="curvaDatagridBottomEsq">
						<div class="curvaDatagridBottomDir">
							<div class="linhaDatagridBottom"></div>
						</div>
					</div>
				
				
				
				<!-- ---------------fim conteudo--------------- -->
				</div>

				<div class="curvaCXBbottomEsq">
					<div class="curvaCXBbottomDir"></div>
				</div>
			
			</div>
		
		</div>
			
	</div>