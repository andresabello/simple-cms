<div class="container">
    <div class="row">
        <div class="col-md-12">
            <breadcrumbs :home="{url: '/', name: 'Inicio'}" :current="{{ $page->name }}"></breadcrumbs>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h1>Contactanos</h1>
            <div itemscope="" itemtype="http://schema.org/LocalBusiness">
                <span itemprop="name">comprasenusaonline.com</span><br>
                <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                    <span itemprop="streetAddress">11512 Terra Bella BLVD.</span><br>
                    <span itemprop="addressLocality">Plantation</span>, <span itemprop="addressRegion">FL</span>
                    <span itemprop="postalCode">33325</span><br>
                    <span itemprop="telephone">(954) 210-0001</span><br>
                    <a href="mailto:info@comprasenusaonline.com" itemprop="email">
                        ayuda@comprasenusaonline.com</a><br>
                    <a href="{{ config('app.url') }}" itemprop="url">{{ config('app.url') }}</a><br>
                    <time itemprop="openingHours" datetime="Mo-Fri">Monday-Friday, 9AM - 5PM EST</time>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="container">
                here is contact form
                <contact-form></contact-form>
            </div>
        </div>
    </div>
</div>