<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Wurfl {
	
	var $wurflManagerFactory;
	var $wurflManager;
	var $wurflConfig;
	var $device;
	var $id;
	var $fallBack;
	
	// Variables
	private $persistenceDir = '';
	private $cacheDir = '';
	private $wurflDir = '';
	private $resourcesDir = '';
	private $wurflName = '';
	private $wurflPatchName = '';
	
	function __construct() {
		// Declare some config variables
		// Config Options
		$this->persistenceDir = BASEPATH."WURFL/resources/storage/persistence";
		$this->cacheDir = BASEPATH."WURFL/resources/storage/cache";
		$this->wurflDir = BASEPATH."WURFL/";
		$this->resourcesDir = BASEPATH."WURFL/resources/";
		$this->wurflName = "wurfl.zip";
		$this->wurflPatchName = "patch.xml";
		
		// Include the application file
		if (is_file($this->wurflDir . 'Application.php')){
			require_once $this->wurflDir . 'Application.php';
			
			// Load config
			$this->wurflConfig = new WURFL_Configuration_InMemoryConfig ();
			$this->wurflConfig
			        ->wurflFile($this->resourcesDir . $this->wurflName)
			        ->wurflPatch($this->resourcesDir . $this->wurflPatchName)
			        ->persistence("file",array(
			                                WURFL_Configuration_Config::DIR => $this->persistenceDir))
			        ->cache("file", array(
			                            WURFL_Configuration_Config::DIR => $this->cacheDir,
			                            WURFL_Configuration_Config::EXPIRATION => 36000));
			
			// Load WURFL
			$this->wurflManagerFactory = new WURFL_WURFLManagerFactory($this->wurflConfig);
			$this->wurflManager = $this->wurflManagerFactory->create(true);
		}
	}
	
	function load($device = ""){
		if (is_array($device)){
			$this->device = $this->wurflManager->getDeviceForHttpRequest($device);
		} else {
			$this->device = $this->wurflManager->getDeviceForUserAgent($device);
		}

		if (!empty($this->device)){
			$this->id = $this->device->id;
			$this->fallBack = $this->device->fallBack;
		} else {
			return false;
		}
	}

	function getDevice(){
		return $this->device;
	}

	function getCapability($capabilityName = ""){
		return $this->device->getCapability($capabilityName);
	}

	function getAllCapabilities(){
		return $this->device->getAllCapabilities();
	}

	function getId(){
		return $this->id;
	}

	function getFallback(){
		return $this->fallback;
	}

}