<% if Image.exists %>
	<% with Image.ScaleWidth(112) %>
		<div class="image">	
			<img class="img-fluid" src="$URL" alt="$Title"/>
		</div>
	<% end_with %>
<% end_if %>

<div class="text">
	<blockquote>
		$Content
	</blockquote>
	<p class="cite">
		- $Name
		<% if $Name && $Business %>, <% end_if %>
		$Business
	</p>
</div>