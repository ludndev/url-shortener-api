<?php



function show($string = '') {

	return print($string . PHP_EOL);

}


function prettyHeader() {
	return file_get_contents( __DIR__ . './header.shell.txt' );
}


function checkFolder($path) {

	if ( !is_dir($path) )
		return NULL;

	$folder = array_slice( scandir($path) , 2);

	if ( count($folder) <= 0 )
		return NULL;

	$phpFiles = [];

	foreach ($folder as $value) {
		if ( preg_match('/^.*\.(php)$/i', $value) ) {
			$phpFiles[] = $value;
		}
	}

	return $phpFiles;

}


function createFolder($path, $table, $mode = 0777) {

	if ( !is_dir($path) ) {
		mkdir($path , $mode);
		createFile( "$path/$table.loader.php" , controllerTemplate('', $table) );
		return TRUE;
	} else {
		return FALSE;
	}

}


function createFile($filename, $content, $overwrite = FALSE) {

	if ( !is_file($filename) ) {
		$handle = fopen(strtolower($filename), 'w');
		fwrite($handle , $content);
		fclose($handle);

		return TRUE;
	} else {
		return FALSE;
	}

}


function controllerTemplate($table, $classname) {

	$table = strtolower($table);
	$classname = strtolower($classname);

	$template = file_get_contents( __DIR__ . './controller.template.txt' );

    $target = [ 
        '({{TABLE}})', 
        '({{CLASSNAME}})'
    ];

    $value  = [ 
        ( empty($table) ? '' : trim('\ ') . ucwords($table) ), 
        ucwords($classname)
    ];

    return 
    	preg_replace( $target, $value, $template );

}