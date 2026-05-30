<?php

declare(strict_types=1);

namespace App\Resources;

use Mcp\Capability\Attribute\McpResourceTemplate;

class DataProvider
{
    /**
     * Provides data by category and ID.
     */
    #[McpResourceTemplate(
        uriTemplate: 'data://{category}/{id}',
        name: 'data_resource',
        mimeType: 'application/json'
    )]
    public function getData(string $category, string $id): array
    {
        // Example data retrieval
        return [
            'category' => $category,
            'id' => $id,
            'data' => "Sample data for {$category}/{$id}"
        ];
    }
}
