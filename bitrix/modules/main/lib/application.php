<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2012 Bitrix
 */
namespace Bitrix\Main;

use Bitrix\Main\Data;
use Bitrix\Main\Diag;
use Bitrix\Main\IO;

/**
 * Base class for any application.
 */
abstract class Application
{
	/**
	 * @var Application
	 */
	protected static $instance = null;

	protected $isBasicKernelInitialized = false;
	protected $isExtendedKernelInitialized = false;

	/**
	 * Execution context.
	 *
	 * @var Context
	 */
	protected $context;

	/**
	 * Pool of database connections.
	 *
	 * @var Data\ConnectionPool
	 */
	protected $connectionPool;

	/**
	 * Managed cache instance.
	 *
	 * @var \Bitrix\Main\Data\ManagedCache
	 */
	protected $managedCache;

	/**
	 * Tagged cache instance.
	 *
	 * @var \Bitrix\Main\Data\TaggedCache
	 */
	protected $taggedCache;

	/**
	 * LRU cache instance.
	 *
	 * @var \Bitrix\Main\Data\LruCache
	 */
	protected $lruCache;

	/**
	 * @var \Bitrix\Main\Diag\ExceptionHandler
	 */
	protected $exceptionHandler = null;

	/**
	 * @var Dispatcher
	 */
	private $dispatcher = null;

	/**
	 * Creates new application instance.
	 */
	protected function __construct()
	{

	}

	/**
	 * Returns current instance of the Application.
	 *
	 * @return Application
	 * @throws SystemException
	 */
	public static function getInstance()
	{
		if (!isset(static::$instance))
			static::$instance = new static();

		return static::$instance;
	}

	/**
	 * Does minimally possible kernel initialization
	 *
	 * @throws SystemException
	 */
	public function initializeBasicKernel()
	{
		if ($this->isBasicKernelInitialized)
			return;
		$this->isBasicKernelInitialized = true;

		$this->initializeExceptionHandler();
		$this->initializeCache();
		$this->createDatabaseConnection();
	}

	public function initializeBasicT()
	{
		if ($this->isBasicKernelInitialized)
			return;
		$this->isBasicKernelInitialized = true;

		$this->initializeExceptionHandler();
		$this->createDatabaseConnection();
	}

	/**
	 * Does full kernel initialization. Should be called somewhere after initializeBasicKernel()
	 *
	 * @param array $params Parameters of the current request (depends on application type)
	 * @throws SystemException
	 */
	public function initializeExtendedKernel()
	{
		if ($this->isExtendedKernelInitialized)
			return;
		$this->isExtendedKernelInitialized = true;

	}


	/**
	 * Initializes context of the current request.
	 * Should be implemented in subclass.
	 */
	abstract protected function initializeContext(array $params);

	/**
	 * Starts request execution. Should be called after initialize.
	 * Should be implemented in subclass.
	 */
	abstract public function start();

	/**
	 * Runs controller and its action and sends response to the output.
	 *
	 * It's a stub method and we can't mark it as abstract because there is compatibility.
	 * @return void
	 */
	public function run()
	{}

	/**
	 * Ends work of application.
	 * Sends response and then terminates execution.
	 * If there is no $response the method will use Context::$response.
	 *
	 * @param int $status
	 * @param Response|null $response
	 *
	 * @return void
	 * @throws SystemException
	 */
	public function end($status = 0, Response $response = null)
	{
		$response = $response?: $this->context->getResponse();
		$response->send();

		$this->terminate($status);
	}

	/**
	 * Terminates application by invoking exit().
	 * It's the right way to finish application @see \CMain::finalActions().
	 *
	 * @param int $status
	 * @return void
	 */
	public function terminate($status = 0)
	{
		/** @noinspection PhpUndefinedClassInspection */
		\CMain::finalActions();
		exit($status);
	}

	protected function initializeExceptionHandler()
	{
		$exceptionHandler = new Diag\ExceptionHandler();

		$exceptionHandling = Config\Configuration::getValue("exception_handling");
		if ($exceptionHandling == null)
			$exceptionHandling = array();

		if (!isset($exceptionHandling["debug"]) || !is_bool($exceptionHandling["debug"]))
			$exceptionHandling["debug"] = false;
		$exceptionHandler->setDebugMode($exceptionHandling["debug"]);

		if (isset($exceptionHandling["handled_errors_types"]) && is_int($exceptionHandling["handled_errors_types"]))
			$exceptionHandler->setHandledErrorsTypes($exceptionHandling["handled_errors_types"]);

		if (isset($exceptionHandling["exception_errors_types"]) && is_int($exceptionHandling["exception_errors_types"]))
			$exceptionHandler->setExceptionErrorsTypes($exceptionHandling["exception_errors_types"]);

		if (isset($exceptionHandling["ignore_silence"]) && is_bool($exceptionHandling["ignore_silence"]))
			$exceptionHandler->setIgnoreSilence($exceptionHandling["ignore_silence"]);

		if (isset($exceptionHandling["assertion_throws_exception"]) && is_bool($exceptionHandling["assertion_throws_exception"]))
			$exceptionHandler->setAssertionThrowsException($exceptionHandling["assertion_throws_exception"]);

		if (isset($exceptionHandling["assertion_error_type"]) && is_int($exceptionHandling["assertion_error_type"]))
			$exceptionHandler->setAssertionErrorType($exceptionHandling["assertion_error_type"]);

		$exceptionHandler->initialize(
			array($this, "createExceptionHandlerOutput"),
			array($this, "createExceptionHandlerLog")
		);

		$this->exceptionHandler = $exceptionHandler;
	}

	public function createExceptionHandlerLog()
	{
		$exceptionHandling = Config\Configuration::getValue("exception_handling");
		if ($exceptionHandling === null || !is_array($exceptionHandling) || !isset($exceptionHandling["log"]) || !is_array($exceptionHandling["log"]))
			return null;

		$options = $exceptionHandling["log"];

		$log = null;

		if (isset($options["class_name"]) && !empty($options["class_name"]))
		{
			if (isset($options["extension"]) && !empty($options["extension"]) && !extension_loaded($options["extension"]))
				return null;

			if (isset($options["required_file"]) && !empty($options["required_file"]) && ($requiredFile = Loader::getLocal($options["required_file"])) !== false)
				require_once($requiredFile);

			$className = $options["class_name"];
			if (!class_exists($className))
				return null;

			$log = new $className();
		}
		elseif (isset($options["settings"]) && is_array($options["settings"]))
		{
			$log = new Diag\FileExceptionHandlerLog();
		}
		else
		{
			return null;
		}

		$log->initialize(
			isset($options["settings"]) && is_array($options["settings"]) ? $options["settings"] : array()
		);

		return $log;
	}

	public function createExceptionHandlerOutput()
	{
		return new Diag\ExceptionHandlerOutput();
	}

	/**
	 * Creates database connection pool.
	 */
	protected function createDatabaseConnection()
	{
		$this->connectionPool = new Data\ConnectionPool();
	}

	protected function initializeCache()
	{
		//TODO: Should be transfered to where GET parameter is defined in future
		//magic parameters: show cache usage statistics
		$show_cache_stat = "";
		if (isset($_GET["show_cache_stat"]))
		{
			$show_cache_stat = (strtoupper($_GET["show_cache_stat"]) == "Y" ? "Y" : "");
			@setcookie("show_cache_stat", $show_cache_stat, false, "/");
		}
		elseif (isset($_COOKIE["show_cache_stat"]))
		{
			$show_cache_stat = $_COOKIE["show_cache_stat"];
		}
	}

	/**
	 * @return \Bitrix\Main\Diag\ExceptionHandler
	 */
	public function getExceptionHandler()
	{
		return $this->exceptionHandler;
	}

	/**
	 * Returns database connections pool object.
	 *
	 * @return Data\ConnectionPool
	 */
	public function getConnectionPool()
	{
		return $this->connectionPool;
	}

	/**
	 * Returns context of the current request.
	 *
	 * @return Context
	 */
	public function getContext()
	{
		return $this->context;
	}


	/**
	 * Static method returns database connection for the specified name.
	 * If name is empty - default connection is returned.
	 *
	 * @static
	 * @param string $name Name of database connection. If empty - default connection.
	 * @return DB\Connection
	 */
	public static function getConnection($name = "")
	{
		$pool = Application::getInstance()->getConnectionPool();
		return $pool->getConnection($name);
	}


	/**
	 * Returns manager of the managed cache.
	 *
	 * @return Data\ManagedCache
	 */
	public function getManagedCache()
	{

		return $this->managedCache;
	}

	/**
	 * Returns UF manager.
	 *
	 * @return \CUserTypeManager
	 */
	public static function getUserTypeManager()
	{
		global $USER_FIELD_MANAGER;
		return $USER_FIELD_MANAGER;
	}

	/**
	 * Returns true id server is in utf-8 mode. False - otherwise.
	 *
	 * @return bool
	 */
	public static function isUtfMode()
	{
		static $isUtfMode = null;
		if ($isUtfMode === null)
		{
			$isUtfMode = Config\Configuration::getValue("utf_mode");
			if ($isUtfMode === null)
				$isUtfMode = false;
		}
		return $isUtfMode;
	}

	/**
	 * Returns server document root.
	 *
	 * @return null|string
	 */
	public static function getDocumentRoot()
	{
		static $documentRoot = null;
		if ($documentRoot != null)
			return $documentRoot;

		$context = Application::getInstance()->getContext();
		if ($context != null)
		{
			$server = $context->getServer();
			if ($server != null)
				return $documentRoot = $server->getDocumentRoot();
		}

		return Loader::getDocumentRoot();
	}

	/**
	 * Returns personal root directory (relative to document root)
	 *
	 * @return null|string
	 */
	public static function getPersonalRoot()
	{
		static $personalRoot = null;
		if ($personalRoot != null)
			return $personalRoot;

		$context = Application::getInstance()->getContext();
		if ($context != null)
		{
			$server = $context->getServer();
			if ($server != null)
				return $personalRoot = $server->getPersonalRoot();
		}

		return isset($_SERVER["BX_PERSONAL_ROOT"]) ? $_SERVER["BX_PERSONAL_ROOT"] : "/bitrix";
	}

}
