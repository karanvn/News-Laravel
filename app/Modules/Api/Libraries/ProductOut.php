<?php

namespace App\Modules\Api\Libraries;

class ProductOut
{

    function __construct()
    {
        $this->statuses = get_api_statuses();
    }

    public function products($products, $filter = []) {
        if(count($products) > 0){
            $result = [];
            foreach($products as $product){
                $result[] = $this->form_product($product);
            }

            return [
                'success' => true,
                'currentPage' => $products->currentPage(),
                'total' => $products->total(),
                'perPage' => $products->perPage(),
                'lastPage' => $products->lastPage(),
                'urlPage' => url('').'/api/products?page='.$products->currentPage().$filter,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.product.product.msg.product_id')
            ];
        }
    }

    public function categories($categories = []) {
        if(count($categories) > 0){
            $result = [];
            foreach($categories as $category){
                $result[] = $this->form_category($category);
            }
            return [
                'success' => true,
                'data' => $result
            ];
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.product.categories.msg.category_id')
            ];
        }
    }


    public function product($product) {
        if(!empty($product)){
            if($product->status == 'A'){
                $form_product =  $this->form_product($product);
                return [
                    'success' => true,
                    'data' => $form_product
                ];
            }else{
                return [
                    'success' => false,
                    'msg' => trans('Api::api.user.msg.empty')
                ];
            }
        }else{
            return [
                'success' => false,
                'msg' => trans('Api::api.user.msg.empty')
            ];
        }
    }

    public function form_product($product){
        if (!empty($product)) {
            $thumb_image_path = config('product.image.product.thumb_path') . (!empty($product->parent_product_id) ? $product->parent_product_id : $product->product_id);
            $source_image_path = config('product.image.product.source_path') . (!empty($product->parent_product_id) ? $product->parent_product_id : $product->product_id);

            $images = $product->images()->orderBy('position', 'asc')->get();
            $result_images = [];
            $avatar = "";
            if(count($images) > 0){
                $avatar = url('') .'/'. show_banner($thumb_image_path, $images->first()->image_path);
                foreach($images as $image){
                    $result_images[] = $this->form_image($image, $source_image_path, $thumb_image_path);
                }
            }

            $results =  [
                'product_id' => $product->product_id,
                'product_code' => $product->product_code,
                'product_name' => @$product->name,
                'product_short_name' => @$product->short_name,
                'product_slug' => @$product->slug,
                'org_price' => (int)$product->org_price,
                'price' => (int)$product->price,
                'avatar' => $avatar,
                'qty' => $product->qty,
                'created_at' => date('d-m-Y H:i:s', strtotime($product->created_at)),
                'description' => $product->description,
                'note' => $product->note,
                'status' => $product->status,
                'status_name' => @$this->statuses[$product->status],
                'seo' => [
                    'name' => $product->seo_name,
                    'slug' => $product->seo_slug,
                    'keywords' => $product->seo_keywords,
                    'link' => $product->seo_link,
                    'description' => $product->seo_description
                ]
            ];

            $skus = $product->skus()->where('status', 'A')->get();
            $result_skus = [];
            if(count($skus) > 0){
                foreach($skus as $sku){
                    $form_sku = $this->form_sku($sku);
                    $sku_images = $sku->images()->orderBy('position', 'asc')->get();
                    if(count($sku_images) > 0){
                        foreach($sku_images as $img){
                            $form_sku['images'][] = $this->form_image($img, $source_image_path, $thumb_image_path);
                        }
                    }else{
                        $form_sku['images'] = [];
                    }
                    $result_skus[] = $form_sku;
                }
            }

            $result_categories = [];
            $categories = $product->categories()->get();
            if(count($categories) > 0){
                foreach($categories as $category){
                    $result_categories[] = $this->form_category($category);
                }
            }

            $result_banners = [];
            $current = date('Y-m-d H:i:s');
            $banners = $product->banners()->where('published_start', '<=', $current)->where('published_end', '>=', $current)->where(['status' => 'A', 'type' => 'PRODUCT'])->orderBy('position', 'asc')->get();
            if(count($banners) > 0){
                foreach($banners as $banner){
                    $result_banners[] = $this->form_banner($banner);
                }
            }

            $results['images'] = $result_images;
            $results['sku'] = $result_skus;
            $results['categories'] = $result_categories;
            $results['banners'] = $result_banners;

            return $results;
        }
        return [];
    }


    public function form_image($image, $image_path, $thumb_path){
        return [
            'id' => $image->id,
            'name' => !empty($image->name) ? $image->name : "",
            'width' => $image->image_width,
            'height' => $image->image_height,
            'position' => $image->position,
            'avatar' => url('') .'/'. show_banner($image_path, $image->image_path),
            'thumb' => url('') .'/'. show_banner($thumb_path, $image->image_path)
        ];
    }

    public function form_sku($sku){
        return [
            'product_id' => $sku->product_id,
            'product_code' => $sku->product_code,
            'product_name' => $sku->name,
            'product_short_name' => $sku->short_name,
            'product_slug' => $sku->slug,
            'org_price' => (int)$sku->org_price,
            'price' => (int)$sku->price
        ];
    }

    public function form_category($category){
        $results = [
            'id' => $category->id,
            'name' => $category->name,
            'parent_id' => $category->parent_id,
            'slug' => $category->slug,
            'description' => $category->description,
            'seo_name' => $category->seo_name,
            'seo_description' => $category->seo_description,
            'avatar' => url('') .'/'. show_image(config('product.image.category.thumb_path'), @$category->avatar)
        ];

        $current = date('Y-m-d H:i:s');
        $banners = $category->banners()->where('published_start', '<=', $current)->where('published_end', '>=', $current)->where(['status' => 'A', 'type' => 'CATEGORY'])->orderBy('position', 'asc')->get();
        $result_banners = [];
        if(count($banners) > 0){
            foreach($banners as $banner){
                $result_banners[] = $this->form_banner($banner);
            }
        }

        $results['banners'] = $result_banners;

        return $results;

    }

    public function form_banner($banner){
        return [
            'id' => $banner->id,
            'name' => $banner->name,
            'type' => $banner->type,
            'object_id' => $banner->object_id,
            'link' => $banner->link,
            'published_start' => $banner->published_start,
            'published_end' => $banner->published_end,
            'position' => $banner->position,
            'extension' => $banner->extension,
            'avatar' => url('').'/'.show_image(config('banner.image.org_path'), $banner->avatar)
        ];
    }
}
