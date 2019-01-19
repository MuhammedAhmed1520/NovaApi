<?php

namespace App\Helper;

use Illuminate\Http\Request;

trait UploaderHelper
{
  /**
   * upload file through $request, Compress it.
   * to the server in public folder: /public/images/{categoryNameFolder}.
   * if_not_exist : create it with 775 permission.
   *
   * @param Request $request
   * @return string
   */
    public function imageUpload($image) {

        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/');
        $image->move($destinationPath, $name);
        return $name;
    }

  public function uploadFile($fileFromRequest,$fileFolder){
    
    $fileName = time().'.'.$fileFromRequest->getClientOriginalExtension();
    $location = public_path('files/'. $fileFolder . '/');
    $fileFromRequest->move($location, $fileName);

    return $fileName;

}

  /**
   * Call upload() func to upload photo album.
   *
   * @param [type] $photos
   * @return void
   */
  public function uploadAlbum($photos)
  {
    foreach ($photos as $album) {
      $imageName = $this->upload($album, 'cars');
      $car_photos[] = $imageName;
    }
    return $car_photos;
  }
}
