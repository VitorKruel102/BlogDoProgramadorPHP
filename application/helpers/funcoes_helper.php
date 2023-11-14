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

/**
 * Function date_format_string
 *
 * Formats a date and time to a friendly representation in Portuguese.
 *
 * @param string $string The date and time string to be formatted.
 * @return string Returns the formatted date in the format: "Day of the week, day of month of year - Hour".
 */
function date_format_string($string){
    $dia_sem= date('w', strtotime($string));
	$dia= date('d', strtotime($string));
	$mes_num = date('m', strtotime($string));

	switch ($dia_sem) {
		case '0':
			$semana = "Domingo";
			break;
		case "1":
			$semana = "Segunda-feira";
			break;
		case "2":
			$semana = "Terça-feira";
			break;
		case "3":
			$semana = "Quarta-feira";
			break;
		case "4":
			$semana = "Quinta-feira";
			break;
		case "5":
			$semana = "Sexta-feira";
			break;
		case "6":
			$semana = "Sábado";
			break;
	}

	switch ($mes_num) {
		case '1':
			$mes= "Janeiro";
			break;
		case "2":
			$mes= "Fevereiro";
			break;
		case "3":
			$mes= "Março";
			break;
		case "4":
			$mes= "Abril";
			break;
		case "5":
			$mes= "Maio";
			break;
		case "6":
			$mes= "Junho";
			break;
		case "7":
			$mes= "Julho";
			break;
		case "8":
			$mes= "Agosto";
			break;
		case "9":
			$mes= "Setembro";
			break;
		case "10":
			$mes= "Outubro";
			break;
		case "11":
			$mes= "Novembro";
			break;
		case "12":
			$mes= "Dezembro";
			break;
	}

	$mes_num = date('m', strtotime($string));
    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));
	$data_formatada = "$semana, $dia de $mes de $ano - $hora";

	return $data_formatada;
}