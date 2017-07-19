<?php
	$N = 2000000;
	$sum = 0;
	$arr ;
	
	for ($i = 2; $i <= $N; $i++){
		$flag = 0;
		
		for ($j = 0; $j < count($arr); $j++){
			if ($i % $arr[$j] == 0){
				$flag++;
				break;
			}
			if ($arr[$j] > sqrt($i)){
				break;
			}
		}
		
		if ($flag == 0){
			$arr[] = $i;
			$sum += $i;
		}
	} 
	
	echo($sum);
?>
 
