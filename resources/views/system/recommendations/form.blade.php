<table class="eds04_01_search">
    <tbody>
            <td>
                <span class="form_title_a">投稿内容（＊）</span>
                @if($edit)
                {!! Form::select('ryouri_1_id', $dishes, null, ['class'=>'input_field_a', 'id'=>'combobox','placeholder'=>'選択してください']) !!}   
                {!! Form::hidden('date',isset($date) && !empty($date) ? $date : $recommendation->date  )!!}     
				@else
				{!! Form::select('ryouri_1_id', $dishes, null, ['class'=>'input_field_a', 'disabled'=>'disabled','placeholder'=>'選択してください']) !!} 
                @endif     
            </td>
        </tr>
    </tbody>
</table>
@push('custom_js')
	<script>
	$( function() {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "input_field_a dcustom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					
					.tooltip({
						classes: {
							"ui-tooltip": "ui-state-highlight"
						}
					}).focus(function() {
						$(this).autocomplete("search", "");
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", "キーワードに該当する料理がありません。" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});

		$( "#combobox" ).combobox();
	} );
	</script>
@endpush