<?php
class HelperFunctions {
	
	public static function calculateNetSalary($salary = 0, $name = '', $net_only = false) {
		
		if ($salary == 0) return false;
			
		$tax = $salary * 0.16;
		$pension_cont = $salary * 0.1;
		$health_insurance = $salary * 0.07;
		$labor_market = $salary * 0.015;
		
		$net_salary = $salary - $tax - $pension_cont - $health_insurance - $labor_market;
		
		if ($net_only) return $net_salary;
		
		$data = array(
			'name' => $name,
			'salary' => $salary,
			'tax' => $tax,
			'pension_cont' => $pension_cont,
			'health_insurance' => $health_insurance,
			'labor_market' => $labor_market,
			'net_salary' => $net_salary
		);
		
		return $data;
	}
	
	public static function orderByNetSalaryDesc(array $salaries) {
		
		if (!empty($salaries)) {
			foreach ($salaries as $name => $salary) {
				$net_salary = self::calculateNetSalary($salary, '', true);
				$salaries[$name] = $net_salary;
			}
			
			arsort($salaries);
			
			return $salaries;
		}		
		return false;
	}
	
	public static function arrayOperations() {
		$args = func_get_args();
		
		$organized = array();
		
		foreach ($args as $argkey => $arg) {
			if (is_array($arg)) {
				$nums_in_array = 0;
				
				$organized[$argkey]["original"] = $arg;
				asort($arg);
				$organized[$argkey]["ordered"] = $arg;
				
				$sum = array_sum($arg);
				if ($sum > 0) {
					$organized[$argkey]["sum"] = $sum;
				}
				
				foreach ($arg as $key => $value) {
					if (is_numeric($value)) {
						$nums_in_array++;
					}
				}
				
				if ($nums_in_array == count($arg)) {
					$organized[$argkey]["avg"] = array_sum($arg) / count($arg);
				}
			}
		}
		
		return $organized;
	}
	
	public static function concatenateOddEven(array $array) {
		if (is_array($array)) {
			
			$data = array();
			
			if (count($array) % 2 != 0) {
				$last_element = array_pop($array);
				$data["last"] = '['.$last_element.']';
			}
			
			$odd = array();
			$even = array();
			foreach ($array as $key => $value) {
				if ($key % 2 == 0) {
					$even[] = $value;
				}
				else {
					$odd[] = $value;
				}
			}
			
			$data["even"] = implode("_", $even);
			$data["odd"] = implode("_", $odd);
			
			return $data;
		}
		
		return false;
	}
}
?>