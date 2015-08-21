<?php 

##############################################################
# Projeto: ReduzirSrt 1.0
# Autor:  Jo�o Pedro Gaelzer Coelho Silva                    #
# Site de origem: www.jpdesign.com.br                        #
# Data: 04-09-2010                                           #
# Vers�o: 1.0                                                #
##############################################################

function reduzirStr($str, $tamanho){

			
			$str = strip_tags($str);
			$str = htmlspecialchars($str);
			
			$str = str_replace('&amp;', '&', $str);
			$str = str_replace('&Aacute;', '�', $str);
			$str = str_replace('&aacute;', '�', $str);
			$str = str_replace('&Iacute;', '�', $str);
			$str = str_replace('&iacute;', '�', $str);
			$str = str_replace('&Eacute;', '�', $str);
			$str = str_replace('&eacute;', '�', $str);
			$str = str_replace('&Oacute;', '�', $str);
			$str = str_replace('&oacute;', '�', $str);
			$str = str_replace('&Uacute;', '�', $str);
			$str = str_replace('&uacute;', '�', $str);
			$str = str_replace('&Atilde;', '�', $str);
			$str = str_replace('&atilde;', '�', $str);
			$str = str_replace('&Otilde;', '�', $str);
			$str = str_replace('&otilde;', '�', $str);
			$str = str_replace('&Acirc;', '�', $str);
			$str = str_replace('&acirc;', '�', $str);
			$str = str_replace('&Ecirc;', '�', $str);
			$str = str_replace('&ecirc;', '�', $str);
			$str = str_replace('&Ocirc;', '�', $str);
			$str = str_replace('&ocirc;', '�', $str);
			$str = str_replace('&Ccedil;', '�', $str);
			$str = str_replace('&ccedil;', '�', $str);
			$str = str_replace('&Agrave;', '�', $str);
			$str = str_replace('&agrave;', '�', $str);
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