<?php
/**
 * PSR-4 Autoloader for namespaced classes
 * Also supports explicit class mapping.
 *
 * @author Sujeet <sujeetkv90@gmail.com>
 * https://github.com/sujeet-kumar/psr-autoloader
 */

class Autoloader
{
	const DS = DIRECTORY_SEPARATOR;
	
	protected $ns_separator = '\\';
	protected $file_ext = '.php';
	
	protected $ns_prefixes = array();
	protected $class_map = array();
	
	protected $loaded_files = array();
	
	protected $strict_mode = true;
	
	/**
	 * Initialize the autoloader
	 * @param	bool $strict_mode
	 * @param	string $file_ext
	 * @param	string $ns_separator
	 */
	public function __construct($strict_mode = true, $file_ext = '', $ns_separator = ''){
		empty($file_ext) or $this->file_ext = $file_ext;
		empty($ns_separator) or $this->ns_separator = $ns_separator;
		$this->strict_mode = (bool) $strict_mode;
	}
	
	/**
	 * Register the autoloader
	 * @param	bool $prepend
	 */
	public function register($prepend = false){
		spl_autoload_register(array($this, 'loadClass'), true, $prepend);
	}
	
	/**
	 * Unregister the autoloader
	 */
	public function unregister(){
		spl_autoload_unregister(array($this, 'loadClass'));
	}
	
	/**
	 * Add base namespace and mapped directory path
	 * @param	string $ns_prefix
	 * @param	string $base_dir
	 * @param	bool $prepend
	 */
	public function addNamespace($ns_prefix, $base_dir, $prepend = false){
		$ns_prefix = trim($ns_prefix, $this->ns_separator) . $this->ns_separator;
		
		$base_dir = rtrim($base_dir, self::DS) . self::DS;
		
        if(! isset($this->ns_prefixes[$ns_prefix])){
			$this->ns_prefixes[$ns_prefix] = array();
		}
		
		if($prepend){
			array_unshift($this->ns_prefixes[$ns_prefix], $base_dir);
		}else{
			array_push($this->ns_prefixes[$ns_prefix], $base_dir);
		}
    }
	
	/**
	 * Add class map
	 * @param	array $class_map
	 */
	public function addClassMap(array $class_map){
		$this->class_map = empty($this->class_map) ? $class_map : array_merge($this->class_map, $class_map);
	}
	
	/**
	 * Load required class
	 * @param	string $class
	 */
	public function loadClass($class){
		$prefix = $class;
		$load_success = false;
		
		if(isset($this->class_map[$class])){
			if($this->requireFile($this->class_map[$class])){
				$this->loaded_files[] = $this->class_map[$class];
				$load_success = true;
			}
		}else{
			while(false !== $pos = strrpos($prefix, $this->ns_separator)){
				$prefix = substr($class, 0, $pos + 1);
				
				$relative_class = substr($class, $pos + 1);
				
				$mapped_file = $this->loadRelativeFile($prefix, $relative_class);
				
				if($mapped_file){
					$this->loaded_files[] = $mapped_file;
					$load_success = true;
					break;
				}
				
				$prefix = rtrim($prefix, $this->ns_separator);
			}
		}
		
		if($load_success === false and $this->strict_mode === true){
			throw new Autoloader_Exception('Class "'.$class.'" not found.');
		}
		return $load_success;
	}
	
	/**
	 * Get namespace separator
	 */
	public function namespaceSeparator(){
		return $this->ns_separator;
	}
	
	/**
	 * Get file extension
	 */
	public function fileExtension(){
		return $this->file_ext;
	}
	
	/**
	 * Get loaded files list
	 */
	public function loadedFiles(){
		return $this->loaded_files;
	}
	
	protected function loadRelativeFile($prefix, $relative_class){
		if(isset($this->ns_prefixes[$prefix]) === false){
			return false;
		}
		
		foreach($this->ns_prefixes[$prefix] as $base_dir){
			$file = $base_dir . str_replace($this->ns_separator, self::DS, $relative_class) . $this->file_ext;
			
			if($this->requireFile($file)){
				return $file;
			}
		}
		
		return false;
	}
	
	protected function requireFile($file){
		if(file_exists($file)){
			require $file;
			return true;
		}
		return false;
	}
}

/* Autoloader exception class */
class Autoloader_Exception extends Exception{}

/* End of file Autoloader.php */