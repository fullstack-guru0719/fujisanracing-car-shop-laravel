<div class="subcategories">
    @foreach ($category->children as $subcategory)
    <a class="subcategory" href="/{{ $subcategory->url_path }}" style="
            @if($subcategory->image_url != '')
                background-image: url({{ $subcategory->image_url }});
            @else
                background: rgba(0,0,0,0.5);
            @endif
            ">
        <div class="name">{{ $subcategory->name }}</div>
    </a>
    @endforeach
</div>
