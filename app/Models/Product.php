<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;


    protected $fillable = ([
        'name',
        'image',
        'slug',
        'status',
        'description',
        'price',
        'compare_price',
        'category_id',
        'store_id'
    ]);

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'image'
    ];


    protected $appends = [
        'image_url',
    ];

    protected  static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::User();
            // if ($user->store_id) {
            //     $builder->where('store_id', '=', $user->store_id);
            // }

            if ($user) {
                // إذا لم يكن للمستخدم store_id، نعين له قيمة افتراضية
                $storeId = $user->store_id ?: 'default_store_id';

                $builder->where('store_id', $storeId);
            }
        });

        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });


        // static::addGlobalScope(new StoreScope());

    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function store()
    {
        return $this->belongsTo(store::class);
    }


    public function tags()
    {
        return $this->belongsToMany(
            tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'


        );
    }

    public function ScopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function getImageUrlAttribute()
    {

        if (!$this->image) {
            return 'https://www.oshean.org/global_graphics/default-store-350x350.jpg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            $this->image;
        }
        return asset('storage/.' . $this->image);
    }


    public function getSalePriceAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id'  => null,
            'tag_id'  => null,
            'category_id'  => null,
            'status'  => 'active',
        ], $filters);

        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });


        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });

        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });


        $builder->when($options['tag_id'], function ($builder, $value) {
            $builder->whereRaw('id in(SELECT product_id FROM product_tag WHERE tag_id =?)', [$value]);
        });
    }
}
