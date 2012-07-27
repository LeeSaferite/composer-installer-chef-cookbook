<?php

namespace Composer\Installer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * Simple installer to support chef-cookbook type
 */
class ChefCookbookInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'chef-cookbook';
    }

    /**
     * Currently uses an absolute path to a chef cookbooks directory
     *
     * @param \Composer\Package\PackageInterface $package
     * @return string
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prettyName = $package->getPrettyName();
        list($vendor, $name) = explode('/', $prettyName);
        return 'tools/chef/cookbooks/' . $name;
    }
}
