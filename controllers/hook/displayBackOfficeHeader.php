<?php

/**
* displayBackOfficeHeader hook controller
* Add stuff in back office's <head>
*/
class SilktideCookieDisplayBackOfficeHeaderController
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
		// Variable to check if we are in module's configuration page
		$show_cookieconsent = false;
		if ((Tools::getValue('configure') == $this->module->name) &&
			(Tools::getValue('module_name') == $this->module->name)) {
			$show_cookieconsent = true;
		}

		// Assign variables to smarty
		$this->context->smarty->assign(array(
			'show_cookieconsent' => $show_cookieconsent
		));

		return $this->module->display($this->file, 'displayBackOfficeHeader.tpl');
	}
}