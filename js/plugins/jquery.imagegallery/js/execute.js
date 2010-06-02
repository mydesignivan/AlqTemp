var ImageGallery = new ClassImageGallery({
    selectorThumbs      : '#container-thumbs',
    selectorPreview     : '#thumb-preview',
    effect_slide        : true,
    step                : 1,
    json_definevar      : {
        href_img_thumb : 'name_thumb',
        href_img_full  : 'name'
    }
});