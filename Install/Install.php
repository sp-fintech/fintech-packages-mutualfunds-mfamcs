<?php

namespace Apps\Fintech\Packages\Mf\Amcs\Install;

use Apps\Fintech\Packages\Mf\Amcs\Install\Schema\MfAmcs;
use Apps\Fintech\Packages\Mf\Amcs\Model\AppsFintechMfAmcs;
use System\Base\BasePackage;
use System\Base\Providers\ModulesServiceProvider\DbInstaller;

class Install extends BasePackage
{
    protected $databases;

    protected $dbInstaller;

    public function init()
    {
        $this->databases =
            [
                'apps_fintech_mf_amcs'  => [
                    'schema'        => new MfAmcs,
                    'model'         => new AppsFintechMfAmcs,
                    'configParams'  =>
                        [
                            'min_index_chars' => 6
                        ]
                ],
            ];

        $this->dbInstaller = new DbInstaller;

        return $this;
    }

    public function install()
    {
        $this->preInstall();

        $this->installDb();

        $this->postInstall();

        return true;
    }

    protected function preInstall()
    {
        return true;
    }

    public function installDb()
    {
        $this->dbInstaller->installDb($this->databases);

        return true;
    }

    public function postInstall()
    {
        //Do anything after installation.
        return true;
    }

    public function truncate()
    {
        $this->dbInstaller->truncate($this->databases);
    }

    public function uninstall($remove = false)
    {
        if ($remove) {
            //Check Relationship
            //Drop Table(s)
            $this->dbInstaller->uninstallDb($this->databases);
        }

        return true;
    }
}