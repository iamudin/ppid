<?php

namespace App\Core;

use CodeIgniter\Database\BaseResult;
use IteratorAggregate;
use Countable;
use Traversable;
use ArrayIterator;

#[\AllowDynamicProperties]
class CI3ResultWrapper implements IteratorAggregate, Countable
{
    /** @var BaseResult */
    protected $result;

    public function __construct(BaseResult $result)
    {
        $this->result = $result;
    }

    public function result(string $type = 'object'): array
    {
        return $this->result->getResult($type);
    }

    public function result_array(): array
    {
        return $this->result->getResultArray();
    }

    public function row(int $n = 0, string $type = 'object')
    {
        return $this->result->getRow($n, $type);
    }

    public function row_array(int $n = 0)
    {
        return $this->result->getRowArray($n);
    }

    public function num_rows(): int
    {
        return $this->result->getNumRows();
    }

    public function getResult(string $type = 'object'): array
    {
        return $this->result->getResult($type);
    }

    public function getResultArray(): array
    {
        return $this->result->getResultArray();
    }

    public function getRow(int $n = 0, string $type = 'object')
    {
        return $this->result->getRow($n, $type);
    }

    public function getRowArray(int $n = 0)
    {
        return $this->result->getRowArray($n);
    }

    public function getNumRows(): int
    {
        return $this->result->getNumRows();
    }

    public function free_result(): void
    {
        $this->result->freeResult();
    }

    public function list_fields(): array
    {
        return $this->result->getFieldNames();
    }

    public function field_data(): array
    {
        return $this->result->getFieldData();
    }

    public function first_row(string $type = 'object')
    {
        return $this->result->getFirstRow($type);
    }

    public function last_row(string $type = 'object')
    {
        return $this->result->getLastRow($type);
    }

    public function next_row(string $type = 'object')
    {
        return $this->result->getNextRow($type);
    }

    public function previous_row(string $type = 'object')
    {
        return $this->result->getPreviousRow($type);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->result->getResult());
    }

    public function count(): int
    {
        return $this->result->getNumRows();
    }

    public function __call(string $name, array $arguments)
    {
        return $this->result->{$name}(...$arguments);
    }

    public function __get(string $name)
    {
        return $this->result->{$name};
    }
}
