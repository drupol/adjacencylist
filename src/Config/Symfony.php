<?php

declare(strict_types = 1);

namespace App\Config;

use drupol\PhpConventions\PhpCsFixer\Config\Php71;

/**
 * Class Symfony.
 */
final class Symfony extends Php71
{
    /**
     * @var string
     */
    public static $rules = 'vendor/drupol/php-conventions/config/php71/phpcsfixer.rules.yml';

    /**
     * {@inheritdoc}
     */
    public function getFinder()
    {
        /** @var \Symfony\Component\Finder\Finder $finder */
        $finder = parent::getFinder();

        return $finder
            ->exclude(['build', 'config', 'libraries', 'node_modules', 'public', 'vendor', 'var'])
            ->in($_SERVER['PWD'] . '/src');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'drupol/php-conventions/php71/symfony';
    }
}
