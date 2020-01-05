<?php

namespace NotoroTest\models;

use Notoro\framework\models\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testNewNodelTestTableNameFromClass()
    {
        $model = new TestModel();
        $this->assertSame('testmodel', $model->table);
    }
}

class TestModel extends Model
{
}
