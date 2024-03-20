<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $title
 * @property string $advertisement_img_url
 * @property string $body
 * @property int $order
 */
class Advertisement extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'title', 'advertisement_img_url', 'body', 'order','advertisement_type','redirect_web_url','redirect_app','redirect_to','status','order'];

}
