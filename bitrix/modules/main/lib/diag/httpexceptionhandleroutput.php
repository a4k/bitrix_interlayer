<?php
namespace Bitrix\Main\Diag;

use Bitrix\Main;


class HttpExceptionHandlerOutput implements IExceptionHandlerOutput
{
	/**
	 * @param \Error|\Exception $exception
	 * @param bool $debug
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentTypeException
	 */
	public function renderExceptionMessage($exception, $debug = false)
	{
		if ($debug)
		{
			echo ExceptionHandlerFormatter::format($exception, true);
		}
		else
		{
		    $context = Main\Application::getInstance();
            if ($context)
                echo GetMessage("eho_render_exception_message");
            else
                echo "A error occurred during execution of this script. You can turn on extended error reporting in .settings.php file.";

        }
	}
}
