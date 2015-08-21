<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Câmara Municipal de Horizonte - Acesso Restrito</title>
  <link rel="stylesheet" href="<?php echo base_url()?>css/base.css" type="text/css" media="screen" />
   <link rel="stylesheet" id="current-theme" href="<? echo base_url()?>css/default/style.css" type="text/css" media="screen" />
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery-1.3.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.scrollTo.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.localscroll.js"></script>
  <script type="text/javascript" charset="utf-8">
    // <![CDATA[
    var Theme = {
      activate: function(name) {
        window.location.hash = 'themes/' + name
        Theme.loadCurrent();
      },

      loadCurrent: function() {
        var hash = window.location.hash;
        if (hash.length > 0) {
          matches = hash.match(/^#themes\/([a-z0-9\-_]+)$/);
          if (matches && matches.length > 1) {
            $('#current-theme').attr('href', 'stylesheets/themes/' + matches[1] + '/style.css');
          } else {
            alert('theme not valid');
          }
        }
      }
    }

    $(document).ready(function() {
      Theme.loadCurrent();
      $.localScroll();
      $('.table :checkbox.toggle').each(function(i, toggle) {
        $(toggle).change(function(e) {
          $(toggle).parents('table:first').find(':checkbox:not(.toggle)').each(function(j, checkbox) {
            checkbox.checked = !checkbox.checked;
          })
        });
      });
    });
    // ]]>
  </script>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><a href="index.html">CSM - Câmara Municipal de Horizonte</a></h1>
      
      
    </div>
    <div id="wrapper" class="wat-cf">
      <div id="main">

    </div>
    <div id="box">
      
      <div class="block" id="block-login">
        <h2>Acesso restrito</h2>
        <div class="content login">
          <div class="flash">
		<?php if ($erro== "S"){?>
            <div class="message notice">
              <p><b>Login e/ou Senha inválidos</b></p>
            </div>
		<?php } ?>	
          </div>
       
		  <form action="<?= base_url()?>admin/login/validar" method="post" class="form login">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">usuário</label>
              </div>
              <div class="right">
                <input type="text" name="login" class="text_field" />
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">senha</label>
              </div>
              <div class="right">
                <input type="password" name="senha" class="text_field" />
              </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <button class="button" type="submit">
                  <img src="<?php echo base_url()?>images/icons/key.png" alt="Save" /> entrar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
	<!---
      <div class="block" id="block-signup">
        <h2>Sign up</h2>
        <div class="content">
          <form action="#" class="form">
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Login</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" />
                <span class="description">Ex: web-app-theme</span>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Email</label>
              </div>
              <div class="right">
                <input type="text" class="text_field" />
                <span class="description">Ex: test@example.com</span>
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label">Password</label>
              </div>
              <div class="right">
                <input type="password" class="text_field" />
                <span class="description">Must contains the word 'yeah'</span>
              </div>
            </div>

            <div class="group">
              <label class="label">Text field</label>
              <input type="text" class="text_field" />
              <span class="description">Ex: a simple text</span>
            </div>
            <div class="group">
              <label class="label">Text field</label>
              <input type="text" class="text_field" />
              <span class="description">Ex: a simple text</span>
            </div>
            <div class="group navform wat-cf">
              <button class="button" type="submit">
                <img src="images/icons/tick.png" alt="Save" /> Signup
              </button>
            </div>
          </form>
        </div>
		-->
      </div>
    </div>
  </div>
</body>
</html>

