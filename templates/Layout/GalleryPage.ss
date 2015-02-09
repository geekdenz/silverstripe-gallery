<h1>$Title</h1>
<article>
    $Content
</article>
<div class="gallery-images">
    <% loop OrderedImages %>
        <a class="fancybox" data-fancybox-group="gallery" href="$ResizedFilename" title="$Caption">
            $Half
        </a>
    <% end_loop %>
</div>
