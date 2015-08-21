$(document).ready(function() {
	$("body").fixPng();
	
	$('#slider').nivoSlider();
	$('#modalContato').hide();
	$('#modalServico').hide();
	
	$('#contatoModal').click(abreModalContato);
	$('#servicoModal').click(abreModalServico);
	
	$('#fechaContato').click(function(){
		$('#modalContato').hide();
		$('#mask').fadeOut(1000);	
	});
	
	$('#fechaServico').click(function(){
		$('#servicoModal').hide();
		$('#mask').fadeOut(1000);	
	});
	
	
	
	function abreModalContato(e){
		e.preventDefault();
		$('#modalContato').fadeIn(1000);	
		
		var maskHeight = $(document).height();
		var maskWidth = $(document).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		var winH = $(document).height();
		var winW = $(document).width();
              
		$('#modalContato').css('top',  winH/3-$('#modalContato').height()/2);
		$('#modalContato').css('left', winW/2-$('#modalContato').width()/2);
		
		
		$('#mask').click(function () {
			$('#mask').fadeOut(1000);	
			$('#modalContato').fadeOut(1000);
			
		});	
	}
	
	function abreModalServico(e){
		e.preventDefault();
		$('#modalServico').fadeIn(1000);	
		
		var maskHeight = $(document).height();
		var maskWidth = $(document).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		var winH = $(document).height();
		var winW = $(document).width();
              
		$('#modalServico').css('top',  winH/3-$('#modalContato').height()/2);
		$('#modalServico').css('left', winW/2-$('#modalContato').width()/2);
		
		$('#mask').click(function () {
			$('#mask').fadeOut(1000);	
			$('#modalServico').fadeOut(1000);
			
		});	
		
	}
	

	
});