<?php

namespace Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use BlobStorage\Models\Blob;

class BlobTest extends TestCase
{
    protected function setUp(): void
    {
        // Load env
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        // Create REST blob service
        $this->blob = new Blob($_ENV["CONNECTION_STRING"]);
    }

    # connection storage
    public function testConnectBlobStorage()
    {
        $this->assertInstanceOf(Blob::class, $this->blob);
    }

    # set container
    public function testSetContainer()
    {
        try {
            $container = 'development';
            $this->blob->setContainer($container);
            $this->assertEquals($container, $this->blob->getContainer());
        } catch (Exception $e) {
            echo "Error Code: " . $e->getCode() . " : " . $e->getMessage() . PHP_EOL;
            throw $e;
        }
    }

    # create new blob @return blob url endpoint
    public function testCreateBlobAndGetUrlEnpoint()
    {
        try {
            $this->blob->setContainer('development');
            $this->blob->setBlobName('test.jpg');
            $this->blob->setContent(__DIR__ . '/test.jpg');
            $newBlob = $this->blob->new();
            $url = $this->blob->getUrl();
            $this->assertEquals(200,  $newBlob->code);
            $this->assertEquals(200,  $url->code);
        } catch (Exception $e) {
            echo "Error code: " . $e->getCode() . " : " . $e->getMessage() . PHP_EOL;
            throw $e;
        }
    }
    # show blob
    public function testShowBlob()
    {
        try {
            $this->blob->setContainer('development');
            $this->blob->setBlobName('test.jpg');
            $blob = $this->blob->show();
            $this->assertNotEmpty($blob);
            $this->assertEquals(200, $blob->code);
        } catch (Exception $e) {
            echo "error code: " . $e->getCode() . " : " . $e->getMessage() . PHP_EOL;
            throw $e;
        }
    }
    # update blob
    # delete blob
    public function testDeletBlob()
    {
        try {
            $this->blob->setContainer('development');
            $this->blob->setBlobName('test.jpg');
            $blob = $this->blob->delete();
            $this->assertEquals(200, $blob->code);
        } catch (Exception $e) {
            echo "error code: " . $e->getCode() . " : " . $e->getMessage() . PHP_EOL;
            throw $e;
        }
    }
}
