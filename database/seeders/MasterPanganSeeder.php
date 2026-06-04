<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterPangan;

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
                'nama_id' => $this->getValue($row, 2),
                'nama_en' => $this->getValue($row, 3),
                'kategori_id' => $this->getValue($row, 4),
                'kategori_en' => $this->getValue($row, 5),
                'kalori' => $this->getNumericValue($row, 6),
                'protein' => $this->getNumericValue($row, 7),
                'karbohidrat' => $this->getNumericValue($row, 8),
                'lemak' => $this->getNumericValue($row, 9),
                'serat' => $this->getNumericValue($row, 10),
                'natrium' => $this->getNumericValue($row, 11),
                'kalsium' => $this->getNumericValue($row, 12),
                'source' => $this->getValue($row, 13),
                'besi' => $this->getNumericValue($row, 15),
                'fosfor' => $this->getNumericValue($row, 16),
                'basis_gram' => $this->getNumericValue($row, 17),
                'abu' => $this->getNumericValue($row, 18),
                'kalium' => $this->getNumericValue($row, 19),
                'tembaga' => $this->getNumericValue($row, 20),
                'seng' => $this->getNumericValue($row, 21),
                'retinol' => $this->getNumericValue($row, 22),
                'beta_karoten' => $this->getNumericValue($row, 23),
                'karoten_total' => $this->getNumericValue($row, 24),
                'thiamin' => $this->getNumericValue($row, 25),
                'riboflavin' => $this->getNumericValue($row, 26),
                'niasin' => $this->getNumericValue($row, 27),
                'vitamin_c' => $this->getNumericValue($row, 28),
                'air' => $this->getNumericValue($row, 29),
                'bdd_percent' => $this->getNumericValue($row, 30),
                'scope' => $this->getValue($row, 31),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($data) >= $batchSize) {
                MasterPangan::insert($data);
                $this->command->info("Inserted " . count($data) . " records");
                $data = [];
            }
        }

        // Insert remaining data
        if (count($data) > 0) {
            MasterPangan::insert($data);
            $this->command->info("Inserted " . count($data) . " records");
        }

        fclose($file);
        $this->command->info("MasterPangan seeding completed successfully!");
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
