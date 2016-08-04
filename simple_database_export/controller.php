<?php
namespace Concrete\Package\SimpleDatabaseExport;

use Concrete\Core\Backup\ContentImporter;
use Package;

class Controller extends Package
{
    /**
     * @var string Package handle.
     */
    protected $pkgHandle = 'simple_database_export';

    /**
     * @var string Required concrete5 version.
     */
    protected $appVersionRequired = '5.7.5';

    /**
     * @var string Package version.
     */
    protected $pkgVersion = '0.1';

    /**
     * Returns the translated package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t('Add simple "Export Database" button in your dashboard.');
    }

    /**
     * Returns the translated package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t("Simple Database Export");
    }

    /**
     * Startup process of the package.
     */
    public function on_start()
    {
        $this->registerAutoload();
    }
    
    /**
     * Register autoloader.
     */
    protected function registerAutoload()
    {
        require $this->getPackagePath() . '/vendor/autoload.php';
    }
    
    /**
     * Install process of the package.
     */
    public function install()
    {
        if (!file_exists($this->getPackagePath() . '/vendor/autoload.php')) {
            throw new Exception(t('Required libraries not found.'));
        }
        $pkg = parent::install();
        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/dashboard.xml');

        return $pkg;
    }
}
