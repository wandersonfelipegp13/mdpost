<?php

require __DIR__ . '/vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

// Define your configuration, if needed
$config = [];

// Configure the Environment with all the CommonMark parsers/renderers
$environment = new Environment($config);
$environment->addExtension(new CommonMarkCoreExtension());

// Add this extension
$environment->addExtension(new TableExtension());

// Instantiate the converter engine and start converting some Markdown!
$converter = new MarkdownConverter($environment);

// sola
$markdown = file_get_contents('markdownit.md');

echo $converter->convertToHtml($markdown);
