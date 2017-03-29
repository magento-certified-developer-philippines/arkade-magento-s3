<?php

class Arkade_S3_Model_Core_File_Storage_Directory_Database extends Mage_Core_Model_File_Storage_Directory_Database
{
	private $helper = null;

	/**
	 * Return subdirectories
	 *
	 * @param string $directory
	 * @return array
	 */
	public function getSubdirectories($directory)
	{
		$directory = Mage::helper('core/file_storage_database')->getMediaRelativePath($directory);

		try {
			return $this->_getResource()->getSubdirectories($directory);
		} catch (Exception $e) {
			return [];
		}
	}

	/**
	 * Create directories recursively
	 *
	 * @param  string $path
	 * @return Arkade_S3_Model_Core_File_Storage_Directory_Database
	 */
	public function createRecursive($path)
	{
		$path = str_replace('//', '/', $path);

		$this->getHelper()->getClient()->putObject($this->getHelper()->getObjectKey($path), array(), array(
			'Content-Type' => "application/x-directory"
		));
		return $this;
	}

	/**
	 * delete directories recursively
	 *
	 * @param  string $path
	 * @return Arkade_S3_Model_Core_File_Storage_Directory_Database
	 */
	public function deleteDirectory($path)
	{
		$relativePath = Mage::helper('core/file_storage_database')->getMediaRelativePath($path);
		Mage::getResourceModel('arkade_s3/core_file_storage_s3')->deleteFolder($relativePath);
		return $this;
	}

	/**
	 * @return Arkade_S3_Helper_Data
	 */
	protected function getHelper()
	{
		if (is_null($this->helper)) {
			$this->helper = Mage::helper('arkade_s3');
		}
		return $this->helper;
	}
}
