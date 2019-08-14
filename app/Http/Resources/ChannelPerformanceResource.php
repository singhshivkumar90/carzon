<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class ChannelPerformanceResource extends Resource
{
    /**
     * Default value
     */
    private const DEFAULT_VALUE = 0;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'seoChart' => [
                'organic_direct' => $this['seoChart']->organic_direct ?? self::DEFAULT_VALUE,
                'google_ads' => $this['seoChart']->google_ads ?? self::DEFAULT_VALUE,
                'B2B' => $this['seoChart']->B2B ?? self::DEFAULT_VALUE,
            ],
            'websiteChart' => [
                'klook' => $this['websiteChart']['klook'] ?? self::DEFAULT_VALUE,
                'MMT' => $this['websiteChart']['MMT'] ?? self::DEFAULT_VALUE,
                'TC' => $this['websiteChart']['TC'] ?? self::DEFAULT_VALUE,
            ]
        ];
    }
}
