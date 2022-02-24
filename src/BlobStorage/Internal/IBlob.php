<?php

namespace BlobStorage\Internal;

interface IBlob
{
    public function new();
    public function show();
    public function update();
    public function delete();
}
