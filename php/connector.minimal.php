<?php
require dirname(dirname(dirname(__DIR__))) . '/inc/php/session.php';
error_reporting(0); // Set E_ALL for debuging

$projectName = preg_replace('/\W/', '', (isset($_GET['project']) ? $_GET['project'] : $_SESSION['___elfinder']) );

if(!isset($_SESSION[$projectName]['special']['user']['fileaccess'])) exit('{"error" : "Access for '.$projectName.' is denied!"}');

//store projectName for further Calls (navigating the dirs)
$_SESSION['___elfinder'] = $projectName;

// we need the URL (http://...)
function httpUrl($pn)
{
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return array_shift(explode('backend', substr($protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'], 0, -8))) . 'projects/'.$pn;
}
$url = httpUrl($projectName);

// get File-Access from Session
$access = array();
foreach ($_SESSION[$projectName]['special']['user']['fileaccess'] as $a)
{
	
	$a['path']	= realpath('../../../../projects/' . $projectName . '/' .  $a['path']); // build the Path below Project-Dir
	$a['path']	= str_replace('##ID##', $_SESSION[$projectName]['special']['user']['id'], $a['path']); // construct Path for a possible User-Dir
	
	$a['URL']	= $url;
	
	$a['tmbPath'] = $a['path'] . '/files/.tmb';
	$a['imgLib'] = 'gd';
	$a['tmbCleanProb'] = 100;
	//$a['mimeDetect'] = 'linux';
	
	
	if($a['URL']) $access[] = $a; // and add it to the Options
}

if(count($access)==0) exit('{"error" : "no Filepath defined"}');

// include Helper
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';

/**
* This method will disable accessing files/folders starting from '.' (dot)
*
* @param  string  $attr  attribute name (read|write|locked|hidden)
* @param  string  $path  file path relative to volume root directory started with directory separator
* @return bool|null
*/
function access($attr, $path, $data, $volume)
{
	// if file/folder begins with '.' (dot) OR is index.XYZ
	return (strpos(basename($path), '.') === 0 || strpos(basename($path), 'index.') === 0)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder should decide it itself
}


// Documentation for connector options:
// https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
$opts = array(
	'debug' => true,
	'tmbDir' => '.tmb',
	'imgLib' => 'gd',
	'mimeDetect' => 'internal',
	'roots' => $access
);

// relative start-path ( works only if rememberLastDir=false and sub-array is in first in roots-array! )
// see: https://github.com/Studio-42/elFinder/issues/356
if( isset($_GET['startPath']) )
{
	//$opts['roots'][0]['startPath'] = '../files2/aha/';
	//$opts['roots'][0]['startPath'] = '../files/nnn/ssa/';
}

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

