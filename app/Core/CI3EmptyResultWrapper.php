<?php

namespace App\Core;

use IteratorAggregate;
use Countable;
use Traversable;
use ArrayIterator;

#[\AllowDynamicProperties]
class CI3EmptyResultWrapper implements IteratorAggregate, Countable
{
    public function result(string $type = 'object'): array
    {
        return [];
    }

    public function result_array(): array
    {
        return [];
    }

    public function row(int $n = 0, string $type = 'object')
    {
        return null;
    }

    public function row_array(int $n = 0)
    {
        return [];
    }

    public function num_rows(): int
    {
        return 0;
    }

    public function getResult(string $type = 'object'): array
    {
        return [];
    }

    public function getResultArray(): array
    {
        return [];
    }

    public function getRow(int $n = 0, string $type = 'object')
    {
        return null;
    }

    public function getRowArray(int $n = 0)
    {
        return [];
    }

    public function getNumRows(): int
    {
        return 0;
    }

    public function free_result(): void
    {
    }

    public function list_fields(): array
    {
        return [];
    }

    public function field_data(): array
    {
        return [];
    }

    public function first_row(string $type = 'object')
    {
        return null;
    }

    public function last_row(string $type = 'object')
    {
        return null;
    }

    public function next_row(string $type = 'object')
    {
        return null;
    }

    public function previous_row(string $type = 'object')
    {
        return null;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator([]);
    }

    public function count(): int
    {
        return 0;
    }

    public function __call(string $name, array $arguments)
    {
        return null;
    }

    public function __get(string $name)
    {
        return null;
    }
}
