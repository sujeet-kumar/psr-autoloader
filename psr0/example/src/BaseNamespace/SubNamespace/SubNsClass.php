<?php
namespace BaseNamespace\SubNamespace;

use ThirdPartyNS\Helper;

class SubNsClass
{
	public function showClass(){
		echo 'SubNsClass ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'SubNsClass_st ' . Helper::getImo();
	}
}