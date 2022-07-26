<% if $Menu(2).exists %>
	<% include SideBar %>
<% end_if %>

<div class="content-container col-xs-12 <% if $Menu(2).exists %>col-md-9 size3of4 lastUnit<% end_if %>">
    <article class="gallery-page">
        <h1>$Title</h1>
        <div class="content">$Content</div>
        <% if $PaginatedTestimonials %>
            <div id="Testimonials">
                <div class="row">
                    <% loop $PaginatedTestimonials %>
                        <div id="Testimonial$ID" class="testimonial col-md-4 <% if Image %>image<% end_if %>">
                            <% include ilateral\SilverStripe\Testimonials\Includes\Testimonial %>
                            <div class="clear"><!--  --></div>
                        </div>
                    <% end_loop %>
                </div>
                
                <% with $PaginatedTestimonials %>
                    <p>
                        <% if $MoreThanOnePage %>
                            <% if $NotFirstPage %>
                                <a class="prev" href="$PrevLink">Prev</a>
                            <% end_if %>
                            
                            <% loop $Pages %>
                                <% if $CurrentBool %>
                                    $PageNum
                                <% else %>
                                    <% if $Link %>
                                        <a href="$Link">$PageNum</a>
                                    <% else %>
                                        ...
                                    <% end_if %>
                                <% end_if %>
                            <% end_loop %>
                            
                            <% if $NotLastPage %>
                                <a class="next" href="$NextLink">Next</a>
                            <% end_if %>
                        <% end_if %>
                    </p>
                <% end_with %>
            </div>
        <% end_if %>
    </article>

    $Form
    $PageComments
</div>

