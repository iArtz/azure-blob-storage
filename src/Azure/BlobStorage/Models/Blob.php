<?php

namespace Azure\BlobStorage\Modal;

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\ServiceException;
use Azure\BlobStorage\Interfaces\IBlob;
use Azure\BlobStorage\Interfaces\IBlobAttrs;

class Blob extends IBlobAttrs implements IBlob
{
    public function __construct(string $connectionString)
    {
        $this->connectionString = $connectionString;
        // Create blob client.
        $blobClient = BlobRestProxy::createBlobService($this->connectionString);
    }

    public function getConnection()
    {
        return $this->connectionStatus;
    }

    public function new()
    {
        return 'Create new blob on storage';
    }

    public function show()
    {
        return 'Show blob';
    }

    public function update()
    {
        return 'Update blob';
    }

    public function delete()
    {
        return 'Delete blob';
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
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
