<?php

namespace App;

use App\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Conversation
 *
 * @property int $id
 * @property string|null $message
 * @property int $user_id
 * @property int $group_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Group $group
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Conversation whereUserId($value)
 * @mixin \Eloquent
 */
class Conversation extends Model
{
    protected $fillable = ['message', 'user_id', 'group_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
