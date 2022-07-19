<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'total'      => $this->total,
            'created_at' => $this->created_at,
            'address'    => $this->address,
            'user' => [
                'name'  => $this->user->name
            ],
        ];
    }
}
