<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'region',
        'province',
        'city',
        'barangay',
        'delivery_notes',
        'order_id',
        'rider_id',
        'user_id',
        'status',
    ];

    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
    }

    public function users() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::Class, 'order_id');
    }

    private function getPsgcName($code, $type)
    {
        if (!$code) return null;

        $data = Cache::remember("psgc_{$type}", 3600, function () use ($type) {
            $path = public_path("ph-json/{$type}.json");
            if (File::exists($path)) {
                return collect(json_decode(File::get($path), true));
            }
            return collect([]);
        });

        $searchKeys = [
            'region'   => ['code' => 'region_code', 'name' => 'region_name'],
            'province' => ['code' => 'province_code', 'name' => 'province_name'],
            'city'     => ['code' => 'city_code', 'name' => 'city_name'],
            'barangay' => ['code' => 'brgy_code', 'name' => 'brgy_name'],
        ];

        $match = $data->firstWhere($searchKeys[$type]['code'], $code);

        return $match ? $match[$searchKeys[$type]['name']] : $code;
    }

    public function getRegionNameAttribute() { return $this->getPsgcName($this->region, 'region'); }
    public function getProvinceNameAttribute() { return $this->getPsgcName($this->province, 'province'); }
    public function getCityNameAttribute() { return $this->getPsgcName($this->city, 'city'); }
    public function getBarangayNameAttribute() { return $this->getPsgcName($this->barangay, 'barangay'); }
}
