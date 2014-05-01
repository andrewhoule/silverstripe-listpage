<li class="list-item">
	<% if PhotoSized %><img src="$PhotoSized(120).URL" class="list-img"><% end_if %>
	<p class="title"><% if LinkExists %><a href="$Link">$Title</a><% else %><strong>$Title</strong><% end_if %></p>
	<% if Content %><p class="content">$Content</p><% end_if %>
</li><!-- list-item -->