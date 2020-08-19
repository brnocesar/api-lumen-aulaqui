<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModelBasico extends Model
{
    protected $appUrl     = "";
    public    $timestamps = false;
    protected $perPage    = 10;


    public function getUrlAttribute(): string
    {
        return "/api/{$this->table}/{$this->id}";
    }

    protected function mountUrlsArray(string $entity): array
    {
        return array_map(function($element) use ($entity) {

            return "{$this->appUrl}/api/{$entity}/{$element}";

        }, $this->{$entity}()->get()->pluck('id')->toArray());
    }
}
