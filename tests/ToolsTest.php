<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Tools\ExampleTool;

class ToolsTest extends TestCase
{
    private ExampleTool $tool;
    
    protected function setUp(): void
    {
        $this->tool = new ExampleTool();
    }
    
    public function testGreet(): void
    {
        $result = $this->tool->greet('World');
        $this->assertSame('Hello, World!', $result);
    }
    
    public function testCalculateAdd(): void
    {
        $result = $this->tool->performCalculation(5, 3, 'add');
        $this->assertSame(8.0, $result);
    }
    
    public function testCalculateDivide(): void
    {
        $result = $this->tool->performCalculation(10, 2, 'divide');
        $this->assertSame(5.0, $result);
    }
    
    public function testCalculateDivideByZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero');
        
        $this->tool->performCalculation(10, 0, 'divide');
    }
    
    public function testCalculateInvalidOperation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid operation');
        
        $this->tool->performCalculation(5, 3, 'modulo');
    }
}
