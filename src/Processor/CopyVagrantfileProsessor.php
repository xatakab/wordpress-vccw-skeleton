<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/31
 * Time: 1:34
 */

namespace Xearts\Wvs\Processor;


use Xearts\Wvs\ProcessorInterface;

class CopyVagrantfileProsessor implements ProcessorInterface
{
    /**
     * @var string
     */
    private $rootPath;
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }
    /**
     * @throws \RuntimeException
     */
    public function process()
    {

        $vccwPath = "{$this->rootPath}/vendor/vccw-team/vccw";

        if (!file_exists("{$vccwPath}/Vagrantfile")) {
            throw new \RuntimeException("Vagrantfile is not exists.");
        }
        if (!file_exists("{$vccwPath}/provision/default.yml")) {
            throw new \RuntimeException("default.yml is not exists.");
        }
        // Vagrantfile
        copy("{$vccwPath}/Vagrantfile", "{$this->rootPath}/Vagrantfile");
        copy("{$vccwPath}/provision/default.yml", "{$this->rootPath}/site.yml");

    }
}
