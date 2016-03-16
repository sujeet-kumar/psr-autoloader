<?php
namespace SuperNs\Base\NamespaceTwo;

use SuperNs\Base\ThirdPartyNS\Helper;

class BaseNsClassTwo
{
	public function showClass(){
		echo 'BaseNsClassTwo ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'BaseNsClassTwo_st ' . Helper::getImo();
	}
}