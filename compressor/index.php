<?php

// exit('comment Exit-Statement in this File to run the compressor');

/*
 * put/extract the Files into its own Directory in elfinder
 * create a new Dir called "min" (must be writable)
 * 
 * to build custom CSS-Styles, replace CSS-Colors with Variable-Names found in helper.php
 * 
 * run this script
 * instead of referencing all the Files below you only need this

 <link href="min/YOUR_STYLE.css" type="text/css" rel="stylesheet">
 <script src="min/elfinder.js" type="text/javascript"></script>

 * 
*/
error_reporting(E_ALL);
 
include '../../../admin/_script_manager/compressors/helper.php';



// use this "XML" copied from ...src-html
$head = <<<XML
<?xml version="1.0"?>
<links>

	<link rel="stylesheet" href="css/common.css"      type="text/css" />
	<link rel="stylesheet" href="css/dialog.css"      type="text/css" />
	<link rel="stylesheet" href="css/toolbar.css"     type="text/css" />
	<link rel="stylesheet" href="css/navbar.css"      type="text/css" />
	<link rel="stylesheet" href="css/statusbar.css"   type="text/css" />
	<link rel="stylesheet" href="css/contextmenu.css" type="text/css" />
	<link rel="stylesheet" href="css/cwd.css"         type="text/css" />
	<link rel="stylesheet" href="css/quicklook.css"   type="text/css" />
	<link rel="stylesheet" href="css/commands.css"    type="text/css" />

	<link rel="stylesheet" href="css/fonts.css"       type="text/css" />
	<link rel="stylesheet" href="css/theme.css"       type="text/css" />
	
	
	<script src="js/elFinder.js"></script>
	<script src="js/elFinder.version.js"></script>
	<script src="js/jquery.elfinder.js"></script>
	<script src="js/elFinder.resources.js"></script>
	<script src="js/elFinder.options.js"></script>
	<script src="js/elFinder.history.js"></script>
	<script src="js/elFinder.command.js"></script>

	
	<script src="js/ui/overlay.js"></script>
	<script src="js/ui/workzone.js"></script>
	<script src="js/ui/navbar.js"></script>
	<script src="js/ui/dialog.js"></script>
	<script src="js/ui/tree.js"></script>
	<script src="js/ui/cwd.js"></script>
	<script src="js/ui/toolbar.js"></script>
	<script src="js/ui/button.js"></script>
	<script src="js/ui/uploadButton.js"></script>
	<script src="js/ui/viewbutton.js"></script>
	<script src="js/ui/searchbutton.js"></script>
	<script src="js/ui/sortbutton.js"></script>
	<script src="js/ui/panel.js"></script>
	<script src="js/ui/contextmenu.js"></script>
	<script src="js/ui/path.js"></script>
	<script src="js/ui/stat.js"></script>
	<script src="js/ui/places.js"></script>

	
	<script src="js/commands/back.js"></script>
	<script src="js/commands/forward.js"></script>
	<script src="js/commands/reload.js"></script>
	<script src="js/commands/up.js"></script>
	<script src="js/commands/home.js"></script>
	<script src="js/commands/copy.js"></script>
	<script src="js/commands/cut.js"></script>
	<script src="js/commands/paste.js"></script>
	<script src="js/commands/open.js"></script>
	<script src="js/commands/rm.js"></script>
	<script src="js/commands/info.js"></script>
	<script src="js/commands/duplicate.js"></script>
	<script src="js/commands/rename.js"></script>
	<script src="js/commands/help.js"></script>
	<script src="js/commands/getfile.js"></script>
	<script src="js/commands/mkdir.js"></script>
	<script src="js/commands/mkfile.js"></script>
	<script src="js/commands/upload.js"></script>
	<script src="js/commands/download.js"></script>
	<script src="js/commands/edit.js"></script>
	<script src="js/commands/quicklook.js"></script>
	<script src="js/commands/quicklook.plugins.js"></script>
	<script src="js/commands/extract.js"></script>
	<script src="js/commands/archive.js"></script>
	<script src="js/commands/search.js"></script>
	<script src="js/commands/view.js"></script>
	<script src="js/commands/resize.js"></script>
	<script src="js/commands/sort.js"></script>	
	<script src="js/commands/netmount.js"></script>	
	<script src="js/jquery.dialogelfinder.js"></script>

	
</links>

XML;

$xml = simplexml_load_string($head);



// JAVASCRIPT ////////////////////////////////////////////////////////////
$code = '';
foreach($xml->script as $script)
{
	if(file_exists('../'.$script['src']))
	{
		$code .= "\n// src: ".$script['src']."\n".
					file_get_contents('../'.$script['src']) // concatenation
					// compress(file_get_contents('../'.$script['src']), true) // compression (ONLY IF JS IS READY FOR COMPRESSION)
					."\n";
	}else {
		echo $script['src'].' does not exist!<br />';
	}
}

file_put_contents('../min/elfinder.js', $code);
chmod('../min/elfinder.js', 0777);
echo '<a href="../min/elfinder.js">JS</a> ';


// CSS ///////////////////////////////////////////////////////////////////
$code = '';
foreach($xml->link as $css)
{
	
	if(file_exists('../'.$css['href'])) {
		//$code .= file_get_contents('../'.$css['href']);// concatenation
		$code .= compress(file_get_contents('../'.$css['href']), true);// compression
	}else {
		echo $css['href'].' does not exist!<br />';
	}
}

/* adapetd stylesheets

foreach ($styles as $k => $v)
{
	parse_str($v, $params);
	$code = strtr($code, $params);
	file_put_contents('../min/'.$k.'.css', $code);
	chmod('../min/'.$k.'.css', 0777);
	echo '<a href="../min/'.$k.'.css" />'.$k.'.css</a> / ';
}*/

/*only one style*/
file_put_contents('../min/elfinder.css', $code);
chmod('../min/elfinder.css', 0777);
echo '<a href="../min/elfinder.css" />CSS</a> ';

?>

<hr /> 
