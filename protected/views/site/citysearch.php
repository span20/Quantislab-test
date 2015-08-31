<h1>Weather</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weather-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name' => 'CitySearchForm[city_name]',
			'sourceUrl' => $this->createUrl('site/searchCityAjax')
		));
		?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php if (isset($like_cities)): ?>
	<?php if (is_array($like_cities)): ?>
		City not found, please select one of the following:
		<?php foreach ($like_cities as $city): ?>
			<a href="javascript:void(0);" class="select_city" data-city="<?php echo $city; ?>"><?php echo $city; ?></a>, 
		<?php endforeach; ?>
		<script>
			$(document).ready(function(){
				$('.select_city').click(function(){					
					$("#CitySearchForm_city_name").val($(this).attr('data-city'));
					$("#weather-form").submit();
				});
			});
		</script>
	<?php else: ?>
		<?php echo $like_cities; ?>
	<?php endif; ?>
<?php endif; ?>
<?php if (isset($weather_desc)): ?>
	<h2><?php echo $model->city_name; ?></h2>
	<div>
		<?php echo $weather_desc; ?>
	</div>	
	<?php if (isset($chart_data) && !empty($chart_data)): ?>
		<div id="chart"></div>
		<script>
			$(document).ready(function(){
				$("#chart").highcharts({
					chart: {
						type: 'spline'
					},
					title: {
						text: 'Weather foreacast for: <?php echo $model->city_name; ?>'
					},
					xAxis: {
						categories: <?php echo $chart_data["xaxis_categories"]; ?>
					},
					yAxis: {
						title: {
							text: 'Temperature'
						},
						labels: {
							formatter: function () {
								return this.value + '°';
							}
						}
					},
					tooltip: {
						crosshairs: true,
						shared: true
					},
					plotOptions: {
						spline: {
							marker: {
								radius: 4,
								lineColor: '#666666',
								lineWidth: 1
							}
						}
					},
					series: [{
						name: 'High',
						marker: {
							symbol: 'square'
						},
						data: <?php echo $chart_data["data_high"]; ?>
					},
					{
						name: 'Low',
						marker: {
							symbol: 'diamond'
						},
						data: <?php echo $chart_data["data_low"]; ?>
					}]
				});
			});
		</script>
	<?php endif; ?>
<?php endif; ?>