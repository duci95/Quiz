<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public function approve($user, $category)
    {
        return DB::table('quiz')
            ->where([
                'user_id' => $user,
                'category_id' => $category
            ])
            ->get();
    }
}
