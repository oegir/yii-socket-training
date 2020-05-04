(function(){
    const FIELD = '#field';
    let game = {};
    
    // Init WebSocket
    var webSocket = $.simpleWebSocket({ url: gameSocket });

    webSocket.listen(function(message) {
        game = message;
        fillField(message);
    });
    
    // Set elements listeners
    $(document).ready(function() {
        $.fn.editable.defaults.mode = 'inline';
        $(FIELD).editable({showbuttons: false, selector: 'span.editable'});

        if ((typeof gameId == 'undefined') || (! gameId)) {
            webSocket.send({command: 'sudoku/create'});
        } else {
            webSocket.send({
                command : 'sudoku/view',
                data: {
                    id : parseInt(gameId)
                }
            });
        }
    });
    
    /**
     * Fill play field
     * @param Object data
     */
    function fillField(data)
    {
        $(FIELD + ' tr').each(function (i) {
            let row = data.field[i];
            
            $(this).find('td').each(function (j) {
                let td = $(this);
                let span = $(this).find('span');
                
                if (span) {
                    $(span).remove();
                }
                
                let newSpan = $('<span/>').data('coordinates', {row: i, column: j});
                
                if (!row[j]) {
                    $(newSpan).editable({
                        showbuttons: false,
                        emptytext: '&nbsp;&nbsp;&nbsp;&nbsp;',
                        send: 'never',
                        unsavedclass: null,
                        success: function (response, newValue) {
                            newValue = parseInt(newValue);
                            const coordinates = $(this).data('coordinates');
                            game.field[coordinates.row][coordinates.column] = newValue;
                            webSocket.send({command: 'sudoku/update', data: game});
                        }
                    });
                } else {
                    $(newSpan).text(row[j]);
                    $(newSpan).data('value', row[j])
                }
                
                td.append(newSpan);
            });
        });
    }
    
})()

