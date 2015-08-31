<h1>Organized arrays</h1>
<?php if ($organized): ?>	
	<table>
		<?php foreach($organized as $key => $value):?>
			<tr>
				<td colspan="2" style="font-size: 14px; font-weight: bold;">Array #<?php echo $key; ?></td>
			</tr>
			<?php if (isset($value["original"])):?>
				<tr>
					<td>Original</td>
					<td><?php print_r($value["original"]); ?></td>
				<tr>
			<?php endif; ?>
			<?php if (isset($value["ordered"])):?>
				<tr>
					<td>Ordered</td>
					<td><?php print_r($value["ordered"]); ?></td>
				<tr>
			<?php endif; ?>
			<?php if (isset($value["sum"])):?>
				<tr>
					<td>Sum</td>
					<td><?php print_r($value["sum"]); ?></td>
				<tr>
			<?php endif; ?>
			<?php if (isset($value["avg"])):?>
				<tr>
					<td>Average</td>
					<td><?php print_r($value["avg"]); ?></td>
				<tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	No arrays!
<?php endif; ?>