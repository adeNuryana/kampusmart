<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const SELLER_PROFILE_FIELDS = [
        'name' => 'Nama lengkap',
        'email' => 'Email',
        'phone' => 'Nomor telepon',
        'whatsapp' => 'WhatsApp',
        'nim' => 'NIM',
        'faculty' => 'Fakultas',
    ];

    protected $fillable = [
        'site_name',
        'admin_whatsapp',
        'logo',
        'favicon',
        'seller_profile_locked_fields',
    ];

    protected function casts(): array
    {
        return [
            'seller_profile_locked_fields' => 'array',
        ];
    }

    /**
     * @return array<int, string>
     */
    public function lockedSellerProfileFields(): array
    {
        $lockedFields = $this->seller_profile_locked_fields;

        if ($lockedFields === null) {
            return array_keys(self::SELLER_PROFILE_FIELDS);
        }

        return array_values(array_intersect(
            array_keys(self::SELLER_PROFILE_FIELDS),
            $lockedFields
        ));
    }

    public function sellerProfileFieldIsLocked(string $field): bool
    {
        return in_array($field, $this->lockedSellerProfileFields(), true);
    }
}
