<?php

namespace Zix\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Zix\Core\Http\Requests\Admin\Gallery\GalleryDestroyRequest;
use Zix\Core\Http\Requests\Admin\Gallery\GalleryShowRequest;
use Zix\Core\Http\Requests\Admin\Gallery\GalleryStoreRequest;
use Zix\Core\Http\Requests\Admin\Gallery\GalleryUpdateRequest;
use Zix\Core\Http\Resources\Admin\GalleryResource;
use Zix\Core\Models\Gallery;

/**
 * Class GalleryController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Gallery
 */
class GalleryController
{
    /**
     * GalleryController constructor.
     * @param Gallery $model
     */
    public function __construct(Gallery $model)
    {
        $this->model = $model;
    }


    /**
     * @param GalleryShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GalleryShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param GalleryShowRequest $request
     * @param Gallery $gallery
     * @return GalleryResource
     */
    public function show(GalleryShowRequest $request, Gallery $gallery)
    {
        return new GalleryResource($gallery);
    }

    /**
     * @param GalleryStoreRequest $request
     * @return GalleryResource
     */
    public function store(GalleryStoreRequest $request)
    {
        return new GalleryResource($this->model->create($request->input()));
    }

    /**
     * @param GalleryUpdateRequest $request
     * @param Gallery $gallery
     * @return GalleryResource
     */
    public function update(GalleryUpdateRequest $request, Gallery $gallery)
    {
        $gallery->update($request->input());
        return new GalleryResource($gallery);
    }

    /**
     * @param GalleryDestroyRequest $request
     * @param Gallery $gallery
     * @return GalleryResource
     * @throws \Exception
     */
    public function destroy(GalleryDestroyRequest $request, Gallery $gallery)
    {
        $gallery->delete();
        return new GalleryResource($gallery);
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     * @return GalleryResource
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function uploadImages(Request $request, Gallery $gallery)
    {
        if ($request->has('items')) {
            foreach ($request->file('items') as $image) {
                $gallery->addMedia($image)->toMediaCollection('images');
            }
        }
        return new GalleryResource($gallery);
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     * @param $image_id
     * @return GalleryResource
     */
    public function deleteImage(Request $request, Gallery $gallery, $image_id)
    {
        $gallery->getMedia('images')->find($image_id)->delete();
        $gallery = Gallery::find($gallery->id);
        return new GalleryResource($gallery);
    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     * @param $image_id
     * @return GalleryResource
     */
    public function updateImage(Request $request, Gallery $gallery, $image_id)
    {
        $media = $gallery->getMedia('images')->find($image_id);
        $media->setCustomProperty('title', $request->get('title'));
        $media->save();

        $gallery = Gallery::find($gallery->id);
        return new GalleryResource($gallery);
    }


}