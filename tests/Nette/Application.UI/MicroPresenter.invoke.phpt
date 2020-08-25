<?php

/**
 * Test: NetteModule\MicroPresenter
 *
 * @author     Filip Procházka
 */

use Nette\Application\Request,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$container = id(new Nette\Config\Configurator)->setTempDirectory(TEMP_DIR)->createContainer();

$presenter = new NetteModule\MicroPresenter($container);


$presenter->run(new Request('Nette:Micro', 'GET', array(
	'callback' => function($id, $page) {
		Notes::add('Callback id ' . $id . ' page ' . $page);
	},
	'id' => 1,
	'page' => 2,
)));
Assert::same(array(
	'Callback id 1 page 2'
), Notes::fetch());
