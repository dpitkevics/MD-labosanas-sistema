<?php

class CriteriaController extends Controller
{
	public function actionCheck()
	{
            $criteria = new CCriteria(Criteria::model()->findByPk(2), 'C:\xampp\htdocs\md\protected\\archive\archive-johntestercom\6788\dp11058\\');
            CVarDumper::dump($criteria->run());
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
        
        public function actionNew()
        {
            $model=new Criteria('create');

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='criteria-new-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['Criteria']))
            {
                $model->attributes=$_POST['Criteria'];
                if($model->validate())
                {
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->render('new',array('model'=>$model));
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