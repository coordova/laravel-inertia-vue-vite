<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->resource);
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,

            /*--------------------------------------------------------*/
            // en caso de requerir los datos relacionados con un modelo (tabla) ej: posts del usr
            // 'posts' => $this->posts,
            // o si es que tenemos una clase PostResource, asi como lo hicimos con UserResource
            // 'posts' => PostResources::collection($this->whenLoaded('posts')),
            /*--------------------------------------------------------*/

            'can' => [
                'edit' => Auth::user()->can('edit', $this->resource)
            ],
            'links' => [
                'profile_path' => url('/profile/' . $this->id)
            ],/*
            'user_links' => [
                'edit' => url('/users/'.$this->id.'/edit')
            ]*/
            /*$this->mergeWhen(Auth::user()->is($this->resource), [
                'email' => $this->email
            ])*/
        ];
    }
}
