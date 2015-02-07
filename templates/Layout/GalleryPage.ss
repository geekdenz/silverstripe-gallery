<h1>$Title</h1>
<article>
    $Content
</article>
<div class="gallery-images">
    <% loop OrderedImages %>
        <a class="fancybox" data-fancybox-group="gallery" href="$Filename" title="$Caption">
            $SetSize(250,250)
        </a>
    <% end_loop %>
</div>
