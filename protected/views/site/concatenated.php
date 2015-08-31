<h1>Concatenated</h1>
<?php if ($concatenated): ?>	
	<table>		
		<?php foreach($concatenated as $value):?>
		<tr>
			<td><?php echo $value; ?></td>
		<tr>		
		<?php endforeach; ?>
	</table>
<?php else: ?>
	No data!
<?php endif; ?>