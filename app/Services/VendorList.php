<?php

namespace App\Services;

use App\Models\Vendor;

class VendorList
{
    protected $vendors;

    public function __construct()
    {
        $this->vendors = collect();
    }

    public function loadFromDB()
    {
        Vendor::all()->each(function ($vendor) {
            $this->vendors->push(
                [
                    'id' => $vendor->id,
                    'categoryId' => $vendor->category_id,
                    'name' => $vendor->name
                ]
            );
        });
    }

    /** @return int Vendor Id | 0 */
    public function contains(int $categoryId, string $vendorName)
    {
        $result = $this->vendors->collect()->filter(function ($vendor) use ($categoryId, $vendorName) {
            return ($vendor['name'] == $vendorName && $vendor['categoryId'] == $categoryId);
        })->all();

        if (count($result)) {
            return $result[array_key_first($result)]['id'];
        }

        return 0;
    }

    /** @return int Vendor Id */
    public function push(int $categoryId, string $vendorName, bool $changeExistStatus = false)
    {
        $vendorId = $this->contains($categoryId, $vendorName);

        if ($vendorId) {
            return $vendorId;
        }

        $vendor = Vendor::firstOrCreate(
            [
                'category_id' => $categoryId,
                'name' => $vendorName
            ],
            ['is_exist' => true]
        );

        if (!$vendor) {
            throw new \Exception('Cant save vendor ' . $vendorName . ' in category ID = ' . $categoryId);
        }

        $this->vendors->push(
            [
                'id' => $vendor->id,
                'categoryId' => $categoryId,
                'name' => $vendorName
            ]
        );

        if ($changeExistStatus && !$vendor->is_exist) {
            $vendor->is_exist = true;
            $vendor->save();
        }

        return $vendor->id;
    }

    public function dd()
    {
        dd($this->vendors->all());
    }
}
