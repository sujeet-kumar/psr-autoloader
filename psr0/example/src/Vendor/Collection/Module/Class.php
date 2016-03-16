<?php
class Vendor_Collection_Module_Class
{
	public function showClass(){
		echo 'Vendor_Collection_Module_Class ' . self::getImo();
	}
	
	public static function showClassSt(){
		echo 'Vendor_Collection_Module_Class_st ' . self::getImo();
	}
	
	public static function getImo(){
		return '(^_^)';
	}
}