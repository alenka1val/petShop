<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none">
    <ul>
        <form method="get" action="{{ route('product.index') }}" id="none">
            @csrf
            <li>
                <input type="hidden" name="animal" value="none">
                <a href="javascript:{}" onclick="document.getElementById('none').submit();"
                   class="w3-bar-item w3-button">All</a>
            </li>
        </form>
        <form method="get" action="{{ route('product.index') }}" id="dog">
            @csrf
            <li>
                <input type="hidden" name="animal" value="dog">
                <a href="javascript:{}" onclick="document.getElementById('dog').submit();"
                   class="w3-bar-item w3-button">Dog</a>
            </li>
        </form>
        <form method="get" action="{{ route('product.index', 'cat') }}" id="cat">
            @csrf
            <li>
                <input type="hidden" name="animal" value="cat">
                <a href="javascript:{}" onclick="document.getElementById('cat').submit();"
                   class="w3-bar-item w3-button">Cat</a>
            </li>
        </form>
        <form method="get" action="{{ route('product.index', 'fish') }}" id="fish">
            @csrf
            <li>
                <input type="hidden" name="animal" value="fish">
                <a href="javascript:{}" onclick="document.getElementById('fish').submit();"
                   class="w3-bar-item w3-button">Fish</a>
            </li>
        </form>
    </ul>
</div>
<script>
    $(function () {
        $(document).on('click', '.side-menu', function (e) {
            e.preventDefault();
            var el = $('.fa-bars:first'),
                iconCross = '<i class="fas fa-times"></i>',
                iconMenu = '<i class="fas fa-bars"></i>';
            if (el.length === 1) {
                $(el.replaceWith(iconCross));
                $('.main').css({"marginLeft": "200px"});
                $('.w3-sidebar').css({"width": "200px", "display": "block"});
            }
            if (el.length === 0) {
                el = $('.fa-times:first');
                $(el.replaceWith(iconMenu));
                $('.main').css("marginLeft", "0%");
                $('.w3-sidebar').css("display", "none");
            }
        })
    });
</script>
