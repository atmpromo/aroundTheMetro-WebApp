/* eslint-disable max-len, brace-style, no-mixed-spaces-and-tabs, comma-dangle, no-var, guard-for-in, new-cap, camelcase */
/**
 * @fileOverview
 * Contains an example of jQuery autocomplete combobox.  It is presented AS IS.
 * We are not responsible for its function.  The developer is free to use it or not.
 */


jQuery(function()
{
  (function( jQuery ) {
    jQuery.widget( 'ui.combobox', {
      _create: function() {
        var input,
          that = this,
          wasOpen = false,
          placeholder_text = this.element.attr('placeholder') || '',
		  select = this.element.hide(),
          selected = select.children( ':selected' ),
          value = selected.val() ? selected.text() : '',
          wrapper = this.wrapper = jQuery( '<span>' )
            .addClass( 'ui-combobox' )
            .insertAfter( select );

        function removeIfInvalid( element ) {
          var value = jQuery( element ).val(),
            matcher = new RegExp( '^' + jQuery.ui.autocomplete.escapeRegex( value ) + '$', 'i' ),
            valid = false;
          select.children( 'option' ).each(function() {
            if ( jQuery( this ).text().match( matcher ) ) {
              this.selected = valid = true;
              return false;
            }
          });

          if ( !valid && value != '') { // Only show for non empty value.
            // remove invalid value, as it didn't match anything
            jQuery( element )
              .val( '' )
              .attr( 'title', value + " didn't match any item" )
              .tooltip( 'open' );
            select.val( '' );
            setTimeout(function() {
              input.tooltip( 'close' ).attr( 'title', '' );
            }, 2500 );
            input.data( 'ui-autocomplete' ).term = '';
          }
        }

        input = jQuery( '<input>' )
          .appendTo( wrapper )
          .val( value )
          .attr( 'title', '' )
          .addClass( 'ui-state-default ui-combobox-input' )
          .attr('placeholder', placeholder_text)
		  .autocomplete({
            delay: 0,
            minLength: 0,
            source: function( request, response ) {
              var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), 'i' );
              response( select.children( 'option' ).map(function() {
                var text = jQuery( this ).text();
                if ( this.value && ( !request.term || matcher.test(text) ) )
                  return {
                    label: text.replace(
                      new RegExp(
                        "(?![^&;]+;)(?!<[^<>]*)(" +
                        jQuery.ui.autocomplete.escapeRegex(request.term) +
                        ")(?![^<>]*>)(?![^&;]+;)", 'gi'
                      ), "<strong>$1</strong>" ),
                    value: text,
                    option: this
                  };
              }) );
            },
            select: function( event, ui ) {
              ui.item.option.selected = true;
              that._trigger( 'selected', event, {
                item: ui.item.option
              });
            },
            change: function( event, ui ) {
              if ( !ui.item ) {
                removeIfInvalid( this );
              }
            }
          })
          .addClass( 'ui-widget ui-widget-content ui-corner-left' )
          // input.data( 'ui-autocomplete' ).term
          // keypress
          // added from
          // http://blog.ov3rk1ll.com/2012/03/jquery-ui-autocomplete-combobox-pick-1st-item-with-enter-key/#.UTTYuaU9arc

          .keypress(function(event) {
              //	console.log('keypress0 '+event.which);
	          	if (event.which == 13)
	          	{
	          		var t = input.data( 'ui-autocomplete' ).term;
	          		if (jQuery('ul.ui-autocomplete').is(':visible'))
	          		{
						var li = $('li.ui-menu-item:first')[0];
						var item = $(li).data('uiAutocompleteItem');// $(li).data('item.autocomplete');
						input.data('ui-autocomplete').options.select(event, {item: item});
	          		}
	          		else
	          		{
						var li = $('li.ui-menu-item:first')[0];
						var item = $(li).data('uiAutocompleteItem');// $(li).data('item.autocomplete');
						input.data('ui-autocomplete').options.select(event, {item: item});
	          		}
				}
			});

        input.data( 'ui-autocomplete' )._renderItem = function( ul, item ) {
          return jQuery( '<li>' )
            .append( '<a>' + item.label + '</a>' )
            .appendTo( ul );
        };

        /* jQuery( '<a>' )
			;
jQuery( '#place-reset' ).click(function() {
jQuery('#place-combobox-input').focus().val('');
jQuery('#place-combobox').focus().val('');
});*/

        jQuery( '<a>' )
          .attr( 'tabIndex', -1 )
          .attr( 'title', 'Clear' )
          .tooltip()
          .appendTo( wrapper )
          .button({
            icons: {
              primary: 'ui-icon-close'
            },
            text: false
          })
          .removeClass( 'ui-corner-all' )
          .addClass( 'ui-corner-right ui-combobox-clear' )
          .click(function() {
            input.focus().val('');
			select.val('');
               that._trigger( 'cleared', event, {});

            // close if already visible
            /* if ( wasOpen ) {
              return;
            }

            // pass empty string as value to search for, displaying all results
            input.autocomplete( 'search', '' );*/
          });

        jQuery( '<a>' )
          .attr( 'tabIndex', -1 )
          .attr( 'title', 'Show All Items' )
          .tooltip()
          .appendTo( wrapper )
          .button({
            icons: {
              primary: 'ui-icon-triangle-1-s'
            },
            text: false
          })
          .removeClass( 'ui-corner-all' )
          .addClass( 'ui-corner-right ui-combobox-toggle' )
          .mousedown(function() {
            wasOpen = input.autocomplete( 'widget' ).is( ':visible' );
          })
          .click(function() {
            input.focus();

            // close if already visible
            if ( wasOpen ) {
              return;
            }

            // pass empty string as value to search for, displaying all results
            input.autocomplete( 'search', '' );
          });

        input.tooltip({
          tooltipClass: 'ui-state-highlight'
        });

        input.attr( 'id', jQuery(select).attr( 'id' )+'-input' );
      },

      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
/*
  jQuery(function() {
    jQuery( '#place-combobox' ).combobox();
    jQuery( '#routeto-combobox' ).combobox();
    jQuery( '#routefrom-combobox' ).combobox();
 //    jQuery( '#combobox2' ).combobox();
 // //   jQuery( '#combobox' ).bind('comboboxselected',function(a,b,c){alert('change');});
 //    jQuery( '#combobox2' ).bind('comboboxselected',function(event,data,c){
 //      alert('change2 '+data.item.value);
 //    });
 //    jQuery( '#toggle' ).click(function() {
 //      jQuery( '#combobox' ).toggle();
//    });
    jQuery( '#select' ).click(function() {
      var jc = jQuery( '#combobox' )[0];
      var opt = jc[jc.selectedIndex];
      alert('selected '+ opt.value);

    });
    jQuery( '#reset' ).click(function() {
      jQuery('#combobox-input').focus().val('');
      jQuery('#combobox').focus().val('');
 // jQuery('.ui-autocomplete-input').focus().val('');
//      jc.val('');

    });
  });

  jQuery(function() {

    jQuery('#combobox2').append('<option value='Perl'>Perl</option>');
    jQuery('#combobox').append('<option value='Perl'>Perl</option>');
  });
*/
});
