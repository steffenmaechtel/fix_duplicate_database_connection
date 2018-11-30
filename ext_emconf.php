<?php
/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Fix duplicate database connection',
    'description' => 'TYPO3 extension to fix duplicate database connection for old extensions using $GLOBALS[\'TYPO3_DB\']',
    'category' => 'be',
    'version' => '0.0.5',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'author' => 'Steffen Maechtel',
    'author_email' => 'info@steffen-maechtel.de',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-8.7.999',
            'php' => '5.5.0-7.2.999'
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
