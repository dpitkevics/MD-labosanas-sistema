<?php

class HometaskController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionList($category = null)
	{
        $hometask = Hometask::model()->findByPk($category);
                
		$this->render('list', array('hometasks'=>$hometask->receivedHomeworks));
	}

	public function actionRun()
	{
		$this->render('run');
	}

	public function actionShow($hid = null)
	{
        $hometask = ReceivedHomework::model()->findByPk($hid);
        if (!$hometask)
            throw new CHttpException(404, "No hometask found");
        
        $files = glob($hometask->sourcePath."*");
		$this->renderPartial('show', array('files'=>$files));
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