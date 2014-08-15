<?php
$config = <<<EOD
{
	"info":  {
		"name": "File-Manager",
		"description": {
			"en": "manage Files in your File-Folder and pick File-Paths",
			"de": "Dateimanager"
		},
		"io":  [
			"path-string",
			"path-string"
		],
		"authors":  ["Christoph Taubmann"],
		"homepage": "http://cms-kit.org",
		"mail": "info@cms-kit.org",
		"copyright": "GPL",
		"credits":  [
			"[elFinder](http://elrte.org/elfinder) BSD"
		]
	},
	"system":  {
		"version": 0.8,
		"inputs":  [
			"VARCHAR"
		],
		"include":  ["wizard:filemanager\\nexternal:true"],
		
		"translations":  [
			"en",
			"de"
		]
	}
}
EOD;
?>
