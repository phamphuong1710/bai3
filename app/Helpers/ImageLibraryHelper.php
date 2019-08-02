<?php

if ( ! function_exists('listImageUser') ) {
    function listImageUser($images)
    {
        $listPath = [];
        foreach ($images as $image) {
            $listPath[$image->id] = $image->image_path;
        }
        $listPath = array_unique($listPath);

        return $listPath;
    }
}

if ( ! function_exists('imageLibraryHtml') ) {
    function imageLibraryHtml($images)
    {
        $html = '';
        foreach ($images as $image) {
            $html .= '<li class="image-checkbox image-item" data-src='.$image.'>
                        <div class="image-item-wrapper">
                            <input type="checkbox" name="image_item" value="'.$image.'">
                            <img src="'.$image.'" alt="Image">
                        </div>
                    </li>';
        }

        return $html;
    }
}

?>

