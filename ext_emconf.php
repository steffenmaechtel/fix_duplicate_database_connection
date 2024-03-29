<?php
/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fix duplicate database connection',
    'description' => 'TYPO3 extension to fix duplicate database connection for old extensions using $GLOBALS[\'TYPO3_DB\']',
    'category' => 'be',
    'version' => '0.0.15',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'author' => 'Steffen Maechtel',
    'author_email' => 'info@steffen-maechtel.de',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.999',
            'php' => '8.1.0-8.2.999'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'SteffenMaechtel\\FixDuplicateDatabaseConnection\\' => 'Classes'
        ]
    ],
];
