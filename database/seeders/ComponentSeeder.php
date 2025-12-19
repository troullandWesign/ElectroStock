<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des résistances
        Component::factory()->resistor()->count(20)->create();
        
        // Créer des condensateurs
        Component::factory()->capacitor()->count(15)->create();
        
        // Créer des microcontrôleurs
        Component::factory()->microcontroller()->count(10)->create();
        
        // Créer quelques composants spécifiques pour les tests
        Component::factory()->resistor()->create([
            'name' => 'Résistance 1kΩ 1/4W 5%',
            'reference' => 'RES-1K-0001',
            'description' => 'Résistance standard pour usage général',
            'stock_quantity' => 1000,
            'price' => 0.05,
            'specifications' => [
                'resistance_value' => '1000Ω',
                'tolerance' => '±5%',
                'power_rating' => '1/4W',
                'temperature_coefficient' => '±100ppm/°C',
            ],
        ]);

        Component::factory()->capacitor()->create([
            'name' => 'Condensateur 100µF 25V Électrolytique',
            'reference' => 'CAP-100UF-0001',
            'description' => 'Condensateur électrolytique pour alimentation',
            'stock_quantity' => 500,
            'price' => 0.15,
            'specifications' => [
                'capacitance_value' => '100µF',
                'voltage_rating' => '25V',
                'capacitor_type' => 'Électrolytique',
                'tolerance' => '±20%',
            ],
        ]);

        Component::factory()->microcontroller()->create([
            'name' => 'Arduino Nano ATmega328P',
            'reference' => 'MCU-NANO-0001',
            'description' => 'Microcontrôleur Arduino Nano basé sur ATmega328P',
            'stock_quantity' => 50,
            'price' => 18.50,
            'specifications' => [
                'processor_speed' => '16MHz',
                'memory_size' => '32KB',
                'pins_count' => 30,
                'architecture' => 'AVR',
                'interfaces' => ['UART', 'SPI', 'I2C', 'ADC', 'PWM'],
            ],
        ]);

        Component::factory()->microcontroller()->create([
            'name' => 'ESP32-WROOM-32 Dev Module',
            'reference' => 'MCU-ESP32-0001',
            'description' => 'Module WiFi/Bluetooth avec microcontrôleur ESP32',
            'stock_quantity' => 75,
            'price' => 8.90,
            'specifications' => [
                'processor_speed' => '240MHz',
                'memory_size' => '520KB',
                'pins_count' => 38,
                'architecture' => 'Xtensa LX6',
                'interfaces' => ['UART', 'SPI', 'I2C', 'WiFi', 'Bluetooth', 'ADC', 'DAC', 'PWM'],
            ],
        ]);

        // Créer quelques composants avec stock faible pour tester les alertes
        Component::factory()->resistor()->create([
            'name' => 'Résistance 10kΩ 1/2W 1%',
            'reference' => 'RES-10K-0001',
            'description' => 'Résistance de précision',
            'stock_quantity' => 5,
            'price' => 0.12,
            'specifications' => [
                'resistance_value' => '10000Ω',
                'tolerance' => '±1%',
                'power_rating' => '1/2W',
                'temperature_coefficient' => '±50ppm/°C',
            ],
        ]);

        Component::factory()->capacitor()->create([
            'name' => 'Condensateur 10nF 50V Céramique',
            'reference' => 'CAP-10NF-0001',
            'description' => 'Condensateur céramique de découplage',
            'stock_quantity' => 8,
            'price' => 0.03,
            'specifications' => [
                'capacitance_value' => '10nF',
                'voltage_rating' => '50V',
                'capacitor_type' => 'Céramique',
                'tolerance' => '±10%',
            ],
        ]);

        // Créer des composants en rupture de stock
        Component::factory()->microcontroller()->create([
            'name' => 'STM32F103C8T6 Blue Pill',
            'reference' => 'MCU-STM32-0001',
            'description' => 'Carte de développement STM32 ARM Cortex-M3',
            'stock_quantity' => 0,
            'price' => 6.50,
            'specifications' => [
                'processor_speed' => '72MHz',
                'memory_size' => '64KB',
                'pins_count' => 48,
                'architecture' => 'ARM Cortex-M3',
                'interfaces' => ['UART', 'SPI', 'I2C', 'USB', 'CAN', 'ADC', 'DAC', 'PWM'],
            ],
        ]);
    }
}

