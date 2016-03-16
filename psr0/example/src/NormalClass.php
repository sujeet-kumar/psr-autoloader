<?php
class NormalClass
{
	public function showClass(){
		echo 'NormalClass ' . self::getImo();
	}
	
	public static function showClassSt(){
		echo 'NormalClass_st ' . self::getImo();
	}
	
	public static function getImo(){
		return '(^_^)';
	}
}