<?php
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH', rtrim(dirname(__FILE__), DS) . DS);
require_once realpath(BASEPATH . '../Autoloader.php');
//-------------------------------------------------------

$loader = new Autoloader();
$loader->register();

$loader->addNamespace('SuperNs\\Base', BASEPATH.'src');
$loader->addNamespace('SuperNs\\Base', BASEPATH.'src2');
//-------------------------------------------------------

$a = new SuperNs\Base\NamespaceOne\BaseNsClass();
$a->showClass(); echo '<br>';

//$loader->unregister();

$b = new SuperNs\Base\NamespaceOne\BaseNsClass2();
$b->showClass(); echo '<br>';

$c = new SuperNs\Base\NamespaceOne\SubNamespace\SubNsClass();
$c->showClass(); echo '<br>';

$d = new SuperNs\Base\NamespaceTwo\BaseNsClassTwo();
$d->showClass(); echo '<br>';

$e = new SuperNs\Base\NamespaceTwo\BaseNsClass2Two();
$e->showClass(); echo '<br>';

echo '====================================<br>';

SuperNs\Base\NamespaceOne\BaseNsClass::showClassSt(); echo '<br>';

SuperNs\Base\NamespaceOne\BaseNsClass2::showClassSt(); echo '<br>';

SuperNs\Base\NamespaceOne\SubNamespace\SubNsClass::showClassSt(); echo '<br>';

SuperNs\Base\NamespaceTwo\BaseNsClassTwo::showClassSt(); echo '<br>';

SuperNs\Base\NamespaceTwo\BaseNsClass2Two::showClassSt(); echo '<br>';

echo '<pre>';
print_r($loader->loadedFiles());
echo '</pre>';