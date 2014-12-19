@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    "License and citing information"
)))

@section("content")
    <section class="row">
        <div class="small-12 medium-10 columns small-centered">
            <h1>License and citing information</h1>

            <h2>General</h2>

            <p>TERESAH uses different licenses for source code and for the content on the website.</p>

            <h2>License for source code</h2>

            <p>The license for the source code of TERESAH is <strong>European Union Public Licence v1.1</strong>. More information about this license can be found <a href="license/source">here</a>.</p>

            <h2>License for content</h2>

            <p>The license for the content of TERESAH is <strong>Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International</strong>. More information about this license can be found <a href="license/content">here</a>.</p>

            <h2>Citing TERESAH in publications</h2>

            <p>To cite TERESAH in publications use:</p>
            
            <p><strong>King's College London, Swedish National Data Service, Finnish Social Science Data Archive, University of Tartu, Universitat Pompeu Fabra and CentERdata (2014). TERESAH: Tools E-registry for E-Social Sciences And Humanities. URL: https://github.com/DASISH/TERESAH.</strong></p>
            
            <p>A BibTex entry:</p>
            
            <p><strong>
            @Manual{,
                title = {TERESAH: Tools E-registry for E-Social Sciences And Humanities},
                author = {King's College London, Swedish National Data Service, Finnish Social Science Data Archive, University of Tartu, Universitat Pompeu Fabra and CentERdata},
                organization = {King's College London, Swedish National Data Service, Finnish Social Science Data Archive, University of Tartu, Universitat Pompeu Fabra and CentERdata},
                year = 2014,
                url = {https://github.com/DASISH/TERESAH}
            }
            </strong></p>
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
