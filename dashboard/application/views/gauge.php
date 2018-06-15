<?php
	///input: data, max, text
	$max = isset($max) ? $max : 100;
	$percent = ($data / $max)*100;
	if($percent < 33){
		$color = "green";
	}else if($percent > 66){
		$color = "red";
	}
	else{
		$color = "orange";
	}
?>

<div class="gauge <?php echo $color; ?>" data-value="<?php echo $data; ?>" data-ceil="<?php echo $max; ?>">
	<div class="gauge-value">
		<span class="gauge-cnt"></span><?php echo $text; ?>
		<span class="gauge-ceil"></span>
	</div>
	<div class="gauge-center"></div>
	<div class="gauge-indicator"></div>
	<div class="gauge-background"></div>
</div>