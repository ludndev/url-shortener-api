<?php


namespace Ludndev\UrlShortener\API\Providers;


use \PDO;
use \Exception;


/**
* 
*/
class DBController
{

	/**
	 * Available data output format
	 *
	 * @access protected
	 * @var array $allowDataFormat
	 */
	protected $allowDataFormat = [
		'object' => PDO::FETCH_OBJ ,
		'array' => PDO::FETCH_ASSOC
	];


	/**
	 * Store PDO Connection
	 *
	 * @access protected
	 * @var array $conn
	 */
	private $conn = NULL;


	/**
	 * Last insert id
	 *
	 * @access private
	 * @var string $lastInsertId
	 */
	private $lastInsertId = 0;

	
	/**
	 * Constructor initialize PDO connection
	 *
	 * @access public
	 * @param string $DRIVER
	 * @param string $DB_HOST
	 * @param string $DB_NAME
	 * @param string $DB_USER
	 * @param string $DB_PASS
	 * @param string $PDO_OPTIONS
	 * @return object
	 */
	public function __construct(string $DRIVER, string $DB_HOST, string $DB_NAME, string $DB_USER, string $DB_PASS, array $PDO_OPTIONS)
	{
		$DSN = "$DRIVER:host=$DB_HOST; dbname=$DB_NAME; charset=utf8";
		$this->conn = $this->connect($DSN, $DB_USER, $DB_PASS, $PDO_OPTIONS);
		return $this;
	}


	/**
	 * Connect to database using PDO
	 *
	 * @access protected
	 * @param string $DSN
	 * @param string $DB_USER
	 * @param string $DB_PASS
	 * @param string $PDO_OPTIONS
	 * @return object
	 */
	protected function connect(string $DSN, string $DB_USER, string $DB_PASS, array $PDO_OPTIONS):object
	{
		try {
			$conn = new PDO ($DSN, $DB_USER, $DB_PASS, $PDO_OPTIONS);
		} catch (PDOException $error) {
			throw new Exception($error->getMessage(), 1);
		} finally {
			return $conn;
		}
	}


	/**
	 * PDO connection for standart usage
	 *
	 * @access public
	 * @return object
	 */
	public function conn():object
	{
		return $this->conn;
	}


	/**
	 * Fetch datum after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $format
	 * @return array|object
	 */
	public function run(string $query, array $parameter = [], string $format = 'object')
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($parameter);
		$data = $statement->fetch($this->format[$format]);
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Fetch all data after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $format
	 * @return array|object
	 */
	public function all(string $query, array $parameter = [], string $format = 'object')
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($parameter);
		$this->lid = $this->conn->lastInsertId();
		$data = $statement->fetchAll($this->format[$format]);
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Count query return row after statement's execution
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $format
	 * @return int
	 */
	public function count(string $query, array $parameter = [], string $format = 'object')
	{
		$statement = $this->conn->prepare($query);
		$statement->execute($parameter);
		$data = $statement->rowCount($this->format[$format]);
		$this->lid = $this->conn->lastInsertId();
		$statement->closeCursor();
		return $data;
	}


	/**
	 * Return after insertion the last inserted row id
	 *
	 * @access public
	 * @param string $query
	 * @param array $parameter
	 * @param string $format
	 * @return int
	 */
	public function lastInsertId():int
	{
		$lastInsertId = $this->lastInsertId;
		$this->lastInsertId = 0;
		return $lastInsertId;
	}


	/**
	 * Correct data format 
	 *
	 * @access public
	 * @param string $format
	 * @return mixed
	 */
	public function getDataFormat(string $format)
	{
		if ( in_array($format, $this->allowDataFormat) ) {
			return $format;
		} else {
			return '';
		}
	}


}