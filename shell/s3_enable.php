<?php
require_once './abstract.php';

class Arkade_S3_Shell_Enable extends Mage_Shell_Abstract
{
    /**
     * Update configuration to tell Magento that we are now using S3
     */
    public function run()
    {
        if ($this->getArg('y') || $this->getArg('yes')) {
            echo "Updating configuration to use S3.\n";

            Mage::getConfig()->saveConfig('system/media_storage_configuration/media_storage', 2);
            Mage::app()->getConfig()->reinit();
        } else {
            echo $this->usageHelp();
        }

        return $this;
    }

    public function usageHelp()
    {
        return <<<USAGE
\033[1mDESCRIPTION\033[0m
    This script will set Magento to use S3 for file storage (you will need to update
    the core_config_data table in the database to revert it back to using the file
    system if you make a mistake). 

    \033[1mNOTE:\033[0m Please make sure to back up your media files before you run this!
    You never know what might happen!

\033[1mSYNOPSIS\033[0m
    php s3_enable.php [-y] [--yes]
                      [-h] [--help]

\033[1mOPTIONS\033[0m
    -y, --yes
        This parameter will confirm that you want to enable using S3 as your storage
        backend.


USAGE;
    }
}

$shell = new Arkade_S3_Shell_Enable();
$shell->run();
