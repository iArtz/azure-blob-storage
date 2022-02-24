<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Azure\BlobStorage\Modal\Blob;

class BlobTest extends TestCase
{
    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
    }
    public function testCanConnectToStorage()
    {
        $blob = new Blob(getenv("ACCOUNT_CONNECTION_STRING"));
        var_dump($blob);
        $this->assertTrue($blob->getConnection());
    }
}
# Test cases

## connection storage
## set container
## create new blob @return blob url endpoint
## show blob
## update blob
## delete blob