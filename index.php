<!DOCTYPE html>
<HTML>
<HEAD>
	<TITLE>................:; WYBORY | Zespół Szkół Technicznych ;:................</TITLE>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</HEAD>
<BODY>
<BR>
<p align=center>
WYBORY<BR>
Panel wyborczy Zespołu Szkół Technicznych w Kole<BR> 
Proszę o rzetelne głosowanie. <BR>
<BR>
<BR>
</p>

<form method="POST" action="wynik.php">
<?php

 require_once('pytania.php');

function rand_array($size, $min, $max) {
   if ($size > $max)
       $size = $max;
   $v = array();
   while ( count($v) < $size ) {
       do {
           $n = rand( $min, $max );
       } while ( array_search($n, $v) !== false);
           $v[] = $n;
   }
   return $v;
}

 //losowanie ciągu rozłącznego (o niepowtarzajacych sie elementach)
 $liczba_pytan=0;
 foreach($pyt as $v) $liczba_pytan++;
 //echo $liczba_pytan;

 $tablica_losowa=rand_array($liczba_pytan, 1, $liczba_pytan);
 //print_r($tablica_losowa);

 $i_pyt=0;
// foreach($pyt as $nr_pyt => $wartosc) { 
 foreach($tablica_losowa as $nr_pyt => $wartosc) { 
	//echo "pytanie: ".$pyt[$nr_pyt][0]."<BR>";
 ?>

 <TABLE border=1 width=677 align=center>
 <TR>
	<TD bgcolor="#FF0000" align=center>
	<FONT COLOR="#FFFFFF"><B>Głosuj</B></FONT>
	</TD>
 </TR>
 <TR>
	<TD>
	<FONT class=titlem align=center> <?php echo $pyt[$tablica_losowa[$i_pyt]][0]; ?> <br><br></FONT>

 <?php
	foreach($pyt[$tablica_losowa[$i_pyt]] as $nr_odp => $wartosc) { 
			//if ($nr_odp) echo "odpowiedz: ".$pyt[$tablica_losowa[$i_pyt]][$nr_odp]."<BR>";
	if ($nr_odp) {
	?>
	<B><?php if($pyt[$tablica_losowa[$i_pyt]][$nr_odp]!="") echo $nr_odp; ?></B> <FONT  align=center> <?php echo $pyt[$tablica_losowa[$i_pyt]][$nr_odp]; 
	if($pyt[$tablica_losowa[$i_pyt]][$nr_odp]!="") echo "<input type=radio  value=".$nr_odp." name=odp_".$tablica_losowa[$i_pyt].">&nbsp;&nbsp;";
	?> </FONT>
	<br>	<br>
	<?php }
	}
 ?>
	
	<center>
	<B><i><textarea name="odp_<?php echo $tablica_losowa[$i_pyt] ?>4" rows="7" cols="90"></textarea></i></B>	
	</center>
 <BR>
	</td>
 <BR> <BR>
 <?php
 $i_pyt++;
 }
?>
<input type=hidden name=liczba_pytan value=<?php echo $liczba_pytan; ?>>

</tr>
</table>
<br> 
<center>
<input type="submit" value="Zakończ" name="zakoncz"></form>
</center>
</BODY>
</HTML>
