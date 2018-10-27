<?php

spl_autoload_register(function($class) {
	$paths = array(
		'/',
		'/components',
		'/models',
		'/controllers',
		
		'/interfaces',
		'/interfaces/controllers',
		'/interfaces/models',
		'/interfaces/modules',
		'/interfaces/databases',
		
		'/implementing',
		'/implementing/controllers',
		'/implementing/databases',
		'/implementing/models',
		'/implementing/modules',

		'/modules',
	);

	foreach ($paths as $path) {
		$path_to_file = ROOT . $path . '/' . $class . '.php';
		$file = preg_replace('/\\\+/', '/', $path_to_file);

		if (file_exists($file)) {
			include_once $file;
		}
	}
});