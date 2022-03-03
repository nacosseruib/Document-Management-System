@if(isset($showSearchBar) && $showSearchBar == 1)
    <div class="header-bottom-middle" style="width: 100%;">
        <div class="search-box">
            <form action="#">
                <input type="text" name="searchProduct" placeholder="Let's help you find what you're looking for..." style="width: 100%; padding: 1px 10px; padding-right: 10px; font-size:16px; border: 2px brown solid; background: #ffffff; color: #000000; border-radius: 0;" />
                <button type="submit" class="bg-brown"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
@endif
