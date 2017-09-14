<?php

use App\Tracker\Answers\Builder;
use App\Tracker\Answers\ContentMapLoader;
use App\Tracker\Answers\SheetsJsonFeedBuilder;

require 'vendor/autoload.php';

$builder = new SheetsJsonFeedBuilder();
$builder->setSheetId('1veKJ6xSapEzxJ2nOqGrsMplWHMSt_KSvunGE-uii43s');
$builder->updateJsonFile(__DIR__ . '/storage/content.en.json');

die();