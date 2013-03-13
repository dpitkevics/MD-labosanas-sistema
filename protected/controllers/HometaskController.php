<?php

class HometaskController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionList($category = null, $hid = null, $file = null)
	{
        $files = null;
        $source = null;
        $extension = null;
        $hometask = Hometask::model()->findByPk($category);
        if (!$hometask)
            throw new CHttpException(404, "No hometask found");
        if (isset($hid) && $hid !== null) {
            $homework = ReceivedHomework::model()->findByPk($hid);
            if (!$homework)
                throw new CHttpException(404, "No homework found");
            
            $files = glob($homework->sourcePath."*");
        }
        if (isset($file) && $file !== null) {
            $source = file_get_contents($file);
            $extension = explode('\\', $file);
            $extension = explode('.', end($extension));
            $extension = end($extension);
        }
            
		$this->render('list', array(
            'hometasks'=>$hometask->receivedHomeworks, 
            'files'=>$files, 
            'source'=>$source,
            'extension'=>$extension,
        ));
	}

	public function actionRun($hid = null)
	{
        $homework = ReceivedHomework::model()->findByPk($hid);
        if (!$homework)
            throw new CHttpException(404, "No homework found");
        
        $criterias = $homework->hometask->hometaskCriterias;
        foreach ($criterias as $criteria) {
            $crit = new CCriteria($criteria->criteria, $homework->sourcePath);
            $validation[$criteria->criteria->id] = $crit->run();
        }
        
		$this->render('run', array('hw'=>$homework, 'validation'=>$validation));
	}

	public function actionShow($hid = null)
	{
        $hometask = ReceivedHomework::model()->findByPk($hid);
        if (!$hometask)
            throw new CHttpException(404, "No hometask found");
        
        $files = glob($hometask->sourcePath."*");
		$this->renderPartial('show', array('files'=>$files));
	}
    
    public function actionCreate()
    {
        $model=new Hometask('create');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='hometask-create-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Hometask']))
        {
            $model->attributes=$_POST['Hometask'];
            $model->isImported = 0;
            $model->timestamp = time();
            $model->term = strtotime($model->term);
            if($model->save())
            {
                $this->refresh();
            }
        }
        $this->render('create',array('model'=>$model));
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