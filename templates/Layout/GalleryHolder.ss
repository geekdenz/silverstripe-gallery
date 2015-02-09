<h1>$Title</h1>
<div class="galleryholder-content">
	 $Content
</div>
<% loop Children %>
	<h2><a href="$Link">$Title</a></h2>
	<div class="galleryholder-content">
		$Content
	</div>
	<article>
		<% loop OrderedImagesLimited %>
			<a class="fancybox" data-fancybox-group="gallery" href="$ResizedFilename" title="$Caption">
				$Half
			</a>
		<% end_loop %>
	</article>
	<div class="galleryholder-morelink">
		<a href="$Link">More ...</a>
	</div>
<% end_loop %>