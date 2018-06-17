require('../scss/app.scss');

var $ = require('jquery');

$(function() {
    $('#table').hide();
    
    selectPlayerPiece();

    movement();
});

function selectPlayerPiece()
{
    $('.piece').on('click', 'button', function () {
        if ($('.btn-light').length) {
            return;
        }

        if ($(this).hasClass('btn-success')) {
            $('.btn-primary').addClass('disabled');
            $('.btn-primary').addClass('btn-light');
            $('.btn-primary').removeClass('btn-primary');
        } else {
            $('.btn-success').addClass('disabled');
            $('.btn-success').addClass('btn-light');
            $('.btn-success').removeClass('btn-success');
        }

        $('#table').data('player-piece', $(this).find('strong').html());

        $('#table').show(); 
    });
}

function movement()
{
    $('#table').on('click', '.tictactoe-cel', function () {
        var x = $(this).data('x');
        var y = $(this).data('y');
        var playerPice = $('#table').data('player-piece');

        $(this).data('piece', playerPice);
        $(this).html('<strong>' + playerPice + '</strong>');
    });
}