var error_offsets = new Array();
var error_lookaheads = new Array();
var error_count = 0;

//var str = "{1,3}"/*prompt( "Please enter a string to be parsed:", "" );*/ 

function get_cell_values(x,y)
{
	var val_x = x;
	var val_y = y;
	
	if ( $("#doc_table").children().size() < val_y)
		return "Некоректне значення y";
	
	var tr = $("#doc_table tr:eq("+val_y+")");
	
	if ( tr.children().size() < val_x )
		return "Некоректне значення x";

	var td_val = tr.children("td:eq("+val_x+")").text();
	
	return parseFloat(td_val);
}

function calc_formula(str)
{
	if( ( error_count = __parse( str, error_offsets, error_lookaheads ) ) > 0 ) 
	{ 
		var errstr = new String(); 
		for( var i = 0; i < error_count; i++ ) 
			errstr += "Parse error in line " + ( str.substr( 0, error_offsets[i] ).match( /\n/g ) ? str.substr( 0, error_offsets[i] ).match( /\n/g ).length : 1 ) + " near \"" + str.substr( error_offsets[i] ) + "\", expecting \"" + error_lookaheads[i].join() + "\"\n" ;
		return errstr;
	}
	else
		return formula_result;
}