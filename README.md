# azure-blob-storage

Azure blob storage helper CRUD

## Installation

This project using composer.

`$ composer require iartz/azure-blob-storage`

## Usage

Conection upload list and delete blob on blob storage

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
