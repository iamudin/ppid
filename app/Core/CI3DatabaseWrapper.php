<?php

namespace App\Core;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\BaseResult;

#[\AllowDynamicProperties]
class CI3DatabaseWrapper
{
    /** @var BaseConnection */
    protected $db;

    /** @var BaseBuilder|null */
    protected $builder = null;

    /** @var string|null */
    protected $currentTable = null;

    /** @var array */
    protected array $pendingCalls = [];

    public function __construct(?BaseConnection $db = null)
    {
        $this->db = $db ?? \Config\Database::connect();
    }

    public function getConnection(): BaseConnection
    {
        return $this->db;
    }

    public function table(string $tableName): BaseBuilder
    {
        return $this->initBuilder($tableName);
    }

    protected function initBuilder(string $table): BaseBuilder
    {
        $this->currentTable = $table;
        $this->builder = $this->db->table($table);
        if (!empty($this->pendingCalls)) {
            foreach ($this->pendingCalls as [$method, $args]) {
                $this->builder->{$method}(...$args);
            }
            $this->pendingCalls = [];
        }
        return $this->builder;
    }

    protected function addCall(string $method, array $args): self
    {
        if ($this->builder !== null) {
            $this->builder->{$method}(...$args);
        } else {
            $this->pendingCalls[] = [$method, $args];
        }
        return $this;
    }

    protected function getBuilder(?string $table = null): BaseBuilder
    {
        if ($table !== null && $table !== '') {
            if ($this->builder === null || $this->currentTable !== $table) {
                return $this->initBuilder($table);
            }
        } elseif ($this->builder === null) {
            $this->builder = $this->db->table('');
        }
        return $this->builder;
    }

    public function from(string $from): self
    {
        $this->initBuilder($from);
        return $this;
    }

    public function select($select = '*', ?bool $escape = null): self
    {
        return $this->addCall('select', [$select, $escape]);
    }

    public function select_max(string $select = '', string $alias = ''): self
    {
        return $this->addCall('selectMax', [$select, $alias]);
    }

    public function select_min(string $select = '', string $alias = ''): self
    {
        return $this->addCall('selectMin', [$select, $alias]);
    }

    public function select_avg(string $select = '', string $alias = ''): self
    {
        return $this->addCall('selectAvg', [$select, $alias]);
    }

    public function select_sum(string $select = '', string $alias = ''): self
    {
        return $this->addCall('selectSum', [$select, $alias]);
    }

    public function join(string $table, string $cond, string $type = '', ?bool $escape = null): self
    {
        return $this->addCall('join', [$table, $cond, $type, $escape]);
    }

    public function where($key, $value = null, ?bool $escape = null): self
    {
        return $this->addCall('where', [$key, $value, $escape]);
    }

    public function or_where($key, $value = null, ?bool $escape = null): self
    {
        return $this->addCall('orWhere', [$key, $value, $escape]);
    }

    public function where_in(?string $key = null, $values = null, ?bool $escape = null): self
    {
        return $this->addCall('whereIn', [$key, $values, $escape]);
    }

    public function or_where_in(?string $key = null, $values = null, ?bool $escape = null): self
    {
        return $this->addCall('orWhereIn', [$key, $values, $escape]);
    }

    public function where_not_in(?string $key = null, $values = null, ?bool $escape = null): self
    {
        return $this->addCall('whereNotIn', [$key, $values, $escape]);
    }

    public function or_where_not_in(?string $key = null, $values = null, ?bool $escape = null): self
    {
        return $this->addCall('orWhereNotIn', [$key, $values, $escape]);
    }

    public function like($field, string $match = '', string $side = 'both', ?bool $escape = null, bool $insensitiveSearch = false): self
    {
        return $this->addCall('like', [$field, $match, $side, $escape, $insensitiveSearch]);
    }

    public function not_like($field, string $match = '', string $side = 'both', ?bool $escape = null, bool $insensitiveSearch = false): self
    {
        return $this->addCall('notLike', [$field, $match, $side, $escape, $insensitiveSearch]);
    }

    public function or_like($field, string $match = '', string $side = 'both', ?bool $escape = null, bool $insensitiveSearch = false): self
    {
        return $this->addCall('orLike', [$field, $match, $side, $escape, $insensitiveSearch]);
    }

    public function or_not_like($field, string $match = '', string $side = 'both', ?bool $escape = null, bool $insensitiveSearch = false): self
    {
        return $this->addCall('orNotLike', [$field, $match, $side, $escape, $insensitiveSearch]);
    }

    public function group_by($by, ?bool $escape = null): self
    {
        return $this->addCall('groupBy', [$by, $escape]);
    }

    public function distinct(bool $val = true): self
    {
        return $this->addCall('distinct', [$val]);
    }

    public function having($key, $value = null, ?bool $escape = null): self
    {
        return $this->addCall('having', [$key, $value, $escape]);
    }

    public function or_having($key, $value = null, ?bool $escape = null): self
    {
        return $this->addCall('orHaving', [$key, $value, $escape]);
    }

    public function order_by(string $orderBy, string $direction = '', ?bool $escape = null): self
    {
        return $this->addCall('orderBy', [$orderBy, $direction, $escape]);
    }

    public function limit($value = null, $offset = 0): self
    {
        $val = ($value !== null) ? (int) $value : null;
        $off = ($offset !== null) ? (int) $offset : 0;
        return $this->addCall('limit', [$val, $off]);
    }

    public function offset($offset): self
    {
        return $this->addCall('offset', [(int) $offset]);
    }

    public function get(?string $table = null, ?int $limit = null, ?int $offset = null): CI3ResultWrapper
    {
        try {
            if ($table !== null && $table !== '') {
                $builder = $this->initBuilder($table);
            } else {
                $builder = $this->getBuilder($table);
            }
            if ($limit !== null) {
                $builder->limit($limit, $offset);
            }
            $result = $builder->get();
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return new CI3ResultWrapper($result);
        } catch (\Throwable $e) {
            log_message('error', 'DB get() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            return new CI3EmptyResultWrapper();
        }
    }

    public function get_where(?string $table = null, $where = null, ?int $limit = null, ?int $offset = null): CI3ResultWrapper
    {
        try {
            $builder = $this->getBuilder($table);
            if ($where !== null) {
                $builder->where($where);
            }
            if ($limit !== null) {
                $builder->limit($limit, $offset);
            }
            $result = $builder->get();
            $this->builder = null;
            $this->currentTable = null;
            return new CI3ResultWrapper($result);
        } catch (\Throwable $e) {
            log_message('error', 'DB get_where() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            return new CI3EmptyResultWrapper();
        }
    }

    public function count_all_results(?string $table = null, bool $reset = true): int
    {
        try {
            $builder = $this->getBuilder($table);
            $count = $builder->countAllResults($reset);
            if ($reset) {
                $this->builder = null;
                $this->currentTable = null;
            }
            return $count;
        } catch (\Throwable $e) {
            log_message('error', 'DB count_all_results() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            return 0;
        }
    }

    public function count_all(string $table = '', bool $reset = true): int
    {
        try {
            return $this->db->table($table)->countAllResults($reset);
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function set($key, $value = '', ?bool $escape = null): self
    {
        return $this->addCall('set', [$key, $value, $escape]);
    }

    public function insert(string $table, $set = null, ?bool $escape = null): bool
    {
        try {
            $builder = $this->initBuilder($table);
            if ($set !== null) {
                $builder->set($set, '', $escape);
            }
            $result = $builder->insert();
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return (bool) $result;
        } catch (\Throwable $e) {
            log_message('error', 'DB insert() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return false;
        }
    }

    public function insert_batch(string $table, ?array $set = null, ?bool $escape = null, int $batchSize = 100): int
    {
        try {
            return $this->db->table($table)->insertBatch($set, $escape, $batchSize);
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function update(string $table, $set = null, $where = null, ?int $limit = null): bool
    {
        try {
            $builder = $this->initBuilder($table);
            if ($where !== null) {
                $builder->where($where);
            }
            if ($limit !== null) {
                $builder->limit($limit);
            }
            if ($set !== null) {
                $builder->set($set);
            }
            $result = $builder->update();
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return (bool) $result;
        } catch (\Throwable $e) {
            log_message('error', 'DB update() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return false;
        }
    }

    public function update_batch(string $table, ?array $set = null, ?string $index = null, int $batchSize = 100): int
    {
        try {
            return $this->db->table($table)->updateBatch($set, $index, $batchSize);
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function delete(string $table, $where = null, ?int $limit = null, bool $resetData = true): bool
    {
        try {
            $builder = $this->initBuilder($table);
            if ($where !== null) {
                $builder->where($where);
            }
            if ($limit !== null) {
                $builder->limit($limit);
            }
            $result = $builder->delete();
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return (bool) $result;
        } catch (\Throwable $e) {
            log_message('error', 'DB delete() Error: ' . $e->getMessage());
            $this->builder = null;
            $this->currentTable = null;
            $this->pendingCalls = [];
            return false;
        }
    }

    public function truncate(string $table): bool
    {
        try {
            return $this->db->table($table)->truncate();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function empty_table(string $table): bool
    {
        try {
            return $this->db->table($table)->emptyTable();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function query(string $sql, $binds = false, bool $setArgs = true)
    {
        // 1. Keamanan: Mencegah Null-Byte Injection
        $sql = str_replace(["\0", "\x00"], '', $sql);

        // 2. Keamanan: Sanitasi klausa LIMIT dari manipulasi SQL Injection berbasis URL parameter
        $sql = preg_replace_callback('/LIMIT\s+([^\s;,\)]+)(?:\s*,\s*([^\s;,\)]+))?/i', function ($m) {
            $first = isset($m[1]) && is_numeric(trim($m[1])) ? (int) trim($m[1]) : 0;
            if (isset($m[2])) {
                $second = is_numeric(trim($m[2])) ? (int) trim($m[2]) : 25;
                return "LIMIT {$first}, {$second}";
            }
            return "LIMIT {$first}";
        }, $sql);

        try {
            $result = $this->db->query($sql, $binds, $setArgs);
            if ($result instanceof BaseResult) {
                return new CI3ResultWrapper($result);
            }
            return $result;
        } catch (\Throwable $e) {
            log_message('error', 'DB query() Error: ' . $e->getMessage() . ' | SQL: ' . $sql);
            return new CI3EmptyResultWrapper();
        }
    }

    public function insert_id(): int
    {
        return (int) $this->db->insertID();
    }

    public function affected_rows(): int
    {
        return $this->db->affectedRows();
    }

    public function escape($str)
    {
        return $this->db->escape($str);
    }

    public function escape_str($str, bool $like = false)
    {
        return $this->db->escapeString($str, $like);
    }

    public function escape_like_str($str)
    {
        return $this->db->escapeLikeString($str);
    }

    public function trans_start(bool $testMode = false): bool
    {
        return $this->db->transStart($testMode);
    }

    public function trans_complete(): bool
    {
        return $this->db->transComplete();
    }

    public function trans_status(): bool
    {
        return $this->db->transStatus();
    }

    public function trans_begin(bool $testMode = false): bool
    {
        return $this->db->transBegin($testMode);
    }

    public function trans_rollback(): bool
    {
        return $this->db->transRollback();
    }

    public function trans_commit(): bool
    {
        return $this->db->transCommit();
    }

    public function last_query(): string
    {
        return (string) $this->db->getLastQuery();
    }

    public function __call(string $name, array $arguments)
    {
        // Try camelCase translation if not exists
        $camel = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
        if ($this->builder !== null && method_exists($this->builder, $camel)) {
            $ret = $this->builder->{$camel}(...$arguments);
            return ($ret === $this->builder) ? $this : $ret;
        }
        if (method_exists($this->db, $camel)) {
            return $this->db->{$camel}(...$arguments);
        }
        if ($this->builder !== null && method_exists($this->builder, $name)) {
            $ret = $this->builder->{$name}(...$arguments);
            return ($ret === $this->builder) ? $this : $ret;
        }
        return $this->db->{$name}(...$arguments);
    }

    public function __get(string $name)
    {
        return $this->db->{$name};
    }
}
