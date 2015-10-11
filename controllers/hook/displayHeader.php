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
		// Assign variables to smarty
		$this->context->smarty->assign(array(
			'message' => Configuration::get('SILKTIDECOOKIE_MESSAGE'),
			'dismiss' => Configuration::get('SILKTIDECOOKIE_DISMISS'),
			'learn_more' => Configuration::get('SILKTIDECOOKIE_LEARNMORE'),
			'link_more' => Configuration::get('SILKTIDECOOKIE_LINK'),
			'expiry_days' => (int)Configuration::get('SILKTIDECOOKIE_EXPIRYDAYS'),
			'active' => Configuration::get('SILKTIDECOOKIE_ACTIVE'),
			'theme' => Configuration::get('SILKTIDECOOKIE_THEME').'-'.Configuration::get('SILKTIDECOOKIE_POSITION')
		));

		return $this->module->display($this->file, 'displayHeader.tpl');
	}
}