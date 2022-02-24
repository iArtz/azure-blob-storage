<?php

namespace BlobStorage\Models;

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use BlobStorage\Internal\BlobAttrs;
use BlobStorage\Internal\IBlob;

class Blob extends BlobAttrs implements IBlob
{
    public function __construct(string $connectionString)
    {
        $this->connectionString = $connectionString;
        // Create blob client.
        $this->blobClient = BlobRestProxy::createBlobService($this->connectionString);
    }

    public function getConnection()
    {
        return $this->connectionStatus;
    }

    public function new()
    {
        if (empty($this->content)) return false;
        if (empty($this->blob_name)) return false;
        if (empty($this->container)) return false;

        try {
            $this->blobClient->createBlockBlob($this->container, $this->blob_name, $this->content);
            $this->code = 200;
            $this->message = 'Create new blob ' . $this->blob_name . ' on storage';
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . PHP_EOL;
            $this->code = $code;
            $this->message = $error_message;
        }

        return (object) [
            'message' => $this->message,
            'code' => $this->code,
            'url' => $this->getUrl(),
        ];
    }

    public function show()
    {
        try {
            $this->blobClient->getBlob($this->container, $this->blob_name);
            $this->code = 200;
            $this->message = 'Show blob ' . $this->blob_name;
        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            $this->code = $code;
            $this->message = $error_message;
        }
        return (object) [
            'message' => $this->message,
            'code' => $this->code,
        ];
    }

    public function update()
    {
        // Implement late on
        return 'Update blob';
    }

    public function delete()
    {
        try {
            $this->blobClient->deleteBlob($this->container, $this->blob_name);
            $this->code = 200;
            $this->message = "Delete blob " . $this->blob_name;
        } catch (ServiceException $e) {
            $this->code = $e->getCode();
            $this->message = $e->getMessage();
        }
        return (object)[
            "code" => $this->code,
            "message" => $this->message,
        ];
    }

    public function setContainer(string $container): void
    {
        $this->container = $container;
    }

    public function getContainer(): string
    {
        return $this->container;
    }

    public function setContent($content)
    {
        if (file_exists($content)) {
            $this->content = fopen($content, 'r');
            return true;
        }
        return false;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUrl()
    {
        try {
            $blob = $this->blobClient->getBlobUrl($this->container, $this->blob_name);
            $this->code = 200;
            $this->message = 'Done';
            $this->data = $blob;
        } catch (ServiceException $e) {
            $this->code = $e->getCode();
            $this->message = $e->getMessage();
        }
        return (object) [
            "code" => $this->code,
            "message" => $this->message,
            "data" => $this->data,
        ];
    }

    public function setBlobName($blob_name)
    {
        $this->blob_name = $blob_name;
        return true;
    }

    public function getBlobName()
    {
        return $this->blob_name;
    }
}
