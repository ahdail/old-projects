<?php 

##############################################################
# Projeto: ReduzirSrt 1.0
# Autor:  João Pedro Gaelzer Coelho Silva                    #
# Site de origem: www.jpdesign.com.br                        #
# Data: 04-09-2010                                           #
# Versão: 1.0                                                #
##############################################################

function reduzirStr($str, $tamanho){

			
			$str = strip_tags($str);
			$str = htmlspecialchars($str);
			
			$str = str_replace('&amp;', '&', $str);
			$str = str_replace('&Aacute;', 'Á', $str);
			$str = str_replace('&aacute;', 'á', $str);
			$str = str_replace('&Iacute;', 'Í', $str);
			$str = str_replace('&iacute;', 'í', $str);
			$str = str_replace('&Eacute;', 'É', $str);
			$str = str_replace('&eacute;', 'é', $str);
			$str = str_replace('&Oacute;', 'Ó', $str);
			$str = str_replace('&oacute;', 'ó', $str);
			$str = str_replace('&Uacute;', 'Ú', $str);
			$str = str_replace('&uacute;', 'ú', $str);
			$str = str_replace('&Atilde;', 'Ã', $str);
			$str = str_replace('&atilde;', 'ã', $str);
			$str = str_replace('&Otilde;', 'Õ', $str);
			$str = str_replace('&otilde;', 'õ', $str);
			$str = str_replace('&Acirc;', 'Â', $str);
			$str = str_replace('&acirc;', 'â', $str);
			$str = str_replace('&Ecirc;', 'Ê', $str);
			$str = str_replace('&ecirc;', 'ê', $str);
			$str = str_replace('&Ocirc;', 'Ô', $str);
			$str = str_replace('&ocirc;', 'ô', $str);
			$str = str_replace('&Ccedil;', 'Ç', $str);
			$str = str_replace('&ccedil;', 'ç', $str);
			$str = str_replace('&Agrave;', 'À', $str);
			$str = str_replace('&agrave;', 'à', $str);
			$str = str_replace('&nbsp;', '', $str);
			$str = str_replace('&rdquo;', '"', $str);
			$str = str_replace('&ldquo;', '"', $str);
			$str = str_replace('&nbsp;', " ", $str);
			$str = str_replace('&', '', $str);
				
			strlen( $str ) > $tamanho ? $str = substr( $str , 0 , $tamanho ) : $str = $str;
			$i = 0;
				$start = strlen( $str );
				$end = 1;
				
	
				while($i != 1) {
					--$start;
					$teste = substr($str, $start, $end);
					
					
					
					if( $teste == " " ){
						
						
						break;
						
					}
					
					
				}
				$fimCorreto = $start; echo "<!-- ". $fimCorreto ." -->";
				$str = substr( $str , 0 , $fimCorreto)."...";

				return $str;
}


?>