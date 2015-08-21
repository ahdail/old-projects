
   <tr class="<?=$cor?>" id="linha_<?=$pergunta['id']?>">
     <th scope="col"><?=$pergunta['pergunta']?></th>
     <th scope="col">
     <select id="tema_<?=$pergunta['id']?>"  style="width: 400px;">
     	<option value="0">Selecione:</option>
  		<? foreach($temas as $tema) { ?>
			<option value='<?=$tema['id']?>'><?=$tema['tema']?></option>
		<? } ?>
     </select>
     
     <a href="#nogo" onclick="mudaTema(<?=$pergunta['id']?>);">[OK]</a>
     </th>
   </tr>