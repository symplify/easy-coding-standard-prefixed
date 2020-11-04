<?php

namespace _PhpScoper75713bc3e278\Composer;

use _PhpScoper75713bc3e278\Composer\Semver\VersionParser;
class InstalledVersions
{
    private static $installed = array('root' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => NULL, 'name' => 'symplify/easy-coding-standard'), 'versions' => array('composer/package-versions-deprecated' => array('pretty_version' => '1.8.0', 'version' => '1.8.0.0', 'aliases' => array(), 'reference' => '98df7f1b293c0550bd5b1ce6b60b59bdda23aa47'), 'composer/semver' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => '84c47f3d8901440403217afc120683c7385aecb8'), 'composer/xdebug-handler' => array('pretty_version' => '1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => 'cbe23383749496fe0f373345208b79568e4bc248'), 'dealerdirect/phpcodesniffer-composer-installer' => array('pretty_version' => 'v0.7.0', 'version' => '0.7.0.0', 'aliases' => array(), 'reference' => 'e8d808670b8f882188368faaf1144448c169c0b7'), 'doctrine/annotations' => array('pretty_version' => 'v1.2.0', 'version' => '1.2.0.0', 'aliases' => array(), 'reference' => 'd9b1a37e9351ddde1f19f09a02e3d6ee92e82efd'), 'doctrine/lexer' => array('pretty_version' => 'v1.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => '2f708a85bb3aab5d99dab8be435abd73e0b18acb'), 'friendsofphp/php-cs-fixer' => array('pretty_version' => 'v2.16.0', 'version' => '2.16.0.0', 'aliases' => array(), 'reference' => 'ceaff36bee1ed3f1bbbedca36d2528c0826c336d'), 'jean85/pretty-package-versions' => array('pretty_version' => '1.2', 'version' => '1.2.0.0', 'aliases' => array(), 'reference' => '75c7effcf3f77501d0e0caa75111aff4daa0dd48'), 'nette/finder' => array('pretty_version' => 'v2.5.2', 'version' => '2.5.2.0', 'aliases' => array(), 'reference' => '4ad2c298eb8c687dd0e74ae84206a4186eeaed50'), 'nette/robot-loader' => array('pretty_version' => 'v3.2.0', 'version' => '3.2.0.0', 'aliases' => array(), 'reference' => '0712a0e39ae7956d6a94c0ab6ad41aa842544b5c'), 'nette/utils' => array('pretty_version' => 'v3.1.0', 'version' => '3.1.0.0', 'aliases' => array(), 'reference' => 'd6cd63d77dd9a85c3a2fae707e1255e44c2bc182'), 'ocramius/package-versions' => array('replaced' => array(0 => '1.2 - 1.8.99')), 'paragonie/random_compat' => array('pretty_version' => 'v1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'a1d9f267eb8b8ad560e54e397a5ed1e3b78097d1'), 'php-cs-fixer/diff' => array('pretty_version' => 'v1.3.0', 'version' => '1.3.0.0', 'aliases' => array(), 'reference' => '78bb099e9c16361126c86ce82ec4405ebab8e756'), 'phpstan/phpdoc-parser' => array('pretty_version' => '0.4.5', 'version' => '0.4.5.0', 'aliases' => array(), 'reference' => '956e7215c7c740d1226e7c03677140063918ec7d'), 'psr/cache' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => '9e66031f41fbbdda45ee11e93c45d480ccba3eb3'), 'psr/cache-implementation' => array('provided' => array(0 => '1.0')), 'psr/container' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f'), 'psr/container-implementation' => array('provided' => array(0 => '1.0')), 'psr/event-dispatcher-implementation' => array('provided' => array(0 => '1.0')), 'psr/log' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'fe0936ee26643249e916849d48e3a51d5f5e278b'), 'psr/log-implementation' => array('provided' => array(0 => '1.0')), 'psr/simple-cache' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => '753fa598e8f3b9966c886fe13f370baa45ef0e24'), 'psr/simple-cache-implementation' => array('provided' => array(0 => '1.0')), 'sebastian/diff' => array('pretty_version' => '3.0.2', 'version' => '3.0.2.0', 'aliases' => array(), 'reference' => '720fcc7e9b5cf384ea68d9d930d480907a0c1a29'), 'slevomat/coding-standard' => array('pretty_version' => '6.4.0', 'version' => '6.4.0.0', 'aliases' => array(), 'reference' => 'bf3a16a630d8245c350b459832a71afa55c02fd3'), 'squizlabs/php_codesniffer' => array('pretty_version' => '3.5.6', 'version' => '3.5.6.0', 'aliases' => array(), 'reference' => 'e97627871a7eab2f70e59166072a6b767d5834e0'), 'symfony/cache' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '72d5cdc6920f889290beb65fa96b5e9d4515e382'), 'symfony/cache-contracts' => array('pretty_version' => 'v1.1.7', 'version' => '1.1.7.0', 'aliases' => array(), 'reference' => 'af50d14ada9e4e82cfabfabdc502d144f89be0a1'), 'symfony/cache-implementation' => array('provided' => array(0 => '1.0')), 'symfony/config' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'f08e1c48e1f05d07c32f2d8599ed539e62105beb'), 'symfony/console' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '35d9077f495c6d184d9930f7a7ecbd1ad13c7ab8'), 'symfony/debug' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'b24b791f817116b29e52a63e8544884cf9a40757'), 'symfony/dependency-injection' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'd4439814135ed1343c93bde998b7792af8852e41'), 'symfony/deprecation-contracts' => array('pretty_version' => 'v2.1.0', 'version' => '2.1.0.0', 'aliases' => array(), 'reference' => 'ede224dcbc36138943a296107db2b8b2a690ac1c'), 'symfony/error-handler' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'e1acb58dc6a8722617fe56565f742bcf7e8744bf'), 'symfony/event-dispatcher' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'ab1c43e17fff802bef0a898f3bc088ac33b8e0e1'), 'symfony/event-dispatcher-contracts' => array('pretty_version' => 'v1.1.1', 'version' => '1.1.1.0', 'aliases' => array(), 'reference' => '8fa2cf2177083dd59cf8e44ea4b6541764fbda69'), 'symfony/event-dispatcher-implementation' => array('provided' => array(0 => '1.1')), 'symfony/filesystem' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'd12b01cba60be77b583c9af660007211e3909854'), 'symfony/finder' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'ce8743441da64c41e2a667b8eb66070444ed911e'), 'symfony/http-foundation' => array('pretty_version' => 'v5.1.0', 'version' => '5.1.0.0', 'aliases' => array(), 'reference' => 'e0d853bddc2b2cfb0d67b0b4496c03fffe1d37fa'), 'symfony/http-kernel' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '5a5e7237d928aa98ff8952050cbbf0135899b6b0'), 'symfony/options-resolver' => array('pretty_version' => 'v3.0.0', 'version' => '3.0.0.0', 'aliases' => array(), 'reference' => '8e68c053a39e26559357cc742f01a7182ce40785'), 'symfony/polyfill-ctype' => array('pretty_version' => 'v1.8.0', 'version' => '1.8.0.0', 'aliases' => array(), 'reference' => '7cc359f1b7b80fc25ed7796be7d96adc9b354bae'), 'symfony/polyfill-mbstring' => array('pretty_version' => 'v1.1.0', 'version' => '1.1.0.0', 'aliases' => array(), 'reference' => '1289d16209491b584839022f29257ad859b8532d'), 'symfony/polyfill-php70' => array('pretty_version' => 'v1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => '7f7f3c9c2b9f17722e0cd64fdb4f957330c53146'), 'symfony/polyfill-php72' => array('pretty_version' => 'v1.4.0', 'version' => '1.4.0.0', 'aliases' => array(), 'reference' => 'd3a71580c1e2cab33b6d705f0ec40e9015e14d5c'), 'symfony/polyfill-php73' => array('pretty_version' => 'v1.9.0', 'version' => '1.9.0.0', 'aliases' => array(), 'reference' => '990ca8fa94736211d2b305178c3fb2527e1fbce1'), 'symfony/polyfill-php80' => array('pretty_version' => 'v1.15.0', 'version' => '1.15.0.0', 'aliases' => array(), 'reference' => '8854dc880784d2ae32908b75824754339b5c0555'), 'symfony/process' => array('pretty_version' => 'v3.3.0', 'version' => '3.3.0.0', 'aliases' => array(), 'reference' => '8e30690c67aafb6c7992d6d8eb0d707807dd3eaf'), 'symfony/service-contracts' => array('pretty_version' => 'v1.1.6', 'version' => '1.1.6.0', 'aliases' => array(), 'reference' => 'ea7263d6b6d5f798b56a45a5b8d686725f2719a3'), 'symfony/service-implementation' => array('provided' => array(0 => '1.0')), 'symfony/stopwatch' => array('pretty_version' => 'v3.0.0', 'version' => '3.0.0.0', 'aliases' => array(), 'reference' => '6aeac8907e3e1340a0033b0a9ec075f8e6524800'), 'symfony/var-dumper' => array('pretty_version' => 'v5.0.0', 'version' => '5.0.0.0', 'aliases' => array(), 'reference' => '956b8b6e4c52186695f592286414601abfcec284'), 'symfony/var-exporter' => array('pretty_version' => 'v4.2.0', 'version' => '4.2.0.0', 'aliases' => array(), 'reference' => '08250457428e06289d21ed52397b0ae336abf54b'), 'symfony/yaml' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '76de473358fe802578a415d5bb43c296cf09d211'), 'symplify/autowire-array-parameter' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '083679c4b8376e42697761db3e1f8fca3b17e97b'), 'symplify/coding-standard' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '2e7d2b35d331881a507698c0ad59c34579eba6c7'), 'symplify/console-color-diff' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '5ee746f77756b91986f0ce1f93a72d656f28f934'), 'symplify/easy-coding-standard' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => NULL), 'symplify/package-builder' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '130b6546bdb2ab67c9eabdb3b5d49df1384c9335'), 'symplify/set-config-resolver' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '6f301b255822aac10ec382386083b05525c760a8'), 'symplify/skipper' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '55e2ba8e57a0e375c4df7b15dd83d64481347333'), 'symplify/smart-file-system' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '962d275caa1eeb74ab6814881ae9f7750f3efa9e'), 'symplify/symplify-kernel' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '8.4.x-dev'), 'reference' => '9db36c72aa99eedda1ad6cbc3a863f34bff13e64')));
    public static function getInstalledPackages()
    {
        return \array_keys(self::$installed['versions']);
    }
    public static function isInstalled($packageName)
    {
        return isset(self::$installed['versions'][$packageName]);
    }
    public static function satisfies(\_PhpScoper75713bc3e278\Composer\Semver\VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));
        return $provided->matches($constraint);
    }
    public static function getVersionRanges($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        $ranges = array();
        if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            $ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
        }
        if (\array_key_exists('aliases', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
        }
        if (\array_key_exists('replaced', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
        }
        if (\array_key_exists('provided', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
        }
        return \implode(' || ', $ranges);
    }
    public static function getVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['version'];
    }
    public static function getPrettyVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['pretty_version'];
    }
    public static function getReference($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['reference'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['reference'];
    }
    public static function getRootPackage()
    {
        return self::$installed['root'];
    }
    public static function getRawData()
    {
        return self::$installed;
    }
    public static function reload($data)
    {
        self::$installed = $data;
    }
}
