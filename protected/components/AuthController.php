<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthController
 *
 * @author User
 */
class AuthController extends Controller {
    
    public function beforeAction($action) {
        if (Yii::app()->user->isGuest) {
            throw new CHttpException(404, "Only registered users have access to this page");
        }
        return true;
    }
    
}

