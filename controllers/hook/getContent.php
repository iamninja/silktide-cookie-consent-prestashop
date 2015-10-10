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
			Configuration::updateValue(
				'SILKTIDECOOKIE_MESSAGE',
				Tools::getValue('SILKTIDECOOKIE_MESSAGE')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_DISMISS',
				Tools::getValue('SILKTIDECOOKIE_DISMISS')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_LEARNMORE',
				Tools::getValue('SILKTIDECOOKIE_LEARNMORE')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_LINK',
				Tools::getValue('SILKTIDECOOKIE_LINK')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_EXPIRYDAYS',
				Tools::getValue('SILKTIDECOOKIE_EXPIRYDAYS')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_THEME',
				Tools::getValue('SILKTIDECOOKIE_THEME')
			);
			Configuration::updateValue(
				'SILKTIDECOOKIE_POSITION',
				Tools::getValue('SILKTIDECOOKIE_POSITION')
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
			array(
                'name' => 'SILKTIDECOOKIE_MESSAGE',
                'label'    => $this->module->l('Message'),
                'type' => 'text',
                'col' => 5,
                'desc' => $this->module->l('The message shown to the user'),
                'empty_message' => $this->module->l('This website uses cookies to ensure you get the best experience on our website')
            ),
            array(
                'name' => 'SILKTIDECOOKIE_DISMISS',
                'label'    => $this->module->l('Dismiss button'),
                'type' => 'text',
                'col' => 3,
                'desc' => $this->module->l('The text to use on the dismiss button'),
                'empty_message' => $this->module->l('Got it!')
            ),
            array(
                'name' => 'SILKTIDECOOKIE_LEARNMORE',
                'label'    => $this->module->l('Learn More button'),
                'type' => 'text',
                'col' => 3,
                'desc' => $this->module->l('The text shown on the link to the cookie policy'),
                'empty_message' => $this->module->l('More info')
            ),
            array(
                'name' => 'SILKTIDECOOKIE_LINK',
                'label'    => $this->module->l('Cookie policy link'),
                'type' => 'text',
                'col' => 5,
                'desc' => $this->module->l('The url of your cookie policy. If it’s set to null, the link is hidden')
            ),
            array(
                'name' => 'SILKTIDECOOKIE_EXPIRYDAYS',
                'label'    => $this->module->l('Days to expire'),
                'type' => 'text',
                'col' => 3,
                'desc' => $this->module->l('The number of days Cookie Consent should store the user’s consent information for'),
                'empty_message' => $this->module->l('365')
            ),
            array(
				'type' => 'radio',
				'label' => $this->module->l('Theme:'),
				'name' => 'SILKTIDECOOKIE_THEME',
				'desc' => $this->module->l('Choose color theme'),
				'is_bool' => false,
				'values' => array(
					array(
						'id' => 'silktidecookie_light',
						'value' => 'light',
						'label' => $this->module->l('Light')
					),
					array(
						'id' => 'silktidecookie_dark',
						'value' => 'dark',
						'label' => $this->module->l('Dark')
					)
				)
			),
			array(
				'type' => 'radio',
				'label' => $this->module->l('Position:'),
				'name' => 'SILKTIDECOOKIE_POSITION',
				'desc' => $this->module->l('Choose the position the cookie consent will appear'),
				'is_bool' => false,
				'values' => array(
					array(
						'id' => 'silktidecookie_top',
						'value' => 'top',
						'label' => $this->module->l('Top')
					),
					array(
						'id' => 'silktidecookie_bottom',
						'value' => 'bottom',
						'label' => $this->module->l('Bottom')
					),
					array(
						'id' => 'silktidecookie_floating',
						'value' => 'floating',
						'label' => $this->module->l('Floating')
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
        		'SILKTIDECOOKIE_MESSAGE' => Tools::getValue(
        			'SILKTIDECOOKIE_MESSAGE',
        			Configuration::get('SILKTIDECOOKIE_MESSAGE')
        		),
        		'SILKTIDECOOKIE_DISMISS' => Tools::getValue(
        			'SILKTIDECOOKIE_DISMISS',
        			Configuration::get('SILKTIDECOOKIE_DISMISS')
        		),
        		'SILKTIDECOOKIE_LEARNMORE' => Tools::getValue(
        			'SILKTIDECOOKIE_LEARNMORE',
        			Configuration::get('SILKTIDECOOKIE_LEARNMORE')
        		),
        		'SILKTIDECOOKIE_LINK' => Tools::getValue(
        			'SILKTIDECOOKIE_LINK',
        			Configuration::get('SILKTIDECOOKIE_LINK')
        		),
        		'SILKTIDECOOKIE_EXPIRYDAYS' => Tools::getValue(
        			'SILKTIDECOOKIE_EXPIRYDAYS',
        			Configuration::get('SILKTIDECOOKIE_EXPIRYDAYS')
        		),
        		'SILKTIDECOOKIE_THEME' => Tools::getValue(
        			'SILKTIDECOOKIE_THEME',
        			Configuration::get('SILKTIDECOOKIE_THEME')
        		),
        		'SILKTIDECOOKIE_POSITION' => Tools::getValue(
        			'SILKTIDECOOKIE_POSITION',
        			Configuration::get('SILKTIDECOOKIE_POSITION')
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