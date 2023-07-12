<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{#advanced_dlg.code_title}</title>
	<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script type="text/javascript" src="js/source_editor.js"></script>
</head>
<body onResize="resizeInputs();" style="display:none; overflow:hidden;">
	<form name="source" onSubmit="saveContent();return false;" action="#">
		<div style="float: left" class="title"><label for="htmlSource">{#advanced_dlg.code_title}</label></div>

		<div id="wrapline" style="float: right">
			<input type="checkbox" name="wraped" id="wraped" onClick="toggleWordWrap(this);" class="wordWrapCode" /><label for="wraped">{#advanced_dlg.code_wordwrap}</label>
		</div>

		<br style="clear: both" />

		<textarea name="htmlSource" id="htmlSource" rows="15" cols="100" style="width: 100%; height: 100%; font-family: 'Courier New',Courier,monospace; font-size: 12px;" dir="ltr" wrap="off" class="mceFocus"></textarea>

		<div class="mceActionPanel">
			<input type="submit" role="button" name="insert" value="{#update}" id="insert" />
			<input type="button" role="button" name="cancel" value="{#cancel}" onClick="tinyMCEPopup.close();" id="cancel" />
		</div>
	</form>
</body>
</html>
