{capture name=path}
    <a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}">My account</a>
    <span class="navigation-pipe">{$navigationPipe}</span>
    <span class="navigation_page">Account Data</span>
{/capture}

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <h1 class="page-subheading">Orders</h1>
            <p>{$orders}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <h1 class="page-subheading">Abandoned Carts</h1>
            <p>{$abandonedCarts}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <h1 class="page-subheading">Total Visits</h1>
            <p>{$visits}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <h1 class="page-subheading">Total Addresses</h1>
            <p>{$addresses}</p>
        </div>
    </div>
</div>
<ul class="footer_links clearfix">
    <li><a class="btn btn-default button button-small" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}"><span><i class="icon-chevron-left"></i>Back to your account</span></a></li>
    <li><a class="btn btn-default button button-small" href="{$link->getModuleLink('gdpr', 'DataFiles')}"><span>View Data Files</span></a></li>
</ul>