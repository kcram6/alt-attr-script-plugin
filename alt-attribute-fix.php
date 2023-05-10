<?php
/**
* Plugin Name: Empty Alt Tag Generator
* Plugin URI: https://hfbtechnologies.com/
* Description: Use the page title as the image's alt tag if it is empty in the media library or in the Divi settings.
* Version: 1.1
* Author: HFB Technologies
* Author URI: https://hfbtechnologies.com/
*/

function add_default_alt_to_images_js() {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Define the default alt text prefix with the page title
        var default_alt_prefix = document.title;

        // Get all <img> tags from the document
        var images = document.getElementsByTagName("img");

        // Loop through each <img> tag and add the default alt text if necessary
        for (var i = 0; i < images.length; i++) {
            var image = images[i];
            var alt = image.getAttribute("alt");
            var dataAlt = image.getAttribute("data-alt");
            var src = image.getAttribute("src");
            var filename = src.substring(src.lastIndexOf("/") + 1).split(".")[0].replace(/-/g, " ");
            var default_alt = default_alt_prefix + " - " + filename;

            if (!alt && !dataAlt) {
                image.setAttribute("alt", default_alt);
                image.setAttribute("data-alt", default_alt);
            } else if (alt === "" && dataAlt === "") {
                image.setAttribute("alt", default_alt);
                image.setAttribute("data-alt", default_alt);
            }
        }
    });
    </script>';
}

add_action( 'wp_footer', 'add_default_alt_to_images_js' );