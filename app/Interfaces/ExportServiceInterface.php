<?php

namespace App\Interfaces;

interface ExportServiceInterface
{
    public function export(string $exportType, string $fileName, array $config);
}
