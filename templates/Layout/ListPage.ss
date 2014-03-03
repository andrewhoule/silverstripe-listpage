<% if Content %>$Content<% end_if %>
<div class="list-content<% if ToggleEffect %> has-toggle<% else %> no-toggle<% end_if %>">
	<% if ListCategories %>
		<% loop ListCategories %>
			<div class="list-category">
				<h3 class="list-items-category"><a class="list-items-$ID">$Category</a></h3>
				<div class="list-items-wrap list-items-$ID">
					<% if Description %><p class="list-items-category-description">$Description</p><% end_if %>
					<% loop ListItems %>
						<div class="list-item">
							<% if PhotoSized %><img src="$PhotoSized(120).URL" class="list-img"><% end_if %>
							<p class="title"><a href="$Link">$Title</a></p>
							<% if Content %><p class="content">$Content</p><% end_if %>
						</div><!-- list-item -->
					<% end_loop %>
				</div><!-- list-items -->
			</div><!-- list-category -->
		<% end_loop %>
	<% end_if %>
	<% if UncategorizedListItems %>
		<div class="list-category">
			<h3 class="list-items-category">Other</h3>
			<div class="list-items-wrap list-items-$ID">
				<% loop UncategorizedListItems %>
					<div class="list-item">
						<% if PhotoSized %><img src="$PhotoSized(120).URL" class="list-img"><% end_if %>
						<p class="title"><a href="$Link">$Title</a></p>
						<% if Content %><p class="content">$Content</p><% end_if %>
					</div><!-- list-item -->
				<% end_loop %>
			</div><!-- list-items -->
		</div><!-- list-category -->
	<% end_if %>
	<% if BottomContent %>$BottomContent<% end_if %>
</div><!-- list-content -->