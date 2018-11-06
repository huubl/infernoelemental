


		  <!--- add slide class to animate --->
     <div id="myDesktopCarousel$ID" class="elemental-slider carousel slide" data-ride="carousel">

     <!--  <ol class="carousel-indicators">
		<% loop Banners %>
        <li data-target="#myDesktopCarousel$ID" data-slide-to="$Pos(0)" <% if $First %>class="active" <% else %>class="" <% end_if %>> <img src="$Banner.CroppedImage(1200,800).URL" alt="$AltTag" height="100px" width="100px" /></li>
       <% end_loop %>
      </ol> -->
      <div class="carousel-inner">
       <% loop Banners %>
        <div class="carousel-item <% if $First %>active<% end_if %>">
         <% if $LinkPage.Link !='' %>
          <a href="$LinkPage.Link"><% else %><% end_if %>
		<img src="$Banner.URL" alt="$AltTag" width="100%"  />

		<% if $LinkPage.Link !='' %></a><% end_if %>

        </div>
        <% end_loop %>
      </div>
      <% loop Banners %>
       <% if $TotalItems > 1 %>
      <a class="carousel-control-prev" href="#myDesktopCarousel$ElementSliderExtension.ID" data-target="#myDesktopCarousel$ElementSliderExtension.ID" role="button" data-slide="prev">
        <!--<span class="carousel-control-prev-icon icon-span-$ElementSliderExtension.ID" aria-hidden="true"></span>-->
		<span class="fa fa-angle-left icon-span-$ElementSliderExtension.ID"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myDesktopCarousel$ElementSliderExtension.ID" data-target="#myDesktopCarousel$ElementSliderExtension.ID" role="button" data-slide="next">
        <!--<span class="carousel-control-next-icon icon-span-$ElementSliderExtension.ID" aria-hidden="true"></span>-->
		<span class="fa fa-angle-right icon-span-$ElementSliderExtension.ID"></span>
        <span class="sr-only">Next</span>
      </a>
      <% end_if %>
      <% end_loop %>

		<style>
			.icon-span-$ID{color:#$IconColor !important;}
			.icon-span-$ID:hover{color:darken(#$IconColor,10%) !important;}
		</style>

    </div>

    <br>
		   <br>
