<?php
namespace Bitrix\Main;

class ModuleManager
{
	protected static $installedModules = array();

	public static function getInstalledModules()
	{
		if (empty(self::$installedModules))
		{
			if (empty(self::$installedModules))
			{
				self::$installedModules = array();
				$con = Application::getConnection();
				$rs = $con->query("SELECT ID FROM b_module ORDER BY ID");
				while ($ar = $rs->fetch())
					self::$installedModules[$ar['ID']] = $ar;
			}
		}

		return self::$installedModules;
	}

	public static function getVersion($moduleName)
	{
		$moduleName = preg_replace("/[^a-zA-Z0-9_.]+/i", "", trim($moduleName));
		if ($moduleName == '')
			return false;

		if (!self::isModuleInstalled($moduleName))
			return false;

		if ($moduleName == 'main')
		{
			$version = SM_VERSION;
		}
		else
		{
			$modulePath = getLocalPath("modules/".$moduleName."/install/version.php");
			if ($modulePath === false)
				return false;

			$arModuleVersion = array();
			include($_SERVER["DOCUMENT_ROOT"].$modulePath);
			$version = (array_key_exists("VERSION", $arModuleVersion)? $arModuleVersion["VERSION"] : false);
		}

		return $version;
	}

	public static function isModuleInstalled($moduleName)
	{
		$arInstalledModules = self::getInstalledModules();
		return isset($arInstalledModules[$moduleName]);
	}

	public static function delete($moduleName)
	{
		$con = Application::getConnection();
		$con->queryExecute("DELETE FROM b_module WHERE ID = '".$con->getSqlHelper()->forSql($moduleName)."'");

		self::$installedModules = array();
		Loader::clearModuleCache($moduleName);

		$cacheManager = Application::getInstance()->getManagedCache();
		$cacheManager->clean("b_module");
		$cacheManager->clean("b_module_to_module");
	}

	public static function add($moduleName)
	{
		$con = Application::getConnection();
		$con->queryExecute("INSERT INTO b_module(ID) VALUES('".$con->getSqlHelper()->forSql($moduleName)."')");

		self::$installedModules = array();
		Loader::clearModuleCache($moduleName);

		$cacheManager = Application::getInstance()->getManagedCache();
		$cacheManager->clean("b_module");
		$cacheManager->clean("b_module_to_module");
	}

	public static function registerModule($moduleName)
	{
		static::add($moduleName);

	}

	public static function unRegisterModule($moduleName)
	{
		$con = Application::getInstance()->getConnection();

		$con->queryExecute("DELETE FROM b_agent WHERE MODULE_ID='".$con->getSqlHelper()->forSql($moduleName)."'");
		\CMain::DelGroupRight($moduleName);

		static::delete($moduleName);

	}
}
