<?php
/**
* Filemanager
*/
require dirname(dirname(__DIR__)) . '/inc/php/session.php';
error_reporting(0);//E_ALL

foreach ($_GET as $k=>$v){ $$k = preg_replace('/\W/', '', $v); }
$projectName = $_SESSION['___elfinder'] = $_GET['project'];

if(!isset($_SESSION[$projectName])) exit('not active!');

$lang = ((file_exists('js/i18n/elfinder.'.$_SESSION[$projectName]['lang'].'.js')) ? $_SESSION[$projectName]['lang'] : 'en');
$theme = end($_SESSION[$projectName]['config']['theme']);

// show file-access
//print_r($_SESSION[$projectName]['special']['user']['fileaccess']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>File-Manager</title>
	
	<!-- jQuery and jQuery UI -->
	<link type="text/css" rel="stylesheet" media="screen" href="../../../vendor/cmskit/jquery-ui/themes/<?php echo $theme?>/jquery-ui.css" />
	<script type="text/javascript" src="../../../vendor/cmskit/jquery-ui/jquery.min.js"></script>
	<script type="text/javascript" src="../../../vendor/cmskit/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../../../vendor/cmskit/jquery-ui/jquery.ui.touchpunch.js"></script>
	
	<!-- elFinder CSS/JS -->
	<link  href="min/elfinder.css" rel="stylesheet" type="text/css" />
	<script src="min/elfinder.js" type="text/javascript"></script>
	
	<!-- elfinder Language -->
	<script src="i18n/elfinder.<?php echo $lang;?>.js" type="text/javascript"></script>

	<script type="text/javascript" charset="utf-8">
		
		$(document).ready(function()
		{
			var f = $('#finder').elfinder(
			{
				url : 'php/connector.minimal.php',
				lang : '<?php echo $lang;?>',
				customData:
				{
					projectName : '<?php echo $projectName?>',
					startPath: <?php echo (isset($callback)?"''":'parent.$("#"+parent.targetFieldId).val()');?> 
				},
				rememberLastDir: false,
				resizable: true,
				getFileCallback : function(file)
				{
					var p = file.url.split("projects/<?php echo $projectName?>/").pop();
					
					<?php
						if(isset($callback))
						{
							echo 'parent.'.$callback.'(p);';
						}
						else
						{
							echo (isset($_GET['noparent'])?'alert(p);':'parent.$("#"+parent.targetFieldId).val(p);');
						}
					?>
					
					//parent. // close the dialog
					return false;
				}
			});
			
		});
	</script>
</head>
<body>
<div id="finder">init File-Manager...</div>
</body>
</html>
