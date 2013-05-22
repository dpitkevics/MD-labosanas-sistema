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
                $model->timestamp = time();
                $model->user_id = Yii::app()->user->id;
                
                if (isset($_POST['v']) && isset($_POST['n']) && isset($_POST['p'])
                    && isset($_POST['fv']) && isset($_POST['fn']) && isset($_POST['fc'])) {
                    $model->criteria_sentence = $this->generateClassString($model->public_name, $_POST['v'], $_POST['n'], $_POST['p'], $_POST['fv'], $_POST['fn'], $_POST['fc']);
                }
                if($model->validate())
                {
                    CVarDumper::dump($model->attributes);
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->render('new',array('model'=>$model));
        }
        
        public function actionClass()
        {
            $this->renderPartial('class');
        }
        
        private function generateClassString($title, $var_visibilities, $var_names, $var_values, $fnc_visibilities, $fnc_names, $fnc_values) {
            $title = ucfirst($title);
            $classString = "class $title { " . PHP_EOL;
            for ($i = 0; $i < sizeof ($var_visibilities); $i++) {
                $classString .= "\t$var_visibilities[$i] \$$var_names[$i] = $var_values[$i];" . PHP_EOL;
            }
            for ($i = 0; $i < sizeof($fnc_visibilities); $i++) {
                $classString .= "\t$fnc_visibilities[$i] function $fnc_names[$i] { " . PHP_EOL;
                $classString .= "\t\t$fnc_values[$i]" . PHP_EOL;
                $classString .= "\t}" . PHP_EOL;
            }
            $classString .= "} " . PHP_EOL;
            return $classString;
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