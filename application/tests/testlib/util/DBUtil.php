<?php

namespace testlib\util;

use \Laravel\Database;
use \Laravel\Config;

final class DBUtil {

    private function __construct() {
        
    }

    /**
     * Alle vorhandenen Tabellen ermitteln und bei allen den Inhalt löschen.
     * Während des Vorgangs werden FK-constraints deaktiviert.
     */
    public static function deleteAllTables() {
        $databaseName = static::getDatabaseName();
        static::deleteAllTablesInDatabase($databaseName);
    }

    /**
     * Löscht den Inhalt aller Tabellen in einer Datenbank.
     * @param string Name der Datenbank, z.B. 'myapp_test'.
     */
    private static function deleteAllTablesInDatabase($databaseName) {
        $tables = static::getAllTables($databaseName);

        static::disableForeignKeyChecks();

        foreach ($tables as $table) {
            Database::table($table->table_name)->delete();
        }

        static::enableForeignKeyChecks();
    }

    /**
     * Foreign Key Checks in dieser DB-Session deaktivieren.
     */
    private static function disableForeignKeyChecks() {
        Database::query('SET FOREIGN_KEY_CHECKS = 0;');
    }

    /**
     * Foreign Key Checks in dieser DB-Session aktivieren.
     */
    private static function enableForeignKeyChecks() {
        Database::query('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * @param string $databaseName
     * @return array Array von Objekten, welche ein Property 'table_name' besitzen.
     */
    private static function getAllTables($databaseName) {
        $sql = "SELECT DISTINCT i.table_name FROM information_schema.tables i WHERE i.table_schema = '" . $databaseName . "';";
        $tables = Database::query($sql);
        return $tables;
    }

    /**
     * Aus der aktuell gültigen Environment-Konfiguration den Namen der Datenbank ermitteln.
     * @return string
     */
    private static function getDatabaseName() {
        $databaseDefault = Config::get('database.default');
        $databaseName = Config::get('database.connections.' . $databaseDefault . '.database');
        return $databaseName;
    }

}