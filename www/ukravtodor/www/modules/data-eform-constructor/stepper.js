
var xml_header 	= "";
var xml_content = "";
var column_count = 0;

function export_header()
{
		var xml = "<Header>\n<htm></htm>\n";
		$("#doc_table .doc_header").each(
		function()
		{
			var tr = $(this);

			xml+="<Row>\n";
			tr.children().each(
				function()
				{
					var td = $(this);
					var text = "";
					var col = td.parent().children().index(td);
					var row = td.parent().parent().children().index(td.parent());
					var rowspan = "rowspan="+td.attr("rowspan");
					var colspan = " colspan="+td.attr("colspan");
					var width = " width="+td.css("width");
					var height = " height="+td.css("height");
					var color = " color="+td.css("color");
					var background_color = " background-color="+td.css("background-color");
					var font_weight = " font-weight="+td.css("font-weight");
					var font_style = " font-style="+td.css("font-style");
					var text_decoration = " text-decoration="+td.css("text-decoration");
					var font_size = " font-size="+td.css("font-size");
					var pddng_lft = " padding-left="+td.css("padding-left");
					var pddng_rght = " padding-right="+td.css("padding-right");
					var pddng_bttm = " padding-bottom="+td.css("padding-bottom");
					var pddng_tp = " padding-top="+td.css("padding-top");	
					var text_align = " text-align="+td.css("text-align");	
					
					var htm = rowspan+colspan+width+height+color+background_color+
							  font_weight+font_style+text_decoration+font_size+
							  pddng_lft+pddng_bttm+pddng_tp+text_align;
					
					if (td.children().size() != 0)
					{
						text = td.children("input").val();
						td.html(text);
					}
					else
						text = td.text();					
						
					td.css("border","1px solid black");
						
					xml += "<Cell>\n";
					xml += "<htm>";xml += htm; xml += "</htm>\n";
					xml += "<text>"; xml+=text;xml+="</text>\n";
					xml += "</Cell>\n";														
				}
			);
			xml += "</Row>\n";
		}
	);
	
	xml+="</Header>\n";
	
	xml_header = xml;
}


function export_content()
{
	var xml = "";
	var cell_id = 0;
	

	
		$("#doc_table .doc_content").each(
		function()
		{
			var tr = $(this);

			xml+="<Content>\n";
			xml+="<DataTable>"; 
			
			var table_url = "modules/data-eform-constructor/get_table_name.php?tab_id="
										+tr.data("tab_id");
			$.ajax({
						url: table_url,
						success: function(data)
						{
							var json_data = jQuery.parseJSON(data);
							xml+=json_data.table;
						},
						async: false
				});
			
			
			xml+="</DataTable>\n";
			xml+="<Serialize>"
			
			if (tr.data("serialize") == "Y")
				xml+="Y";
			else
				xml+="N";
			xml+="</Serialize>\n";
			xml+="<Row>\n";
			tr.children().each(
				function()
				{
					var td = $(this);
					var text = "";
					var col = td.parent().children().index(td);
					var row = td.parent().parent().children().index(td.parent());
					var rowspan = "rowspan="+td.attr("rowspan");
					var colspan = " colspan="+td.attr("colspan");
					var width = " width="+td.css("width");
					var height = " height="+td.css("height");
					var color = " color="+td.css("color");
					var background_color = " background-color="+td.css("background-color");
					var font_weight = " font-weight="+td.css("font-weight");
					var font_style = " font-style="+td.css("font-style");
					var text_decoration = " text-decoration="+td.css("text-decoration");
					var font_size = " font-size="+td.css("font-size");
					var pddng_lft = " padding-left="+td.css("padding-left");
					var pddng_rght = " padding-right="+td.css("padding-right");
					var pddng_bttm = " padding-bottom="+td.css("padding-bottom");
					var pddng_tp = " padding-top="+td.css("padding-top");	
					var text_align = " text-align="+td.css("text-align");	
					
					var htm = rowspan+colspan+width+height+color+background_color+
							  font_weight+font_style+text_decoration+font_size+
							  pddng_lft+pddng_bttm+pddng_tp+text_align;
					
					if (td.children().size() != 0)
					{
						text = td.children("input").val();
						td.html(text);
					}
					else
						text = td.text();					
						
					td.css("border","1px solid black");
						
					xml += "<Cell>\n";
					xml += "<htm>";xml += htm; xml += "</htm>\n";
					// put id
					xml += "<id>"; xml += cell_id; xml += "</id>\n";				
					cell_id +=1;
					// put entity type
					var cell_type = td.data("type");
					xml += "<EntityType>"; xml+= cell_type; xml+="</EntityType>\n";
					// put Entity
					xml+= "<Entity>";
					if (cell_type == "input" || cell_type=="autocomplete")
					{
						var crit_url = "modules/data-eform-constructor/get_criteria.php?criteria_id="
										+td.data("criteria_id");
						$.ajax({
						url: crit_url,
						success: function(data)
						{
							var json_data = jQuery.parseJSON(data);
							xml += "<DataField>"; xml+= json_data.field; xml+= "</DataField>\n";
							xml += "<DataTable>"; xml+= json_data.tab; xml+= "</DataTable>\n";
							if (cell_type =="input")
							{
								xml += "<DataType>";  xml+= json_data.type; xml+="</DataType>\n";							
								xml += "<DataFormat>";xml+= json_data.format; xml+="</DataFormat>\n";
							
								if (json_data.type == "ufloat" || json_data.type =="float")
								{
									xml+= "<DataDecimals>";xml+= json_data.decimals; xml+="</DataDecimals>\n";
									xml+= "<DataSeparator>";xml+= json_data.separator; xml+="</DataSeparator>\n";
								}
							}
						},
						async: false
						});
					}
					xml+= "<Entity>\n";
					
					xml += "</Cell>\n";														
				}
			);
			xml += "</Row>\n";
			xml+="</Content>\n";
		}
	);
	
	xml_content += xml;
}


function clear_table()
{	
	var cur_html = "<table class=\"constructor\">"+$("#doc_table").html()+"</table>";	
	var prev_html = $("#doc_preview").html();
	$("#doc_preview").html(prev_html+cur_html);
	
	var new_html="<tr>",i;
	
	for (i = 0 ; i < column_count ; i ++)
	{
		new_html +="<td>Нова Комірка</td>";
	}
	new_html += "</tr>";
	$("#doc_table").html
	(
		new_html
	);
	
	$("#doc_table td").click(select_cell);
	$("#doc_table td").data("type","text");
	$("#doc_table td").data("field_name","");
	$("#doc_table td").data("table_name","");
	$("#doc_table td").data("field_type","none");
	$("#doc_table td").data("date_format","");
	$("#doc_table td").data("text_size","30");
	$("#doc_table td").data("decimals","4");
	$("#doc_table td").data("delimiter",".");
	$("#doc_table td").data("formula_values",[]);
	$("#doc_table td").data("formula_type","sum");
	$("#doc_table td").data("formula_text","0");
	$("#doc_table td").css("background-color","rgb(175, 192, 205)");
	$("#doc_table td").css("text-align","left");
}

var total_xml="";
function make_total_xml()
{
	total_xml ="";
	total_xml += "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	total_xml += "<EForm>\n";
	total_xml += "<Table>\n";
	total_xml += "<Title>";
	total_xml += "<Label>";
	total_xml += $("#doc_h1_table_name").text(); 
	total_xml += "</Label>\n";
	total_xml += "<htm></htm>\n";
	total_xml += "</Title>\n";
	total_xml += xml_header;
	total_xml += xml_content;
	total_xml += "</Table>\n";
	total_xml += "</EForm>\n";
}

$("#doc_step_submit").click(function()
{
	export_header();
	export_content();
	make_total_xml();
	$("#doc_preview").text(total_xml);
//		$.post("modules/data-eform-constructor/saveasEform.php", { id: document.getElementById('doc_db_table_list').value, content: xml_content },function(data) {alert("Збережено!");} );
//$('#moduleInfo').load('modules/data-eform-constructor/saveEform.php',{id: document.getElementById('doc_db_table_list').value, content: xml_content});

});
