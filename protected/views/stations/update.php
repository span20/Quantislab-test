<?php
/* @var $this StationsController */
/* @var $model Stations */

$this->breadcrumbs=array(
	'Stations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stations', 'url'=>array('index')),
	array('label'=>'Create Stations', 'url'=>array('create')),
	array('label'=>'View Stations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Stations', 'url'=>array('admin')),
);
?>

<h1>Update Stations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>