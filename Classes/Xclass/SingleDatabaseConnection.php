<?php
namespace SteffenMaechtel\FixDuplicateDatabaseConnection\Xclass;

/**
 * @author Steffen Maechtel <info@steffen-maechtel.de>
 */
use mysqli;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
        } else {
            parent::connectDB();
        }
    }
}
