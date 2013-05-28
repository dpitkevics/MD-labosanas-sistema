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
                $file = base64_decode($file);
                $source = file_get_contents($file);
                $extension = explode(DIRECTORY_SEPARATOR, $file);
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

            $sums = array(
                'weight' => 0,
                'user' => 0,
            );
            foreach ($criterias as $criteria) {
                $sums['weight'] += $criteria->criteria->weight;

                $crit = new CCriteria($criteria->criteria, $homework->sourcePath);
                $validation[$criteria->criteria->id] = $crit->run();

                $sums['user'] += ((strpos($validation[$criteria->criteria->id], '<a')=== false && $validation[$criteria->criteria->id])?$criteria->criteria->weight:0);
            }
        
            $this->render('run', array('hw'=>$homework, 'validation'=>$validation, 'sums' => $sums));
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
                    $user_hometask = new UserHometask();
                    $user_hometask->user_id = Yii::app()->user->id;
                    $user_hometask->hometask_id = $model->primaryKey;
                    $user_hometask->timestamp = time();
                    $user_hometask->save(false);
                    Yii::app()->user->setFlash('success', "Hometask created!");
                    $this->refresh();
                }
            }
            $this->render('create',array('model'=>$model));
        }
        
        public function actionUpdate($id)
        {
            $model=Hometask::model()->findByPk($id);
            $model->term = date('Y-m-d', $model->term);

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
                    $user_hometask = new UserHometask();
                    $user_hometask->user_id = Yii::app()->user->id;
                    $user_hometask->hometask_id = $model->primaryKey;
                    $user_hometask->timestamp = time();
                    $user_hometask->save(false);
                    Yii::app()->user->setFlash('success', "Hometask updated!");
                    $this->refresh();
                }
            }
            $this->render('update',array('model'=>$model));
        }
        
        public function actionUpload()
        {
            if (isset($_FILES['Hometask']))
            {
                $file = CUploadedFile::getInstanceByName('Hometask[upload]');
                if (strpos($file->type, 'zip')===false && strpos($file->name, '.zip')===false)
                    throw new CHttpException(404, "This is not a valid zip file");
                $baseDir = Yii::app()->basePath;
                $dataDir = $baseDir . DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'data-'.$this->getDirAppendix().DIRECTORY_SEPARATOR;
                if ($file->saveAs($dataDir . $file->name)) {
                    Yii::app()->user->setFlash('success', 'Hometask uploaded!');
                    $this->redirect (array('/hometask/index'));
                }
            }
            $this->render('upload');
        }
        
        public function actionViewHometasks()
        {
            $userHometasks = UserHometask::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
            $this->render('viewHometasks', array(
                'userHometasks' => $userHometasks,
            ));
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