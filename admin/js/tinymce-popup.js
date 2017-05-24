( function() {

var textarea = document.getElementById( 'code-snippet-input' );
textarea.addEventListener( 'keydown', function( e ) {
	console.log( e.key );
	// Handle tabs
	if ( e.keyCode === 9 ) {
		e.preventDefault();
		
		var start = this.selectionStart;
		var end = this.selectionEnd;

		this.value = this.value.substr( 0, start ) + '\t' + this.value.substr( end );
		this.selectionStart = this.selectionEnd =start + 1;
	} else if ( e.keyCode === 222 || e.keyCode === 219 ) {
		// Handle "" - 222, '' - 222, {} - 219, [] - 219
		var start = this.selectionStart;
		var end = this.selectionEnd;

		var inverse;

		switch ( e.key ) {
			case "'":
				inverse = "'";
				break;
			case '"':
				inverse = '"';
				break;
			case '{':
				inverse = '}';
				break;
			case '[':
				inverse = ']'
				break;
		}

		this.value = this.value.substr( 0, start ) + inverse + this.value.substr( end );
		this.selectionStart = this.selectionEnd = start;

	} else if ( e.keyCode === 57) {
		// Handle ( - 57
		if ( e.key == '(' ) {
			var start = this.selectionStart;
			var end = this.selectionEnd;

			this.value = this.value.substr( 0, start ) + ')' + this.value.substr( end );
			this.selectionStart = this.selectionEnd = start;
		}
	}
} );

// Handle the output
var ButtonDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ButtonDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {
 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
 
		// set up variables to contain our input values
		var language = document.getElementById( 'code-snippet-language' ).value;
		var code = document.getElementById( 'code-snippet-input' ).value;

		// setup the output of our shortcode
		var output = '<pre>[wp_code_snippets language="' + language + '"]\n';
			output += code + '\n';
		output += '[/wp_code_snippets]</pre>';

		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
 
		// Return
		tinyMCEPopup.close();
	}
}
tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);

var insertButton = document.getElementById( 'code-snippet-insert' );
insertButton.addEventListener( 'click', function() {
	ButtonDialog.insert(ButtonDialog.local_ed)
} );

} )();