<?php

require_once '../src/HtmlRenderer.php';

$renderer = new HtmlRenderer();
$data = ['name' => 'John Doe'];
$renderer->render('Template.php', $data);