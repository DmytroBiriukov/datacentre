$("#doc_load").click(function() 
{
	var load_url = "modules/data-eform-constructor/eform1.xml";	
	$.ajax({
		url: load_url,
	  	success: function(xml_data) 
	  	{
	  		$("#doc_table").html("");
	  	// load table's title
	  		var xml = $(xml_data);
	  		var title_text = xml.find("Title").find("Label").text();
	  		$("#doc_table_name").val(title_text);
	  		submit_table_name();
	  		
	  	// loading header
	  		xml.find("Header").find("Row").each(function()
	  		{
	  			var xml_row = $(this);
	  			var new_tr = $("<tr></tr>");	  			
	  			
	  			new_tr.attr("class","doc_header");
	  			xml_row.find("Cell").each(function()
	  			{
	  				var row_xml = $(this);
	  				var new_td = $("<td " + row_xml.find("htm").text()+ "></td>");
	  				new_td.text(row_xml.find("text").text());
	  				new_td.click(select_cell);
	  				new_tr.append(new_td);
	  			});
	  			$("#doc_table").append(new_tr);
	  		});
	  		
	  		xml.find("Content").each(function()
	  		{
	  			var xml_content = $(this);
	  			var new_tr = $("<tr></tr>");
	  			
	  			new_tr.attr("class","doc_content");
	  			new_tr.data("serialize", xml_content.find("Serialize").text()); 
	  			
	  			xml_content.find("Row").find("Cell").each(function()
	  			{
	  				var xml_row = $(this);
	  				var new_td = $("<td"+xml_row.find("htm").text() +"></td");	  				
	  				var entity_type = xml_row.find("EntityType").text();
	  				
	  				new_td.data("type",entity_type);
	  				new_td.text("Нова комірка");
	  				new_td.click(select_cell);	  				
	  				new_tr.append(new_td);
	  			});
	  			$("#doc_table").append(new_tr);
	  		});
	  	},
	  	dataType: "xml"
	  	}
	);
});