<?php

namespace App\Traits;

use App\Common\Comment\Models\Comment as CommentModel;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait Comment
 * @package App\Traits
 */
trait Comment
{
    /**
     * @return MorphOne
     */
    public function comment()
    {
        return $this->morphOne(CommentModel::class, 'entity');
    }
}
