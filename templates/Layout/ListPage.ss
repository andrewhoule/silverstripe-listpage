<% if $Content %>$Content<% end_if %>
<div class="list-content<% if $ToggleEffect %> has-toggle<% if $StartToggleClosed %> start-closed-toggle<% else %> start-open-toggle<% end_if %><% else %> no-toggle<% end_if %><% if $ToggleEffectItems %> has-list-items-toggle<% else %> no-list-items-toggle<% end_if %>">
	<% if $ListCategories %>
		<% loop ListCategories %>
			<div class="list-category">
				<h3 class="list-items-category">
					<% if $Top.ToggleEffect %>
						<a class="list-items-$ID">$Category</a>
					<% else %>
						$Category
					<% end_if %>
				</h3>
				<ul class="list-items-wrap list-items-$ID">
					<% if $Description %><div class="list-items-category-description">$Description</div><% end_if %>
					<% loop ListItems %>
						<% include ListItems %>
					<% end_loop %>
				</ul><!-- list-items -->
			</div><!-- list-category -->
		<% end_loop %>
	<% end_if %>
	<% if $UncategorizedListItems %>
		<div class="list-category">
			<% if $MoreThanOneListCategory %>
				<h3 class="list-items-category">
					<% if $Top.ToggleEffect %>
						<a class="list-items-$ID">Other</a>
					<% else %>
						Other
					<% end_if %>
				</h3>
			<% end_if %>
			<ul class="list-items-wrap list-items-$ID">
				<% loop UncategorizedListItems %>
					<% include ListItems %>
				<% end_loop %>
			</ul><!-- list-items -->
		</div><!-- list-category -->
	<% end_if %>
</div><!-- list-content -->
<% if $BottomContent %>$BottomContent<% end_if %>