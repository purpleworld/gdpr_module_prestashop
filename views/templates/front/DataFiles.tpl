<form>
    {foreach from=$file_name item=name}
        <div class="checkbox">
            <label>
                <input type="checkbox">{$name['data_file_name']}
            </label>
        </div>
    {/foreach}
    <button type="submit" class="btn btn-default">Submit</button>
</form>