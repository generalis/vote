<!DOCTYPE html>
<HTML>
<HEAD>
	<TITLE>................:; WYBORY | Zespół Szkół Technicznych ;:................</TITLE>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</HEAD>
<BODY>
<p align=center>
<BR>
WYBORY<BR>
Panel wyborczy Zespołu Szkół Technicznych w Kole<BR> 
<BR>
<BR>
</p>

<?php
error_reporting(E_ALL & !E_NOTICE);

require_once('pytania.php'); // tutaj znajduje sie tablica poprawnych odpowiedzi $pop_odp

$ilosc_glosow=0;
// skrypt wyswietlajacy zawartosc folderu
	$scieza="./glosy/";
	if ($handle = opendir($scieza)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "index.php~" && $file != "." && $file != ".." && $file != "index.php") { 
 			include($scieza.$file);

			$ilosc_glosow++;
				for($i=1;$i<=$liczba_pytan;$i++) {
					$count[$i][$odp[$i]]++;

					// Pobieramy największy element
					$max[$i]=0;
					//for($j=1;$j<=4;$j++) if ($count[$i][$j]>$max[$i]) $max[$i] = $count[$i][$j];
					$j=1;
					foreach($odp as $o) {
						if ($count[$i][$j]>$max[$i]) $max[$i] = $count[$i][$j];
						$j++;
					}

					// Obliczamy mnożnik
					if($max[$i]) $mnoznik[$i] = 500/$max[$i]; // 150 to nasza maksymalna długość słupka
 				}

 	    		} 
 		}
    	closedir($handle); 
	}

 for($i=1;$i<=$liczba_pytan;$i++) {
	foreach ($pyt[$i] as $key => $p) {
		if ($key==0) echo "<p align=left><b>".$pyt[$i][0]."</b><BR> ";
		else echo '<img src="./gif/bar2.gif" height="17" width="'.round($count[$i][$key]*$mnoznik[$i]).'"><img src="./gif/barend.gif"> '.$p.' <b>'.$count[$i][$key].'</b><br>';
	}
 echo "</p><BR><BR>";
 }

?>
</BODY>
</HTML>
