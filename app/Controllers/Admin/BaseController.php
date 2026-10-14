<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController as AppBaseController;
use App\Models\SettingModel;

abstract class BaseController extends AppBaseController
{
    protected $data = [];

    /**
     * Initialize controller, check authentication, and load shared data.
     *
     * @param \CodeIgniter\HTTP\RequestInterface  $request
     * @param \CodeIgniter\HTTP\ResponseInterface $response
     * @param \Psr\Log\LoggerInterface            $logger
     *
     * @return void
     */
    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        helper('text');

        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
            redirect()->to('/login')->send();
            exit;
        }

        $settingModel = new SettingModel();
        $this->data['site_name'] = $settingModel->get('site_name') ?? 'SekolahKu';

        $this->data['user'] = [
            'userId'   => session()->get('userId'),
            'username' => session()->get('username'),
            'fullName' => session()->get('fullName'),
            'role'     => session()->get('role'),
        ];
    }

    /**
     * Restrict access to controllers/actions based on the authenticated role.
     * This is server-side authorization; hiding menu items alone is not sufficient.
     */
    protected function requireRoles(array $allowedRoles, string $redirectTo = '/admin/dashboard'): void
    {
        $role = (string) session()->get('role');
        if (! in_array($role, $allowedRoles, true)) {
            redirect()->to($redirectTo)
                ->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk membuka halaman ini.')
                ->send();
            exit;
        }
    }

    /**
     * Validate and re-encode an uploaded image before placing it in a public upload directory.
     * Limits apply before GD decoding to reduce memory-exhaustion risk. The original upload
     * is never copied directly, which strips trailing non-image payloads from accepted files.
     *
     * @return string|null Generated safe filename, or null when validation/storage fails.
     */
    protected function storeValidatedImage($file, string $relativeDirectory, int $maxWidth, int $maxBytes = 8388608): ?string
    {
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $fileSize = (int) $file->getSize();
        if ($fileSize < 1 || $fileSize > $maxBytes) {
            return null;
        }

        $tempPath = $file->getTempName();
        if (! $tempPath || ! is_file($tempPath)) {
            return null;
        }

        $info = @getimagesize($tempPath);
        if ($info === false || ! isset($info[0], $info[1], $info[2])) {
            return null;
        }

        [$sourceWidth, $sourceHeight, $type] = $info;
        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP];
        if (! in_array($type, $allowedTypes, true)
            || $sourceWidth < 1 || $sourceHeight < 1
            || $sourceWidth > 10000 || $sourceHeight > 10000
            || ($sourceWidth * $sourceHeight) > 16000000
            || $maxWidth < 1) {
            return null;
        }

        $loader = match ($type) {
            IMAGETYPE_JPEG => 'imagecreatefromjpeg',
            IMAGETYPE_PNG  => 'imagecreatefrompng',
            IMAGETYPE_WEBP => 'imagecreatefromwebp',
            default        => null,
        };
        $writer = match ($type) {
            IMAGETYPE_JPEG => 'imagejpeg',
            IMAGETYPE_PNG  => 'imagepng',
            IMAGETYPE_WEBP => 'imagewebp',
            default        => null,
        };

        if (! $loader || ! $writer || ! function_exists($loader) || ! function_exists($writer)
            || ! function_exists('imagecreatetruecolor') || ! function_exists('imagecopyresampled')) {
            return null;
        }

        $source = @call_user_func($loader, $tempPath);
        if (! $source) {
            return null;
        }

        $scale = min(1, $maxWidth / $sourceWidth);
        $targetWidth = max(1, (int) round($sourceWidth * $scale));
        $targetHeight = max(1, (int) round($sourceHeight * $scale));
        $target = @imagecreatetruecolor($targetWidth, $targetHeight);
        if (! $target) {
            imagedestroy($source);
            return null;
        }

        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_WEBP) {
            imagealphablending($target, false);
            imagesavealpha($target, true);
            $transparent = imagecolorallocatealpha($target, 0, 0, 0, 127);
            imagefilledrectangle($target, 0, 0, $targetWidth, $targetHeight, $transparent);
        }

        $copied = @imagecopyresampled(
            $target, $source, 0, 0, 0, 0,
            $targetWidth, $targetHeight, $sourceWidth, $sourceHeight
        );

        $relativeDirectory = trim($relativeDirectory, "/\\");
        $uploadPath = rtrim(FCPATH, "/\\") . DIRECTORY_SEPARATOR
            . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativeDirectory);
        if (! is_dir($uploadPath) && ! @mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {
            imagedestroy($source);
            imagedestroy($target);
            return null;
        }
        if (! is_writable($uploadPath) || ! $copied) {
            imagedestroy($source);
            imagedestroy($target);
            return null;
        }

        $filename = $this->buildSafeName($type);
        $destination = $uploadPath . DIRECTORY_SEPARATOR . $filename;
        $saved = match ($type) {
            IMAGETYPE_JPEG => @imagejpeg($target, $destination, 85),
            IMAGETYPE_PNG  => @imagepng($target, $destination, 8),
            IMAGETYPE_WEBP => @imagewebp($target, $destination, 85),
            default        => false,
        };

        imagedestroy($source);
        imagedestroy($target);

        if (! $saved || ! is_file($destination) || (int) @filesize($destination) < 1) {
            if (is_file($destination)) {
                @unlink($destination);
            }
            return null;
        }

        return $filename;
    }

    /**
     * Build a random file name whose extension is derived from the detected
     * image type, never from the client-supplied name.
     *
     * @param int $type An IMAGETYPE_* constant.
     *
     * @return string
     */
    protected function buildSafeName(int $type): string
    {
        $ext = match ($type) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG  => 'png',
            IMAGETYPE_WEBP => 'webp',
            default        => 'img',
        };

        return time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
    }
}
