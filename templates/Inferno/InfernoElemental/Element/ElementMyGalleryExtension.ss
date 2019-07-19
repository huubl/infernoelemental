<head>
<style>
    .gal-style{
        margin: 5px;
        border: 5px white solid;
        border-radius: 15px;
        box-shadow: 0px 4px 14px -7px #000000;

        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .gal-style:hover {
        -moz-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

</style>
</head>
<div class="container">


    <div class="d-none d-lg-block">
        <div id="lightgallery" class="row">
            <% loop $MyGalleryImages %>

                <a  href="$Image.URL" data-sub-html="$Description">

                        <img class="gal-style" src="$Image.Fill($Up.WidthHeight,$Up.WidthHeight).URL" alt="$Tilte"/>

                </a>

            <% end_loop %>
        </div>
    </div>



    <div class="d-block d-lg-none">
        <div id="lightgallery2" class="row">
            <% loop $MyGalleryImages %>

                <div class="col-md-4 col-6" href="$Image.URL" data-sub-html="$Description">
                    <img class="gal-style" src="$Image.Fill(250,250).URL" alt="$Tilte"/>
                </div>
            <% end_loop %>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightgallery").lightGallery();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightgallery2").lightGallery();
        });
    </script>

    <%--<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>--%>
</div>