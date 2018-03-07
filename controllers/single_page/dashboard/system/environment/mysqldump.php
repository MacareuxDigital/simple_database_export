<?php
namespace Concrete\Package\SimpleDatabaseExport\Controller\SinglePage\Dashboard\System\Environment;

use Concrete\Core\Database\Connection\Connection;
use Ifsnop\Mysqldump\Mysqldump as IMysqldump;

class Mysqldump extends \Concrete\Core\Page\Controller\DashboardPageController
{
    public function view()
    {
        $dumpOptions = [
            'compress' => [
                IMysqldump::NONE => IMysqldump::NONE,
                IMysqldump::GZIP => IMysqldump::GZIP,
                IMysqldump::BZIP2 => IMysqldump::BZIP2,
            ],
            'add-drop-table' => [1 => t('Yes'),  0 => t('No')],
            'single-transaction' => [1 => t('Yes'),  0 => t('No')],
            'lock-tables' => [1 => t('Yes'),  0 => t('No')],
            'add-locks' => [1 => t('Yes'),  0 => t('No')],
            'extended-insert' => [1 => t('Yes'),  0 => t('No')],
            'disable-keys' => [1 => t('Yes'),  0 => t('No')],
            'no-create-info' => [1 => t('Yes'),  0 => t('No')],
            'skip-triggers' => [1 => t('Yes'),  0 => t('No')],
            'add-drop-trigger' => [1 => t('Yes'),  0 => t('No')],
            'add-drop-database' => [1 => t('Yes'),  0 => t('No')],
            'no-autocommit' => [1 => t('Yes'),  0 => t('No')],
            'skip-comments' => [1 => t('Yes'),  0 => t('No')],
            'skip-dump-date' => [1 => t('Yes'),  0 => t('No')],
        ];
        $defaultOptions = [
            'compress' => IMysqldump::NONE,
            'add-drop-table' => 0,
            'single-transaction' => 1,
            'lock-tables' => 1,
            'add-locks' => 1,
            'extended-insert' => 1,
            'disable-keys' => 1,
            'no-create-info' => 0,
            'skip-triggers' => 0,
            'add-drop-trigger' => 1,
            'add-drop-database' => 0,
            'no-autocommit' => 1,
            'skip-comments' => 0,
            'skip-dump-date' => 0,
        ];
        $this->set('dumpOptions', $dumpOptions);
        $this->set('defaultOptions', $defaultOptions);
    }

    public function run()
    {
        if ($this->token->validate("mysqldump")) {
            ini_set('memory_limit', -1);
            set_time_limit(0);

            $options = [
                'compress' => IMysqldump::NONE,
                'add-drop-table' => ($this->post('add-drop-table')) ? true : false,
                'single-transaction' => ($this->post('single-transaction')) ? true : false,
                'lock-tables' => ($this->post('lock-tables')) ? true : false,
                'add-locks' => ($this->post('add-locks')) ? true : false,
                'extended-insert' => ($this->post('extended-insert')) ? true : false,
                'disable-keys' => ($this->post('disable-keys')) ? true : false,
                'no-create-info' => ($this->post('no-create-info')) ? true : false,
                'skip-triggers' => ($this->post('skip-triggers')) ? true : false,
                'add-drop-trigger' => ($this->post('add-drop-trigger')) ? true : false,
                'add-drop-database' => ($this->post('add-drop-database')) ? true : false,
                'no-autocommit' => ($this->post('no-autocommit')) ? true : false,
                'skip-comments' => ($this->post('skip-comments')) ? true : false,
                'skip-dump-date' => ($this->post('skip-dump-date')) ? true : false,
            ];

            $ext = '.sql';
            switch ($options['compress']) {
                case IMysqldump::GZIP:
                    $ext = '.sql.gz';
                    break;
                case IMysqldump::BZIP2:
                    $ext = '.sql.bz2';
            }
            $filename = 'concrete5_dump_' . time() . $ext;

            try {
                header('Content-type: application/octet-stream');
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Pragma: public");
                header("Cache-Control: private", false);
                header("Content-Transfer-Encoding: binary");
                header("Content-Encoding: plainbinary");

                $conn = $this->app->make(Connection::class);
                $params = $conn->getParams();
                $dump = new IMysqldump('mysql:host=' . $params['server'] . ';dbname=' . $params['database'], $params['username'], $params['password'], $options);
                $dump->start();
                $this->app->shutdown();
            } catch (\Exception $e) {
                $this->error->add($e->getMessage());
            }
        } else {
            $this->error->add($this->token->getErrorMessage());
        }

        $this->view();
    }
}
