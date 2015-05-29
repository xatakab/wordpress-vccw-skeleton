<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/31
 * Time: 2:19
 */

namespace Xearts\Wvs\Processor;


use Composer\Util\Filesystem;
use Xearts\Wvs\ProcessorInterface;

class CleanUpFilesProcessor implements ProcessorInterface
{
    /**
     * @var \Composer\Util\Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param Filesystem $filesystem
     * @param string $rootPath
     */
    public function __construct(Filesystem $filesystem, $rootPath)
    {
        $this->filesystem = $filesystem;
        $this->rootPath = $rootPath;
    }

    public function process()
    {
        $this->filesystem->removeDirectory("{$this->rootPath}/src");

        unlink("{$this->rootPath}/.gitignore");
        rename("{$this->rootPath}/.gitignore.dist", "{$this->rootPath}/.gitignore");
    }

}
