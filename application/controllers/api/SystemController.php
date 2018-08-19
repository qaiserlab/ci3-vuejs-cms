<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemController extends MY_Controller {

  public function readConfig() {
    $this->success('DATA_READ', [
      'baseUrl' => base_url(),
      'apiKey' => $this->config->item('api_key'),
    ]);
  }

  private function mkUniqFileName($fileName) {
    $xFileName = explode('.', $fileName);

    $fileFirstName = $xFileName[0];
    $fileExtension = $xFileName[count($xFileName) - 1];

    $uniqFileName = $fileFirstName.'-'.uniqid().'.'.$fileExtension;

    return $uniqFileName;
  }

  public function upload() {
    $this->authen(AT_FREE);

    $fileActive = $_FILES["fileActive"];

    $archivesDir = 'writable/archives';
    $targetDir = 'writable/tmp';

    $targetFile = $fileActive['name'];

    $archivesPath = $archivesDir.'/'.$targetFile;
    $targetPath = $targetDir.'/'.$targetFile;

    if (file_exists($archivesPath) || file_exists($targetPath)) {

      $targetFile = $this->mkUniqFileName($targetFile);
      $targetPath = $targetDir.'/'.$targetFile;
    }

    $targetUrl = base_url($targetPath);

    if (move_uploaded_file($fileActive["tmp_name"], $targetPath))
      $this->success('FILE_UPLOADED', [
        'file' => $targetFile,
        'path' => $targetPath,
        'url' => $targetUrl,
      ]);
    else
      $this->failed('UPLOAD_FAILED');
  }

  public function uploadAndStore() {
    $this->authen(AT_FREE);

    $fileActive = $_FILES["fileActive"];
    $targetDir = 'writable/archives';
    $targetFile = $fileActive['name'];

    $targetPath = $targetDir.'/'.$targetFile;

    if (file_exists($targetPath)) {

      $targetFile = $this->mkUniqFileName($targetFile);
      $targetPath = $targetDir.'/'.$targetFile;
    }

    $targetUrl = base_url($targetPath);

    if (move_uploaded_file($fileActive["tmp_name"], $targetPath))
      $this->success('FILE_UPLOADED', [
        'file' => $targetFile,
        'path' => $targetPath,
        'url' => $targetUrl,
      ]);
    else
      $this->failed('UPLOAD_FAILED');
  }

}
