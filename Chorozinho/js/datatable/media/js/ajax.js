$(function(){
      $("#carregando").hide();
         $("a#grupo").click(function(){
            pagina = $(this).attr('href')
           $("#carregando").ajaxStart(function(){
               $(this).show()
               })
            $("#carregando").ajaxStop(function(){
               $(this).hide();
               
            })
            
			 $("#conteudo").attr('src', pagina);
            return false;	
            
         })		 
})

