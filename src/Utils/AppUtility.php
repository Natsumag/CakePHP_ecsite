<?php
namespace App\Utils;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

/**
 * AppUtility.
 */
class AppUtility
{
    /*
     * Common function
     */
    public function file_upload($file = null,$dir = null, $limitFileSize = 1024 * 1024){
        try {

            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($file['error']) || is_array($file['error'])){
                throw new RuntimeException('Invalid parameters.');
            }

            // エラーのチェック
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // ファイル情報取得
            $fileInfo = new File($file['tmp_name']);

            // ファイルサイズのチェック
            if ($fileInfo->size() > $limitFileSize) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

//             ファイルタイプのチェックし、拡張子を取得
            if (false === $ext = array_search($fileInfo->mime(),
                    [
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ],
                    true)){
                throw new RuntimeException('aaaaInvalid file format.');
            }

            // ファイルの移動 move_uploaded_file()だと止まったときエラーが返せないため
            if (!@move_uploaded_file($file["tmp_name"], $dir)){
                throw new RuntimeException('Failed to move uploaded file.');
            }

        } catch (RuntimeException $e) {
            throw $e;
        }
    }

    public function file_exist($uploadFile) {
        if($uploadFile['error'] !== 0) {
            throw new RuntimeException('ファイルを選択してください。');
        }
    }

}
