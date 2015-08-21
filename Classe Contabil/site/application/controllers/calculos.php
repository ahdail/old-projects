<?php
class Calculos extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helpers(array('data', 'login'));
	}

	function index()
	{
		$this->render('calculos',$var);
	}

	
	function valorFuturo(){
		if (!($mod_comp || $mod_simp)) {
			echo "Nenhuma modalidade selecionada.";
		}

		echo $vr_presente;
		echo "<br>";
		echo $prazo;
		echo "<br>";
		echo $tx_juros;
		echo "<br>";
		echo $mod_comp;
		echo "<br>";
		echo $mod_simp;
		echo "<br>";
		//die();
		$this->render('calculos',$var);
	}
}
?>