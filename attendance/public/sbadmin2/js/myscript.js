$(document).on('focus','#keyword',function(){
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url:BaseUrl+'/home/search',
				type: "POST",
				dataType: "json",
				data: {
				   keyword: request.term,
				   type: 'param'
				},
				 success: function( data ) {
					if(data.length){
						response( $.map( data, function( item ) {
							var code = item.split("|");
							return {
								label: code[1],
								value: code[1],
								data : item
							}
						}));
					}
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var respon = ui.item.data.split("|");						
				$('#keyid').val(respon[0]);
				$('#keyword').val(respon[1]);
			}
	});
});

$(document).on('focus','#keywordbig',function(){
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url:BaseUrl+'/home/search',
				type: "POST",
				dataType: "json",
				data: {
				   keyword: request.term,
				   type: 'param'
				},
				 success: function( data ) {
					if(data.length){
						response( $.map( data, function( item ) {
							var code = item.split("|");
							return {
								label: code[1],
								value: code[1],
								data : item
							}
						}));
					}
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var respon = ui.item.data.split("|");						
				$('#keyidbig').val(respon[0]);
				$('#keywordbig').val(respon[1]);
			}
	});
});