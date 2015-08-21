(function($) {
	$.fn.limitText = function(maxSize) {
		return this.each(function(){
			maxSize = (maxSize) ? maxSize : $(this).attr('maxlength');
			
			$(this).keypress(function(e) {
				if (this.value.length >= maxSize && e.which > 31) {
					return false;
				} 
			});
			
			$(this).keyup(function(e) {
				if (this.value.length > maxSize) {
					$(this).val(this.value.substr(0, maxSize));
				} 
			});
				
		});
	};
})(jQuery);