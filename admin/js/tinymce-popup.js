( function() {

var textarea = document.getElementById( 'code-snippet-input' );
textarea.addEventListener( 'keydown', function( e ) {

	// Handle tabs
	if ( e.keyCode === 9 ) {
		e.preventDefault( e );
		
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

	var $this = this;
	checkInverse( e, $this );
} );

/**
 * Check inverse typing
 * Example - { immediately followed by }
 *
 * }
 * ]
 * '
 * "
 * )
 */
function checkInverse( e, $this ) {

	if ( e.key != '}' &&
	     e.key != ']' &&
	     e.key != "'" &&
	     e.key != '"' &&
	     e.key != ')' ) {
		return;
	}

	var start = $this.selectionStart;
	var end = $this.selectionEnd;
	var prevChar = $this.value.substr( start - 1, 1 );

	if ( e.key == '}' && prevChar == '{' ) {
		$this.value = $this.value.substr( 0, start ) + $this.value.substr( start + 1, end );
		$this.selectionStart = $this.selectionEnd = start;
	} else if ( e.key == ']' && prevChar == '[' ) {
		$this.value = $this.value.substr( 0, start ) + $this.value.substr( start + 1, end );
		$this.selectionStart = $this.selectionEnd = start;
	} else if ( e.key == ')' && prevChar == '(' ) {
		$this.value = $this.value.substr( 0, start ) + $this.value.substr( start + 1, end );
		$this.selectionStart = $this.selectionEnd = start;
	} else if ( e.key == "'" && prevChar == "'" ) {
		$this.value = $this.value.substr( 0, start ) + $this.value.substr( start + 2, end );
		$this.selectionStart = $this.selectionEnd = start + 1;
	} else if ( e.key == '"' && prevChar == '"' ) {
		$this.value = $this.value.substr( 0, start ) + $this.value.substr( start + 2, end );
		$this.selectionStart = $this.selectionEnd = start + 1;
	}
}

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
		var output = '[wp_code_snippets language="' + language + '"]<pre>';
			output += code + '';
		output += '</pre>[/wp_code_snippets]';

		tinyMCEPopup.execCommand('mceReplaceContent', true, output);
 
		// Return
		tinyMCEPopup.close();
	}
}
tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);

var insertButton = document.getElementById( 'code-snippet-insert' );
insertButton.addEventListener( 'click', function() {
	ButtonDialog.insert(ButtonDialog.local_ed)
} );

// Handle editing an existing shortcode
function handleExisiting() {
	var content = tinyMCE.activeEditor.selection.getContent( { format: "text" } );
	var textarea = document.getElementById( 'code-snippet-input' );
	if ( content == '' ) {
		return;
	}

	// Get the language
	if ( ! content.match( /"(.*?)"/ ) ) {
		return;
	}
	var language = content.match( /"(.*?)"/ )[0]
						  .replace( /"/g, '' );

	if ( language == null ) {
		return;
	}

	// Strip the shortcode
	content = content.replace( /\[wp_code_snippets(.*)"\]/, '' );
	content = content.replace( /\[\/wp_code_snippets\]/, '' );
	content = content.trim();

	textarea.value = content;

	// Set the select option
	document.getElementById( 'code-snippet-language' ).value = language;
}

handleExisiting();

} )();