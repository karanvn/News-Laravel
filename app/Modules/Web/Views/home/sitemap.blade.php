@php
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
    $domain = $protocol . $_SERVER['HTTP_HOST'] . '/';  
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>{{$domain}}</loc>
        <lastmod>2020-11-26T04:08:10+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    @foreach ($cateParents as $item)
    <url>
        <loc>{{route('optimize_slug', ['alias1'=>$item->slug . '.html'])}}</loc>
        <lastmod>{{ $item->created_at }}</lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach

    @foreach ($cateParents as $key => $val) 
        @if ($val->parent_id == 0)
            @php
                $menuchild = $category->where('parent_id',$val->id);
            @endphp
            @foreach ($menuchild as $key => $value)
                <url>
                    <loc>{{route('optimize_slug', ['alias1'=>$val->slug, 'alias2'=>$value->slug . '.html'])}}</loc>
                    <lastmod>{{ $value->created_at }}</lastmod>
                    <priority>0.80</priority>
                </url>
            @endforeach
        @endif
    @endforeach

    @foreach ($products as $key => $value)
        @if(!empty($value->categories))
            @php
                $cate = $value->categories()->first();
            @endphp
            @if (!empty($cate->parent))
                @php
                    $alias1 = $cate->parent->slug;
                    $alias2 = $cate->slug;
                    $alias3 = $value->slug;
                @endphp
                <url>
                    <loc>{{route('optimize_slug', ['alias1'=>$alias1, 'alias2'=>$alias2, 'alias3' => $alias3])}}</loc>
                    <lastmod>{{ $value->created_at }}</lastmod>
                    <priority>0.80</priority>
                </url>
            @endif
        @endif
    @endforeach
                
    @foreach ($blogs as $item)
        @php
            $alias1 = @$item->category->parent->slug;
            $alias2 = @$item->category->slug;
            $alias3 = @$item->slug;
        @endphp
        <url>
            <loc>{{ route('optimize_slug',['alias1' => $alias1, 'alias2' => $alias2, 'alias3' => $alias3]) }}</loc>
            <lastmod>{{ $item->created_at }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>