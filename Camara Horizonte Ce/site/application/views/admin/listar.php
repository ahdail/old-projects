<?php include 'inicio.inc.php';?>

   

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="#block-text">Text</a></li>
              <li class="active"><a href="#block-tables">Tables</a></li>
              <li><a href="#block-forms">Forms</a></li>
              <li><a href="#block-messages">Messages</a></li>
              <li><a href="#block-forms-2">2 Columns Forms</a></li>
              <li><a href="#block-lists">Lists</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Tables</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table">
                  <tr>
                    <th class="first"><input type="checkbox" class="checkbox toggle" /></th>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th class="last">&nbsp;</th>
                  </tr>
                  <tr class="odd">
                    <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>1</td><td>hulk</td><td>Hulk</td><td>Hogan</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
                  </tr>
                  <tr class="even">
                    <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>2</td><td>ultimate</td><td>Ultimate</td><td>Warrior</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
                  </tr>
                  <tr class="odd">
                    <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>3</td><td>andre</td><td>Andre</td><td>The Giant</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
                  </tr>
                  <tr class="even">
                    <td><input type="checkbox" class="checkbox" name="id" value="1" /></td><td>4</td><td>machoman</td><td>Macho Man</td><td>Randy Savage</td><td class="last"><a href="#">show</a> | <a href="#">edit</a> | <a href="#">destroy</a></td>
                  </tr>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">
                    <button class="button" type="submit">
                      <img src="images/icons/cross.png" alt="Delete" /> Delete
                    </button>
                  </div>
                  <div class="pagination">
                    <span class="disabled prev_page">« Previous</span><span class="current">1</span><a rel="next" href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><a href="#">10</a><a href="#">11</a><a rel="next" class="next_page" href="#">Next »</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <?php include 'final.inc.php';?>
