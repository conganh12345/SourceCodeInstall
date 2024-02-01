<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'publish_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = $post->slug ?: Str::slug($post->title);

            $originalSlug = $post->slug;
            $count = 1;

            while (static::where('slug', $post->slug)->exists()) {
                $post->slug = $originalSlug . '-' . $count++;
            }
        });
    }

    public function getThumbnailAttribute()
    {
        // Lấy URL của ảnh đại diện (thumbnail)
        $media = $this->getFirstMedia(); // No collection specified

        if ($media) {
            // Sử dụng phương thức `getUrl` để lấy URL từ disk 'public'
            $url = $media->getUrl();

            // Kiểm tra xem URL đã có cổng 8000 chưa
            if (strpos($url, 'http://localhost') !== false && strpos($url, 'http://localhost:8000') === false) {
                // Nếu không có cổng 8000, thêm nó vào URL
                $url = str_replace('http://localhost', 'http://localhost:8000', $url);
            }

            return $url;
        }

        return asset('path/to/default-thumbnail.jpg');

    }



}
