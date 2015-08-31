<?php
/* @var $this StationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stations',
);

$this->menu=array(
	array('label'=>'Create Stations', 'url'=>array('create')),
	array('label'=>'Manage Stations', 'url'=>array('admin')),
);
?>

<h1>Stations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
