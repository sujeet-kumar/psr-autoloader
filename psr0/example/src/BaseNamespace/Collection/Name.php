<?php
namespace BaseNamespace;

use ThirdPartyNS\Helper;

class Collection_Name
{
	public function showClass(){
		echo 'Collection_Name ' . Helper::getImo();
	}
	
	public static function showClassSt(){
		echo 'Collection_Name_st ' . Helper::getImo();
	}
}