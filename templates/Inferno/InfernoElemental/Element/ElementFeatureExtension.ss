<div class="element_content__content <% if Style %>element_content__$CssStyle<% end_if %>"  style="background-image: url($BackgroundImage.URL);background-position: $BackgroundImagePos;background-color: #$BackgroundColor;background-size: $BackgroundSize;color:#$TextColor;
<% if $PaddingOptions == 0 %>
<% if $Padding == "" %>padding: 20px !important; <% else %>padding-top:$Padding\px !important;padding-bottom:$Padding\px !important; <% end_if %><% end_if %>
<% if $PaddingOptions == 1 %>
padding-top:$TopPadding\px !important;
padding-right:$RightPadding\px !important;
padding-bottom:$BottomPadding\px !important;
padding-left:$LeftPadding\px !important;  																									<% end_if %>

<% if $MarginOptions == 0 %>margin:$Margin\px !important;
<% end_if %>
  <% if $MarginOptions == 1 %>
margin-top:$TopMargin\px !important;
margin-right:$RightMargin\px !important;
margin-bottom:$BottomMargin\px !important;
margin-left:$LeftMargin\px !important;
<% end_if %>
">
	<div class="container">


				$HTML



		<% include InfernoFeature/Feature/Features %>

	</div>
</div>
