<html>
<head>
<title>Login: Comunica&ccedil;&atilde;o Interna</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php $url = base_url();?>

<style type="text/css">

div.tudo{ min-height:100%;	position:relative; width:100%; }

div.header { background:url(<?php echo $url; ?>images/head_bg.gif) repeat-x; height:130px }

div.header div{ background:url(<?php echo $url; ?>images/logo-esm.png) no-repeat; height:130px }

div.form-login { background:url(<?php echo $url; ?>images/img-login.png) no-repeat; height:276px; margin:10% 0 0 38%; width:400px }

div.login { padding:36% 0 0 15% }

div.login span { color: #333; font:12px Arial; font-weight:bold }

div.login input { border: solid 1px #666; height:20px; margin: 10px 0 0 15px ; width:200px }

button[type=submit] { color:#FFF; background:url(<?php echo $url; ?>images/entrar-btn.png) no-repeat; border:none; font:12px Arial; font-weight:bold; height:21px; text-transform:uppercase; width:94px;  }

span.button { margin:0 0 0 175px; }

span.button:nth-of-type(1) { margin:0 0 0 175px; }

div.rodape { background:url(<?php echo $url; ?>images/head_bg.gif) repeat-x; bottom:0; height:50px; position:absolute; width:100% }

div.rodape p { color:#FFF; font:10px Verdana; margin:8px 0 0 0 }

div.rodape div { background:url(<?php echo $url; ?>images/nome_esmaltec.png) no-repeat; height:20px; margin:5px 0 0 48% }

</style>

</head>

<body>

<div class="tudo">
                    <div class="header">
                    
                        <div>
                        </div>
                    
                    </div>
	
		<div class="conteudo">
    
       
					<?php echo form_open("login/validSession", "name='form'");?>

						<div class="form-login">
                        
                          <div class="login">
                          
                          <font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php if($this->uri->segment(3)=="msn"){echo "Usuario ou Senha Incoreta!!!";}?></font></strong></font> <br />
                          
                            <span>Usuario: </span>
                           	 	<input name="user" type="text" id="user"><br />
							<span>Senha: &nbsp;&nbsp; </span>
                            	<input name="password" type="password" id="password"> <br />
                                 <span class="button"><input type="image" value="ok" width="94px" style="width:94px; border:none;" src="<?php echo $url; ?>images/entrar-btn2.png"/></span>
         
                                <input name="flag" type="hidden" id="flag" value="verify">
                                <input name="idSystem" type="hidden" id="idSystem" value="54">

                          </div>
                          
						</div>
                    
					</form>
	
		</div>

                    <div class="rodape">
                    
                        <p align="center"> Sistemas Esmaltec - Nome do Sistema </p>
                        
                        <div>
                        </div>
                    </div>
    
</div> 

</body>
</html>
