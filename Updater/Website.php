<?php
/**
 * Class Website
 * Simple container class for a website on my server
 */
class Website {
	/** @var string The display name for the site */
	private $name;
	/** @var string The file path to the site */
	private $folderName;
	public function __construct($name, $folderName) {
		$this->folderName = $folderName;
		$this->name = $name;
	}
	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	/**
	 * @return string
	 */
	public function getFolderName() {
		return $this->folderName;
	}
	/**
	 * @param string $folderName
	 */
	public function setFolderName($folderName) {
		$this->folderName = $folderName;
	}
	/**
	 * Updates the given website and returns the command line result
	 * @return string
	 * @throws Exception Thrown if directory does not exist
	 */
	public function update() {
		$fullDirectory = "C:/wamp/www/uoreplay.com/login" . $this->folderName;
		if (!file_exists($fullDirectory))
			throw new Exception("No site found");
		echo chdir($fullDirectory);
		return shell_exec("C:/Program Files (x86)/Git/bin/git.exe pull");
	}
}