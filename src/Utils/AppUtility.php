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
        $category = new CategoriesController();
        try {
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            $file_up = true;
            if (!isset($file['error']) || is_array($file['error'])){
                $file_up = false;
                $message[] = '未定義、複数ファイル、破損攻撃です';
            }
            // エラーのチェック
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $file_up = false;
                    $message[] = 'ファイルはアップロードされませんでした。';
                case UPLOAD_ERR_INI_SIZE:
                    $file_up = false;
                    $message[] = 'ファイルは２Mより大きいためアップロードされませんでした。';
                case UPLOAD_ERR_FORM_SIZE:
                    $file_up = false;
                    $message[] = 'アップロードされたファイルは、HTML フォームで指定された MAX_FILE_SIZE を超えています。';
                default:
                    $file_up = false;
                    $message[] = 'Unknown errors.';
            }

            // ファイル情報取得
            $fileInfo = new File($file['tmp_name']);

            // ファイルサイズのチェック
            if ($fileInfo->size() > $limitFileSize) {
                $file_up = false;
                $message[] = 'Exceeded filesize limit.';
            }

            // ファイルタイプのチェックし、拡張子を取得
            if (false === $ext = array_search($fileInfo->mime(),
                    [
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ],
                    true)){
                $file_up = false;
                $message[] = 'Invalid file format.';
            }
            if ($file_up === false) {
                $conversion = implode(",", $message);
                $category->Flash->error(__($conversion));
//                return $file_up;
            }

            // ファイルの移動 move_uploaded_file()だと止まったときエラーが返せないため
            if (!@move_uploaded_file($file['tmp_name'], $dir)){
                $file_up = false;
                $message[] = 'ファイルの移動に失敗しました。';
            }

        } catch (RuntimeException $e) {
            $category->Flash->error(__('ファイルの更新に失敗しました。'));
            $category->Flash->error(__($e->getMessage()));
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
            $category->Flash->error(__('ファイルの更新に失敗しました。'));
            $category->Flash->error(__($e->getMessage()));
        }
    }

}
