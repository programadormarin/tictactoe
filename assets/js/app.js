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

        $('#table').data('player-piece', $(this).data('piece'));

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
        $(this).attr('data-piece', playerPice)
        $(this).html(playerPice);
        getComputerMove();
    });
}

function getComputerMove()
{
    callMoveAPI().done(function (jsonResponse) {
        if (jsonResponse.winner) {
            $('#table').find(`[data-piece='${jsonResponse.winner}']`).addClass('winner-' + jsonResponse.winner);
            return;
        }
        
        if (jsonResponse.nextMove.length) {
            var move = jsonResponse.nextMove;
            var boardMovement = $('#table').find(`[data-x='${move[0]}']` + `[data-y='${move[1]}']`);
            boardMovement.data('piece', move[2]);
            boardMovement.attr('data-piece', move[2]);
            boardMovement.html(move[2]);
        }
        
        if (jsonResponse.tied) {

        }
    }).fail(function () {
        alert('Sorry, we did can\'t play our move, try reset the game.' );
    });
}

/**
 * @return jqXHR
 */
function callMoveAPI()
{
    if (!$('#table').data('player-piece').length) {
        return;
    }

    var playerPice = $('#table').data('player-piece');
    var board = mountBoard();

    return $.ajax({
        url: '/api/move',
        type: "POST",
        data: JSON.stringify({boardState: board, playerUnit: playerPice}),
        contentType: "application/json; charset=utf-8",
        dataType: "json"
    });
}

/**
 * @return array[]
 */
function mountBoard()
{
    var board = [['', '', ''], ['', '', ''], ['', '', '']];

    $('#table').find('.row').each(function (line, row) {
        $(row).find('.col-4').each(function (column, item) {
            board[line][column] = $(item).data('piece');
        });
    });

    return board;
}