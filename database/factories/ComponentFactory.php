<?php

namespace Database\Factories;

use App\Models\Component;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    protected $model = Component::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['resistor', 'capacitor', 'microcontroller']);
        
        return [
            'name' => $this->generateName($type),
            'reference' => $this->generateReference($type),
            'type' => $type,
            'description' => $this->faker->sentence(),
            'stock_quantity' => $this->faker->numberBetween(0, 500),
            'price' => $this->faker->randomFloat(2, 0.10, 150.00),
            'specifications' => $this->generateSpecifications($type),
        ];
    }

    /**
     * State for resistor components
     */
    public function resistor(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'resistor',
            'name' => $this->generateName('resistor'),
            'reference' => $this->generateReference('resistor'),
            'specifications' => $this->generateSpecifications('resistor'),
        ]);
    }

    /**
     * State for capacitor components
     */
    public function capacitor(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'capacitor',
            'name' => $this->generateName('capacitor'),
            'reference' => $this->generateReference('capacitor'),
            'specifications' => $this->generateSpecifications('capacitor'),
        ]);
    }

    /**
     * State for microcontroller components
     */
    public function microcontroller(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'microcontroller',
            'name' => $this->generateName('microcontroller'),
            'reference' => $this->generateReference('microcontroller'),
            'specifications' => $this->generateSpecifications('microcontroller'),
        ]);
    }

    /**
     * Generate name based on component type
     */
    private function generateName(string $type): string
    {
        return match($type) {
            'resistor' => 'Résistance ' . $this->faker->randomElement(['1/4W', '1/2W', '1W']) . ' ' . $this->faker->randomElement(['5%', '1%', '0.1%']),
            'capacitor' => 'Condensateur ' . $this->faker->randomElement(['Céramique', 'Électrolytique', 'Tantale', 'Film']),
            'microcontroller' => $this->faker->randomElement(['Arduino', 'STM32', 'ESP32', 'PIC', 'ATmega']) . ' ' . $this->faker->bothify('????-###'),
            default => $this->faker->word(),
        };
    }

    /**
     * Generate reference based on component type
     */
    private function generateReference(string $type): string
    {
        $prefix = match($type) {
            'resistor' => 'RES',
            'capacitor' => 'CAP',
            'microcontroller' => 'MCU',
            default => 'CMP',
        };
        
        return $prefix . '-' . $this->faker->unique()->bothify('####??##');
    }

    /**
     * Generate specifications based on component type
     */
    private function generateSpecifications(string $type): array
    {
        return match($type) {
            'resistor' => [
                'resistance_value' => $this->faker->randomElement([100, 220, 330, 470, 1000, 2200, 4700, 10000, 47000, 100000]) . 'Ω',
                'tolerance' => $this->faker->randomElement(['±1%', '±5%', '±10%']),
                'power_rating' => $this->faker->randomElement(['1/8W', '1/4W', '1/2W', '1W', '2W']),
                'temperature_coefficient' => $this->faker->randomElement(['±50ppm/°C', '±100ppm/°C', '±200ppm/°C']),
            ],
            'capacitor' => [
                'capacitance_value' => $this->faker->randomElement([10, 22, 47, 100, 220, 470, 1000, 2200, 4700, 10000]) . $this->faker->randomElement(['pF', 'nF', 'µF']),
                'voltage_rating' => $this->faker->randomElement([6.3, 10, 16, 25, 35, 50, 63, 100, 250, 400]) . 'V',
                'capacitor_type' => $this->faker->randomElement(['Céramique', 'Électrolytique', 'Tantale', 'Film polyester', 'Film polypropylène']),
                'tolerance' => $this->faker->randomElement(['±5%', '±10%', '±20%']),
            ],
            'microcontroller' => [
                'processor_speed' => $this->faker->randomElement([8, 16, 32, 48, 72, 100, 120, 168, 240]) . 'MHz',
                'memory_size' => $this->faker->randomElement([2, 4, 8, 16, 32, 64, 128, 256, 512]) . 'KB',
                'pins_count' => $this->faker->randomElement([8, 14, 20, 28, 32, 40, 48, 64, 100]),
                'architecture' => $this->faker->randomElement(['AVR', 'ARM Cortex-M0', 'ARM Cortex-M3', 'ARM Cortex-M4', 'RISC-V', 'PIC']),
                'interfaces' => $this->faker->randomElements(['UART', 'SPI', 'I2C', 'USB', 'CAN', 'ADC', 'DAC', 'PWM'], $this->faker->numberBetween(2, 6)),
            ],
            default => [],
        };
    }
}

