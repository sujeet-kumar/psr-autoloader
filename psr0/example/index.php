<?php
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH', rtrim(dirname(__FILE__), DS) . DS);
require_once realpath(BASEPATH . '../Autoloader.php');
//-------------------------------------------------------
Autoloader::register( BASEPATH.'src' );
//-------------------------------------------------------

$obj = new Vendor_Collection_Module_Class();
$obj->showClass(); echo '<br>';

$a = new NormalClass();
$a->showClass(); echo '<br>';

//Autoloader::unregister();

$b = new BaseNamespace\BaseNsClass();
$b->showClass(); echo '<br>';

$c = new BaseNamespace\BaseNsClass2();
$c->showClass(); echo '<br>';

$d = new BaseNamespace\Collection_Name();
$d->showClass(); echo '<br>';

$e = new BaseNamespace\SubNamespace\SubNsClass();
$e->showClass(); echo '<br>';

echo '====================================<br>';

Vendor_Collection_Module_Class::showClassSt(); echo '<br>';

NormalClass::showClassSt(); echo '<br>';

BaseNamespace\BaseNsClass::showClassSt(); echo '<br>';

BaseNamespace\BaseNsClass2::showClassSt(); echo '<br>';

BaseNamespace\Collection_Name::showClassSt(); echo '<br>';

BaseNamespace\SubNamespace\SubNsClass::showClassSt(); echo '<br>';

echo '<pre>';
print_r(Autoloader::loadedFiles());
echo '</pre>';