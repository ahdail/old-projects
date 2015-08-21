<?php
include 'inicio_inc.php';

?>
        <div id="wrapper">
            <div id="content">
                
                <br />
                <div id="box">
                	<h3 id="adduser">Venda realizadas</h3>
                    <form id="form" action="..." method="post">
					
                      <fieldset id="personal">
					 
                        <legend>Realizar vendas</legend>
						
                        <label>&nbsp;</label>
						<b>Quantidade | &nbsp; Valor(R$)</b>
						
						
                        <br />
						
                        <label for="lastname">Comerciário : </label> 
                        <input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						<input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						
                        <br />
                        <label for="firstname">Dependente : </label>
                        <input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						<input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
                        <br />
                        <label for="email">Dep. 7 até 12: </label>
                        <input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						<input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
                        <br />
                       
                        <label for="pass">Usuário : </label>
                        <input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						<input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
                        <br />
                        <label for="pass-2">Servidor : </label>
                        <input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
						<input name="lastname" size="6" id="lastname" type="text" tabindex="1" />
                        <br />
                      </fieldset>
                      
                      
                      <div align="center">
                      <input id="button1" type="submit" value="Venda" /> 
                      <input id="button2" type="reset"  value="Cancelar"/>
                      </div>
                    </form>

                </div>
            </div>
<?php
include 'final_inc.php';

?>