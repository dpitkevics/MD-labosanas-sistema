<?php

class AjaxController extends Controller
{
	public function actionHomeworkTypes()
	{
        if (Yii::app()->request->isAjaxRequest) {
            $hometasks = Hometask::model()->findAll();
            $this->renderPartial('homeworkTypes', array('hometasks'=>$hometasks));
        } else {
            throw new CHttpException(404, "You are not allowed here");
        }
	}
    
    public function actionImportHometasks()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $baseDir = Yii::app()->basePath . '\\..';
            $dataDir = $baseDir . '\\data\\';
            $archiveDir = $baseDir . '\\archive\\';
            $files = glob($dataDir.'*.zip');
            foreach ($files as $file) {
                $name = explode ('\\', $file);
                $name = end($name);
                $data = explode ('-', $name);
                $zipID = explode ('.', end($data));
                $zipID = $zipID[0];
                
                $hometask = Hometask::model()->findByAttributes(array('zipID'=>$zipID));
                if (!$hometask || $hometask->isImported)
                    throw new CHttpException (404, "Not a valid hometask");
                
                $zipDir = $archiveDir . $zipID . '\\';
                $zip = Yii::app()->zip;
                $zip->extractZip($file, $zipDir);
                
                $zips = glob($archiveDir.$zipID.'\\*');
                foreach ($zips as $single) {
                    $singleName = explode('\\', $single);
                    $singleName = explode('_', end($singleName));
                    if (count($singleName) < 2) { continue; }
                    $stAplNr = $singleName[1];
                    $zip->extractZip($single, $archiveDir.$zipID.'\\'.$stAplNr.'\\');
                    
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
                    $receivedHomework->sourcePath = $archiveDir.$zipID.'\\'.$stAplNr.'\\';
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