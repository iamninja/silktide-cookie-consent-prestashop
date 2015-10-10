<?php

/**
* displayHeader hook controller
* Add stuff into <head>
*/
class SilktideCookieDisplayHeaderController
{

	public function __construct($module, $file, $path)
	{
		$this->file = $file;
		$this->module = $module;
		$this->context = Context::getContext();
		$this->_path = $path;
	}

	public function run($params)
	{
		return $this->module->display($this->file, 'displayHeader.tpl');
	}
}