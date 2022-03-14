<?php

namespace iArtz\BlobStorage\Internal;

abstract class BlobAttrs
{
    protected $connectString;
    protected $blobClient;
    protected $container;
    protected $blob_name;
    protected $content;
    protected $code;
    protected $message;
    protected $data;
}
