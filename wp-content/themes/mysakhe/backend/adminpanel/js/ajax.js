jQuery(document).ready(function($){
	window.load_table_data = function(table, query){
		dataTable = $(table).dataTable();
	 	dataTable.fnClearTable();
    		dataTable.fnDraw();  
		jQuery.ajax({
            type:"POST",
            url: ajaxUrl,
            data: query,
            success: function(data){
            	data = JSON.parse(data); 
            	$.each(data, function(index, data) {
            		var data = $.map(data, function(value, index) {
    				return [value];
				});
            	 $(table).dataTable().fnAddData( data ); 
            	});
    			
            },
            error: function(errorThrown){
                  error = JSON.stringify(errorThrown);
            } 
        });
	}
	window.submit_data = function($data, $function_name=null){
		$.ajax({
			url: ajaxUrl,
			method: "POST",
			data: $data,
			success: function(data){
				data = JSON.parse(data);
				if(data.success){
					alert(data.msg);
				}
				$function_name();
			}
		});
	}
	window.get_data = function(query){
		return JSON.parse($.ajax({
			url: ajaxUrl,
			method: "POST",
			data: query,
			 global: false,
                async: false,
			success: function(data){
				return data;
			}
		}).responseText);
	}
});