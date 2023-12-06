<?php

namespace App\Contracts;

interface DownloadableDocument
{
    public function getTemplate(): string;

    public function getTemplateValues(): array;

    public function getFilename(): string;
}