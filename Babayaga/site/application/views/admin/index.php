<?php include 'inicio_inc.php';?>


        <div id="wrapper">
            <div id="content">
       			<div id="rightnow">
                    <h3 class="reallynow">
                        <span>Bem-vindo(a) <?php echo $session_login;?> </span>                       
                        <br />
                    </h3>
					<div style="padding:20px 0 0 150px; margin: 20px">
					<a href="<?php echo base_url();?>admin/galeriafoto/pesquisar"><img src="<?php echo base_url()?>site/img/admin/gallery.png" title="Galeria de Imagens"></a>
					<a href="<?php echo base_url();?>admin/video/listar"><img src="<?php echo base_url()?>site/img/admin/movies.png" title="Videos"></a>
					<a href="<?php echo base_url();?>admin/noticia/manter"><img src="<?php echo base_url()?>site/img/admin/mail-new.png" title="Notícias"></a>
					<a href="<?php echo base_url();?>admin/evento/listar"><img src="<?php echo base_url()?>site/img/admin/schedule.png" title="Eventos"></a>
					<a href="<?php echo base_url();?>admin/babayaga/manter"><img src="<?php echo base_url()?>site/img/admin/contact-new.png" title="perfil babayaga"></a>
					
					</div>
					<!--
					<p class="youhave"><strong>Comentários no site:</strong> <a href="<?php echo base_url();?>">clique aqui</a></p>
					<p class="youhave"><strong>Mensagens recebidas</strong> <a href="<?php echo base_url();?>">clique aqui</a></p>
					-->
				</div>
              
            </div>
         
<?php include 'final_inc.php';?>