<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class MultipartRequest extends FormRequest
{
    /**
     * Return request fields normalized with storage paths for present files.
     *
     * @return array
     */
    public function storeFiles(array $paths = [])
    {
        $fields = $request->all();
        foreach ($fields as $name) {
            if (isset($paths[$name])) {
                if ($request->hasFile($name) && isset($paths[$name]['path'])) {
                    $file = $request->file($name);
                    if (isset($paths[$name]['name'])) {
                        $extension = $file->extension();
                        if (isset($paths[$name]['disk'])) {
                            $fields[$name] = $file->storeAs($paths[$name]['path'], $paths[$name]['name'] . ".{$extension}", $paths[$name]['disk']);
                        } else {
                            $fields[$name] = $file->storeAs($paths[$name]['path'], $paths[$name]['name'] . ".{$extension}");
                        }
                    } else if (isset($paths[$name]['disk'])) {
                        $fields[$name] = $file->store($paths[$name]['path'], $paths[$name]['disk']);
                    } else {
                        $fields[$name] = $file->store($paths[$name]['path']);
                    }
                } else if ($fields[$name] == 'DELETE') {
                    $fields[$name] = '';
                } else {
                    unset($fields[$name]);
                }
            }
        }
        return $fields;
    }
}