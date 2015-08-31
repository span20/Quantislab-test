<h1>Ordered salaries</h1>
<?php if ($ordered_salaries): ?>	
	<table>
		<tr>
			<th>Name</th>
			<th>Salary</th>
		</tr>
		<?php foreach($ordered_salaries as $name => $salary):?>
		<tr>
			<td><?php echo $name; ?></td>
			<td><?php echo number_format($salary); ?></td>
		<tr>		
		<?php endforeach; ?>
	</table>
<?php else: ?>
	No salaries!
<?php endif; ?>