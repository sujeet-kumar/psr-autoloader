<?php
namespace SuperNs\Base\NamespaceTwo;

use SuperNs\Base\ThirdPartyNS\Helper;

class BaseNsClass2Two
{
	public function showClass(){
		echo 'BaseNsClass2Two ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'BaseNsClass2Two_st ' . Helper::getImo();
	}
}