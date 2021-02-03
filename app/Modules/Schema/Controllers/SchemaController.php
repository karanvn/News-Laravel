<?php


namespace App\Modules\Schema\Controllers;

use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Modules\Product\Models\Category;
use App\Modules\Banner\Models\Banner;
use App\Libraries\Upload;

use App\Modules\Schema\Models\Schema;
use App\Modules\Product\Models\Feature;
use App\Modules\Branch\Models\Branch;
use App\Modules\Log\Libraries\LibActivityLog;
use App\Modules\Log\Models\ActivityLog;
use App\Modules\Partner\Models\Partner;

class SchemaController extends SiteController
{
    function __construct()
    {
        $this->schema = new Schema();
        $this->up = new Upload();
    }

    public function index(Request $request){
        $filters = [
            'status' => @$request->get('status'),
        ];

        $params = array_merge($filters, ['limit' => 12]);
        $schema = $this->schema->get_schemas($params);
        return view('Schema::index', [
            'schema' => $schema]);
    }

    public function add(){
        return view('Schema::add');
    }
   
    public function postadd(Request $request){

        $data = $request->all();
        $source_path = '/Schema';

        foreach ($request->image as $value) {
            $result  = $this->up->doUpload($source_path, $value, '', [], true);
            $hinhs[] = $result['name'];
        }

        $json = '{
            "@context": "'.$request->context.'",
            "@type": "'.$request->type.'",
            "image": [';
                $i = 1;
                foreach($hinhs as $hinh){
                    if($i==1){
                        $json=$json.'"'.$hinh.'"';
                    }else{
                        $json=$json.',"'.$hinh.'"';
                    }
                    $i++;
                }
                $json .= '],
            "@id": "'.$request->id.'",
            "name": "'.$request->name.'",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "'.$request->streetAddress.'",
                "addressLocality": "'.$request->addressLocality.'",
                "addressRegion": "'.$request->addressRegion.'",
                "postalCode": "'.$request->postalCode.'",
                "addressCountry": "'.$request->addressCountry.'"
            },
            "review": {
                "@type": "Review",
                "reviewRating": {
                "@type": "Rating",
                "ratingValue": "'.$request->ratingValue.'",
                "bestRating": "'.$request->bestRating.'"
                },
                "author": {
                "@type": "Person",
                "name": "'.$request->authorname.'"
                }
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": '.$request->latitude.',
                "longitude": '.$request->longitude.'
            },
            "url": "'.$request->url.'",
            "telephone": "'.$request->telephone.'",
            "servesCuisine": "'.$request->servesCuisine.'",
            "priceRange": "VND",
            "openingHoursSpecification": [
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": [';
                        $i = 1;
                        foreach($request->dayOfWeek as $day){
                            if($i==1){
                                $json=$json.'"'.$day.'"';
                            }else{
                                $json=$json.',"'.$day.'"';
                            }
                            $i++;
                        }
                    $json .= '],
                    "opens": "'.$request->opens.'",
                    "closes": "'.$request->closes.'"
                }
            ],
        "menu": "http://www.example.com/menu",
        "acceptsReservations": "True"
        }
        ';
        // echo $json;
        $this->schema->type = '1';
        $this->schema->value = $json;
        $this->schema->save();

        return redirect()->route('Schema')->with(['message'=>'Thêm schema thành công']);

    }

    
}
