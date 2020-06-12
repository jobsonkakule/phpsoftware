<?php
namespace App\Attachment;

use Intervention\Image\ImageManager;

class EntityAttachment {

    public static function upload ($entity, $sizes = [320, 1280], bool $square = false) {
        $image = $entity->getImage();
        if (empty($image) || $entity->shouldUpload() === false) {
            return;
        }
        $directory = $entity->getUploadPath();
        if (file_exists($directory) === false) {
            mkdir($directory, 0777, true);
        }
        if (!empty($entity->getOldImage())) {
            $formats = ['thumb', 'large'];
            foreach ($formats as $format) {
                $oldFile = $directory . DIRECTORY_SEPARATOR . $entity->getOldImage() . '_' . $format . '.jpg';
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }
        $filename = uniqid("", true);
        $manager = new ImageManager(['driver' => 'gd']);

        if ($square) {
            $manager
                ->make($image)
                ->fit($sizes[0])
                ->save($directory . DIRECTORY_SEPARATOR . $filename . '_thumb.jpg');

        } else {
            $manager
                ->make($image)
                ->resize($sizes[0], null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($directory . DIRECTORY_SEPARATOR . $filename . '_thumb.jpg');
        }
        $manager
            ->make($image)
            ->resize($sizes[1], null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($directory . DIRECTORY_SEPARATOR . $filename . '_large.jpg');
        $entity->setImage($filename);
    }

    public static function detach ($entity)
    {
        if (!empty($entity->getImage())) {
            $formats = ['thumb', 'large'];
            foreach ($formats as $format) {
                $file = $entity->getUploadPath() . DIRECTORY_SEPARATOR . $entity->getImage() . '_' . $format . '.jpg';
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

    }
}