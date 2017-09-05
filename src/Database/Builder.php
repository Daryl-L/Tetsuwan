<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/9/4
 * Time: 下午11:37
 */

namespace Tetsuwan\Database;

use Tetsuwan\Contracts\Database\Builder as BuilderContract;
use Tetsuwan\Contracts\Database\Model;

class Builder implements BuilderContract
{
    protected $columns = '*';

    protected $where = [];

    /** @var  Model */
    protected $model;

    protected $sql;

    protected $method;

    public function getModel()
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function select(...$columns)
    {
        $this->columns = implode('`,`', $columns);
        $this->columns = '`' . $this->columns . '`';
    }

    public function get()
    {
        $table = $this->model->getTable();
        $query = 'select ';
        $query .= $this->columns;
        $query .= ' from ';
        $query .= $table;
    }
}