<?php

class CriteriaController extends Controller
{
	public function actionCheck()
	{
		$this->render('check');
	}

	public function actionGet()
	{
		$this->render('get');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSet()
	{
		$this->render('set');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}