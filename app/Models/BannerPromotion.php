<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BannerPromotion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image_path',
        'is_active',
        'sort_order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot function to automatically fill audit trail fields and clear cache.
     */
    protected static function boot(): void
    {
        parent::boot();

        // Isi created_by saat data pertama kali dibuat
        static::creating(function (self $model) {
            $model->created_by = Auth::user()?->email ?? 'system';
        });

        // Isi updated_by setiap kali data diperbarui
        static::updating(function (self $model) {
            $model->updated_by = Auth::user()?->email ?? 'system';
        });

        // Isi deleted_by saat data di-soft-delete
        static::deleting(function (self $model) {
            $model->deleted_by = Auth::user()?->email ?? 'system';
            $model->saveQuietly();
        });

        // Hapus cache API setiap ada perubahan data (create / update)
        static::saved(function () {
            Cache::forget('local_cms_banner_promotions_');
        });

        // Hapus cache API setiap ada penghapusan data
        static::deleted(function () {
            Cache::forget('local_cms_banner_promotions_');
        });
    }
}
