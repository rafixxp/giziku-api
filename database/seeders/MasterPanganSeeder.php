<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodIngredients;

class MasterPanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = public_path('dataset.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("File {$csvFile} tidak ditemukan!");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        
        $data = [];
        $batchSize = 500; // Insert per 500 baris
        
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'sheet_row_id' => $this->getValue($row, 1),
                'name_id' => $this->getValue($row, 2),
                'name_en' => $this->getValue($row, 3),
                'category_id' => $this->getValue($row, 4),
                'category_en' => $this->getValue($row, 5),
                'calories' => $this->getNumericValue($row, 6),
                'protein' => $this->getNumericValue($row, 7),
                'carbohydrates' => $this->getNumericValue($row, 8),
                'fat' => $this->getNumericValue($row, 9),
                'fiber' => $this->getNumericValue($row, 10),
                'sodium' => $this->getNumericValue($row, 11),
                'calcium' => $this->getNumericValue($row, 12),
                'source' => $this->getValue($row, 13),
                'iron' => $this->getNumericValue($row, 16),
                'phosphorus' => $this->getNumericValue($row, 17),
                'basis_gram' => $this->getNumericValue($row, 18),
                'ash' => $this->getNumericValue($row, 19),
                'potassium' => $this->getNumericValue($row, 20),
                'copper' => $this->getNumericValue($row, 21),
                'zinc' => $this->getNumericValue($row, 22),
                'retinol' => $this->getNumericValue($row, 23),
                'beta_carotene' => $this->getNumericValue($row, 24),
                'total_carotene' => $this->getNumericValue($row, 25),
                'thiamin' => $this->getNumericValue($row, 26),
                'riboflavin' => $this->getNumericValue($row, 27),
                'niacin' => $this->getNumericValue($row, 28),
                'vitamin_c' => $this->getNumericValue($row, 29),
                'water' => $this->getNumericValue($row, 30),
                'bdd_percent' => $this->getNumericValue($row, 31),
                'scope' => $this->getValue($row, 32),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($data) >= $batchSize) {
                FoodIngredients::insert($data);
                $this->command->info("Inserted " . count($data) . " records");
                $data = [];
            }
        }

        // Insert remaining data
        if (count($data) > 0) {
            FoodIngredients::insert($data);
            $this->command->info("Inserted " . count($data) . " records");
        }

        fclose($file);
        $this->command->info("FoodIngredients seeding completed successfully!");
    }

    /**
     * Get value from row array at index, handle empty values
     */
    private function getValue($row, $index): ?string
    {
        if (isset($row[$index]) && $row[$index] !== '') {
            return trim($row[$index]);
        }
        return null;
    }

    /**
     * Get numeric value from row array at index
     */
    private function getNumericValue($row, $index): ?float
    {
        if (isset($row[$index]) && $row[$index] !== '') {
            $value = trim($row[$index]);
            $numeric = floatval($value);
            return is_numeric($value) ? $numeric : null;
        }
        return null;
    }
}
