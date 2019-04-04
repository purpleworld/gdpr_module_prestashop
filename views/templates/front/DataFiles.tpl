<div class="box">
    <h1 class="page-subheading">Data files</h1>
    <form>
        {foreach from=$file_name item=name}
            <div class="form-group">
                <label>{$name['data_file_name']}</label>
                <p>{$name['description']}</p>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="">
                        Allow
                    </label>
                </div>
            </div>
        {/foreach}

        <button type="submit" class="btn btn-default">Save</button>
    </form>
</div>
<ul class="footer_links clearfix">
    <li><a class="btn btn-default button button-small" href="#"><span>View Account Data</span></a></li>
</ul>