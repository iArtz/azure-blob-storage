# azure-blob-storage

Azure blob storage helper CRUD

## Installation

This project using composer.

`$ composer require iartz/php-package`

## Usage

Generate random string

```php
<?php

use BlobStorage\Blob;

$blob = new Blob(CONNECTION_STRING);

// Set contaniner
$blob->setContainer(CONTANER);
$blob->setBlobName(BLOB_NAME);
$blob->setContent(PATH_OF_CONTENT);

// Create blob
$blob->new();

// Read blob
$blob->show();

// Update blob
$blob->update();

// Delete blob
$blob->delete();
```
