<?php require('includes/header.php');

	function getSize($int){
	    switch($int){
	        case 0:
	            return "Small";
	        case 1:
	            return "Medium";
	        case 2:
	            return "Large";
	        case 3:
	            return "Extra Large";
	        case 4:
	        	return "Extra Extra Large";
	    }
	}
	
$stmt = $dbh->prepare('SELECT major, shirt_size, COUNT(*) as total FROM portfolio_students GROUP BY major, shirt_size');
$stmt->execute();
$shirt_array = $stmt->fetchAll();

$stmt = $dbh->prepare('SELECT major, shirt_size, COUNT(*) as total FROM faculty WHERE shirt_size IS NOT NULL GROUP BY major, shirt_size');
$stmt->execute();
$faculty_shirts = $stmt->fetchAll();

$majorGroup = array();
$masterTotal = array();

foreach($shirt_array as $shirt){
	$majorGroup[$shirt['major']][$shirt['shirt_size']] = $shirt['total'];
}

foreach($faculty_shirts as $shirt){
	if(isset($majorGroup[$shirt['major']][$shirt['shirt_size']]))
		$majorGroup[$shirt['major']][$shirt['shirt_size']] += $shirt['total'];
	else
		$majorGroup[$shirt['major']][$shirt['shirt_size']] = $shirt['total'];
}
?>
<div class="container">
	<div class="row">
		<h1>Shirt Totals</h1>
		
		<table class="table">
		<?php foreach($majorGroup as $major => $sizes){?>
			<tr>
				<td><h4><?=getMajor($major); ?></h4></td>
				<?php
					$total = 0;
					foreach($sizes as $size => $count){
					$total += $count;
					if(isset($masterTotal[$size]))
						$masterTotal[$size] += $count;
					else
						$masterTotal[$size] = $count;
				?>
				<td><?=$count?> <?=getSize($size)?></td>
				<? } ?>
				<td><b><?=$total?> total</b></td>
			</tr>
		<? } ?>
		
			<tr>
				<td><h3>MASTER TOTAL</h3></td>
				<?php
					$total = 0;
					foreach($masterTotal as $size => $count){
						$total += $count;
				?>
				<td><?=$count?> <?=getSize($size)?></td>
				<? } ?>
				<td><b><?=$total?> total</b></td>
			</tr>
		</table>
	</div>
</div>

<? require('includes/footer.php'); ?>