<?php
/**
 * PSR-0 Autoloader for classes
 * @author Sujeet <sujeetkv90@gmail.com>
 * https://github.com/sujeet-kumar/psr-autoloader
 */

class Autoloader
{
	const DS = DIRECTORY_SEPARATOR;
	
	protected static $base_include_path = '';
	protected static $loaded_files = array();
	
	protected static $ns_separator = '\\';
	protected static $file_ext = '.php';
	protected static $strict_mode = true;
	
	/**
	 * Register the autoloader
	 * @param	string $base_include_path
	 * @param	bool $strict_mode
	 * @param	string $file_ext
	 * @param	string $ns_separator
	 */
	public static function register($base_include_path, $strict_mode = true, $file_ext = '', $ns_separator = ''){
		self::$base_include_path = rtrim($base_include_path, self::DS);
		empty($file_ext) or self::$file_ext = $file_ext;
		empty($ns_separator) or self::$ns_separator = $ns_separator;
		self::$strict_mode = (bool) $strict_mode;
		
		spl_autoload_register(array(get_class(), 'loadClass'));
	}
	
	/**
	 * Unregister the autoloader
	 */
	public static function unregister(){
		spl_autoload_unregister(array(get_class(), 'loadClass'));
	}
	
	/**
	 * Get namespace separator
	 */
	public static function namespaceSeparator(){
		return self::$ns_separator;
	}
	
	/**
	 * Get file extension
	 */
	public static function fileExtension(){
		return self::$file_ext;
	}
	
	/**
	 * Get loaded files list
	 */
	public static function loadedFiles(){
		return self::$loaded_files;
	}
	
	/**
	 * Load required class
	 * @param	string $class_name
	 */
	public static function loadClass($class_name){
		$file_name = '';
		$namespace = '';
		
		if(false !== ($lastNsPos = strripos($class_name, self::$ns_separator))){
			$namespace = substr($class_name, 0, $lastNsPos);
			$class_name = substr($class_name, $lastNsPos + 1);
			$file_name = str_replace('\\', self::DS, $namespace) . self::DS;
		}
		
		$file_name .= str_replace('_', self::DS, $class_name) . self::$file_ext;
		$full_file_name = self::$base_include_path . self::DS . $file_name;
		
		if(file_exists($full_file_name)){
			self::$loaded_files[] = $full_file_name;
			require $full_file_name;
		}elseif(self::$strict_mode){
			throw new Autoloader_Exception('Class "'.$class_name.'" not found.');
		}
	}
	
	/* workaround for Autoloader class consistency */
	protected function __construct(){} /* prevents class instantiation */
	protected function __clone(){} /* prevents object cloning */
	protected function __sleep(){} /* prevent object serialization */
	protected function __wakeup(){} /* prevent object unserialization */
}

/* Autoloader exception class */
class Autoloader_Exception extends Exception{}

/* End of file Autoloader.php */