<h1>Net salary calculator</h1>
<?php if ($net_salary): ?>	
	<table>
		<tr>
			<td>Name</td>
			<td><?php echo $net_salary["name"]; ?></td>
		<tr>
		<tr>
			<td>Salary</td>
			<td><?php echo number_format($net_salary["salary"]); ?></td>
		<tr>
		<tr>
			<td>Personal Income Tax</td>
			<td><?php echo number_format($net_salary["tax"]); ?></td>
		<tr>
		<tr>
			<td>Pension contribution</td>
			<td><?php echo number_format($net_salary["pension_cont"]); ?></td>
		<tr>
		<tr>
			<td>Health insurance contribution</td>
			<td><?php echo number_format($net_salary["health_insurance"]); ?></td>
		<tr>
		<tr>
			<td>Labor market contribution</td>
			<td><?php echo number_format($net_salary["labor_market"]); ?></td>
		<tr>
		<tr>
			<td>Net salary</td>
			<td><?php echo number_format($net_salary["net_salary"]); ?></td>
		<tr>
	</table>
<?php else: ?>
	No salary!
<?php endif; ?>