@if ($category->slug)
    @if (count($category->children) > 0)
        <?php
            $name = $category->name;
            $locale = app()->getLocale();
            if ($category->translations && count($category->translations)) {
                foreach ($category->translations as $translation) {
                    if ($translation->locale == $locale) {
                        $name = $translation->name;
                    }
                }
            }

        ?>
        <li class="has-submenu">
            <a href="{{ url()->to('/') }}/{{ $category->translations[0]->url_path }}">{{ $name }} <i class="fa fa-{{ $category->parent_id == 1 ? 'angle-down' : 'angle-right' }}"></i></a> 
            <ul class="sub-menu">
                @foreach($category->children as $category)
                    @include('shop::partials.navlink', $category)
                @endforeach
            </ul>
        </li>
    @else
        <li><a href="{{ url()->to('/') }}/{{ $category->translations[0]->url_path }}">{{ $name }}</a></li>
    @endif
@endif