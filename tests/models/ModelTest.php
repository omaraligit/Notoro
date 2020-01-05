<?php

namespace NotoroTest\models;

use PHPUnit\Framework\TestCase;
use NotoroTest\models\TestModel;

class ModelTest extends TestCase
{
    public function testNewNodelTestTableNameFromClass()
    {
        $model = new TestModel();
        $this->assertSame('testmodel', $model->table);
    }
}
