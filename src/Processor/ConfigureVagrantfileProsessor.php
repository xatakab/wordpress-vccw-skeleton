<?php
/**
 * Created by PhpStorm.
 * User: TTakabayashi
 * Date: 15/05/31
 * Time: 1:37
 */

namespace Xearts\Wvs\Processor;


use Xearts\Wvs\ProcessorInterface;
use Xearts\Wvs\SiteYmlConfigure;

class ConfigureVagrantfileProsessor implements ProcessorInterface
{
    /**
     * @var \Xearts\Wvs\SiteYmlConfigure
     */
    private $siteYmlConfigure;

    /**
     * @param SiteYmlConfigure $siteYmlConfigure
     */
    public function __construct(SiteYmlConfigure $siteYmlConfigure)
    {
        $this->siteYmlConfigure = $siteYmlConfigure;
    }

    public function process()
    {
        $this->siteYmlConfigure->modifyVagrantFile();
        $this->siteYmlConfigure->set('chef_cookbook_path', 'vendor/vccw-team/vccw/provision');
    }
}
