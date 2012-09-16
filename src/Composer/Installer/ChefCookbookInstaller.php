<?php

namespace Composer\Installer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * Simple installer to support chef-cookbook and chef-role type
 */
class ChefCookbookInstaller extends LibraryInstaller
{
    /**
     * A map of package type to directory name.
     *
     * @var array
     */
    private static $packageDirs = array(
        'chef-cookbook' => 'cookbooks',
        'chef-role' => 'roles'
    );

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return isset(self::$packageDirs[$packageType]);
    }

    /**
     * Adds cookbooks and roles into separate folders within chef-vendor.
     *
     * @param \Composer\Package\PackageInterface $package
     * @return string
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prettyName = $package->getPrettyName();
        list($vendor, $name) = explode('/', $prettyName);

        $packageDir = self::$packageDirs[$package->getType()];

        return "{$this->vendorDir}/chef-vendor/{$packageDir}/{$name}";
    }
}
