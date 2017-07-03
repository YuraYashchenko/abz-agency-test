<?php

namespace App;
use Illuminate\Http\Request;
use Image;
use Storage;

class ImageUpload
{
    protected $request;
    protected $employee;

    public function __construct(Request $request, Employee $employee)
    {
        $this->request = $request;
        $this->employee = $employee;
    }

    public function upload($width, $heigth)
    {
        if ($this->request->hasFile('avatar')) {
            $image = $this->makeImage($this->request->file('avatar'), $width, $heigth);

            Storage::disk('local')->put("public/avatars/{$this->employee->id}/avatar.jpeg", $image);
        }
    }

    protected function makeImage($file, $width, $heigth)
    {
        $image = Image::make($file)
            ->resize($width, $heigth, function($constraint) {
                $constraint->aspectRatio();
            });
        return $image->stream();
    }
}