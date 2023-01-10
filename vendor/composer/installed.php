<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'admin/api',
        'dev' => true,
    ),
    'versions' => array(
        'admin/api' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'giacocorsiglia/wordpress-stubs' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'php-stubs/wordpress-stubs' => array(
            'pretty_version' => 'v6.1.0',
            'version' => '6.1.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-stubs/wordpress-stubs',
            'aliases' => array(),
            'reference' => '19e7966c8e70a99a4824b3e5d1526680a151f13b',
            'dev_requirement' => true,
        ),
        'php-stubs/wp-cli-stubs' => array(
            'pretty_version' => 'v2.7.0',
            'version' => '2.7.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-stubs/wp-cli-stubs',
            'aliases' => array(),
            'reference' => '428544fc3696273bfbb4cffe4ac88f5fed428fc8',
            'dev_requirement' => true,
        ),
    ),
);
