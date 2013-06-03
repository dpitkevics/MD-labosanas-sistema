<?php

class CriteriaController extends AuthController
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

	public function actionSet($cid = null)
	{
            if ($cid === null) {
                $criteria = Criteria::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));

                $this->render('set', array('criteria' => $criteria, '_step' => 1));
            } else if ($cid !== null) {
                $criteria = Criteria::model()->findByPk($cid);
                $hometasks = UserHometask::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
                if (!$criteria)
                    throw new CHttpException(404, "No criterion found");
                
                $this->render('set', array('criteria' => $criteria, 'hometasks' => $hometasks, '_step' => 2));
            }
	}
        
        public function actionView()
        {
            $model = Criteria::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
            
            $this->render('view', array('criteria' => $model));
        }
        
        public function actionEdit($id)
        {
            $model = Criteria::model()->findByPk($id);
            if (!$model)
                throw new CHttpException(404, "No Criteria found");
            // uncomment the following code to enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='criteria-new-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['Criteria']))
            {
                $model->attributes=$_POST['Criteria'];
                $model->timestamp = time();
                $model->user_id = Yii::app()->user->id;
                
                if (isset($_POST['v']) && !empty($_POST['v'][0]) && isset($_POST['n']) && !empty($_POST['n'][0]) && isset($_POST['p']) && !empty($_POST['p'][0])
                    && isset($_POST['fv']) && !empty($_POST['fv'][0]) && isset($_POST['fn']) && !empty($_POST['fn'][0]) && isset($_POST['fc']) && !empty($_POST['fc'][0])) {
                    $init = false;
                    $c = 0;
                    foreach ($_POST['fn'] as $fn) {
                        if (($pos = strpos($fn, 'run('))!==false && $pos === 0) {
                            if ($_POST['fv'][$c] != 'public')
                                $model->addError('criteria_sentence', 'Method "run" must be public');
                            $init = true;
                        }
                        $c++;
                    } 
                    if (!$init)
                        $model->addError ('criteria_sentence', 'Method "run" not found');
                    
                    $model->criteria_sentence = $this->generateClassString($model->public_name, $_POST['v'], $_POST['n'], $_POST['p'], $_POST['fv'], $_POST['fn'], $_POST['fc']);
                }
                if($model->validate(null, false))
                {
                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', "Criteria updated!");
                        $this->redirect(array('/criteria/index'));
                    }
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->render('edit',array('model'=>$model));
        }
        
        public function actionNew()
        {
            $model=new Criteria('create');

            // uncomment the following code to enable ajax-based validation
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='criteria-new-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            

            if(isset($_POST['Criteria']))
            {
                $model->attributes=$_POST['Criteria'];
                $model->timestamp = time();
                $model->user_id = Yii::app()->user->id;
                
                if (isset($_POST['v']) && !empty($_POST['v'][0]) && isset($_POST['n']) && !empty($_POST['n'][0]) && isset($_POST['p']) && !empty($_POST['p'][0])
                    && isset($_POST['fv']) && !empty($_POST['fv'][0]) && isset($_POST['fn']) && !empty($_POST['fn'][0]) && isset($_POST['fc']) && !empty($_POST['fc'][0])) {
                    $init = false;
                    $c = 0;
                    foreach ($_POST['fn'] as $fn) {
                        if (($pos = strpos($fn, 'run('))!==false && $pos === 0) {
                            if ($_POST['fv'][$c] != 'public')
                                $model->addError('criteria_sentence', 'Method "run" must be public');
                            $init = true;
                        }
                        $c++;
                    } 
                    if (!$init)
                        $model->addError ('criteria_sentence', 'Method "run" not found');
                    
                    $model->criteria_sentence = $this->generateClassString($model->public_name, $_POST['v'], $_POST['n'], $_POST['p'], $_POST['fv'], $_POST['fn'], $_POST['fc']);
                }
                if($model->validate(null, false))
                {
                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', "Criteria created!");
                        $this->redirect(array('/criteria/index'));
                    }
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
            $title = ucfirst(str_replace(' ', '_', $title));
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