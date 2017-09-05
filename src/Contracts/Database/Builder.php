<?php
/**
 * Created by PhpStorm.
 * User: daryl
 * Date: 2017/9/4
 * Time: 下午11:37
 */

namespace Tetsuwan\Contracts\Database;


interface Builder
{
    public function getModel();

    public function setModel(Model $model);
}