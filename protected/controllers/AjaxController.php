<?php

class AjaxController extends AuthController
{
    public function actionHomeworkTypes()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $hometasks = Hometask::model()->findAllByAttributes(array('isImported' => 1));
            foreach ($hometasks as $hometask) {
                if ($hometask->userHometasks->user_id === Yii::app()->user->id)
                    $rHometasks[] = $hometask;
            }
            $this->renderPartial('homeworkTypes', array('hometasks'=>$rHometasks));
        } else {
            throw new CHttpException(404, "You are not allowed here");
        }
    }
    
    public function actionImportHometasks()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $baseDir = Yii::app()->basePath . DIRECTORY_SEPARATOR;
            $dataDir = $baseDir . 'data'.DIRECTORY_SEPARATOR.'data-'.$this->getDirAppendix().DIRECTORY_SEPARATOR;
            $archiveDir = $baseDir . 'archive'.DIRECTORY_SEPARATOR.'archive-'.$this->getDirAppendix().DIRECTORY_SEPARATOR;
            if (!is_dir($archiveDir))
                mkdir ($archiveDir);
            $files = glob($dataDir.'*.zip');
            foreach ($files as $file) {
                $name = explode (DIRECTORY_SEPARATOR, $file);
                $name = end($name);
                $data = explode ('-', $name);
                $zipID = explode ('.', end($data));
                $zipID = $zipID[0];
                $hometask = UserHometask::model()->with('hometask', array('criteria' => array('condition' => array('zipID' => $zipID))))->findByAttributes(array('user_id' => Yii::app()->user->id));
                if ($hometask->user_id !== Yii::app()->user->id)
                    continue;
                $hometask = $hometask->hometask;
                if (!$hometask || $hometask->isImported)
                    continue;
                $zipDir = $archiveDir . $zipID . DIRECTORY_SEPARATOR;
                $zip = Yii::app()->zip;
                $zip->extractZip($file, $zipDir);
                
                $zips = glob($archiveDir.$zipID.DIRECTORY_SEPARATOR.'*');
                foreach ($zips as $single) {
                    $singleName = explode(DIRECTORY_SEPARATOR, $single);
                    $singleName = explode('_', end($singleName));
                    if (count($singleName) < 2) { continue; }
                    $stAplNr = $singleName[1];
                    $zip->extractZip($single, $archiveDir.$zipID.DIRECTORY_SEPARATOR.$stAplNr.DIRECTORY_SEPARATOR);
                    
                    $student = Student::model()->findByAttributes(array('studentIDNumber'=>$stAplNr));
                    if (!$student) {
                        $student = new Student;
                        $personal = explode(" ", $singleName[0]);
                        $student->name = $personal[0];
                        $student->surname = $personal[1];
                        $student->studentIDNumber = $stAplNr;
                        $student->timestamp = time();
                        $student->save();
                    }
                    
                    $receivedHomework = new ReceivedHomework;
                    $receivedHomework->homestaskID = $hometask->id;
                    $receivedHomework->studentIDNumber = $student->studentIDNumber;
                    $receivedHomework->sourcePath = $archiveDir.$zipID.DIRECTORY_SEPARATOR.$stAplNr.DIRECTORY_SEPARATOR;
                    $receivedHomework->timestamp = time();
                    $receivedHomework->save();
                    
                    unlink($single);
                }
                
                $hometask->isImported = true;
                $hometask->save();
                
                unlink($file);
            }
        }
        $this->renderPartial('importHometasks');
    }
    
    public function actionFilecontent($url = null)
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            echo file_get_contents($url);
        }
    }
    
    public function actionCriteriaState()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $entry = $_POST['entry'];
            $cid = $_POST['cid'];
            $hid = $_POST['hid'];
            switch ($entry) {
                case 'add':
                    $hc = new HometaskCriteria;
                    $hc->hometask_id = $hid;
                    $hc->criteria_id = $cid;
                    $hc->timestamp = time();
                    $hc->save();
                    break;
                case 'del':
                    $hc = HometaskCriteria::model()->findByAttributes(array('hometask_id' => $hid, 'criteria_id' => $cid));
                    if (!$hc)
                        return;
                    $hc->delete();
                    break;
            }
        }
    }
    
    public function actionSaveMark()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $hid = (int)$_POST['hid'];
            $grade = (int)$_POST['mark'];
            if ($grade < 0 || $grade > 10)
                throw new CHttpException(404, "Mark is invalid");
            $rhg = ReceivedHomeworkGrade::model()->findByAttributes(array('received_homework_id' => $hid));
            if (!$rhg) {
                $rhg = new ReceivedHomeworkGrade;
                $rhg->received_homework_id = $hid;
                $rhg->grade = $grade;
                $rhg->timestamp = time();
            } else {
                $rhg->grade = $grade;
                $rhg->timestamp = time();
            }
            $rhg->save();
        }
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