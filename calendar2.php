
<?php 
$month=date('n');
$year=date('Y');
$buton="";
if (array_key_exists("month", $_POST)){
	$month= $_POST["month"];
}
if (array_key_exists("year", $_POST)){
	$year= (int) $_POST["year"];
}
if (array_key_exists("buton", $_POST)){
	$buton= $_POST["buton"];
}
if ($buton=="Bugün"){
	$month=date('n');
	$year=date('Y');
}
if($buton=="<"){
	$month=$month-1;
	if ($month==0){
		$year=$year-1;
		$month=12;
	}
}
if($buton==">"){
	$month=$month+1;
	if ($month==13){
		$year=$year+1;
		$month=1;
	}
}


$aylar = array(
		"1" =>"Ocak",
		"2" =>"Şubat",
		"3" =>"Mart",
		"4" =>"Nisan",
		"5" =>"Mayıs",
		"6" =>"Haziran",
		"7" =>"Temmuz",
		"8" =>"Ağustos",
		"9" =>"Eylül",
		"10" =>"Ekim",
		"11" =>"Kasım",
		"12" =>"Aralık"
		)
?>
<form method="post" action="calendar2.php">
<select name ="month">
<?php 
foreach ($aylar as $key => $value ) {
	$selcode2 = "";
	if ($key==$month){
		$ay_goster=$value;
		$selcode2 = "selected";
	}
	echo "<option value=\"{$key}\" {$selcode2} >{$value}</option>";
}
?>
</select>
<select name ="year">
<?php for ($i=2023;$i>1988;$i--){
    $selcode = "";
	if ($i==$year){
		$selcode = "selected";
	}	

	echo "<option value=\"{$i}\" {$selcode} >{$i}</option>";	
}
?>
</select>

<input type="submit" name="buton" value="Git">
<br/>
<input type="submit" name="buton" value="<" /> 
<input type="submit" name="buton" value="Bugün" />
<input type="submit" name="buton" value=">" /> 

<br/>
<table border="1" style="color: grey">
<tr style="background-color: grey; color: cyan"><td>Pzt</td><td>Sal</td>
<td>Çar</td><td>Per</td><td>Cum</td>
<td style="background-color: red">Crt</td><td style="background-color: red">Pzr</td></tr>
<?php 
$tarih=mktime(0,0,0,$month,1,$year);
#$day=date("j",$tarih);
$month=date("n",$tarih);
$gun_sayisi=date("t",$tarih);
$detay=getdate($tarih);
$day=date('j');
$baslangic=$detay['wday']-1;

for ($i=0;$i<($gun_sayisi+$baslangic);$i++){
	if ($baslangic==-1) $baslangic=6;
	if(($i%7)==0) 
		echo '<tr>';
	$renk="";
	if($month==date('n') && $year==date('Y')){
		$renk=($day==($i-1))? 'bgcolor="cyan"' : "";
	}
	if($i<$baslangic)
		echo "<td></td>";
	else 
		echo "<td $renk>".($i-$baslangic+1)."</td>";
	
	if (($i%7)==6)
		echo "</tr>";	
}
?>
</table>
</form>
