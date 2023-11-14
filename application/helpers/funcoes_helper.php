<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function snake_case($string){
	$table['/'] = '';
	$table['('] = '';
	$table[')'] = '';

    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
	$string= preg_replace(
		'/[,.;:`´^~\'"]/', 
		'',
		iconv('UTF-8','ASCII//TRANSLIT',$string)
	);
	$string= strtolower($string);
	$string= str_replace(
		" ", 
		"-", 
		$string
	);
	$string= str_replace(
		"---", 
		"-", 
		$string
	);
	return $string;
}