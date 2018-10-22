<?php
/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(function () {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Database\\DatabaseConnection'] = array(
        'className' => 'SteffenMaechtel\\FixDuplicateDatabaseConnection\\Xclass\\SingleDatabaseConnection'
    );
});