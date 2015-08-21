<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->database();

	}
	
	function index()
	{
		$this->load->view('login');
	}
	
	function validSession()
	{
		print_r($_POST);
		
		
		$senha = crypt($_POST['password'],$_POST['user']);
		$usuario = $_POST['user'];
		$sistema = $_POST['idSystem'];
		
		if($usuario == "" ||$senha == "" ){
			redirect('login/index/msn');
		}
		
		$DB3 = $this->load->database('UsersMaster', TRUE);
		//consulta que retorna os dados do usuario.
		 $this->db->trans_start();
		 $SQL = "SELECT 
				Users.idUser, 
				Users.idRegister, 
				Users.Name, 
				Users.idDepartament, 
				Users.idHierarch,
				Systems.Activate,
				UserSystemsPermissions.isBlocked,
				UserSystemsPermissions.idLevel
			FROM 
				UsersMaster.Users, 
				UsersMaster.UserSystemsPermissions,
				UsersMaster.Systems
			WHERE 
				Users.idUser = UserSystemsPermissions.idUser AND
				UserSystemsPermissions.idSystem = Systems.idSystem AND
				Users.Login= '".$usuario."' AND Users.Pass ='".$senha."' AND
				UserSystemsPermissions.idSystem = ".$sistema." AND
				UserSystemsPermissions.isBlocked = 0 AND
				Systems.Activate = 0 AND
				Users.DateExpire is NULL";
	
			echo $SQL;
			//die();
			$inforUser = $DB3->query($SQL);
			/*$this->db->trans_complete();
			if ( $this->db->trans_status() === FALSE){ 
				redirect('login/index/msn');
			}*/
			
			if($inforUser->num_rows() > 0)
			{
				
				foreach($inforUser->result() as $resu)
				{
				
					//print_r($resu);
				
					$novosdados = array(
							   'idUser'  		=> $resu->idUser,
							   'idRegister' 	=> $resu->idRegister,
								'Name' 			=> $resu->Name,
								'idDepartament' => $resu->idDepartament,
								'idHierarch' 	=> $resu->idHierarch,
								'Activate' 		=> $resu->Activate,
								'isBlocked' 	=> $resu->isBlocked,
								'idLevel' 		=> $resu->idLevel
							   );
	
					print_r($novosdados);
					//die();
					$this->session->set_userdata($novosdados);
					
					
				}
				
				redirect('home');
			}
			else
			{
				redirect('login/index/msn');
			}
				
		
	
	}
}