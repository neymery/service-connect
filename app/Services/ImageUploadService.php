<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadAndResize(UploadedFile $file, string $directory, int $maxWidth = 800, int $maxHeight = 800): string
    {
        // Générer un nom unique pour le fichier
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;
        
        // Sauvegarder directement le fichier (sans redimensionnement pour éviter les dépendances)
        Storage::disk('public')->putFileAs($directory, $file, $filename);
        
        return $path;
    }
    
    public function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
