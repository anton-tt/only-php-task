<?php

class dev_site extends CModule
{
    public $MODULE_ID = 'dev.site';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME = 'Модуль задания №5';
    public $PARTNER_NAME = 'dev';

    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    public function InstallFiles()
    {
        return true;
    }

    public function UnInstallFiles()
    {
        return true;
    }

    public function DoInstall()
    {
        RegisterModule($this->MODULE_ID);

        $this->InstallEvents();
        $this->InstallAgents();
    }

    public function DoUninstall()
    {
        $this->UnInstallEvents();
        $this->UnInstallAgents();

        UnRegisterModule($this->MODULE_ID);
    }

    public function InstallEvents()
    {
        RegisterModuleDependences(
            'iblock',
            'OnAfterIBlockElementAdd',
            $this->MODULE_ID,
            '\\Dev\\Site\\Handlers\\Iblock',
            'handleElement'
        );

        RegisterModuleDependences(
            'iblock',
            'OnAfterIBlockElementUpdate',
            $this->MODULE_ID,
            '\\Dev\\Site\\Handlers\\Iblock',
            'handleElement'
        );
    }

    public function UnInstallEvents()
    {
        UnRegisterModuleDependences(
            'iblock',
            'OnAfterIBlockElementAdd',
            $this->MODULE_ID,
            '\\Dev\\Site\\Handlers\\Iblock',
            'handleElement'
        );

        UnRegisterModuleDependences(
            'iblock',
            'OnAfterIBlockElementUpdate',
            $this->MODULE_ID,
            '\\Dev\\Site\\Handlers\\Iblock',
            'handleElement'
        );
    }

    public function InstallAgents()
    {
        \CAgent::AddAgent(
            "\\Dev\\Site\\Agents\\Iblock::cleanLog();",
            $this->MODULE_ID,
            "N",
            3600,
            "",
            "Y"
        );
    }

    public function UnInstallAgents()
    {
        \CAgent::RemoveModuleAgents($this->MODULE_ID);
    }
    
}
