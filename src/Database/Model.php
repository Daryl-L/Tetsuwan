<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/8/30
 * Time: 下午10:30
 */

namespace Tetsuwan\Database;

use Tetsuwan\Contracts\Database\Model as ModelContract;

class Model implements ModelContract
{
    protected $table = null;

    protected $original;

    public function __construct()
    {
        $this->initTable();
        var_dump($this->table);
    }

    protected function initTable()
    {
        if (is_null($this->table)) {
            $className = get_class($this);
            preg_match_all("/([A-Z]{1}[a-z]+)/", $className, $string);
            $this->table = strtolower(implode('_', $string[0])) . 's';
        }
    }
}