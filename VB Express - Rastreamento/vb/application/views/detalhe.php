
	<div class="conteudo">

		<div class="container">
		
			<div class="pathway">
			
				<ul>
					<li><a href="#">início</a></li>

					<li><span>-</span></li>
				
					<li><a href="#">Destinatátio</a></li>
					
					<li><span>-</span></li>
				
					<li><strong>Listagem de Cargas</strong></li>
					
				</ul>
			
				<br clear="all" />
			
			</div>
			
			            
            
            
			<!-- ---------- caixa básica ---------- -->
			<div>
			
				<div class="curvaCXBtopoEsq">
					<div class="curvaCXBtopoDir"></div>
				</div>
				
				<div class="contentCXB">
				<!-- ----- colocar o conteudo aqui dentro ----- -->
				
                    <div class="descricao">
                    	
                        <fieldset>
                        	<legend>Detalhes do Conhecimento</legend>
                                                
                            <ul class="cercaCampos">
                                <?php
								if (is_array($dados)){
									foreach ($dados as $key => $value) {
								?>
                                <li style="width:317px;">
                                    <label>Destinatário:</label>
                                  <?php echo $value->texto_noticia;?>
                                </li>
                               
                                <li style="width:317px;">
                                    <label>Remetente / Pagador:</label>
                                    <?php echo $value->titulo_noticia;?>
                                </li>
                                 <?php
									}
								}
								?>
                                <br clear="all" />

                                <li style="width:80px;">
                                    <label>Conhecimento:</label>
                                    FOR A 92566
                                </li>

                                <li style="width:65px;">
                                    <label>Data Emissão:</label>
                                    10/02/2010
                                </li>

                                <li style="width:82px;">
                                    <label>Peso Calculado:</label>
                                    30
                                </li>

                                <li style="width:45px;">
                                    <label>Volume:</label>
                                    1
                                </li>
                            
                                <li style="width:55px;">
                                    <label>Peso Nota:</label>
                                    30
                                </li>

                                <li style="width:40px;">
                                    <label>Espécie:</label>
                                    VOL
                                </li>

                                <li style="width:30px;">
                                    <label>CFOP:</label>
                                    6353
                                </li>

                                <li style="width:147px;">
                                    <label>Cidades do Trecho:</label>
                                    FORTALEZA / SAO PAULO
                                </li>
                                
                                <br clear="all" />

                                <li style="width:80px;">
                                    <label>Trecho:</label>
                                    FORSPO
                                </li>

                                <li style="width:110px;">
                                    <label>Loc. Recebimento:</label>
                                    FORTALEZA
                                </li>

                                <li style="width:110px;">
                                    <label>Loc. Entrega:</label>
                                    SAO PAULO
                                </li>

                                <li style="width:63px;">
                                    <label>Nota Fiscal:</label>
                                    9958
                                </li>

                                <li style="width:64px;">
                                    <label>Valor da NF:</label>
                                    R$ 157,00
                                </li>

                                <li style="width:66px;">
                                    <label>Tipo Tabela:</label>
                                    Normal Peso
                                </li>

                                <li style="width:66px;">
                                    <label>Nº da Fatura:</label>
                                    384821
                                </li>
                                
                                <li style="width:317px;">
                                    <label>Serviço:</label>
                                    CARGA EXPRESSA
                                </li>
                                
                                <li style="width:317px;">
                                    <label>SID:</label>
                                    Não existe imagem digitalizada.
                                </li>
                            
                            <br clear="all" />
                            </ul>
                        </fieldset>

                        <br clear="all" />

                        <fieldset>
                        	<legend>Detalhes do Transporte</legend>
                                                
                            <ul class="cercaCampos">
                                
                                <li style="width:317px;">
                                    <label>Status:</label>
                                    Mercadoria saiu para Entrega em 17/02/2010 
                                </li>
                                
                                <li style="width:318px;">
                                    <label>Ocorrências</label>
                                    ...
                                </li>
                                
                                <br clear="all" />

                                <li style="width:578px;">
                                    <label>Descrição:</label>
                                    ENTREGA REALIZADA NORMALMENTE
                                </li>

                                <li style="width:57px;">
                                    <label>Data:</label>
                                    26/02/2010 
                                </li>

                                <li style="width:650px;">
                                    <label>Localização do Veículo:</label>
                                    Mercadoria aguardando embarque, em processo de entrega, entregue ou sem informação da localização!!!
                                </li>

                            <br clear="all" />
                            </ul>
                        </fieldset>

                        <br clear="all" />

                        <fieldset>
                        	<legend>Informações de Transporte</legend>

                            <fieldset>
                                <legend>Posição de Carga</legend>
                                <ul class="cercaCampos">
                                    
                                    <li style="width:103px;">
                                        <label>Origem:</label>
                                        FORTALEZA 
                                    </li>
                                    
                                    <li style="width:60px;">
                                        <label>Emitido em:</label>
                                        10/02/2010
                                    </li>

                                    <li style="width:60px;">
                                        <label>Embarque:</label>
                                        10/02/2010
                                    </li>

                                    <li style="width:90px;">
                                        <label>Dias Dep. Origem:</label>
                                        1
                                    </li>

                                    <li style="width:90px;">
                                        <label>Em Trânsito:</label>
                                        ...
                                    </li>

                                    <li style="width:55px;">
                                        <label>Chegada:</label>
                                        15/02/2010
                                    </li>

                                    <li style="width:85px;">
                                        <label>Dias em Viagem:</label>
                                        ...
                                    </li>

                                    <li style="width:103px;">
                                        <label>Destino:</label>
                                        SAO PAULO
                                    </li>
                                    
                                    <li style="width:120px;">
                                        <label>Prev. Entrega (Emissão):</label>
                                        19/02/2010
                                    </li>
                                    
                                    <li style="width:85px;">
                                        <label>Entrega:</label>
                                        ...
                                    </li>

                                    <li style="width:85px;">
                                        <label>Dias Dep. Dest.:</label>
                                        2
                                    </li>
                                        
                                    <br clear="all" />
                                </ul>
                            </fieldset>
                            
                            <br clear="all" />
                            
                            <fieldset>
                                <legend>Manifesto de Carga</legend>
                                <ul class="cercaCampos">
                                    
                                    <li style="width:50px;">
                                        <label>MNF:</label>
                                        13651 
                                    </li>
                                    
                                    <li style="width:60px;">
                                        <label>Embarque:</label>
                                        11/02/2010
                                    </li>

                                    <li style="width:60px;">
                                        <label>Chegada:</label>
                                        10/02/2010
                                    </li>

                                    <li style="width:50px;">
                                        <label>Coleta:</label>
                                        ...
                                    </li>

                                    <li style="width:60px;">
                                        <label>Data:</label>
                                        10/02/2010
                                    </li>

                                    <li style="width:60px;">
                                        <label>Valor:</label>
                                        R$ 2,19
                                    </li>

                                    <li style="width:50px;">
                                        <label>Entrega:</label>
                                       ...
                                    </li>

                                    <li style="width:60px;">
                                        <label>Data: </label>
                                        10/02/2010
                                    </li>

                                    <li style="width:60px;">
                                        <label>Valor:</label>
                                        R$ 2,19
                                    </li>
                                        
                                    <br clear="all" />
                                </ul>
                            </fieldset>
                            
                            <br clear="all" />
                            
                            <fieldset>
                                <legend>Componentes do Frete</legend>
                                <ul class="cercaCampos">
                                    
                                    <li style="width:50px;">
                                        <label>F.Peso:</label>
                                        9.6 
                                    </li>
                                    
                                    <li style="width:60px;">
                                        <label>F.Valor:</label>
                                        0.79
                                    </li>

                                    <li style="width:60px;">
                                        <label>GRIS:</label>
                                        0.31
                                    </li>

                                    <li style="width:60px;">
                                        <label>Coleta:</label>
                                        0.31
                                    </li>

                                    <li style="width:60px;">
                                        <label>Entrega:</label>
                                        0.31
                                    </li>

                                    <li style="width:60px;">
                                        <label>Despacho:</label>
                                        0.31
                                    </li>

                                    <li style="width:60px;">
                                        <label>Pedágio:</label>
                                        0.31
                                    </li>

                                    <li style="width:30px;">
                                        <label>ICMS:</label>
                                        0.31
                                    </li>
                                    
                                    <li style="width:70px;">
                                        <label>Total Frete:</label>
                                        R$ 54,70
                                    </li>

                                    <br clear="all" />
                                </ul>
                            </fieldset>
                            <br clear="all" />
                        </fieldset>
                        <br clear="all" />
                    </div>


								
				<!-- ---------------fim conteudo--------------- -->
				</div>

				<div class="curvaCXBbottomEsq">
					<div class="curvaCXBbottomDir"></div>
				</div>
			
			</div>
		
		</div>
			
	</div>