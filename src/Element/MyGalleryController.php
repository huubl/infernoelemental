<?php

namespace Inferno\InfernoElemental\Element;


    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Core\Extension;
    use SilverStripe\View\Requirements;

    class MyGalleryController extends Extension
    {
        public function onAfterInit() {

            Requirements::set_write_js_to_body(true);

            Requirements::css("opticinferno/infernoelemental:client/lightgallery/dist/css/lg-fb-comment-box.css");
            Requirements::css("opticinferno/infernoelemental:client/lightgallery/dist/css/lg-transitions.css");
            Requirements::css("opticinferno/infernoelemental:client/lightgallery/dist/css/lightgallery.css");

            Requirements::javascript("opticinferno/infernoelemental:client/lightgallery/dist/js/ajax-jqeury.js");
            Requirements::javascript("opticinferno/infernoelemental:client/lightgallery/dist/js/picturefill.js");

            Requirements::javascript("opticinferno/infernoelemental:client/lightgallery/dist/js/lightgallery-all.js");
            Requirements::javascript("opticinferno/infernoelemental:client/lightgallery/lib/jquery.mousewheel.min.js");
            Requirements::javascript("opticinferno/infernoelemental:client/lightgallery/lib/picturefill.min.js");




        }

}
