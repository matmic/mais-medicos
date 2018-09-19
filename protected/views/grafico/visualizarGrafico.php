<h4 class="c-grey-900 mB-20"><?php echo $title; ?></h4>
<div class="mT-30">
<?php 
	$this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
		'data' => $dados,
		// 'options' => array(
			// 'title' => $title,
		// ),
	));
	?>
</div>