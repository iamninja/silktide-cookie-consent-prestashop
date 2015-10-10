<?php

/**
* getContent controller
*/
class SilktideCookieGetContentController
{

	public function __construct($module, $file, $path)
	{
		$this->file = $file;
		$this->module = $module;
		$this->context = Context::getContext();
		$this->_path = $path;
	}

	public function processConfiguration()
	{
		if (Tools::isSubmit('silktidecookie_form')) {
			Configuration::updateValue(
				'SILKTIDECOOKIE_ACTIVE',
				Tools::getValue('SILKTIDECOOKIE_ACTIVE')
			);
		}
	}

	public function renderForm()
	{
		// Create array to be rendered on configuration page
		$forms_array = array(
			array(
				'type' => 'switch',
				'label' => $this->module->l('Enabled:'),
				'name' => 'SILKTIDECOOKIE_ACTIVE',
				'desc' => $this->module->l('Activate module'),
				'is_bool' => true,
				'values' => array(
					array(
						'id' => 'silktidecookie_disabled',
						'value' => 0,
						'label' => $this->module->l('No')
					),
					array(
						'id' => 'silktidecookie_enabled',
						'value' => 1,
						'label' => $this->module->l('Yes')
					)
				)
			),
		);
		$submit_array = array(
			'submit' => array(
				'title' => $this->module->l('Save'),
				'class' => 'button'
			)
		);

		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->module->l('Silktide Cookie Consent Configuration'),
					'icon' => 'icon-wrench'
				),
				'input' => $forms_array,
				'submit' => $submit_array
			)
		);

		// Build HelperForm
		$helper = new HelperForm();
		$helper->table = 'silktidecookie';
		$helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
		$helper->allow_employee_form_lang = (int)Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
		$helper->submit_action = 'silktidecookie_form';
		$helper->currentIndex =
			$this->context->link->getAdminLink('AdminModules', false).
            '&configure='.$this->module->name.
            '&tab_module='.$this->module->tab.
            '&module_name='.$this->module->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
        	'fields_value' => array(
        		'SILKTIDECOOKIE_ACTIVE' => Tools::getValue(
        			'SILKTIDECOOKIE_ACTIVE',
        			Configuration::get('SILKTIDECOOKIE_ACTIVE')
        		),
        	),
        	'languages' => $this->context->controller->getLanguages()
        );

        return $helper->generateForm(array($fields_form));
	}

	public function run()
	{
		$this->processConfiguration();
		$html_tpl = $this->module->display($this->file, 'getContent.tpl');
		$html_form = $this->renderForm();
		return $html_tpl.$html_form;
	}
}