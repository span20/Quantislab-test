<?php foreach($stat as $area): ?>
	<h1>
		<?php echo $area["area_name"]; ?>
	</h1>
	<?php foreach($area["stations"] as $station): ?>
		<h2>
			<?php echo $station["station_name"]; ?>
		</h2>
		<?php foreach($station["stat"] as $month => $data): 
			$sum = array_sum(array_column($data, 'avg_temp'));
		?>
			<h3>
				Hónap: <?php echo $month; ?>, Hőösszeg: <?php echo $sum; ?>
			</h3>
			<div>
				<?php foreach($data as $measurement): ?>
					<div><?php echo $measurement["measurement_date"]; ?>: <?php echo $measurement["avg_temp"]; ?></div>
				<?php endforeach; ?>
			</div>
			<hr>
		<?php endforeach; ?>
	<?php endforeach; ?>
<?php endforeach; ?>