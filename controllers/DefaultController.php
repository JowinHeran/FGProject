<?php

class DefaultController extends Controller
{
	public $main_menu="default";
	public function actionIndex()
	{
		$this->render('index');
	}
}