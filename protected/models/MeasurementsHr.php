<?php

/**
 * This is the model class for table "tbl_measurements_hr".
 *
 * The followings are the available columns in table 'tbl_measurements_hr':
 * @property integer $stationid
 * @property integer $date
 * @property string $temperature
 * @property string $humidity
 * @property integer $rain
 * @property integer $leaf_wetness
 * @property string $battery
 * @property string $sun
 * @property integer $current
 * @property integer $mah
 * @property integer $av
 * @property integer $avmah
 * @property string $btemperature
 * @property string $rain_mm
 * @property integer $bat_temperature
 * @property string $precip_intensity
 *
 * The followings are the available model relations:
 * @property Stations $station
 */
class MeasurementsHr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_measurements_hr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stationid, date, rain, leaf_wetness, current, mah, av, avmah, bat_temperature', 'numerical', 'integerOnly'=>true),
			array('temperature, humidity, battery, sun, btemperature', 'length', 'max'=>5),
			array('rain_mm, precip_intensity', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stationid, date, temperature, humidity, rain, leaf_wetness, battery, sun, current, mah, av, avmah, btemperature, rain_mm, bat_temperature, precip_intensity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'station' => array(self::BELONGS_TO, 'Stations', 'stationid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stationid' => 'Stationid',
			'date' => 'Date',
			'temperature' => 'Temperature',
			'humidity' => 'Humidity',
			'rain' => 'Rain',
			'leaf_wetness' => 'Leaf Wetness',
			'battery' => 'Battery',
			'sun' => 'Sun',
			'current' => 'Current',
			'mah' => 'Mah',
			'av' => 'Av',
			'avmah' => 'Avmah',
			'btemperature' => 'Btemperature',
			'rain_mm' => 'Rain Mm',
			'bat_temperature' => 'Bat Temperature',
			'precip_intensity' => 'Precip Intensity',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('stationid',$this->stationid);
		$criteria->compare('date',$this->date);
		$criteria->compare('temperature',$this->temperature,true);
		$criteria->compare('humidity',$this->humidity,true);
		$criteria->compare('rain',$this->rain);
		$criteria->compare('leaf_wetness',$this->leaf_wetness);
		$criteria->compare('battery',$this->battery,true);
		$criteria->compare('sun',$this->sun,true);
		$criteria->compare('current',$this->current);
		$criteria->compare('mah',$this->mah);
		$criteria->compare('av',$this->av);
		$criteria->compare('avmah',$this->avmah);
		$criteria->compare('btemperature',$this->btemperature,true);
		$criteria->compare('rain_mm',$this->rain_mm,true);
		$criteria->compare('bat_temperature',$this->bat_temperature);
		$criteria->compare('precip_intensity',$this->precip_intensity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MeasurementsHr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
