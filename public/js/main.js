function requisicaoAjax(url,array){
	
	var ret;

	$.ajax({
		url: url,
		method:'post',
		dataType:'json',
		data: arrayData,
		success: function(json){
			ret = json;
		},
		error: function(json){
			ret = json;
		}
	});

	return ret;
}
