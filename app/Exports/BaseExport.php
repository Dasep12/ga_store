<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

abstract class BaseExport implements FromCollection, WithHeadings, WithMapping
{
    protected $model;
    protected $columns;
    protected $headings;

    public function __construct()
    {
        $this->initialize();
    }

    abstract protected function initialize();

    public function collection()
    {
        return $this->model::get();
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function map($row): array
    {
        $result = [];
        foreach ($this->columns as $column) {
            $result[] = $row->{$column};
        }
        return $result;
    }

    protected function setModel(string $modelClass)
    {
        if (!class_exists($modelClass)) {
            throw new \Exception("Model class {$modelClass} not found");
        }
        $this->model = $modelClass;
    }

    protected function setColumns(array $columns)
    {
        $this->columns = $columns;
    }

    protected function setHeadings(array $headings)
    {
        $this->headings = $headings;
    }
}
