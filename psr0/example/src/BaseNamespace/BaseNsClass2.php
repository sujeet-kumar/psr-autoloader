<?php
namespace BaseNamespace;

use ThirdPartyNS\Helper;

class BaseNsClass2
{
	public function showClass(){
		echo 'BaseNsClass2 ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'BaseNsClass2_st ' . Helper::getImo();
	}
}