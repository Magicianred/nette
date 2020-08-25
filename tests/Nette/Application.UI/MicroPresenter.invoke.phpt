<?php

/**
 * Test: NetteModule\MicroPresenter
 */

use Nette\Application\Request;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$container = id(new Nette\Configurator)->setTempDirectory(TEMP_DIR)->createContainer();

test(function () use ($container) {
	$presenter = new NetteModule\MicroPresenter($container);

	$presenter->run(new Request('Nette:Micro', 'GET', array(
		'callback' => function ($id, $page) {
			Notes::add('Callback id ' . $id . ' page ' . $page);
		},
		'id' => 1,
		'page' => 2,
	)));
	Assert::same(array(
		'Callback id 1 page 2'
	), Notes::fetch());
});
