<?php

require __DIR__ . '/../vendor/autoload.php';

class TestCase extends \Tetsuwan\Database\Model
{
    protected $table = 'test';
}

new TestCase();