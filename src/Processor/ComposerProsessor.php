<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/31
 * Time: 2:12
 */

namespace Xearts\Wvs\Processor;


use Xearts\Wvs\ProcessorInterface;

class ComposerProsessor implements ProcessorInterface
{
    /**
     * @var string
     */
    private $rootPath;

    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function process()
    {
        // composer.json
        unlink("{$this->rootPath}/composer.json");
        rename("{$this->rootPath}/composer.json.dist", "{$this->rootPath}/composer.json");

        $autoloadPsr4Path = "{$this->rootPath}/vendor/composer/autoload_psr4.php";

        $content = file_get_contents($autoloadPsr4Path);

        file_put_contents($autoloadPsr4Path, str_replace('    \'Xearts\\Wvs\\\' => array($baseDir . \'/src\'),', '', $content));
    }
}
