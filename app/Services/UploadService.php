<?php declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @return string
     * @throws \Exception
     */
    public function start(UploadedFile $file): string
    {
        $fileName = $file->hashName();
        $completedFile = $file->storeAs('news', $fileName, 'public');
        if (!$completedFile){
            throw new \Exception('Фаил не найден');
        }
        return $completedFile;
    }
}
