<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Arquivo de funcoes FORTES INFORMATICA Versao 1.0
class Funcoes {	
	function converte_data($data){
	    if (strstr($data, "/")){//verifica se tem a barra /
			  $d = explode ("/", $data);//tira a barra
			  $invert_data = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mês etc...
			  return $invert_data;
	    }
	    elseif(strstr($data, "-")){
			  $d = explode ("-", $data);
			  $invert_data = "$d[2]/$d[1]/$d[0]";    
			  return $invert_data;
	    }
	    else{
	  		return "Data invalida";
	  }
	    
	}
	
	
}
?>