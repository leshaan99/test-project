<?php
class ImageController
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    public function uploadImage(array $file, string $targetDir): string
    {
        try {
            // Validate input
            if (!isset($file['error']) || is_array($file['error'])) {
                throw new RuntimeException('Invalid file parameters');
            }

            // Check for upload errors
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file uploaded');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit');
                default:
                    throw new RuntimeException('Unknown upload error');
            }

            // Verify file size
            if ($file['size'] > 5_000_000) { // 5MB limit
                throw new RuntimeException('Exceeded filesize limit');
            }

            // Create target directory
            $this->createDirectory($targetDir);

            // Validate image
            $imageInfo = getimagesize($file['tmp_name']);
            if (!$imageInfo || !in_array($imageInfo['mime'], self::ALLOWED_MIME_TYPES)) {
                throw new RuntimeException('Invalid file type');
            }

            // Generate secure filename
            $extension = $this->getExtensionFromMime($imageInfo['mime']);
            $filename = $this->generateFilename($extension);

            // Move uploaded file
            if (!move_uploaded_file($file['tmp_name'], $targetDir . $filename)) {
                throw new RuntimeException('Failed to move uploaded file');
            }

            return $filename;
        } catch (RuntimeException $e) {
            // Log error here if needed
            return '';
        }
    }

    public function resizeImage(array $file, string $targetDir, int $width, int $height): string
    {
        try {
            $tempFile = $file['tmp_name'];
            $originalName = $file['name'];

            // Basic validation
            if (!is_uploaded_file($tempFile)) {
                throw new RuntimeException('Invalid file upload');
            }

            $imageInfo = getimagesize($tempFile);
            if (!$imageInfo) {
                throw new RuntimeException('Invalid image file');
            }

            $this->createDirectory($targetDir);

            $extension = $this->getExtensionFromMime($imageInfo['mime']);
            $filename = $this->generateFilename($extension);

            // Process image
            $resizedImage = $this->processImage(
                $tempFile,
                $imageInfo,
                $width,
                $height
            );

            // Save resized image
            $this->saveImage($resizedImage, $imageInfo['mime'], $targetDir . $filename);

            // Clean up resources
            imagedestroy($resizedImage);

            return $filename;
        } catch (RuntimeException $e) {
            // Log error here if needed
            return '';
        }
    }

    private function processImage(
        string $filePath,
        array $imageInfo,
        int $targetWidth,
        int $targetHeight
    ) {
        [$originalWidth, $originalHeight] = $imageInfo;

        $sourceImage = $this->createImageResource($filePath, $imageInfo['mime']);
        $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);

        // Preserve transparency for PNG/GIF
        $this->preserveTransparency($resizedImage, $imageInfo['mime']);

        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0, 0, 0, 0,
            $targetWidth,
            $targetHeight,
            $originalWidth,
            $originalHeight
        );

        imagedestroy($sourceImage);
        return $resizedImage;
    }

    private function createImageResource(string $filePath, string $mimeType)
    {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagecreatefromjpeg($filePath);
            case 'image/png':
                return imagecreatefrompng($filePath);
            case 'image/gif':
                return imagecreatefromgif($filePath);
            default:
                throw new RuntimeException('Unsupported image type');
        }
    }

    private function saveImage($imageResource, string $mimeType, string $filePath): void
    {
        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($imageResource, $filePath, 85);
                break;
            case 'image/png':
                imagepng($imageResource, $filePath, 9);
                break;
            case 'image/gif':
                imagegif($imageResource, $filePath);
                break;
            default:
                throw new RuntimeException('Unsupported image type');
        }
    }

    private function preserveTransparency($image, string $mimeType): void
    {
        if ($mimeType === 'image/png' || $mimeType === 'image/gif') {
            imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, false);
            imagesavealpha($image, true);
        }
    }

    private function generateFilename(string $extension): string
    {
        return bin2hex(random_bytes(8)) . '_' . time() . '.' . $extension;
    }

    private function getExtensionFromMime(string $mimeType): string
    {
        $mimeMap = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif'
        ];

        return $mimeMap[$mimeType] ?? 'bin';
    }

    private function createDirectory(string $path): void
    {
        if (!is_dir($path) && !mkdir($path, 0755, true) && !is_dir($path)) {
            throw new RuntimeException("Failed to create directory: $path");
        }
    }
}

//Usage information

// require_once 'ImageController.php';

// // Example 1: Basic File Upload
// try {
//     $imageController = new ImageController();
    
//     // Handle profile picture upload
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
//         $uploadDir = __DIR__ . '/uploads/profile_pictures/';
//         $uploadedFile = $imageController->uploadImage(
//             $_FILES['profile_picture'],
//             $uploadDir
//         );

//         if ($uploadedFile) {
//             echo "Upload successful! File: " . htmlspecialchars($uploadedFile);
//         } else {
//             echo "Upload failed!";
//         }
//     }
// } catch (Exception $e) {
//     error_log('Image upload error: ' . $e->getMessage());
//     echo "An error occurred during upload.";
// }

// // Example 2: Upload with Resizing
// try {
//     $imageController = new ImageController();
    
//     // Handle product image upload with thumbnail creation
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['product_image'])) {
//         $baseDir = __DIR__ . '/uploads/products/';
        
//         // Original upload
//         $originalImage = $imageController->uploadImage(
//             $_FILES['product_image'],
//             $baseDir . 'originals/'
//         );

//         if ($originalImage) {
//             // Create resized version
//             $resizedImage = $imageController->resizeImage(
//                 $_FILES['product_image'],
//                 $baseDir . 'resized/',
//                 800,
//                 600
//             );
            
//             echo "Original: {$originalImage}<br>";
//             echo "Resized: {$resizedImage}<br>";
            
//             // Create thumbnail
//             $thumbnail = $imageController->resizeImage(
//                 $_FILES['product_image'],
//                 $baseDir . 'thumbnails/',
//                 200,
//                 200
//             );
            
//             echo "Thumbnail: {$thumbnail}<br>";
//         }
//     }
// } catch (Exception $e) {
//     error_log('Image processing error: ' . $e->getMessage());
//     echo "An error occurred during image processing.";
// }

// // Example 3: Full Form Handling
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $imageController = new ImageController();
//         $uploadDir = __DIR__ . '/uploads/' . date('Y/m/d') . '/';
        
//         if (!empty($_FILES['main_image']['name'])) {
//             $mainImage = $imageController->uploadImage(
//                 $_FILES['main_image'],
//                 $uploadDir
//             );
            
//             if ($mainImage) {
//                 $previewImage = $imageController->resizeImage(
//                     $_FILES['main_image'],
//                     $uploadDir . 'previews/',
//                     400,
//                     300
//                 );
//             }
//         }
        
//         // Handle other form data...
//         // $title = $_POST['title'] ?? '';
        
//         // Save to database or process further...
//     } catch (Exception $e) {
//         error_log('Form processing error: ' . $e->getMessage());
//         echo "Error: " . htmlspecialchars($e->getMessage());
//     }
// }
 

// <!-- HTML Form Example -->
// <!DOCTYPE html>
// <html>
// <head>
//     <title>Image Upload Example</title>
// </head>
// <body>
//     <!-- Simple Upload Form -->
//     <form method="POST" enctype="multipart/form-data">
//         <h2>Upload Profile Picture</h2>
//         <input type="file" name="profile_picture" accept="image/*">
//         <button type="submit">Upload</button>
//     </form>

//     <!-- Complex Form with Multiple Images -->
//     <form method="POST" enctype="multipart/form-data">
//         <h2>Product Submission</h2>
        
//         <label>Main Image:
//             <input type="file" name="product_image" accept="image/*">
//         </label>
        
//         <label>Additional Images:
//             <input type="file" name="additional_images[]" multiple accept="image/*">
//         </label>
        
//         <button type="submit">Submit</button>
//     </form>
// </body>
// </html>