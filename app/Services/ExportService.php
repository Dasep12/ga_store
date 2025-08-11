<?php

namespace App\Services;

use App\Interfaces\ExportServiceInterface;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ExportService implements ExportServiceInterface
{
    public function export(string $exportType, string $fileName, array $config)
    {
        return match ($exportType) {
            'query' => $this->exportFromQuery($fileName, $config),
            'view' => $this->exportFromView($fileName, $config),
            'collection' => $this->exportFromCollection($fileName, $config),
            default => throw new \Exception("Unsupported export type: {$exportType}"),
        };
    }

    protected function exportFromQuery(string $fileName, array $config)
    {
        $this->validateConfig($config, ['query', 'columns', 'headings']);

        $query = $config['query'];
        $columns = $config['columns'];
        $headings = $config['headings'];

        return Excel::download(new class($query, $columns, $headings) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            private $query;
            private $columns;
            private $headings;

            public function __construct($query, $columns, $headings)
            {
                $this->query = $query;
                $this->columns = $columns;
                $this->headings = $headings;
            }

            public function collection()
            {
                return $this->query->get($this->columns);
            }

            public function headings(): array
            {
                return $this->headings;
            }
        }, $fileName);
    }

    protected function exportFromView(string $fileName, array $config)
    {
        $this->validateConfig($config, ['view', 'data']);

        return Excel::download(new class($config['view'], $config['data']) implements \Maatwebsite\Excel\Concerns\FromView {
            private $view;
            private $data;

            public function __construct($view, $data)
            {
                $this->view = $view;
                $this->data = $data;
            }

            public function view(): \Illuminate\Contracts\View\View
            {
                return view($this->view, $this->data);
            }
        }, $fileName);
    }

    protected function exportFromCollection(string $fileName, array $config)
    {
        $this->validateConfig($config, ['collection', 'headings']);

        return Excel::download(new class($config['collection'], $config['headings']) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            private $collection;
            private $headings;

            public function __construct($collection, $headings)
            {
                $this->collection = $collection;
                $this->headings = $headings;
            }

            public function collection()
            {
                return $this->collection;
            }

            public function headings(): array
            {
                return $this->headings;
            }
        }, $fileName);
    }

    private function validateConfig(array $config, array $requiredKeys)
    {
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new \Exception("Missing config key: {$key}");
            }
        }
    }
}
