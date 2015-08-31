<?php
class CitySearchForm extends CFormModel
{
	public $city_name;	

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('city_name', 'required'),			
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'city_name'=>'City name',
		);
	}
}
?>