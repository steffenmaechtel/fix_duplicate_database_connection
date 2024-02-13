<?php
/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
defined('TYPO3') || die('Access denied.');

call_user_func(function () {
    $isAlreadyExtended = call_user_func(function ($className) {
        // Dont check already extended in extension manager (install/uninstall: this file is loaded twice)
        if (isset($_GET['route']) && $_GET['route'] === '/module/tools/ExtensionmanagerExtensionmanager') {
            return false;
        }

        if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'])) {
            return false;
        }

        return isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][$className]) && is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][$className]) && !empty($GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][$className]['className']);
    }, 'TYPO3\\CMS\\Core\\Database\\DatabaseConnection');

    if ($isAlreadyExtended) {
        throw new Exception('Class TYPO3\\CMS\\Core\\Database\\DatabaseConnection is already extended. (' .
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Database\\DatabaseConnection']['className'] . ')', 1543599433);
    }

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Database\\DatabaseConnection'] = array(
        'className' => 'SteffenMaechtel\\FixDuplicateDatabaseConnection\\Xclass\\SingleDatabaseConnection'
    );
    
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Typo3DbLegacy\\Database\\DatabaseConnection'] = array(
        'className' => 'SteffenMaechtel\\FixDuplicateDatabaseConnection\\Xclass\\SingleDatabaseConnection'
    );
});
