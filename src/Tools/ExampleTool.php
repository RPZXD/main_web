<?php

declare(strict_types=1);

namespace App\Tools;

use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;

class ExampleTool
{
    /**
     * Performs a greeting with the provided name.
     * 
     * @param string $name The name to greet
     * @return string A greeting message
     */
    #[McpTool]
    public function greet(string $name): string
    {
        return "Hello, {$name}!";
    }
    
    /**
     * Performs arithmetic calculations.
     */
    #[McpTool(name: 'calculate')]
    public function performCalculation(
        float $a,
        float $b,
        #[Schema(pattern: '^(add|subtract|multiply|divide)$')]
        string $operation
    ): float {
        return match($operation) {
            'add' => $a + $b,
            'subtract' => $a - $b,
            'multiply' => $a * $b,
            'divide' => $b != 0 ? $a / $b : 
                throw new \InvalidArgumentException('Division by zero'),
            default => throw new \InvalidArgumentException('Invalid operation')
        };
    }
}
