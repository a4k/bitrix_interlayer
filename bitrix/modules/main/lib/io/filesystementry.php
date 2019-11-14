<?php
namespace Bitrix\Main\IO;

abstract class FileSystemEntry
{
	protected $path;
	protected $originalPath;
	protected $pathPhysical;
	protected $siteId;

	public function __construct($path, $siteId = null)
	{
		if ($path == '')
			throw new InvalidPathException($path);

		$this->originalPath = $path;
		$this->path = Path::normalize($path);
		$this->siteId = $siteId;

		if ($this->path == '')
			throw new InvalidPathException($path);
	}

	public function getName()
	{
		return Path::getName($this->path);
	}

	public function getDirectoryName()
	{
		return Path::getDirectory($this->path);
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getDirectory()
	{
		return new Directory($this->getDirectoryName());
	}

	abstract public function getCreationTime();
	abstract public function getLastAccessTime();
	abstract public function getModificationTime();

	abstract public function isExists();

	public abstract function isDirectory();
	public abstract function isFile();
	public abstract function isLink();

	public abstract function markWritable();
	public abstract function getPermissions();
	public abstract function delete();

	public function getPhysicalPath()
	{
		if (is_null($this->pathPhysical))
			$this->pathPhysical = Path::convertLogicalToPhysical($this->path);

		return $this->pathPhysical;
	}
}
