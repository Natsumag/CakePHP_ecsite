<?php
namespace App\Utils;

use App\Controller\Admin\CategoriesController;
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
    public function file_upload($file = null,$dir = null, $limitFileSize = 1024 * 1024)
    {
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

            // ファイルタイプのチェックし、拡張子を取得
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

    public function edit_check_file($file_before, $beforeUploadPath, $uploadPath, $uploadFile, $limitFileSize = 1024 * 1024)
    {
        $category = new CategoriesController();
        try {
            // 古い画像ファイルの削除
            if ($file_before) {
                $delete_file = new File($beforeUploadPath . $file_before);
                if (!$delete_file->delete()) {
                    $category->log('ファイル更新時に下記のファイルが削除できませんでした。', LOG_DEBUG);
                    $category->log($file_before, LOG_DEBUG);
                }
            }
            // 更新処理
            AppUtility::file_upload($uploadFile, $uploadPath, $limitFileSize);
            $array = date('YmdHis') . $uploadFile['name'];
            return $array;
        } catch (RuntimeException $e) {
            $category->Flash->error(__('ファイルのアップロードができませんでした.'));
            $category->Flash->error(__($e->getMessage()));
        }
    }

}
