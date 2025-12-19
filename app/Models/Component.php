<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'reference',
        'type',
        'description',
        'stock_quantity',
        'price',
        'specifications',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specifications' => 'array',
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    /**
     * Scope for resistors
     */
    public function scopeResistors($query)
    {
        return $query->where('type', 'resistor');
    }

    /**
     * Scope for capacitors
     */
    public function scopeCapacitors($query)
    {
        return $query->where('type', 'capacitor');
    }

    /**
     * Scope for microcontrollers
     */
    public function scopeMicrocontrollers($query)
    {
        return $query->where('type', 'microcontroller');
    }

    /**
     * Scope for filtering by type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Check if component is a resistor
     */
    public function isResistor(): bool
    {
        return $this->type === 'resistor';
    }

    /**
     * Check if component is a capacitor
     */
    public function isCapacitor(): bool
    {
        return $this->type === 'capacitor';
    }

    /**
     * Check if component is a microcontroller
     */
    public function isMicrocontroller(): bool
    {
        return $this->type === 'microcontroller';
    }

    /**
     * Check if component is in stock
     */
    public function isInStock(): bool
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Check if component is low on stock (less than 10)
     */
    public function isLowStock(): bool
    {
        return $this->stock_quantity > 0 && $this->stock_quantity < 10;
    }
}

