<?php

namespace Azure\BlobStorage\Interfaces;

interface IBlob
{
    public function new();
    public function show();
    public function update();
    public function delete();
}

abstract class IBlobAttrs
{
    protected $content;
    protected $container;
    protected $connectString;
    protected $key;
}
