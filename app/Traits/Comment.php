<?php

namespace App\Traits;

use App\Common\Comment\Models\Comment as CommentModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait Comment
 * @package App\Traits
 */
trait Comment
{
    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(CommentModel::class, 'entity');
    }
}
