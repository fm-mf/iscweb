<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    const IMAGES_DIR = 'public/products';

    use SoftDeletes;

    public $timestamps = true;
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'name', 'type', 'description', 'price', 'image'
    ];

    public function sales()
    {
        return $this->hasMany('\App\Models\ProductSale', 'id_product', 'id_product');
    }

    public function hasImage()
    {
        return $this->image ? true : false;
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return '';
        }

        return asset("storage/products/{$this->image}");
    }

    public function storeImage(UploadedFile $image)
    {
        $imageName = Uuid::uuid4()->toString() . ".{$image->extension()}";
        while (Storage::exists(self::IMAGES_DIR . "/{$imageName}")) {
            $imageName = Uuid::uuid4()->toString() . ".{$image->extension()}";
        }
        $image->storeAs(self::IMAGES_DIR, $imageName);
        $oldImageName = $this->image;

        $this->image = $imageName;
        $this->save();

        if (!empty($oldImageName) && Storage::exists(self::IMAGES_DIR . "/{$oldImageName}")) {
            Storage::delete(self::IMAGES_DIR . "/{$oldImageName}");
        }
    }
}
