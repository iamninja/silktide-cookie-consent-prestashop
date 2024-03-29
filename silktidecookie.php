<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Silktidecookie extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'silktidecookie';
        $this->tab = 'front_office_features';
        $this->version = '0.1.0';
        $this->author = 'Vagios Vlachos';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Silktide Cookie Consent for Prestashop');
        $this->description = $this->l('Add Silktide cookie consent on your Prestashop app');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall Silktide Cookie Consent for Prestashop?');
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        // Set configuration values
        Configuration::updateValue('SILKTIDECOOKIE_ACTIVE', false);

        // Call parent and register hooks
        if (!parent::install() ||
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('displayBackOfficeHeader') ||
            !$this->registerHook('displayFooter') ||
            !$this->registerHook('displayTop')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        // Delete configuration values
        Configuration::deleteByName('SILKTIDECOOKIE_ACTIVE');

        // Call parent
        if (!parent::uninstall()) {
            return false;
        }

        return true;
    }

    public function getHookController($hook_name)
    {
        // Include the controller file
        require_once(dirname(__FILE__).'/controllers/hook/'.$hook_name.'.php');

        // Build the controller name
        $controller_name = $this->name.$hook_name.'Controller';

        // Instantiate controller
        $controller = new $controller_name($this, __FILE__, $this->_path);

        // Return the controller
        return $controller;
    }

    public function getContent()
    {
        $controller = $this->getHookController('getContent');
        return $controller->run();
    }

    public function hookDisplayHeader($params)
    {
        $controller = $this->getHookController('displayHeader');
        return $controller->run($params);
    }

    public function hookDisplayBackOfficeHeader($params)
    {
        $controller = $this->getHookController('displayBackOfficeHeader');
        return $controller->run($params);
    }
}
