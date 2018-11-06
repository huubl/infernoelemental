<div class="element_content__content">
    <div class="container">
    <div class="row">

        <% loop $Blocks %>

            <div class="col-xs-12 $ColumnsWidth" style="background-color:#$BackgroundColor; color:#$TextColor; <% if $Padding %>padding:$Padding\px;<% else %>padding:0px;<% end_if %>">
            $Text

        </div>

        <% end_loop %>

    </div>
    </div>
</div>
