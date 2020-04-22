<?php
error_reporting(E_ALL & !E_NOTICE);

function php_to_js($array, $base) {
   $js = '';
   foreach ($array as $key=>$val) {
       if (is_array($val)) {
           $js .= php_to_js($val, $base.(is_numeric($key) ? '['.$key.']' : "['".addslashes($key)."']"));
       } else {
           $js .= $base;
           $js .= is_numeric($key) ? '['.$key.']' : "['".addslashes($key)."']";
           $js .= ' = ';
           $js .= is_numeric($val) ? ''.$val.'' : "'".addslashes($val)."'";
           $js .= ";\n";
       }
   }
   return $js;
}

function utf82iso88592($text) {
 $text = str_replace("\xC4\x85", 'a', $text);
 $text = str_replace("\xC4\x84", 'A', $text);
 $text = str_replace("\xC4\x87", 'c', $text);
 $text = str_replace("\xC4\x86", 'C', $text);
 $text = str_replace("\xC4\x99", 'e', $text);
 $text = str_replace("\xC4\x98", 'E', $text);
 $text = str_replace("\xC5\x82", 'l', $text);
 $text = str_replace("\xC5\x81", 'L', $text);
 $text = str_replace("\xC3\xB3", 'o', $text);
 $text = str_replace("\xC3\x93", 'O', $text);
 $text = str_replace("\xC5\x9B", 's', $text);
 $text = str_replace("\xC5\x9A", 'S', $text);
 $text = str_replace("\xC5\xBC", 'z', $text);
 $text = str_replace("\xC5\xBB", 'Z', $text);
 $text = str_replace("\xC5\xBA", 'z', $text);
 $text = str_replace("\xC5\xB9", 'Z', $text);
 $text = str_replace("\xc5\x84", 'n', $text);
 $text = str_replace("\xc5\x83", 'N', $text);

return $text;
} // utf82iso88592

// Ustaw ogranicznik pami&#281;ci podr&#281;cznej na 'private'
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
//echo "Ogranicznikiem pami&#281;ci podr&#281;cznej jest teraz $cache_limiter<p>";


	$imie=$_REQUEST['imie'];
	$nazwisko=$_REQUEST['nazwisko'];
	$klasa=$_REQUEST['klasa'];
	$numer=$_REQUEST['numer'];
	$przedmiot=$_REQUEST['przedmiot'];
	$liczba_pytan=$_REQUEST['liczba_pytan'];

	$ip=$_SERVER["REMOTE_ADDR"];
	//$data=date("j, m, Y, g:i a");
	$data=date("Ymj");

	for ($i=1;$i<=$liczba_pytan;$i++) {
	// for ($j=1;$j<5;$j++) {

	  $odpowiedzi[$i]=$_REQUEST["odp_".$i];
	// }
	}
	$odpowiedzi[$i]=$_REQUEST["odp_14"];

	$imie = trim($imie);
	$nazwisko = trim($nazwisko);
	$klasa = trim($klasa);
	$numer = trim($numer);
	$przedmiot = trim($przedmiot);
	
	$folder = str_replace(" ", "", $folder);

	$imie = utf82iso88592($imie);
	$nazwisko = utf82iso88592($nazwisko);
	//$imie = strtr($imie, "Ĺş", "z");
	//$nazwisko = strtr($nazwisko, "\xA5\x8C\x8F\xB9\x9C\x9F", "\xA1\xA6\xAC\xB1\xB6\xBC");

		

	// echo "uploading file ";
	// sprawdzenie czy wypełniono pola danymi

	if ($imie!="0" && $nazwisko!="0" && $klasa!="0" && $przedmiot!="0") {
		$uploadDir = __DIR__.'/glosy';
		if(!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777);
			chmod($uploadDir, 0777);
			}
		$uploadDir .= '/';
		
		//$filename = $uploadDir.basename($_SERVER['HTTP_REFERER']); 
		$filename = $uploadDir.time().".php";



	 if (!$uchwyt = fopen($filename, 'x+')) {
           echo "Nie mogę otworzyć pliku. Kliknij wstecz i ponów próbę.";
           exit;
	 } 
	 chmod($filename, 0777);

	 //$results = print_r($odpowiedzi, true);
	 $results = php_to_js($odpowiedzi, '$odp');
	 $results = "<?php \n".$results."\n?>";
	 // Zapis $trochetresci do naszego otwartego pliku.
    	 if (fwrite($uchwyt, $results) === FALSE) {
         echo "Nie mogę zapisać do pliku. Kliknij wstecz i ponów próbę.";
         exit;
    	 } 

	 fclose($uchwyt); 

	} else {
	echo "Coś nie tak.";
	}	
?>

<HTML>
<HEAD>
<META HTTP-EQUIV="refresh" content="2;URL=sum.php">
</HEAD>
<BODY>


<BR><BR>
<p align=center>
Dziękujemy za głosowanie<BR> 
Zaczekaj 2 sekundy.
</p>
</BODY>
</HTML>

