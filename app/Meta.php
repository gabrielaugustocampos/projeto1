<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_meta_tags';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var array
     */
    
    protected $fillable = ['id', 'name', 'content', 'ativo', 'tipo_meta', 'created_at', 'updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function save_image_meta($request):bool
    {
        if ($request->has('imagem')) {
            //salvar meta tag og:image
            $size = getimagesize($request->imagem);
            $meta_img = new Meta;
            $image = $request->file('imagem');
            $name = uniqid('img_') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imagens_meta');
            $image->move($destinationPath, $name);
            $meta_img->name = "og:image";
            $meta_img->content = $name;
            $meta_img->tipo_meta = 0;
            $meta_img->save();
            //salvar meta tag og:image:width
            $meta_img_width = new Meta;
            $meta_img_width->name = "og:image:width";
            $meta_img_width->content = $size[0];
            $meta_img_width->tipo_meta = 0;
            $meta_img_width->save();
            //salvar meta tag og:image:height
            $meta_img_height = new Meta;
            $meta_img_height->name = "og:image:height";
            $meta_img_height->content = $size[1];
            $meta_img_height->tipo_meta = 0;
            $meta_img_height->save();
            //salvar meta tag og:image:type
            $meta_img_type = new Meta;
            $meta_img_type->name = "og:image:type";
            $meta_img_type->content = $image->getClientOriginalExtension();
            $meta_img_type->tipo_meta = 0;
            $meta_img_type->save();
        }
        return true;
    }

    public function update_image_meta($request):bool
    {
        if ($request->has('imagem')) {
            //salvar meta tag og:image
            $size = getimagesize($request->imagem);
            $meta_img = Meta::where('name', 'og:image')->firstOrFail();
            $image = $request->file('imagem');
            $name = uniqid('img_') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/imagens_meta');
            $path = $destinationPath.DIRECTORY_SEPARATOR.$meta_img->content;
            if (file_exists($path)) {
                @unlink($path);
            }
            $image->move($destinationPath, $name);
            $meta_img->content = $name;
            $meta_img->save();
            //salvar meta tag og:image:width
            $meta_img_width = Meta::where('name', 'og:image:width')->firstOrFail();
            $meta_img_width->content = $size[0];
            $meta_img_width->save();
            //salvar meta tag og:image:height
            $meta_img_height = Meta::where('name', 'og:image:height')->firstOrFail();
            $meta_img_height->content = $size[1];
            $meta_img_height->save();
            //salvar meta tag og:image:type
            $meta_img_type = Meta::where('name', 'og:image:type')->firstOrFail();
            $meta_img_type->content = $image->getClientOriginalExtension();
            $meta_img_type->save();
        }
        return true;
    }

    public static function retorna_array($request):array
    {
        $array_templates = [
            1 => ["template_imagem", "og:image"],
            2 => ["template_texto", "keywords"],
            3 => ["template_texto", "og:site_name"],
            4 => ["template_texto", "author"],
            5 => ["template_texto", "title"],
            6 => ["template_texto", "og:locale"],
            7 => ["template_texto", "og:url"],
            8 => ["template_texto", ["description", "og:description"]],
        ];
        return $array_templates[$request->tipo_meta];
    }

}
