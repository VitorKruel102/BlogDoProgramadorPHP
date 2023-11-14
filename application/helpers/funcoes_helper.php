<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Function snake_case
 *
 * Converts a string to snake_case format by removing special characters,
 * replacing spaces with hyphens, and converting to lowercase.
 *
 * @param string $string The string to be converted to snake_case.
 * @return string Returns the string in snake_case format.
 */
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