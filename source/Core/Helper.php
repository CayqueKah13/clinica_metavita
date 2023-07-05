<?php

namespace Source\Core;

class Helper {

  // navigation
  static function redirectToPage($page) {
    header("Location: ".$page);
    exit;
  }


  // safe values
  static function safeInt($value) {
  	if (is_null($value) || !is_numeric($value) || $value < 0) {
  		return 0;
  	}
  	return intval($value);
  }

  static function safeString($value) {
  	if (is_null($value) || !is_string($value) || $value == "") {
  		return "";
  	} else {
  		return addslashes(trim($value));
  	}
  }

  static function numbersOnly($string) {
  	return preg_replace('/[^0-9]/', '', $string);
  }

  static function uppercase($string) {
  	return strtoupper($string);
  }


  static function brlMoneyToDecimal($price) {
    $price = str_replace(".", "", $price);
    $price = str_replace(",", ".", $price);
    return $price;
  }

  static function decimalToBrlMoney($price, $addPrefix = true) {
    $formatted = number_format($price, 2, ',', '.');
    if ($addPrefix == true) {
      return "R$ ".$formatted;
    } else {
      return $formatted;
    }
  }


  static function monthNameFrom($monthNumber) {
    $months = [
      1 => 'Janeiro',
      2 => 'Fevereiro',
      3 => 'Março',
      4 => 'Abril',
      5 => 'Maio',
      6 => 'Junho',
      7 => 'Julho',
      8 => 'Agosto',
      9 => 'Setembro',
      10 => 'Outubro',
      11 => 'Novembro',
      12 => 'Dezembro'
    ];
    return $months[$monthNumber];
  }


  static function addZeroPrefixIfNeeded($value) {
    if ($value >= 10) {
      return $value;
    } else {
      return '0'.$value;
    }
  }



  static function slugFrom($text) {
  	// lowercase
  	$text = mb_strtolower($text);


  	$replaces = array(
  		'a' => array('á', 'à', 'â', 'ã'),
  		'e' => array('é', 'è', 'ê'),
  		'i' => array('í', 'ì', 'î'),
  		'o' => array('ó', 'ò', 'ô', 'õ'),
  		'u' => array('ú', 'ù', 'û'),
  		'c' => array('ç')
  	);

  	foreach ($replaces as $key => $items) {
  		foreach ($items as $specialCharacter) {
  			$text = str_replace($specialCharacter, $key, $text);
  		}
  	}

    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    if (empty($text)) {
      return 'n-a';
    }
    return $text;
  }





  static function youtubeEmbedUrlFrom($link) {
    $embedBaseUrl = "https://www.youtube.com/embed/";
    $link = str_replace("https://www.youtube.com/watch?v=", $embedBaseUrl, $link);
    return $link;
  }


}
