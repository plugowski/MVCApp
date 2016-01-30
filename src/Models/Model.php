<?php
namespace MyApp\Models;

use DB\SQL;
use MyApp\Config;

/**
 * Class Model
 * @package MyApp\Models
 */
class Model
{
    /**
     * @var SQL
     */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';port=' . Config::DB_PORT . ';dbname=' . Config::DB_NAME;
        $this->db = new SQL($dsn, Config::DB_USER, Config::DB_PASS);
    }
}