<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

/**
 * @package    Plugins/Filemanager
 */

class Model_FileSystem_Directory extends DirectoryIterator {
	
	/**
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function createFolder($name)
	{
		$folder_path = $this->getPath() . DIRECTORY_SEPARATOR . $name;
		if ( ! is_dir($folder_path))
		{
			return mkdir($folder_path);
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * 
	 * @return boolean
	 */
	public function delete()
	{
		$dirHandle = opendir($this->getRealPath());
			
		while (FALSE !== ($file = readdir($dirHandle))) 
		{
			if ($file != '.' AND $file != '..')
			{
				$tmpPath = $this->getRealPath() . DIRECTORY_SEPARATOR . $file;
				chmod($tmpPath, 0777);

				Model_FileSystem::factory($tmpPath)->delete();
			}
		}

		closedir($dirHandle);

		if (file_exists($this->getRealPath()))
		{
			return rmdir($this->getRealPath());
		}
		
		return FALSE;
	}
	
	/**
	 * 
	 * @return Model_FileSystem
	 */
	public function getParent()
	{
		$path = $this->getRealPath();
		$parent_path = (!empty($path) ? substr($path, 0, strrpos($path, DIRECTORY_SEPARATOR)): '');
		return Model_FileSystem::factory($parent_path);
	}
}