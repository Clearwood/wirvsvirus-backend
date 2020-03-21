<?php

namespace App\Models;

use Illuminate\Support\Str;

/**
 * A trait to use UUIDs as primary keys for models.
 *
 * @package App\Models\Concerns
 */
trait UsesUuid
{

    /**
     * Get whether the primary key has to be incremented.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the type of the primary key.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * Register a function to set a random UUID on creation of the entity
     */
    protected static function bootUsesUuid(): void
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

}