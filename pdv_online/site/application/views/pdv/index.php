<?php include 'inicio_inc.php';?>


        <div id="wrapper">
            <div id="content">
       			<div id="rightnow">
                    <h3 class="reallynow">
                        <span>Bem-vindo(a) <?php echo $session_login;?> </span>                       
                        <br />
                    </h3>
				    <p class="youhave"><strong>Para verificar seu caixa</strong> <a href="<?= base_url()?>pdv/caixa/verifica/<? echo $session_idUsuario?>">clique aqui</a>
                    </p>
				</div>
              
            </div>
         
<?php include 'final_inc.php';?>