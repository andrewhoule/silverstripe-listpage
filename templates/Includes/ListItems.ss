<li class="list-item">
	<% if $ToggleEffectItems %>
		<p class="title"><a class="list-item-trigger">$Title</a></p>
	<% else %>
		<p class="title"><% if $LinkExists %><a href="$Link">$Title</a><% else %><strong>$Title</strong><% end_if %></p>
	<% end_if %>
	<div class="list-item-content">
		<% if $ToggleEffectItems %><% if $LinkExists %><a href="$Link">Download/View</a><% end_if %><% end_if %>
		<% if $PhotoSized %><img src="$PhotoSized(120).URL" class="list-img"><% end_if %>
		<% if $Content %>$Content<% end_if %>
	</div><!-- .list-item-content -->
</li><!-- list-item -->