<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2012 Bitrix
 */
namespace Bitrix\Main;

use Bitrix\Main\Engine\Binder;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Engine\Router;
use Bitrix\Main\UI\PageNavigation;

/**
 * Http application extends application. Contains http specific methods.
 */
class HttpApplication extends Application
{
	/**
	 * Creates new instance of http application.
	 */
	protected function __construct()
	{
		parent::__construct();
	}

	/**
	 * Initializes context of the current request.
	 *
	 * @param array $params Request parameters
	 */
	protected function initializeContext(array $params)
	{
	}

	public function createExceptionHandlerOutput()
	{
		return null;
	}

	/**
	 * Starts request execution. Should be called after initialize.
	 */
	public function start()
	{
		//register_shutdown_function(array($this, "finish"));
	}

	/**
	 * Finishes request execution.
	 * It is registered in start() and called automatically on script shutdown.
	 */
	public function finish()
	{
		//$this->managedCache->finalize();
	}

	private function getSourceParametersList()
	{
	}

	/**
	 * Runs controller and its action and sends response to the output.
	 *
	 * @return void
	 * @throws SystemException
	 */
	public function run()
	{
	}

	private function registerAutoWirings()
	{
	}

	/**
	 * Builds a response by result's action.
	 * If an action returns non subclass of HttpResponse then the method tries to create Response\StandardJson.
	 *
	 * @param mixed $actionResult
	 * @param Error[] $errors
	 * @return HttpResponse
	 */
	private function buildResponse($actionResult, $errors)
	{
	}
}
