<?php
namespace SuperNs\Base\NamespaceOne\SubNamespace;

use SuperNs\Base\ThirdPartyNS\Helper;

class SubNsClass
{
	public function showClass(){
		echo 'SubNsClass ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'SubNsClass_st ' . Helper::getImo();
	}
}