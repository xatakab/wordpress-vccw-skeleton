<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/29
 * Time: 17:34
 */

namespace Xearts\Wvs;

use Composer\Script\Event;
use Composer\Util\Filesystem;
use Xearts\Wvs\Processor\ComposerProsessor;
use Xearts\Wvs\Processor\ConfigureVagrantfileProsessor;
use Xearts\Wvs\Processor\CopyVagrantfileProsessor;
use Xearts\Wvs\Processor\CleanUpFilesProcessor;

class Installer
{

    /**
     * Composer post install script
     *
     * @param Event $event
     * @throws \LogicException
     */
    public static function postInstall(Event $event = null)
    {
        $io = $event->getIO();
        $filesystem = new Filesystem();


        $rootPath = dirname(__DIR__);



        $copyVagrantfileProcessor = new CopyVagrantfileProsessor($rootPath);
        $copyVagrantfileProcessor->process();

        $siteYmlConfigure = new SiteYmlConfigure($io, $rootPath);
        $configureVagrantfileProcessor = new ConfigureVagrantfileProsessor($siteYmlConfigure);
        $configureVagrantfileProcessor->process();

        $composerProcessor = new ComposerProsessor($rootPath);
        $composerProcessor->process();

        $cleanUpFilesProcessor = new CleanUpFilesProcessor($filesystem, $rootPath);
        $cleanUpFilesProcessor->process();
    }
    /**
     * @param string   $path
     * @param Callable $job
     *
     * @return void
     */
    private static function recursiveJob($path, $job)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        foreach($iterator as $file) {
            $job($file);
        }
    }
}
