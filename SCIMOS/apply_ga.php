<?php

session_start();
$cid= $_SESSION['name'];

$con = mysqli_connect("localhost","root",null,"scimos");

if(! $con)
{
    die('Connection Failed'.mysql_error());
}

mysqli_select_db($con, "scimos");

$table_name= $cid.'_history';

$result = mysqli_query($con,"SELECT distinct pid from $table_name");
$row = mysqli_fetch_all($result, MYSQL_BOTH);

$chromos[] = array();
$chromosome = array();
 $histtablename = '';
$k = 0;
$table_name= $cid.'_chromo';

///////////////////crossover and mutation functions
/////////////////////////////////////////////////////////////////////NEW PART ADDED HERE
///////////////////////////// crossover ///////////////////////////
// selecting random crossover points
function crossover($fit_chromo1 , $fit_chromo2, $lcols)
{
$cross1= rand(0, $lcols-1);
$cross2= rand(0, $lcols-1);

if($cross1==$cross2)
	while($cross1==$cross2)
		$cross2= rand(0,$lcols-1);
if($cross2< $cross1)
{
	$t= $cross1;
	$cross1= $cross2;
	$cross2= $t;
}
$swap_temp;
for($a=0; $a<=$cross1; $a++)
{
	$swap_temp = $fit_chromo1[$a];
	$fit_chromo1[$a]= $fit_chromo2[$a];
	$fit_chromo2[$a]= $swap_temp;
}

for($a= $cross2; $a<$lcols; $a++)
{
	$swap_temp = $fit_chromo1[$a];
	$fit_chromo1[$a]= $fit_chromo2[$a];
	$fit_chromo2[$a]= $swap_temp;
}
}
/////////////////////////////////////////////////////Mutation
function mutation($fit_chromo1 , $fit_chromo2, $lcols, $minarray , $maxarray , $index , $lrows , $lcols, $history, $ranpop_next)
{
$noofmutpts = 1;
//generate 2 random pts
$mp1 = rand(0 , $lcols-1);
$mp2 = rand(0, $lcols-1);
$mvalue1 = rand($minarray[$mp1] , $maxarray[$mp1]);
$mvalue2 = rand($minarray[$mp2] , $maxarray[$mp2]);

//for fit chromo 1
$fit_chromo1[$mp1] = $mvalue1;
//for fiy chromo 2
$fit_chromo2[$mp2] = $mvalue2;
for($l = 0; $l< $lcols; $l++)
{
$ranpop_next[$index][$l]= $fit_chromo1[$l];
$ranpop_next[$index+1][$l]= $fit_chromo2[$l];
}
//////////////////
$ranpop_next[$index][$lcols] = 0;
$ranpop_next[$index+1][$lcols] = 0;
$ranpop_next[$index][$lcols+1] = 0;
$ranpop_next[$index+1][$lcols+1] = 0;



/////////////////////////////////fitness calculation
for($b = 0;$b<$lrows ; $b++)
{
	$flag = true;
	$temp = array();
	$temp = $history[$b];
	for($c = 0;$c < $lcols ; $c++)
	{
		//min max
		if($fit_chromo1[$c] >= floor($temp[$c]*0.75) && $fit_chromo1[$c] <= ceil($temp[$c]*1.25)) ///change limits
		{
			
		}
		else $flag = false;
	}
	if($flag == true)
	{
	 $ranpop_next[$index][$lcols]++;
	}
	for($c = 0;$c < $lcols ; $c++)
	{
		//min max
		if($fit_chromo2[$c] >= floor($temp[$c]*0.75) && $fit_chromo2[$c] <= ceil($temp[$c]*1.25)) ///change limits
		{
			
		}
		else $flag = false;
	}
	if($flag == true)
	{
	 $ranpop_next[$index+1][$lcols]++;
	}
}		

///


/////////////////////////updating fitness
	//fitness formula
	$fit = log(1 - $ranpop_next[$index][$lcols] / $lrows);    //////---->>> check for ln and log - here ln
	$ranpop_next[$index][$lcols+1] = $fit;	
	//fitness formula
	$fit = log(1 - $ranpop_next[$index+1][$lcols] / $lrows);    //////---->>> check for ln and log - here ln
	$ranpop_next[$index+1][$lcols+1] = $fit;	
	
////////////////

//echo '<br><br>';
		return $ranpop_next;


}
//////////////////////////////////////////////////////////////Mutation END
 
foreach($row as $r)
{

$chromos[$k] = array();
echo 'CHROMOSOME OF PID : '.$r['pid'].'<br>';
///////////////////pushing PID also////////////
array_push($chromosome , $r['pid']);
array_push($chromos[$k] , $r['pid']);
///////////////////////////////END///////////

array_push($chromosome , $cid);
array_push($chromos[$k] , $cid);


 $cpid = $r['pid'];

 $findrespuid= mysqli_query($con,"SELECT * FROM `$table_name` WHERE pid = '$cpid'"); 
 $row1= mysqli_fetch_row($findrespuid);
 $count = count($row1);


 for($i = 2;$i<$count;$i++)
 {

	if($row1[$i] == NULL) 
	{	array_push($chromosome , NULL);
		
		array_push($chromos[$k] , NULL);
	}
	else
	{	array_push($chromosome, $row1[$i]);
		array_push($chromos[$k] , $row1[$i]);
	}
	
 }

 foreach($chromos[$k] as $c)
 {
	
	//////////////////////////////////fetching history of pid///////////////////////////
	$tablename = $cid.'_history';
	$chromotablename = $cid.'_chromo';
	$histtablename = $cpid.'_hist';
	
	if($cpid == $c)
	{
	$query3 = mysqli_query($con,"create table `$histtablename` as (SELECT * FROM `$tablename` where pid = '$c')");
	$query6 = mysqli_query($con , "ALTER TABLE `$histtablename` DROP `week`;");
	$query7 = mysqli_query($con , "ALTER TABLE `$histtablename` ADD `id` INT(10) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`) ;");
	$query4 = mysqli_query($con ,"SELECT * FROM `$histtablename` WHERE 1");
	$row3 = mysqli_fetch_row($query4);
	$query5 = mysqli_query($con ,"SELECT * FROM `$chromotablename` WHERE pid = '$c'");
	$row4 = mysqli_fetch_row($query5);
	
	$count1 = count($row3);
	
for($i = 0;$i<$count1;$i++)
 {

	
	if($row3[$i] == NULL)
	{	
	
	$temp = $row4[$i-1];
		$query2 = mysqli_query($con , "ALTER TABLE `$histtablename` DROP `$temp`;");
	}
  }
 
	}
	
 }
///////////////////////////////////////////////////////////RANGE/////////////
$ranpop_count = 50;

$cpid = $r['pid'];
$countsupp = mysqli_query($con , "SELECT count(uid) FROM `user_products` WHERE pid = '$cpid' and uid IN(select uid from users where type = 'supplier')");
$countret = mysqli_query($con , "SELECT count(uid) FROM `user_products` WHERE pid = '$cpid' and uid IN(select uid from users where type = 'retailer')");
$counttotal = mysqli_query($con , "select count(pid) from `$chromotablename`");
	
$heysupp = mysqli_fetch_row($countsupp);
$heyret = mysqli_fetch_row($countret);
$heytotal = mysqli_fetch_all($counttotal,MYSQL_BOTH);
	
$csupp = $heysupp[0];	// supplier count 
$cret = $heyret[0];		//retailer count

$columns = mysqli_query($con , "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='scimos' 
    AND `TABLE_NAME`='$histtablename';");
$colrows = mysqli_fetch_all($columns , MYSQL_BOTH);
$i = 0;
$k = 0;
$minarray = array();
$maxarray = array();
foreach($colrows as $cr)
{
	
	if($i >1 )
	{	
		
		$findmin = mysqli_query($con , "select min($cr[0]) from `$histtablename`");
		$findmax = mysqli_query($con , "select max($cr[0]) from `$histtablename`");
		$tempmin = mysqli_fetch_row($findmin);
		$tempmax = mysqli_fetch_row($findmax);
		$minvalue = round($tempmin[0]*.95);
		$maxvalue = round($tempmax[0]*1.05);
		array_push($minarray, $minvalue);
		array_push($maxarray , $maxvalue);
		$k++;
	}
	$i++;
	
}
//////////////////////////////////////////////////RANDOM POPULATION/////////
$ranpop[][] = array();
$ranpop_next[][] = array();
echo 'random values<br>';
for($i = 0;$i<$ranpop_count;$i++)
{
	$ranpop[$i] = array();
	for($j = 0;$j<$k;$j++)
	{
		$ranvalue = rand($minarray[$j] , $maxarray[$j]);
		array_push($ranpop[$i] , $ranvalue);
		echo ' '.$ranpop[$i][$j].' ';
		if($j == $k-1)
		{
		array_push($ranpop[$i], 0);
		echo ' '.$ranpop[$i][$j+1].' ';
		array_push($ranpop[$i], 0);
		echo ' '.$ranpop[$i][$j+2].' ';
		}
	}
	
	
	echo '<br>';
}

///////////////////////////////////////////////STORING HIST in array
$i = 0;
$histarray[][] = array();
$k = 0;
foreach($colrows as $cr)
{
	$j = 0;
	$histarray[$k] = array();
	if($i >1 )
	{	
		
		$fetch = mysqli_query($con , "select $cr[0] from `$histtablename`");
		$colfetch = mysqli_fetch_all($fetch , MYSQL_BOTH);
		foreach($colfetch as $cf)
		{
			$v = $cf[0];
			
			array_push($histarray[$k] , $v);
			
			$j++;
		}
		echo '<br>';
		$k++;
	
	}
	$i++;
	
}
$lrows = $j;
echo '<br>lrows = '.$lrows.'<br>';
$lcols = $k;
echo '<br>lcols = '.$lcols.'<br>';

$history[][] = array();
echo '<br>Displaying HISTORY<br>';
for($i = 0;$i<$lrows;$i++)
{
	$history[$i] = array();
	for($j = 0;$j<$lcols;$j++)
	{
		$value = $histarray[$j][$i];
		
		array_push($history[$i] , $value);
		echo $history[$i][$j].' ';
		
	}
	echo '<br>';
	
}



/////////////////////////////////fitness calculation
for($a = 0 ; $a<$ranpop_count;$a++)
{
	$crow = array();
	$crow = $ranpop[$a];
	for($b = 0;$b<$lrows ; $b++)
	{
		$flag = true;
		$temp = array();
		$temp = $history[$b];
		for($c = 0;$c < $lcols ; $c++)
		{
			//min max
			if($crow[$c] >= floor($temp[$c]*0.75) && $crow[$c] <= ceil($temp[$c]*1.25)) ///change limits
			{
				
			}
			else $flag = false;
		}
		if($flag == true)
		{
 		 $ranpop[$a][$lcols]++;
		}
	}		
}
///


/////////////////////////updating fitness
for($a = 0;$a< $ranpop_count;$a++)
{
	//fitness formula
	$fit = log(1 - $ranpop[$a][$lcols] / $lrows);    //////---->>> check for ln and log - here ln
	$ranpop[$a][$lcols+1] = $fit;	
}

for($p = 0 ;$p<50;$p++)
{
/////////////////////////// sorting array
for($y=0; $y<$ranpop_count-1; $y++)
{
	for($x=0; $x< $ranpop_count- $y- 1; $x++)
	{	
		if($ranpop[$x][$lcols+1] > $ranpop[$x+1][$lcols+1])
		{
		 for($z =0; $z< $lcols+2; $z++)
		 {
			$t= $ranpop[$x+1][$z];
			$ranpop[$x+1][$z]= $ranpop[$x][$z];
			$ranpop[$x][$z] = $t;
		 }
		}
	}	
}

/////////////////////////////////////displying ranpop
echo 'random values with incremented count in sorted order<br>';
for($i = 0;$i<50;$i++)
{
	for($j = 0;$j<$k;$j++)
	{
		echo ' '.$ranpop[$i][$j].' ';
		if($j == $k-1)
		{
			echo ' '.$ranpop[$i][$j+1].' ';
			echo ' '.$ranpop[$i][$j+2].' ';
		}
	}	
	echo '<br>';
}
echo '<br><br>';

//////////elitism adding fitted 10 in next generation directly

for($i = 0;$i<10;$i++)
{
	for($j = 0; $j< $lcols+2; $j++)
	{
		$ranpop_next[$i][$j]= $ranpop[$i][$j]; 
	}
}

echo '<br>displaying elitimsm<br>';	
for($i = 0;$i<10;$i++)
{
	for($j = 0; $j< $lcols+2; $j++)
	{	
		echo $ranpop_next[$i][$j].' ';
	}
	echo '<br>';
}
echo '<br><br>';
	
	

//selecting 2 chromos
for($i = 0;$i<39;$i=$i+2)
{
$fit_chromo1 = $ranpop[$i];
$fit_chromo2 = $ranpop[$i+1];
$index = $i + 10;
if($lcols > 1)
	crossover($fit_chromo1 , $fit_chromo2, $lcols);
$ranpop_next = mutation($fit_chromo1 , $fit_chromo2, $lcols, $minarray,$maxarray , $index , $lrows, $lcols, $history,$ranpop_next);

}


echo '<br>Displaying FINAL RANDOM NEXT<br>';	
for($i = 0;$i<50;$i++)
{
	for($j = 0; $j< $lcols+2; $j++)
	{	
		echo $ranpop_next[$i][$j].' ';
	}
	echo '<br>';
}
echo '<br><br>';
	
$ranpop = $ranpop_next;
//****************************************************END OF 1 ITERATION*****************************************
}

///////////////finding fittest chromosome
$fittest_chromo = array();
$minfit = 0;
$minindex = 0;
for($i = 0;$i < 50; $i++)
{
	if($ranpop_next[$i][$lcols+1] < $minfit)
	{
		$minfit = $ranpop_next[$i][$lcols+1];
		$minindex = $i;
	}
} 

///////inserting it into respective product_hist table
$tempvalues = '';
for($i = 0;$i<$lcols;$i++)
{
	if($i > 0)
		$tempvalues = $tempvalues.',\''.$ranpop_next[$minindex][$i].'\'';
	else
		$tempvalues = '\''.$ranpop_next[$minindex][$i].'\'';
}	
echo $tempvalues;	
$columns = mysqli_query($con , "SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='scimos' 
    AND `TABLE_NAME`='$histtablename';");
$rows = mysqli_fetch_all($columns , MYSQL_BOTH);
$columnlist = '';
$count = count($rows);
$i = 0;
foreach($rows as $r)
{

	if($i > 1)
		$columnlist = $columnlist.',`'.$r[0].'`';
	else if($i == 1)
		$columnlist = '`'.$r[0].'`';
	
	$i++;
}

$insertquery = mysqli_query($con , "insert into `$histtablename`($columnlist) VALUES ('$cpid',$tempvalues)");

 echo "<br><br><br>";
 $k++;
}

?>