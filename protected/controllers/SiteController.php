<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionNetSalary() {
			
		$salary = 100000;
		$name = 'Teszt Elek';
		
		$net_salary = HelperFunctions::calculateNetSalary($salary, $name);
		$this->render('netsalary', array('net_salary' => $net_salary));
		
	}
	
	public function actionOrderSalaries() {
			
		$salaries = array(
			"Kiss Janos" => 170000, 
			"Nagy Jozsef" => 198500, 
			"Szegeny Bela" => 2500000,
			"Magnas Miska" => 750000, 
			"Gipsz Jakab" => 458010
		);
		
		$ordered_salaries = HelperFunctions::orderByNetSalaryDesc($salaries);
		$this->render('orderedsalaries', array('ordered_salaries' => $ordered_salaries));
		
	}
	
	public function actionArrayOperations() {
		
		$array1 = array(97, 154, 66, 75, 122, 13254, 11, 0, 14);
		$array2 = array(
			"A" => "Audi", 
			"Z" => "BMW z4", 
			"F" => "LaFerrari", 
			"H" => "Hummer h2", 
			"C" => "Corvette", 
			"VW" => "VolksWagen Scirocco"
		);
		$array3 = array("kutya", "alma", "macska", "hangya", "pocak", "nadrag", "golyostoll", "cekla", "korte", "angyal", "aaa2545", 14, 26, 48);
		$array4 = array(1.25, 63.44, 24.89, 6565.233331, 454, 1099, 6547);
		
		$organized = HelperFunctions::arrayOperations($array1, $array2, $array3, $array4);
		$this->render('organizedarrays', array('organized' => $organized));
	}
	
	public function actionConcatenate() {
		$array = array(
			"lajos", "kiraly", "pista", "valami", "aladar", "kiraly", "pista"
		);
		
		$concatenated = HelperFunctions::concatenateOddEven($array);
		$this->render('concatenated', array('concatenated' => $concatenated));
	}
	
	public function actionCitySearch()
	{
		$model=new CitySearchForm;
		
		if(isset($_POST['CitySearchForm'])) {
			
			$model->attributes=$_POST['CitySearchForm'];
			
			if($model->validate()) {				
				$exists_q = "SELECT id FROM tbl_cities WHERE LOWER(city_name) = :city_name";
				$command = Yii::app()->db->createCommand($exists_q);
				$command->bindValue(":city_name", mb_strtolower($model->city_name, 'UTF-8'), PDO::PARAM_STR);
				$city = $command->queryColumn();
				if (!empty($city)) {				
					$baseUrl = Yii::app()->baseUrl; 
					$cs = Yii::app()->getClientScript();
					$cs->registerScriptFile($baseUrl.'/js/highcharts.js');
					
					$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
					$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$model->city_name.'") AND u="c"';
					$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
					
					$session = curl_init($yql_query_url);
					curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
					$json = curl_exec($session);
					
					$weather_data = json_decode($json, true);
					
					$weather_desc = $weather_data["query"]["results"]["channel"]["item"]["description"];
					
					$forecast_array = $weather_data["query"]["results"]["channel"]["item"]["forecast"];
					$chart_data = array();
					
					$high_array = array_column($forecast_array, 'high');
					$high_array = array_map('intval', $high_array);
					
					$low_array = array_column($forecast_array, 'low');
					$low_array = array_map('intval', $low_array);
					
					if (!empty($forecast_array)) {
						$chart_data = array(
							"xaxis_categories" => json_encode(array_column($forecast_array, 'date')),
							"data_high" => json_encode($high_array),
							"data_low" => json_encode($low_array)
						);					
					}
					$this->render('citysearch',array('model'=>$model, 'weather_desc' => $weather_desc, 'chart_data' => $chart_data));
				} else {
					$q ="SELECT city_name FROM tbl_cities WHERE LOWER(city_name) LIKE :city_name";
					$command = Yii::app()->db->createCommand($q);
					$command->bindValue(":city_name", '%'.mb_strtolower($model->city_name, 'UTF-8').'%', PDO::PARAM_STR);
					$cities = $command->queryColumn();
					
					if (empty($cities)) $cities = "No city found!";
					
					$this->render('citysearch',array('model'=>$model, 'like_cities' => $cities));
				}
			} else {
				Yii::app()->user->setFlash('citySearch','Something wrong!');
				$this->refresh();
			}
		} else {
			$this->render('citysearch',array('model'=>$model));
		}
	}
	
	public function actionSearchCityAjax($term)
	{		
		if (isset($_GET['term'])) {
			$q ="SELECT city_name FROM tbl_cities WHERE LOWER(city_name) LIKE :city_name";
			$command = Yii::app()->db->createCommand($q);
			$command->bindValue(":city_name", '%'.mb_strtolower($_GET['term'], 'UTF-8').'%', PDO::PARAM_STR);
			$cities = $command->queryColumn();
			
			echo CJSON::encode($cities);
		}
		
		Yii::app()->end(); 
	}
	
	public function actionStat() {
		$stat = array();
		
		$start_date = strtotime("2015-03-01");
		$end_date = strtotime("2015-04-10");
		
		$areas = Areas::model()->with('stations')->findAll();
		
		foreach ($areas as $area) {
			$stations = $area->stations;
			
			$stat[$area->id]["area_name"] = $area->name;
			
			foreach ($stations as $station) {
				$q = "
					SELECT AVG(temperature) AS avg_temp, MONTH(FROM_UNIXTIME(date)) as measurement_month, DAY(FROM_UNIXTIME(date)) as measurement_day, DATE(FROM_UNIXTIME(date)) as measurement_date
					FROM tbl_measurements_hr
					WHERE stationid = :stationid
					GROUP BY measurement_month, measurement_day
				";
				$command = Yii::app()->db->createCommand($q);
				$command->bindValue(":stationid", $station->id, PDO::PARAM_STR);
				$avg = $command->queryAll();
				
				$ordered = array();
				
				foreach ($avg as $data) {
					$ordered[$data["measurement_month"]][] = $data;
				}
				
				$stat[$area->id]["stations"][$station->id]["station_name"] = $station->name;
				$stat[$area->id]["stations"][$station->id]["stat"] = $ordered;
			}
		}
		
		$this->render('stat', array('stat' => $stat));
	}
	
}