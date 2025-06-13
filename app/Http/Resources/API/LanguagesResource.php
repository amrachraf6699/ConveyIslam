<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id' => $this->id,
            'english_name' => $this->english_name,
            'native_name' => $this->native_name,
            'flag' => $this->flag_url,
            'sound' => $this->sound_url,
            'additional_sounds_count' => $this->sounds_count,
            'additional_sounds' => $this->whenLoaded('sounds', function () {
                return SoundsResource::collection($this->sounds);
            }),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'created_at_human' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'updated_at_human' => $this->updated_at->diffForHumans(),
        ];
    }
}
