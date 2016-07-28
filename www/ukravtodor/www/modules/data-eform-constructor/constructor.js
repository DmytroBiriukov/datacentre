var current_cell = $("#doc_table td:first");
//$("#doc_table td").css("background-color","white");

function get_current_row()
{	
	return current_cell.parent();
}

function get_current_col()
{
	var current_row = get_current_row();	
	var index = $("#doc_td_pos_x").text();
	
	return current_row.children().eq(index);	
}

function manage_menu()
{
	if ( current_cell.parent().attr("class") == "doc_header" )
	{
		$("#doc_now_editing").text("Шапка таблиці");
		
		$("#doc_db_connect").hide();
//		$("#doc_manage_parameters").hide();
		$("#doc_manage_tr").show();
		$("#doc_manage_db_data").hide();
		$("#doc_manage_cells").show();
		
		$("#doc_tab2").text("Вставка рядків");
		$("#doc_tab3").text("Вставка комірок");
	}
	else
	{
		$("#doc_now_editing").text("Частина з даними для шаблону звітньої форми");
		
		$("#doc_db_connect").show();		
//		$("#doc_manage_parameters").show();
		$("#doc_manage_tr").hide();
		$("#doc_manage_db_data").show();
		$("#doc_manage_cells").hide();
		
		$("#doc_tab2").text("Параметри звітньої форми");
		$("#doc_tab3").text("Дані в комірці");	
	}

}


function select_cell()
{
	//remove editable text
	var edit_text = current_cell.children("input").val();
	current_cell.html(edit_text);	
	
	if (current_cell.data("type")=="formula")
	{
		current_cell.html(calc_formula(edit_text));
		current_cell.data("formula_text",edit_text);		
	}

	// do "select" animation
	current_cell.css("border-color","black");
	$(this).css("border-color","red");
	current_cell = $(this);		
	
	manage_menu();
	
	// display col,row
	var col = $(this).parent().children().index($(this));
	var row = $(this).parent().parent().children().index($(this).parent());
	
	$("#doc_td_pos_x").text(col);
	$("#doc_td_pos_y").text(row);	
	
	//make current cell editable
	var static_text = current_cell.text();
	var input_width = current_cell.css("width");
	var input_height = current_cell.css("height");
	var input_input = $("<input type=\"text\" />");
	input_input.css("width",input_width);	
	input_input.css("height",input_height);
	input_input.css("margin","0px 0px 0px 0px");
	input_input.css("padding","0px 0px 0px 0px");

	// if it's doc_content, then dispay valid table
	if (current_cell.parent().attr("class") == "doc_content")
	{
		var tab_id = current_cell.parent().data("tab_id");
		$("#data_table_list [value='"+ tab_id +"']").attr("selected","selected");	
		$('#Parameters').load('modules/data-eform-constructor/list_param.php',{tabtitle:tab_id});
	    $('#Criteria').load('modules/data-eform-constructor/list_criteria.php',{tabtitle:tab_id});
	    
	    var is_serialized = current_cell.parent().data("serialize")=="Y";
	    $("#doc_serialize").attr("checked",is_serialized);
	    	
	}
	
	// if it's formula, then display it's data
	if (current_cell.data("type") == "formula")
		input_input.val(current_cell.data("formula_text"));
	else
		input_input.val(static_text);
	current_cell.html(input_input);		
	input_input.focus();	
	
	// display colspan,rowspan
	$("#doc_td_rowspan").val( $(this).attr("rowspan"));
	$("#doc_td_colspan").val( $(this).attr("colspan"));
				
	// display tr's height
	var current_row = get_current_row();
	$("#doc_tr_height").val( current_row.css("height"));
	
	// display td's width
	var current_col = get_current_col();
	$("#doc_td_width").val ( current_col.css("width"));
	
	// display type
	var type = current_cell.data("type");
	$("#doc_td_type [value='"+ type +"']").attr("selected","selected");
	
	// display criteria
	var criteria_id = current_cell.data("criteria_id");
	$("#id_criteria [value='"+ criteria_id +"']").attr("selected","selected");	
	
	// display font color
	var color = current_cell.css("color");
	$("#doc_td_color [value='"+ color +"']").attr("selected","selected");
	
	// display background color
	var bg_color = current_cell.css("background-color");
	$("#doc_td_bgcolor [value='"+ bg_color +"']").attr("selected","selected");			
	
	// display bold
	var is_bold = current_cell.css("font-weight") == "bold";
	$("#doc_td_bold").attr("checked", is_bold);
	
	// display italic
	var is_italic = current_cell.css("font-style") == "italic";
	$("#doc_td_italic").attr("checked",is_italic);
	
	// display line-through
	var is_line_through = current_cell.css("text-decoration") == "line-through";
	$("#doc_td_line_through").attr("checked",is_line_through);
	
	// display font-size
	var font_size = current_cell.css("font-size");
	$("#doc_td_font_size").val(font_size);	
	
	//display padding
	var padding_left 	= current_cell.css("padding-left");
	var padding_right	= current_cell.css("padding-right");
	var padding_bottom   = current_cell.css("padding-bottom");
	var padding_top		= current_cell.css("padding-top");	
	
	$("#doc_td_padding_left").	val(padding_left);
	$("#doc_td_padding_right").	val(padding_right);
	$("#doc_td_padding_bottom").	val(padding_bottom);
	$("#doc_td_padding_top").	val(padding_top);
	
	// display align
	var text_align = current_cell.css("text-align");
	if 		(text_align == "left")
		$("#doc_td_text_align_left").attr("checked","checked");
	else if (text_align == "center")
		$("#doc_td_text_align_center").attr("checked","checked");
	else if (text_align == "right")
		$("#doc_td_text_align_right").attr("checked","checked");
		
	// display or hide db data	
	var cell_type = current_cell.data("type");
	if (cell_type == "input")
		$("#doc_db_data").show();
	else
		$("#doc_db_data").hide();
	
	// display table name and field name and type
	if (cell_type == "input")
	{
		$("#doc_td_table_list").children("[value='"+current_cell.data("table_name")+"']").attr("selected","selected");
		$("#doc_td_field_name").val(current_cell.data("field_name"));
		$("#doc_td_input_field").children("[value='"+current_cell.data("field_type")+"']").attr("selected","selected");
	}
	
	// display additional field settings
	var field_type = current_cell.data("field_type");
	if (field_type == "date")
	{
		$("#doc_p_date_format").show();
		$("#doc_td_date_format").val(current_cell.data("date_format"));
	}
	else
		$("#doc_p_date_format").hide();
	
	if (field_type == "char")
	{
		$("#doc_p_text_size").show();
		$("#doc_td_text_size").val(current_cell.data("text_size"));
	}
	else
		$("#doc_p_text_size").hide();
		
	if (field_type == "float" || field_type == "ufloat")
	{
		$("#doc_p_decimals").show();
		$("#doc_p_delimiter").show();
		$("#doc_td_decimals").val(current_cell.data("decimals"));
		$("#doc_td_delimiter").val(current_cell.data("delimiter"));
	}
	else
	{
		$("#doc_p_decimals").hide();
		$("#doc_p_delimiter").hide();
	}
	
	// display formula values and type
	if (cell_type == "formula")
	{
		var div_formula = $("#doc_div_formula");
		var formula_vals = current_cell.data("formula_values");
		
		$("#doc_select_formula").html("");
		for (var i = 0; i < formula_vals.length ; i +=2)
		{
			var new_option = $("<option></option>");			
			new_option.text(formula_vals[i]+":"+formula_vals[i+1]);
			$("#doc_select_formula").append(new_option);
			
			$("#doc_select_formula_type").children("[value='"+current_cell.data("formula_type")+"']").attr("selected","selected");
		}
		div_formula.show();
	}
	else
		$("#doc_div_formula").hide();	
		

	
/*	change_color();
	change_bgcolor();*/
	change_bold();
	change_italic();
	change_line_through();
	submit_font_size();
}

function add_content_tr()
{
	var tr_jquery = get_current_row();
	
	var header_column_count = $("#doc_table .doc_header:last").children().length;
	var new_row_html = "<tr class=\"doc_content\">";
	
	for (var i = 0 ; i < header_column_count; i ++)
		new_row_html += "<td>Нова комірка</td>";
	new_row_html += "</tr>";
	
	var new_row = $(new_row_html);
	var new_cell;
	new_row.children().each(
		function()
	{
		new_cell = $(this);
		new_cell.data("type","text");
		new_cell.data("field_name","");
		new_cell.data("table_name","");
		new_cell.data("field_type","none");
		new_cell.data("date_format","");	
		new_cell.data("text_size","30");
		new_cell.data("decimals","4");
		new_cell.data("delimiter",".");
		new_cell.data("formula_values",[]);
		new_cell.data("formula_type","sum");
		new_cell.data("formula_text","0");
		new_cell.css("background-color","rgb(175, 192, 205)");
		new_cell.css("text-align","left");
		new_cell.click(select_cell);
	}
	);

	
	tr_jquery.after(new_row);
		
	new_cell.click();
}

function del_content_tr()
{
	if ($("#doc_table .doc_content").size() == 1)
	{
		alert("Неможливо видалити останній рядок!");
	}
	else
	{
		var tr_jquery = get_current_row();
		tr_jquery.remove();		
		$("#doc_table .doc_content:first").children(":first").click();
	}
}

function add_tr(after)
{		
	var tr_jquery = get_current_row();
	var new_row = $("<tr class=\"doc_header\"><td>Нова комірка</td></tr>");
	var new_cell = new_row.children("td:first");
	
	new_cell.data("type","text");
	new_cell.data("field_name","");
	new_cell.data("table_name","");
	new_cell.data("field_type","none");
	new_cell.data("date_format","");	
	new_cell.data("text_size","30");
	new_cell.data("decimals","4");
	new_cell.data("delimiter",".");
	new_cell.data("formula_values",[]);
	new_cell.data("formula_type","sum");
	new_cell.data("formula_text","0");
	new_cell.css("background-color","rgb(175, 192, 205)");
	new_cell.css("text-align","left");
	new_cell.click(select_cell);
	
	if (after)
	{
		tr_jquery.after(new_row);
		
		if ($("#doc_table .doc_header:last")[0] == new_row[0])
		{
			$(".doc_content").each(function() {
				var tr_jquery1 = $(this);
				tr_jquery1.children(":gt(0)").remove();
			});
		}
	}
	else
		tr_jquery.before(new_row);
		
	new_cell.click();
}


function add_tr_after(){add_tr(true);}
function add_tr_before(){add_tr(false);}

function get_new_cell()
{
	var new_cell = $("<td>Нова комірка</td>")
	
	new_cell.data("type","text");
	new_cell.data("field_name","");
	new_cell.data("table_name","");	
	new_cell.data("field_type","none");	
	new_cell.data("date_format","");
	new_cell.data("text_size","30");	
	new_cell.data("decimals","4");	
	new_cell.data("delimiter",".");	
	new_cell.data("formula_values",[]);	
	new_cell.data("formula_type","sum");
	new_cell.data("formula_text","0");	
	new_cell.css("background-color","rgb(175, 192, 205)");
	new_cell.css("text-align","left");
	new_cell.click(select_cell);
	
	return new_cell;
}

function is_last_tr_header()
{
	return current_cell.parent()[0] == $("#doc_table .doc_header:last")[0];
}

function add_td(after)
{
	var new_cell = get_new_cell();
	
	if (is_last_tr_header())
	{
		var insert_index = current_cell.prevAll().length;
		$(".doc_content").each(function(){
			var tr_jquery = $(this);
			
			if (after)
				tr_jquery.children(":eq("+insert_index+")").after(get_new_cell());
			else
				tr_jquery.children(":eq("+insert_index+")").before(get_new_cell());			
		});
	}
	
	if (after)
		current_cell.after(new_cell);
	else
		current_cell.before(new_cell);
}

function add_td_after(){add_td(true);}
function add_td_before(){add_td(false);}



function delete_tr()
{
	var tr_jquery = get_current_row();
	
	if ($("#doc_table .doc_header").size() == 1)
		alert("Неможливо видалити останній рядок!");
	else
	{
		if (is_last_tr_header())
		{
			var old_col_count = current_cell.parent().children().length;
			var new_col_count = current_cell.parent().prev().children().length;
			
			if (old_col_count > new_col_count)
			{
				var to_delete_count = old_col_count - new_col_count;
				$(".doc_content").each(function() {
					var tr_jquery1 = $(this);
					for (var i = 0 ; i < to_delete_count ; i ++)
						tr_jquery1.children(":last").remove();
				});
			}
			else if (old_count < new_col_count)
			{
				var to_add_count = new_col_count - old_col_count;
				$(".doc_content").each(function(){
					var tr_jquery1 = $(this);
					for (var i = 0; i < to_add_count; i ++)
						tr_jquery1.chlildren(":last").after(get_new_cell());
				});
			}
		}
	
		tr_jquery.remove();		
		$("#doc_table td:first").click();
	}
}

function delete_td()
{
	if (current_cell.parent().children().size() == 1)
		delete_tr();
	else
	{	
		if (is_last_tr_header())
		{
			var delete_index = current_cell.prevAll().length;	
			$(".doc_content").each(function() {
				var tr_jquery = $(this);
				
				tr_jquery.children(":eq("+delete_index+")").remove();
			});
		}
		
		current_cell.remove();
		$("#doc_table td:first").click();
	}
}

function submit_rowspan()
{
	current_cell.attr("rowspan", $("#doc_td_rowspan").val() );
	
	if (is_last_tr_header())
	{
		var rowspan_index = current_cell.prevAll().length;
		$("#doc_table .doc_content").each(function() 
		{
			var tr_jquery = $(this);		
			tr_jquery.children(":eq("+rowspan_index+")").attr("rowspan", $("#doc_td_rowspan").val());
		});	
	}
}
function submit_colspan()
{
	current_cell.attr("colspan", $("#doc_td_colspan").val() );

	if (is_last_tr_header())
	{
		var colspan_index = current_cell.prevAll().length;
		$("#doc_table .doc_content").each(function() 
		{
			var tr_jquery = $(this);		
			tr_jquery.children(":eq("+colspan_index+")").attr("colspan", $("#doc_td_colspan").val());
		});	
	}
}

function submit_trheight()
{
	var current_row = get_current_row();
	
	current_row.css("height", $("#doc_tr_height").val());
}

function submit_tdwidth()
{
	var current_col = get_current_col();
	
	current_col.css("width", $("#doc_td_width").val());
}

function change_type()
{
	var new_type = $("#doc_td_type :selected").val();
	var db_data = $("#doc_db_data");
	
	current_cell.data("type",new_type);
	if 		(new_type == "counter")	
	{	
		current_cell.html("Нумератор");		
		db_data.hide();
	}
	else if	(new_type == "input")
	{
		current_cell.html("Поле з БД");
//		var criteria_id = $("#id_criteria :selected").val();
//		current_cell.data("criteria_id",criteria_id);
		$("#doc_td_input_field").children(":first").attr("selected","selected");
		db_data.show();
	}
	else if (new_type == "autocomplete")
	{
		current_cell.html("Поле з БД для заповнення");
//		var criteria_id = $("#id_criteria :selected").val();
//		current_cell.data("criteria_id",criteria_id);
		$("#doc_td_input_field").children(":first").attr("selected","selected");
		db_data.show();	
	}
	else if (new_type == "formula")
	{
//		current_cell.html("formula");
		db_data.hide();
	}
			
			
	if (!(new_type == "input" || new_type == "autocomplete"))
	{
		current_cell.off("mouseenter");
		current_cell.off("mouseleave");
	}
	
	current_cell.click();
}

function change_criteria()
{	
		var criteria_id = $("#id_criteria :selected").val();
		current_cell.data("criteria_id",criteria_id);
		
		current_cell.off("mouseenter");
		current_cell.off("mouseleave");
		
		current_cell.mouseenter(function()
		{
			var crit_url = "modules/data-eform-constructor/get_criteria.php?criteria_id="
										+$(this).data("criteria_id");
			var crit_desc;
										
			$.ajax({
			url: crit_url,
			success: function(data)
			{
				var json_data = jQuery.parseJSON(data);
				var html_data = "Назва: <strong>";
				html_data+=json_data.title;
				html_data+="</strong>, ";
				html_data+=json_data.measure;
				html_data+="</br>Тип: <em>";
				html_data+=json_data.texttype;
				html_data+="</em>";
				$("#doc_db_preview").html(html_data);
			}
			//,
//			async: false
			});
			

		}
		);
		current_cell.mouseleave(function()
		{
			$("#doc_db_preview").text("");
		}
		);
}

function change_color()
{
	var new_color = $("#doc_td_color :selected").val();
	
	current_cell.css("color",new_color);
//	current_cell.children().css("color",new_color);	
}

function change_bgcolor()
{
	var new_color = $("#doc_td_bgcolor :selected").val();
	
	current_cell.css("background-color",new_color);
//	current_cell.children().css("background-color",new_color);	
}

function change_bold()
{
	var is_bold = $("#doc_td_bold").is(":checked");
	
	if (is_bold)
	{
		current_cell.css("font-weight","bold");
		current_cell.children().css("font-weight","bold");
	}
	else
	{
		current_cell.css("font-weight","normal");
		current_cell.children().css("font-weight","normal");
	}
}

function change_italic()
{
	var is_italic = $("#doc_td_italic").is(":checked");
	
	if (is_italic)
	{
		current_cell.css("font-style","italic");
		current_cell.children().css("font-style","italic");	
	}
	else
	{
		current_cell.css("font-style","normal");
		current_cell.children().css("font-style","normal");		
	}	
}

function change_line_through()
{
	var is_line_through = $("#doc_td_line_through").is(":checked")
	
	if (is_line_through)
	{
		current_cell.css("text-decoration","line-through");
		current_cell.children().css("text-decoration","line-through");		
	}
	else
	{
		current_cell.css("text-decoration","none");
		current_cell.children().css("text-decoration","none");		
	}
}


  function ConvertCssPxToInt(cssPxValueText) {

            // Set valid characters for numeric number.
            var validChars = "0123456789.";

            // If conversion fails return 0.
            var convertedValue = 0;

            // Loop all characters of
            for (i = 0; i < cssPxValueText.length; i++) {

                // Stop search for valid numeric characters,  when a none numeric number is found.
                if (validChars.indexOf(cssPxValueText.charAt(i)) == -1) {

                    // Start conversion if at least one character is valid.
                    if (i > 0) {
                        // Convert validnumbers to int and return result.
                        convertedValue = parseInt(cssPxValueText.substring(0, i));
                        return convertedValue;
                    }
                }
            }

            return convertedValue;
        }
        
function submit_font_size()
{
	var new_size = ConvertCssPxToInt($("#doc_td_font_size").val());
	
	
	current_cell.css("font-size",new_size+"px");
	current_cell.children().css("font-size",(new_size - 2)+"px");	
}

function submit_padding_left(){current_cell.css("padding-left",$("#doc_td_padding_left").val());}
function submit_padding_right(){current_cell.css("padding-right",$("#doc_td_padding_right").val());}
function submit_padding_bottom(){current_cell.css("padding-bottom",$("#doc_td_padding_bottom").val());}
function submit_padding_top(){current_cell.css("padding-top",$("#doc_td_padding_top").val());}
function submit_table_name(){$("#doc_h1_table_name").text($("#doc_table_name").val());}

function change_text_align()
{
	var new_align = "";
	
	if 		($("#doc_td_text_align_left").attr("checked"))
		new_align = "left";
	else if ($("#doc_td_text_align_center").attr("checked"))
		new_align = "center"
	else if ($("#doc_td_text_align_right").attr("checked"))	
		new_align = "right";

	current_cell.css("text-align",new_align);
}

function create_new_table()
{
	var new_option = $("<option></option>");
	var new_cell_option = $("<option></option>");
	var new_table_name = $("#doc_db_new_table").val();
	var table_list = $("#doc_db_table_list"); 
	var cell_table_list = $("#doc_td_table_list");
	var table_list_children = table_list.children();
	var can_create = true;
	
	for (var i = 0; i < table_list_children.size(); i ++)
	{	
		if (table_list_children.eq(i).text()  == new_table_name)
		{
			can_create = false;
			alert("Таблиця з назвою '"+new_table_name+"' вже існує в даному наборі");
			break;
		}
	}

	if (can_create)
	{
		new_option.data("key","");
		new_option.data("query","");
		new_option.text(new_table_name);
		new_cell_option.text(new_table_name);
		table_list.append(new_option);		
		cell_table_list.append(new_cell_option);
	}
}

function change_db_table()
{
	var selected_table = $("#doc_db_table_list :selected");

	$("#doc_db_table_key").val(selected_table.data("key"));
	$("#doc_db_table_query").val(selected_table.data("query"));
}

function submit_db_table_key(){ $("#doc_db_table_list :selected").data("key",$("#doc_db_table_key").val());}
function submit_db_table_query(){ $("#doc_db_table_list :selected").data("query",$("#doc_db_table_query").val());}
function submit_delete_table()
{
	var table_option = $("#doc_db_table_list :selected");
	var table_name = table_option.val();	
	var cell_option = $("#doc_td_table_list").children("[value='"+table_name+"']");

	table_option.remove();
	cell_option.remove();
}

function change_td_table(){current_cell.data("table_name",$("#doc_td_table_list").val());}
function submit_field_name(){current_cell.data("field_name",$("#doc_td_field_name").val());}
function change_td_field_type(){current_cell.data("field_type",$("#doc_td_input_field").val());current_cell.click();}
function submit_date_format(){current_cell.data("date_format",$("#doc_td_date_format").val());}
function submit_text_size(){current_cell.data("text_size",parseInt($("#doc_td_text_size").val()));}
function submit_decimals(){current_cell.data("decimals",parseInt($("#doc_td_decimals").val()));}
function submit_delimiter(){current_cell.data("delimiter",$("#doc_td_delimiter").val());}

function connect_table()
{
	var tab_id = $("#data_table_list").val();
	
	current_cell.parent().data("tab_id",tab_id);
}

function change_serialize()
{
	if($("#doc_serialize").is(":checked"))
		current_cell.parent().data("serialize","Y");
	else
		current_cell.parent().data("serialize","N");
}

$("#doc_add_tr_after").click(add_tr_after);
$("#doc_add_tr_before").click(add_tr_before);
$("#doc_delete_tr").click(delete_tr);

$("#doc_add_td_after").click(add_td_after);
$("#doc_add_td_before").click(add_td_before);
$("#doc_delete_td").click(delete_td);
$("#doc_td_submit_rowspan").click(submit_rowspan);
$("#doc_td_submit_colspan").click(submit_colspan);
$("#doc_tr_submit_height").click(submit_trheight);
$("#doc_td_submit_width").click(submit_tdwidth);
$("#doc_td_type").change(change_type);
$("#doc_td_color").change(change_color);
$("#doc_td_bgcolor").change(change_bgcolor);
$("#doc_td_bold").change(change_bold);
$("#doc_td_italic").change(change_italic);
$("#doc_td_line_through").change(change_line_through);
$("#doc_td_submit_font_size").click(submit_font_size);
$("#doc_td_submit_padding_left").click(submit_padding_left);
$("#doc_td_submit_padding_right").click(submit_padding_right);
$("#doc_td_submit_padding_bottom").click(submit_padding_bottom);
$("#doc_td_submit_padding_top").click(submit_padding_top);
$("#doc_submit_table_name").click(submit_table_name);
$("#doc_td_text_align_left").change(change_text_align);
$("#doc_td_text_align_center").change(change_text_align);
$("#doc_td_text_align_right").change(change_text_align);
$("#doc_db_submit_new_table").click(create_new_table);
$("#doc_db_table_list").change(change_db_table);
$("#doc_db_submit_table_key").click(submit_db_table_key);
$("#doc_db_submit_table_query").click(submit_db_table_query);
$("#doc_db_delete_table").click(submit_delete_table);
$("#doc_td_table_list").change(change_td_table);
$("#doc_td_submit_field_name").click(submit_field_name);
$("#doc_td_input_field").change(change_td_field_type);
$("#doc_td_submit_date_format").click(submit_date_format);
$("#doc_td_submit_text_size").click(submit_text_size);
$("#doc_td_submit_decimals").click(submit_decimals);
$("#doc_td_submit_delimiter").click(submit_delimiter);
$("#doc_add_content_tr").click(add_content_tr);
$("#doc_del_content_tr").click(del_content_tr);
$("#doc_connect_table").click(connect_table);
$("#doc_serialize").change(change_serialize);

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


$("#doc_table td:first").click();

