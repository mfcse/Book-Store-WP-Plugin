<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite3b384e26398a493a7004885cc274606
{
    public static $files = array (
        '6d00d399407a6abfc02f308bb75dc6e8' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Book\\Store\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Book\\Store\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite3b384e26398a493a7004885cc274606::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite3b384e26398a493a7004885cc274606::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}