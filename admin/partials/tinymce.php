<html>
<head>
	<meta charset="UTF-8">
	<title>Insert Code Snippet</title>
	<link href="<?php echo includes_url() . '/js/tinymce/themes/advanced/skins/wp_theme/dialog.css' ;?>" />
	<style>
		label {
			font-family: sans-serif;
		}
		textarea {
			font-family: monospace;
			height: 80%;
			width: 100%;
		}
		select,
		textarea {
			margin-bottom: 10px;
		}
		* {
			font-size: 16px !important;
		}
	</style>
</head>
<body>
	<form action="/" method="get" accept-charset="utf-8">
		<label for="code-snippet-language">Language</label>
		<select id="code-snippet-language">
			<?php foreach ( $languages as $key => $language ) {
				printf( '<option value="%s">%s</option>',
					$language,
					$key
				);
			} ?>
		</select>
		<textarea id="code-snippet-input"></textarea>
		<button id="code-snippet-insert">Add Snippet</button>
	</form>
</body>
<script language="javascript" type="text/javascript" src="<?php echo includes_url() . '/js/tinymce/tiny_mce_popup.js'; ?>"></script>
<script src="<?php echo plugin_dir_url( plugin_dir_path( __FILE__ ) ) . 'js/tinymce-popup.js';?>">


</script>
</html>