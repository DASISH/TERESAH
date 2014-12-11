@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    "Licens- och citeringsinformation"
)))

@section("content")
    <section class="row">
        <div class="small-12 medium-10 columns small-centered">
            <h1>Licens- och citeringsinformation</h1>

            <h2>Generellt</h2>

            <p>TERESAH använder olika licenser för källkod och för innehåll på hemsidan.</p>

            <h2>Licens för källkod</h2>

            <p>Licensen TERESAH använder sig av för källkod är <strong>European Union Public Licence v1.1</strong>. Mer information om licensen kan hittas <a href="license/source">här</a>.</p>

            <h2>License for content</h2>

            <p>Licensen TERESAH använder sig av för källkod är <strong>Creative Commons Attribution-ShareAlike 4.0 International</strong>. Mer information om licensen kan hittas <a href="license/content">här</a>.</p>
            
            <h2>Citera TERESAH i publikationer</h2>

            <p>För att citera TERESAH i publikationer använd:</p>
            
            <p><strong>DASISH (2014). TERESAH: Tools E-registry for E-Social Sciences And Humanities. URL: http://teresah.dasish.eu.</strong></p>
            
            <p>BibTex:</p>
            
            <p><strong>
            @Manual{,
                title = {TERESAH: Tools E-registry for E-Social Sciences And Humanities},
                author = {DASISH},
                organization = {DASISH},
                year = 2014,
                url = {http://teresah.dasish.eu}
            }
            </strong></p>
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
