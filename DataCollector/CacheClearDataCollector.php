<?php
namespace CacheClearToolbar\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class CacheClearDataCollector
 * @package CacheClearToolbar\DataCollector
 */
class CacheClearDataCollector extends DataCollector
{

	/**
	 * Collect Git data for DebugBar (branch,commit,author,email,merge,date,message)
	 *
	 * @param Request $request
	 * @param Response $response
	 * @param \Exception $exception
	 */
	public function collect(Request $request, Response $response, \Exception $exception = null)
	{
		$this->data['currentRoute'] = $request->get('_route');
	}

	/**
	 * DataCollector name : used by service declaration into container.yml
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'datacollector_cache_clear';
	}

	public function getCurrentRoute() {
		return $this->data['currentRoute'];
	}

	/**
	 * change the icon color depending on the kernel version
	 *
	 * #3f3f3f < 2.8
	 * #AAAAAA >= 2.8
	 *
	 * @return string
	 */
	final public function getIconColor()
	{
		if ((float) $this->getSymfonyVersion() >= 2.8) {
			return $this->data['iconColor'] = '#AAAAAA';
		}
		return $this->data['iconColor'] = '#3F3F3F';
	}

	/**
	 * @return string
	 */
	private function getSymfonyVersion()
	{
		$symfonyVersion = \Symfony\Component\HttpKernel\Kernel::VERSION;
		$symfonyVersion = explode('.', $symfonyVersion, -1);
		$symfonyMajorMinorVersion = implode('.', $symfonyVersion);
		return $symfonyMajorMinorVersion;
	}
}
