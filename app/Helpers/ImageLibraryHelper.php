<?php

if ( ! function_exists('imageLibraryHtml') ) {
    function imageLibraryHtml($images)
    {
        $html = '';
        foreach ($images as $image) {
            $html .= '<li class="image-checkbox image-item" data-id='.$image->id.'>
                        <div class="image-item-wrapper">
                            <input type="checkbox" name="image_item" value="'.$image->id.'">
                            <img src="'.$image->image_path.'" alt="Image">
                        </div>
                    </li>';
        }

        return $html;
    }
}

?>

