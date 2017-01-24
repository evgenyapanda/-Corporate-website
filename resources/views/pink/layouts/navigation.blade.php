@if($menu)
    <div class="menu classic">
        <ul id="nav" class="menu">
            @include(env('THEME').'.customMenuItems', ['items'=>$menu->roots()]) <!--метод roots возвращает только родительские пункты меню-->
        </ul>
    </div>
@endif

