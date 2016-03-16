<?php
namespace SuperNs\Base\NamespaceOne;

use SuperNs\Base\ThirdPartyNS\Helper;

class BaseNsClass
{
	public function showClass(){
		echo 'BaseNsClass ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'BaseNsClass_st ' . Helper::getImo();
	}
}