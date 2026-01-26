<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;

class TranslationSeeder extends Seeder
{
  public function run(): void
  {
    DB::disableQueryLog();

    $path = database_path('seeders/translations');

    if (!File::exists($path)) {
      throw new RuntimeException("Translation directory not found: {$path}");
    }

    $files = File::files($path);

    if (empty($files)) {
      $this->command->warn('No translation files found.');
      return;
    }

    $now = now();
    $allTranslations = [];

    foreach ($files as $file) {
      $locale = pathinfo($file->getFilename(), PATHINFO_FILENAME);

      $translations = require $file->getPathname();

      if (!is_array($translations)) {
        throw new RuntimeException(
          "Translation file {$file->getFilename()} must return an array."
        );
      }

      foreach ($translations as $key => $value) {
        // Skip invalid values early
        if (!is_string($key) || (!is_string($value) && !is_numeric($value))) {
          continue;
        }

        $allTranslations[] = [
          'locale'      => $locale,
          'key'         => $key,
          'value'       => (string) $value,
          'is_default'  => $locale === 'en',
          'created_at'  => $now,
          'updated_at'  => $now,
        ];
      }
    }

    if (empty($allTranslations)) {
      $this->command->warn('No valid translations to insert.');
      return;
    }

    foreach (array_chunk($allTranslations, 1000) as $chunk) {
      DB::table('translations')->upsert(
        $chunk,
        ['locale', 'key'],
        ['value', 'is_default', 'updated_at']
      );
    }

    $this->command->info(count($allTranslations) . ' translations seeded successfully.');
  }
}
