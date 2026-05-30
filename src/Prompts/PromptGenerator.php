<?php

declare(strict_types=1);

namespace App\Prompts;

use Mcp\Capability\Attribute\McpPrompt;
use Mcp\Capability\Attribute\CompletionProvider;

class PromptGenerator
{
    /**
     * Generates a code review prompt.
     */
    #[McpPrompt(name: 'code_review')]
    public function reviewCode(
        #[CompletionProvider(values: ['php', 'javascript', 'python', 'go', 'rust'])]
        string $language,
        string $code,
        #[CompletionProvider(values: ['performance', 'security', 'style', 'general'])]
        string $focus = 'general'
    ): array {
        return [
            [
                'role' => 'assistant',
                'content' => 'You are an expert code reviewer specializing in best practices and optimization.'
            ],
            [
                'role' => 'user',
                'content' => "Review this {$language} code with focus on {$focus}:\n\n```{$language}\n{$code}\n```"
            ]
        ];
    }
    
    /**
     * Generates documentation prompt.
     */
    #[McpPrompt]
    public function generateDocs(string $code, string $style = 'detailed'): array
    {
        return [
            [
                'role' => 'user',
                'content' => "Generate {$style} documentation for:\n\n```\n{$code}\n```"
            ]
        ];
    }
}
