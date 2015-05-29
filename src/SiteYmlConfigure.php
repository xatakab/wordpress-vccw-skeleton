<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/31
 * Time: 1:41
 */

namespace Xearts\Wvs;


use Composer\IO\IOInterface;

class SiteYmlConfigure
{
    /**
     * @var \Composer\IO\IOInterface
     */
    private $io;

    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param IOInterface $io
     * @param string $rootPath
     */
    public function __construct(IOInterface $io, $rootPath)
    {
        $this->io = $io;
        $this->rootPath = $rootPath;
    }

    public function modifyVagrantFile()
    {
        $vagrantFile = "{$this->rootPath}/Vagrantfile";
        $content = file_get_contents($vagrantFile);
        file_put_contents(
            $vagrantFile,
            str_replace(
                "File.join(File.dirname(__FILE__), 'provision/default.yml')",
                "File.join(File.dirname(__FILE__), 'vendor/vccw-team/vccw/provision/default.yml')",
                $content
            )
        );


    }

    public function set($name, $value)
    {
        $filename = "{$this->rootPath}/site.yml";
        $content = file_get_contents($filename);

        if (is_string($value)) {
            $content = preg_replace("/^{$name}:\s+.+$/m", "{$name}: {$value}", $content);
        }

        file_put_contents($filename, $content);
    }
}
