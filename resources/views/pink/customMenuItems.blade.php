@foreach($items as $item)

            <li>
                <a href="{{ $item->url() }}">{{ $item->title }}</a>
                @if($item->hasChildren())
                    <ul class="sub-menu">
                        @include(env('THEME').'.customMenuItems', ['items'=>$item->children()]) <!--метод children возвращает дочерние елементы для конкретного родителя-->
                    </ul>
                @endif
            </li>

@endforeach