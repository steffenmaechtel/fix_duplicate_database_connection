<?php
namespace SteffenMaechtel\FixDuplicateDatabaseConnection\Xclass;

/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
use mysqli;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Database\PostProcessQueryHookInterface;
use TYPO3\CMS\Core\Database\PreProcessQueryHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use UnexpectedValueException;

class SingleDatabaseConnection extends DatabaseConnection
{

    /**
     * @overload
     * 
     * Reuse existing database connection from connection pool
     */
    public function connectDB()
    {
        /* @var $database Connection */
        $database = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionByName(ConnectionPool::DEFAULT_CONNECTION_NAME);
        $handle = $database->getWrappedConnection()->getWrappedResourceHandle();

        if ($handle instanceof mysqli) {
            $this->setDatabaseHandle($handle);
            $this->isConnected = true;

            $this->afterDatabaseConnection();
        } else {
            parent::connectDB();
        }
    }

    /**
     * This stuff is normaly done in connectDB after a new connection is opened
     */
    protected function afterDatabaseConnection()
    {
        // Prepare user defined objects (if any) for hooks which extend query methods
        $this->preProcessHookObjects = [];
        $this->postProcessHookObjects = [];
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_db.php']['queryProcessors'])) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_db.php']['queryProcessors'] as $classRef) {
                $hookObject = GeneralUtility::makeInstance($classRef);
                if (!(
                    $hookObject instanceof PreProcessQueryHookInterface || $hookObject instanceof PostProcessQueryHookInterface
                    )) {
                    throw new UnexpectedValueException(
                    '$hookObject must either implement interface TYPO3\\CMS\\Core\\Database\\PreProcessQueryHookInterface or interface TYPO3\\CMS\\Core\\Database\\PostProcessQueryHookInterface', 1299158548
                    );
                }
                if ($hookObject instanceof PreProcessQueryHookInterface) {
                    $this->preProcessHookObjects[] = $hookObject;
                }
                if ($hookObject instanceof PostProcessQueryHookInterface) {
                    $this->postProcessHookObjects[] = $hookObject;
                }
            }
        }
    }
}
