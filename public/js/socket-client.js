var auction = $('#auctionId').text();
var socket = io(':3001', {query: "auction_id=" + auction, secure: true, rejectUnauthorized : false});

$(document).on('submit', '.bet', function(e) {
	e.preventDefault();

	var form = $(this);
	var action = form.attr('action');
	var method = form.attr('method');

	var auctionId = $('.bet input[name=auction_id]').val();
	var userId = $('.bet input[name=user_id]').val();
	var userLogin = $('.bet input[type=hidden][name=user_login]').val();
	var bet = $('.bet-sum').val();
	var winUser = $('.bet input[type=hidden][name=user_login]').val();
	
	dataBet = {
		auctionId: auctionId,
		userId: userId,
		userLogin: userLogin,
		bet: bet,
		winUser: userLogin
	};

	$.ajax({
		url: action,
		type: method,
		data: {
	    	auction_id: auctionId,
	    	userId: userId,
	    	bet: bet		
		},
		success: function(response) {
			socket.emit('betRoom', dataBet);
			socket.emit('betsHome', dataBet);
		}, 
		error: function(e) {
			var error = $.parseJSON(e.responseText);
			$('.error-bet').text(error.message).show();
		}
	});
});

socket.on('betRoom', function(data) {
	$('.bet-sum').val(data['bet']);
	$('#lastBet').text(data['bet']);

	var betSum = accounting.formatNumber(data['bet'], {
		thousand : " "
	});

	$('.betCount').text(betSum);

	$('#history-bets').prepend(
		'<tr class="bet table-item user-bet-item" data-user-login="' + data['userLogin'] + '" data-user-id="' + data['userId'] + '">'+ 
			'<td class="table-align-left">' + data['userLogin'] + '</td>'+
			'<td class="table-align-right"><div class="user-bet-value" style="display: none;">' + data['bet'] + '</div><div class="user-bet"></div> руб.<span class="user-bet-count"></span></td>' +
		'</tr>'
	);

	userBetCount();
});

socket.on('betsHome', function(data) {
	var currentAuction = $('[data-auction-id="' + data['auctionId'] + '"]');
	var currentPrice = '[data-current-price]';
	var winUser = '[data-win-user]';
	var userId = '[data-user-id]';

	currentAuction.find(currentPrice).text(data['bet']);
	currentAuction.find(currentPrice).next('.card-lot-cost').text(accounting.formatNumber(currentAuction.find(currentPrice).text(), {
        thousand: " "
	}));

	currentAuction.find(winUser).attr('data-win-user', data['winUser']);
	currentAuction.find(userId).attr('data-user-id', data['userId']);
});
