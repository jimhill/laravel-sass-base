<?php

class SiteController extends BaseController {

	public function index()
	{
		return View::make('site/index');
	}

}
