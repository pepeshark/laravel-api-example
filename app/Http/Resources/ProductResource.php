<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'productName' => $this->name,
            'productPrice' => $this->price,
            'categoryId' => $this->category_id,
            'categoryName' => ($this->category ? $this->category->name : ''),
        ];
    }
}
